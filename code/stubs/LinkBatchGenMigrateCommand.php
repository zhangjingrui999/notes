<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace LinkSoft\BaseFrame\Command\Common\Migrate;

use Hyperf\Command\Annotation\Command;
use Hyperf\Database\Commands\Migrations\BaseCommand;
use Hyperf\DbConnection\Db;
use Hyperf\Utils\Filesystem\Filesystem;
use Hyperf\Utils\Str;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputOption;
use Throwable;

/**
 * @Command()
 */
#[Command]
class LinkBatchGenMigrateCommand extends BaseCommand
{
    protected $name = 'linkMigrate:batchGen';

    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * 忽略的数据表
     * @var string[]
     */
    protected $ignoreTableList = ['migrations'];

    /**
     * Create a new migration install command instance.
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct('linkMigrate:batchGen');
        $this->setDescription('Reverse by table generate a new migration file');
        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Now we are ready to write the migration out to disk. Once we've written
        // the migration out, we will dump-autoload for the entire framework to
        // make sure that the migrations are registered by the class loaders.
        $this->writeMigration();
    }

    protected function getOptions(): array
    {
        return [
            ['path', null, InputOption::VALUE_OPTIONAL, 'The location where the migration file should be created'],
            ['realpath', null, InputOption::VALUE_NONE, 'Indicate any provided migration file paths are pre-resolved absolute paths'],
            ['ignore', null, InputOption::VALUE_OPTIONAL, 'The skipped data table'],
            ['reverseIgnore', null, InputOption::VALUE_NONE, 'Reverse the meaning of the parameter ignore'],
        ];
    }

    /**
     * Write the migration file to disk.
     */
    protected function writeMigration(): void
    {
        try {
            // 获取数据库表
            $fields = ['table_name', 'engine', 'table_collation', 'table_comment'];
            $fields = join(',', $fields);
            $tableList = Db::select(
                'SELECT ' . $fields . ' FROM `information_schema`.`tables` WHERE `table_schema` = ? AND `table_type` = \'BASE TABLE\'',
                [
                    $this->getDatabaseName()
                ]);

            // 脚本生成目录
            $path = $this->getMigrationPath();
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            $prefix = config('databases.default.prefix');
            foreach ($tableList as $tableItem) {
                if (is_object($tableItem)) {
                    $tableItem = obj_to_array($tableItem);
                }
                $realTableName = $tableItem['table_name'];
                if (strpos($realTableName, $prefix) === 0) {
                    $realTableName = substr($realTableName, strlen($prefix));
                }
                $scriptName = sprintf('create_%s_table', $realTableName);
                // 处理忽略表
                if ($this->isIgnoreTable($realTableName)) {
                    $this->info("<info>[INFO] Migration class {$this->getClassName($scriptName)} set ignore, skipped.</info>");
                    continue;
                }
                // 确保之前的脚本不存在，存在则跳过
                if (!$this->ensureMigrationDoesntAlreadyExist($scriptName)) {
                    $this->info("<info>[INFO] Migration class {$this->getClassName($scriptName)} Exists, skipped.</info>");
                    continue;
                }
                // 填充脚本内容
                $stub = $this->getStub();
                $stub = $this->populateStub($stub, $scriptName, $realTableName, $tableItem);
                // 写入文件
                $filePath = $path . '/' . $this->getDatePrefix() . '_' . $scriptName . '.php';
                $this->files->put($filePath, $stub);
                $this->info("<info>[INFO] Created Migration:</info> $filePath");
            }
            $this->info("<info>[INFO] Created Migration Done</info>");
        } catch (Throwable $e) {
            $this->error("<error>[ERROR] Created Migration Fail, Err:</error> {$e->getMessage()}");
        }
    }

    /**
     * Get the migration stub file.
     */
    protected function getStub(): string
    {
        return $this->files->get($this->stubPath() . '/create.stub');
    }

    /**
     * Get stub path
     * @return string
     */
    protected function stubPath(): string
    {
        return __DIR__ . '/stubs';
    }

    /**
     * Populate the place-holders in the migration stub.
     */
    protected function populateStub(string $stub, string $scriptName, string $realTableName, array $tableItem): string
    {
        $stub = str_replace('%DummyClass%', $this->getClassName($scriptName), $stub);
        $stub = str_replace('%DummyTable%', $realTableName, $stub);
        $stub = str_replace('%DummyComment%', sprintf('$table->comment(\'%s\');', $tableItem['table_comment']), $stub);
        // 填充字段信息
        [$columnContent, $incrKeyName] = $this->genColumn($tableItem);
        $stub = str_replace('%DummyContent%', $columnContent, $stub);
        // 填充索引信息
        $stub = str_replace('%DummyIndex%', $this->genIndex($tableItem, $incrKeyName), $stub);
        return $stub;
    }

    /**
     * 生成字段
     * @param array $tableItem
     * @return array
     */
    protected function genColumn(array $tableItem): array
    {
        $columnMap = [
            'tinyint'          => [
                'stub'      => '$table->tinyInteger(\'%s\', %s, %s)->default(%s)->nullable(%s)->comment(\'%s\');',
                'fieldList' => ['column_name', 'auto_increment', 'unsigned', 'column_default', 'is_nullable', 'column_comment']
            ],
            'smallint'         => [
                'stub'      => '$table->smallInteger(\'%s\', %s, %s)->default(%s)->nullable(%s)->comment(\'%s\');',
                'fieldList' => ['column_name', 'auto_increment', 'unsigned', 'column_default', 'is_nullable', 'column_comment']
            ],
            'mediumint'        => [
                'stub'      => '$table->mediumInteger(\'%s\', %s, %s)->default(%s)->nullable(%s)->comment(\'%s\');',
                'fieldList' => ['column_name', 'auto_increment', 'unsigned', 'column_default', 'is_nullable', 'column_comment']
            ],
            'int'              => [
                'stub'      => '$table->integer(\'%s\', %s, %s)->default(%s)->nullable(%s)->comment(\'%s\');',
                'fieldList' => ['column_name', 'auto_increment', 'unsigned', 'column_default', 'is_nullable', 'column_comment']
            ],
            'bigint'           => [
                'stub'      => '$table->bigInteger(\'%s\', %s, %s)->default(%s)->nullable(%s)->comment(\'%s\');',
                'fieldList' => ['column_name', 'auto_increment', 'unsigned', 'column_default', 'is_nullable', 'column_comment']
            ],
            'varchar'          => [
                'stub'      => '$table->string(\'%s\', %d)->default(%s)->nullable(%s)->comment(\'%s\');',
                'fieldList' => ['column_name', 'character_maximum_length', 'column_default', 'is_nullable', 'column_comment']
            ],
            'char'             => [
                'stub'      => '$table->char(\'%s\', %d)->default(%s)->nullable(%s)->comment(\'%s\');',
                'fieldList' => ['column_name', 'character_maximum_length', 'column_default', 'is_nullable', 'column_comment']
            ],
            'text'             => [
                'stub'      => '$table->text(\'%s\')->nullable(%s)->comment(\'%s\');',
                'fieldList' => ['column_name', 'is_nullable', 'column_comment']
            ],
            'float'            => [
                'stub'      => '$table->float(\'%s\', %d, %d)->default(%s)->nullable(%s)->comment(\'%s\');',
                'fieldList' => ['column_name', 'numeric_precision', 'numeric_scale', 'column_default', 'is_nullable', 'column_comment']
            ],
            'decimal'          => [
                'stub'      => '$table->decimal(\'%s\', %d, %d)->default(%s)->nullable(%s)->comment(\'%s\');',
                'fieldList' => ['column_name', 'numeric_precision', 'numeric_scale', 'column_default', 'is_nullable', 'column_comment']
            ],
            'unsigned_decimal' => [
                'stub'      => '$table->decimal(\'%s\', %d, %d)->unsigned()->default(%s)->nullable(%s)->comment(\'%s\');',
                'fieldList' => ['column_name', 'numeric_precision', 'numeric_scale', 'column_default', 'is_nullable', 'column_comment']
            ]
        ];

        // 填充字段部分
        $fields = ['table_name', 'column_name', 'column_default', 'is_nullable', 'data_type', 'character_maximum_length', 'character_octet_length', 'numeric_precision', 'numeric_scale', 'datetime_precision', 'character_set_name', 'collation_name', 'column_type', 'column_key', 'extra', 'column_comment'];
        $fields = join(',', $fields);
        $columnList = Db::select(
            'SELECT ' . $fields . ' FROM `information_schema`.`columns` WHERE `table_schema` = ? AND `table_name` = ? ORDER BY ORDINAL_POSITION',
            [
                $this->getDatabaseName(), $tableItem['table_name']
            ]);

        // 因为框架会把inc认定为主键，所以这里可能会产生一部分的主键索引，要传递到索引处理层
        $content = [];
        $incrKeyName = null;
        foreach ($columnList as $columnInfo) {
            if (is_object($columnInfo)) {
                $columnInfo = obj_to_array($columnInfo);
            }
            $columnInfo = $this->prepareColumnInfo($columnInfo);

            if (!isset($columnMap[$columnInfo['data_type']])) {
                throw new InvalidArgumentException(sprintf('An undefined data type %s was caught by table %s, review your data definition or refine the script', $columnInfo['data_type'], $columnInfo['table_name']));
            }
            // 判断是否产生了主键
            if (!empty($columnInfo['auto_increment']) && $columnInfo['auto_increment'] == 'true') {
                $incrKeyName = $columnInfo['column_name'];
            }
            // 填充脚本正文
            $replaceList = [];
            foreach ($columnMap[$columnInfo['data_type']]['fieldList'] as $fieldName) {
                $replaceList[] = $columnInfo[$fieldName];
            }
            $content[] = sprintf($columnMap[$columnInfo['data_type']]['stub'], ...$replaceList);
        }
        return [join(PHP_EOL . "\t\t\t", $content), $incrKeyName];
    }

    /**
     * 生成索引
     * @param array $tableItem
     * @param string|null $incrKeyName
     * @return string
     */
    protected function genIndex(array $tableItem, ?string $incrKeyName): string
    {
        $indexMap = [
            'primary'  => [
                'stub'      => '$table->primary([%s]);',
                'fieldList' => ['index_column']
            ],
            'btree'    => [
                'stub'      => '$table->index([%s], \'%s\');',
                'fieldList' => ['index_column', 'index_name']
            ],
            'unique'   => [
                'stub'      => '$table->unique([%s], \'%s\');',
                'fieldList' => ['index_column', 'index_name']
            ],
            'fulltext' => [
                'stub'      => '$table->fulltext([%s], \'%s\');',
                'fieldList' => ['index_column', 'index_name']
            ],
            'spatial'  => [
                'stub'      => '$table->spatialIndex([%s], \'%s\');',
                'fieldList' => ['index_column', 'index_name']
            ],
        ];
        // 填充字段部分
        $fields = ['table_name', 'non_unique', 'index_name', 'GROUP_CONCAT(column_name) as index_column', 'index_type'];
        $fields = join(',', $fields);
        $indexList = Db::select(
            'SELECT ' . $fields . ' FROM `information_schema`.`statistics` WHERE `table_schema` = ? AND `table_name` = ? GROUP BY table_name, index_name',
            [
                $this->getDatabaseName(), $tableItem['table_name']
            ]);
        $indexContent = [];
        foreach ($indexList as $indexInfo) {
            if (is_object($indexInfo)) {
                $indexInfo = obj_to_array($indexInfo);
            }
            $indexInfo = $this->prepareIndexInfo($indexInfo, $incrKeyName);
            if (empty($indexInfo)) {
                continue;
            }
            if (!isset($indexMap[$indexInfo['index_type']])) {
                throw new InvalidArgumentException(sprintf('An undefined index type %s was caught by table %s, review your data definition or refine the script', $indexInfo['index_type'], $indexInfo['index_name']));
            }
            $replaceList = [];
            foreach ($indexMap[$indexInfo['index_type']]['fieldList'] as $fieldName) {
                $replaceList[] = $indexInfo[$fieldName];
            }
            $indexContent[] = sprintf($indexMap[$indexInfo['index_type']]['stub'], ...$replaceList);
        }
        return join(PHP_EOL . "\t\t\t", $indexContent);
    }

    /**
     * 对 $columnInfo 的数据进行规范化处理
     * @param array $columnInfo
     * @return array
     */
    protected function prepareColumnInfo(array $columnInfo): array
    {
        $columnInfo['is_nullable'] = $columnInfo['is_nullable'] == 'NO' ? 'false' : 'true';
        $columnInfo['unsigned'] = 'false';
        $columnInfo['zerofill'] = 'false';
        $columnInfo['auto_increment'] = 'false';
        $columnTypeList = explode(' ', $columnInfo['column_type']);
        foreach ($columnTypeList as $columnType) {
            if ($columnType == 'unsigned') {
                $columnInfo['unsigned'] = 'true';
            }
            if ($columnType == 'zerofill') {
                $columnInfo['zerofill'] = 'true';
            }
        }
        $columnExtraList = explode(' ', $columnInfo['extra']);
        foreach ($columnExtraList as $columnExtra) {
            if ($columnExtra == 'auto_increment') {
                $columnInfo['auto_increment'] = 'true';
            }
        }

        // 由于框架原因，decimal的unsigned表示需要特殊处理，这里直接定义一个类型方便模板赋值
        if ($columnInfo['data_type'] == 'decimal' && $columnInfo['unsigned'] == 'true') {
            $columnInfo['data_type'] = 'unsigned_decimal';
        }

        // 对字段默认值尝试进行断言
        if (is_null($columnInfo['column_default'])) {
            $columnInfo['column_default'] = 'null';
        } else {
            // 注意这个一定不能和null放在一起，因为null也被处理成了一个字符串
            $stringTypeList = ['char', 'varchar'];
            if (in_array($columnInfo['data_type'], $stringTypeList)) {
                $columnInfo['column_default'] = sprintf('\'%s\'', $columnInfo['column_default']);
            }
        }
        return $columnInfo;
    }

    /**
     * 对 $indexInfo 的数据进行规范化处理
     * @param array $indexInfo
     * @param string|null $incrKeyName
     * @return array
     */
    protected function prepareIndexInfo(array $indexInfo, ?string $incrKeyName): array
    {
        $indexInfo['index_type'] = strtolower($indexInfo['index_type']);
        if ($indexInfo['non_unique'] == '0') {
            $indexInfo['index_type'] = 'unique';
        }
        if ($indexInfo['index_name'] == 'PRIMARY') {
            // 如果已存在自增主键
            if (null !== $incrKeyName) {
                if ($incrKeyName != $indexInfo['index_column']) {
                    throw new InvalidArgumentException('The script currently does not support handling compound primary keys with increment');
                }
                return [];
            }
            $indexInfo['index_type'] = 'primary';
        }
        $indexColumnList = explode(',', $indexInfo['index_column']);
        foreach ($indexColumnList as $key => $columnName) {
            $indexColumnList[$key] = sprintf('\'%s\'', $columnName);
        }
        $indexInfo['index_column'] = join(', ', $indexColumnList);
        return $indexInfo;
    }

    protected function isIgnoreTable(string $realTableName): bool
    {
        foreach ($this->ignoreTableList as $ignoreTableName) {
            if ($ignoreTableName == $realTableName) {
                return true;
            }
        }
        $userIgnoreList = $this->input->getOption('ignore');
        if (!empty($userIgnoreList)) {
            $userIgnoreList = explode(',', $userIgnoreList);
            $reverseIgnore = $this->input->getOption('reverseIgnore');
            if (empty($reverseIgnore)) {
                return in_array($realTableName, $userIgnoreList);
            } else {
                return !in_array($realTableName, $userIgnoreList);
            }
        }
        return false;
    }

    /**
     * @return string
     */
    protected function getDatabaseName(): string
    {
        return config('databases.default.database');
    }

    /**
     * Get the class name of a migration name.
     */
    protected function getClassName(string $name): string
    {
        return Str::studly($name);
    }

    /**
     * Get migration path (either specified by '--path' option or default location).
     *
     * @return string
     */
    protected function getMigrationPath()
    {
        if (!is_null($targetPath = $this->input->getOption('path'))) {
            return !$this->usingRealPath()
                ? BASE_PATH . '/' . $targetPath
                : $targetPath;
        }

        return parent::getMigrationPath();
    }

    /**
     * Ensure that a migration with the given name doesn't already exist.
     * @param string $name
     * @return bool
     */
    protected function ensureMigrationDoesntAlreadyExist(string $name): bool
    {
        $migrationPath = $this->getMigrationPath();
        if (!empty($migrationPath)) {
            $migrationFiles = $this->files->glob($migrationPath . '/*.php');

            foreach ($migrationFiles as $migrationFile) {
                $this->files->requireOnce($migrationFile);
            }
        }

        if (class_exists($this->getClassName($name))) {
            return false;
        }
        return true;
    }

    /**
     * Get the date prefix for the migration.
     */
    protected function getDatePrefix(): string
    {
        return date('Y_m_d_His');
    }
}
