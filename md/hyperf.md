[文档](https://hyperf.wiki/2.0/#/README)

### 1. 概述
    Hyperf 是基于 Swoole 4.5+ 实现的高性能、高灵活性的 PHP 协程框架，内置协程服务器及大量常用的组件，性能较传统基于 PHP-FPM 的框架有质的提升，提供超高性能的同时，也保持着极其灵活的可扩展性，标准组件均基于 PSR 标准 实现，基于强大的依赖注入设计，保证了绝大部分组件或类都是 可替换 与 可复用 的。
    框架组件库除了常见的协程版的 MySQL 客户端、Redis 客户端，还为您准备了协程版的 Eloquent ORM、WebSocket 服务端及客户端、JSON RPC 服务端及客户端、GRPC 服务端及客户端、Zipkin/Jaeger (OpenTracing) 客户端、Guzzle HTTP 客户端、Elasticsearch 客户端、Consul 客户端、ETCD 客户端、AMQP 组件、Apollo 配置中心、阿里云 ACM 应用配置管理、ETCD 配置中心、基于令牌桶算法的限流器、通用连接池、熔断器、Swagger 文档生成、Swoole Tracker、视图引擎、Snowflake 全局 ID 生成器 等组件，省去了自己实现对应协程版本的麻烦。
    Hyperf 还提供了 基于 PSR-11 的依赖注入容器、注解、AOP 面向切面编程、基于 PSR-15 的中间件、自定义进程、基于 PSR-14 的事件管理器、Redis/RabbitMQ 消息队列、自动模型缓存、基于 PSR-16 的缓存、Crontab 秒级定时任务、国际化、Validation 表单验证器 等非常便捷的功能，满足丰富的技术场景和业务场景，开箱即用。

### 2. 安装
#### 2.1 docker下开发
```shell script
    # 下载并运行 hyperf/hyperf 镜像，并将镜像内的项目目录绑定到宿主机的 [开发]目录
    docker run -v [开发]:/hyperf-skeleton -p 9501:9501 -it --entrypoint /bin/sh hyperf/hyperf:latest    

    # 镜像容器运行后，在容器内安装 Composer
    wget https://github.com/composer/composer/releases/download/1.8.6/composer.phar
    chmod u+x composer.phar
    mv composer.phar /usr/local/bin/composer
    # 将 Composer 镜像设置为阿里云镜像，加速国内下载速度
    composer config -g repo.packagist composer https://mirrors.aliyun.com/composer
    
    # 通过 Composer 安装 hyperf/hyperf-skeleton 项目
    composer create-project hyperf/hyperf-skeleton
    
    # 进入安装好的 Hyperf 项目目录
    cd hyperf-skeleton
    # 启动 Hyperf
    php bin/hyperf.php start
    
    # 停止进程
    kill pid
    # pid 来自 /runtime/hyper.pid
```

#### 2.2 本地
    Hyperf 对系统环境有一些要求，仅可运行于 Linux 和 Mac 环境下
    
    确保运行环境达到了以下的要求：
        PHP >= 7.2
        Swoole PHP 扩展 >= 4.5，并关闭了 Short Name
        OpenSSL PHP 扩展
        JSON PHP 扩展
        PDO PHP 扩展 （如需要使用到 MySQL 客户端）
        Redis PHP 扩展 （如需要使用到 Redis 客户端）
        Protobuf PHP 扩展 （如需要使用到 gRPC 服务端或客户端）

### 3. 路由
#### 3.1 路由文件(config/routes.php)
```php
<?php
    use Hyperf\HttpServer\Router\Router;
    
    // 此处代码示例为每个示例都提供了三种不同的绑定定义方式，实际配置时仅可采用一种且仅定义一次相同的路由
    
    // 设置一个 GET 请求的路由，绑定访问地址 '/get' 到 App\Controller\IndexController 的 get 方法
    Router::get('/get', 'App\Controller\IndexController::get');
    Router::get('/get', 'App\Controller\IndexController@get');
    Router::get('/get', [\App\Controller\IndexController::class, 'get']);
    
    // 设置一个 POST 请求的路由，绑定访问地址 '/post' 到 App\Controller\IndexController 的 post 方法
    Router::post('/post', 'App\Controller\IndexController::post');
    Router::post('/post', 'App\Controller\IndexController@post');
    Router::post('/post', [\App\Controller\IndexController::class, 'post']);
    
    // 设置一个允许 GET、POST 和 HEAD 请求的路由，绑定访问地址 '/multi' 到 App\Controller\IndexController 的 multi 方法
    Router::addRoute(['GET', 'POST', 'HEAD'], '/multi', 'App\Controller\IndexController::multi');
    Router::addRoute(['GET', 'POST', 'HEAD'], '/multi', 'App\Controller\IndexController@multi');
    Router::addRoute(['GET', 'POST', 'HEAD'], '/multi', [\App\Controller\IndexController::class, 'multi']);
```

#### 3.2 注间路由
##### 3.2.1 @AutoController
    @AutoController 为绝大多数简单的访问场景提供路由绑定支持，使用 @AutoController 时则 Hyperf 会自动解析所在类的所有 public 方法并提供 GET 和 POST 两种请求方式。
```php
<?php
    declare(strict_types=1);
    
    namespace App\Controller;
    
    use Hyperf\HttpServer\Contract\RequestInterface;
    use Hyperf\HttpServer\Annotation\AutoController;
    
    /**
     * @AutoController()
     */
    class IndexController
    {
        // Hyperf 会自动为此方法生成一个 /index/index 的路由，允许通过 GET 或 POST 方式请求
        public function index(RequestInterface $request)
        {
            // 从请求中获得 id 参数
            $id = $request->input('id', 1);
            return (string)$id;
        }
    }
```

##### 3.2.2 @Controller
    @Controller 注解用于表明当前类为一个 Controller 类，同时需配合 @RequestMapping 注解来对请求方法和请求路径进行更详细的定义
```php
<?php
    declare(strict_types=1);
    
    namespace App\Controller;
    
    use Hyperf\HttpServer\Contract\RequestInterface;
    use Hyperf\HttpServer\Annotation\Controller;
    use Hyperf\HttpServer\Annotation\RequestMapping;
    
    /**
     * @Controller(prefix="index")
     */
    class IndexController
    {
        // Hyperf 会自动为此方法生成一个 /index/index 的路由，允许通过 GET 或 POST 方式请求
        /**
         * @RequestMapping(path="index", methods="get,post")
         */
        public function index(RequestInterface $request)
        {
            // 从请求中获得 id 参数
            $id = $request->input('id', 1);
            return (string)$id;
        }
    }
```

#### 3.3 Service引用
##### 3.3.1 依赖自动注入
```php
<?php
    use App\Service\UserService;

    /**
     * @var UserService
     */
    private $userService;

    // 在构造函数声明参数的类型，Hyperf 会自动注入对应的对象或值
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
```

##### 3.3.2 @Inject注解注入
```php
<?php
    use App\Service\UserService;

    /**
     * @Inject()
     * @var UserService
     */
    private $userService;
```

### 4. 配置
#### 4.1 控制台输出
```php
    # config/config.php
    // 控制台DeBug输出
    LogLevel::DEBUG,
```

#### 4.2 代理类缓存
```php
    # config/config
    'scan_cacheable' => env('SCAN_CACHEABLE', false)

    # .env
    SCAN_CACHEABLE=true
```

### 5. 组件
#### 热更新
```shell script
    # 1. cmd 下载插件
    wget -O watch https://gitee.com/hanicc/hyperf-watch/raw/master/watch

    # 2. 启动监听
    php watch
    # 2. 启动监听并删除代理类缓存(./runtime/container)
    php watch -c

    # 3. 退出监听
    Control + C
```

##### 默认配置（打开watch文件，可自行修改）
```php
    # PHP Bin File PHP程序所在路径（默认自动获取）
    const PHP_BIN_FILE = 'which php';
    # Watch Dir 监听目录（默认监听脚本所在的根目录）
    const WATCH_DIR = __DIR__ . '/';
    # Watch Ext 监听扩展名（多个可用英文逗号隔开）
    const WATCH_EXT = 'php,env';
    # Exclude Dir 排除目录（不监听的目录，数组形式)
    const EXCLUDE_DIR = ['vendor', 'runtime', 'public'];
    # Entry Point File 入口文件
    const ENTRY_POINT_FILE = __DIR__ . '/bin/hyperf.php';
    # Start Command 启动命令
    const START_COMMAND = [ENTRY_POINT_FILE, 'start'];
    # PID File Path PID文件路径
    const PID_FILE_PATH = __DIR__ . '/runtime/hyperf.pid';
    # Scan Interval 扫描间隔（毫秒，默认2000）
    const SCAN_INTERVAL = 2000;
    # Console Color 控制台颜色
    const CONSOLE_COLOR_DEFAULT = "\033[0m";
    const CONSOLE_COLOR_RED = "\033[0;31m";
    const CONSOLE_COLOR_GREEN = "\033[0;32m";
    const CONSOLE_COLOR_YELLOW = "\033[0;33m";
    const CONSOLE_COLOR_BLUE = "\033[0;34m";
```

#### [Snowflake](https://hyperf.wiki/2.0/#/zh-cn/snowflake?id=snowflake)
```shell script
    # 1. 安装
    composer require hyperf/snowflake

    # 2. 配置文件
    php bin/hyperf.php vendor:publish hyperf/snowflake

    return [
        'begin_second' => MetaGeneratorInterface::DEFAULT_BEGIN_SECOND,
        RedisMilliSecondMetaGenerator::class => [
            // Redis Pool
            'pool' => 'default',
            // 用于计算 WorkerId 的 Key 键
            'key' => RedisMilliSecondMetaGenerator::DEFAULT_REDIS_KEY
        ],
        RedisSecondMetaGenerator::class => [
            // Redis Pool
            'pool' => 'default',
            // 用于计算 WorkerId 的 Key 键
            'key' => RedisMilliSecondMetaGenerator::DEFAULT_REDIS_KEY
        ],
    ];
```

##### 使用
```php
<?php
    use Hyperf\Snowflake\IdGeneratorInterface;
    use Hyperf\Utils\ApplicationContext;
    
    $container = ApplicationContext::getContainer();
    $generator = $container->get(IdGeneratorInterface::class);
    
    $id = $generator->generate();

    $meta = $generator->degenerate($id);
```

##### 重写 Meta 生成器
```php
<?php
    declare(strict_types=1);
    
    use Hyperf\Snowflake\IdGenerator;
    
    class UserDefinedIdGenerator
    {
        /**
         * @var IdGenerator\SnowflakeIdGenerator
         */
        protected $idGenerator;
    
        public function __construct(IdGenerator\SnowflakeIdGenerator $idGenerator)
        {
            $this->idGenerator = $idGenerator;
        }
    
        public function generate(int $userId)
        {
            $meta = $this->idGenerator->getMetaGenerator()->generate();
    
            return $this->idGenerator->generate($meta->setWorkerId($userId % 31));
        }
    
        public function degenerate(int $id)
        {
            return $this->idGenerator->degenerate($id);
        }
    }
    
    use Hyperf\Utils\ApplicationContext;
    
    $container = ApplicationContext::getContainer();
    $generator = $container->get(UserDefinedIdGenerator::class);
    $userId = 20190620;
    
    $id = $generator->generate($userId);
```

