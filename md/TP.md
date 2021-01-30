### 1. 目录结构
> + application          应用目录          
> > + index              模块
> > > + controller       控制器
> > > + model            模型
> > > + view             视图
> > >   config.php       配置文件
> > >   database.php     数据库配置文件
> > + admin
> + extend               扩展文件
> + public               入口
> > + static             公共资源
> >   index.php          入口文件
> + runtime              缓存文件
> + vendor               第三方扩展
> + thinkphp             tp核心文件夹
> > + lang               语言包
> > + library            tp核心类
> > + tpl                跳转模板
> >   convention.php     核心配置
> >   helper.php

### 2. MVC原理
    M model 模型 完成实际的业务逻辑和数据封装返回数据
    V view  视图 可视化页面
    C controller 控制器
    VC 开发页面
    MC 开发接口
    
#### 2.1 入口文件
    http://www.*.com/public/index.php/index/index/index
    协议  /网站      /入口文件夹/入口文件 /模块  /控制器/方法
    
#### 2.2 其他
    namespace    命名空间 解决函数和类名冲突的问题
    use app/index/{index,login as logins}    调用类 {}多个引用  as别名
    
### 3. 命名规范
    目录,文件
        目录使用小写+下划线
        类库、函数文件统一以 .php 为后缀
        类文件名均以命名空间定义,并且命名空间的路径和类库文件所在路径一致
        类文件采用驼峰法(首字母大写)命名,其他文件采用小写+下划线命名
        类名和类文件名保持一致,统一采用驼峰发(首字母大写)命名
    函数,类,属性
        类命名采用驼峰法
        函数命名使用小写字母+下划线(首字母小写)
        方法命名使用驼峰法(首字母小写)
        属性命名使用驼峰法(首字母小写)
        以双下划线大头的函数或方法作为魔术方法
    常量配置
        常量以大写字母+下划线命名
        配置参数以小写字母和下划线命名
    数据表,字段
        小写字母+下划线
        字段名不以下划线开头
        不建议使用驼峰法和中文作数据表,字段命名
        
### 4. 方法调用
#### 4.1 跨方法
```php
public function index()
{
    $this->add();
    self::add();
    User::add();
    action('add'); //助手函数
}
```

#### 4.2 跨控制器调用
```php
use app\index\controller\Index as index;
public function kkzq()
{
    // use
    $obj = new index;
    $obj->update();
    // 命名空间
    $obj = new \app\index\controller\Index;
    $obj->update();
    // 系统函数
    $obj = controller('Index/index');
    $obj->update();
}
```

#### 4.3 跨模块调用
```php
use \app\index\controller\index as IndexIndex;
public function index()
{
    // use
    $obj = new IndexIndex;
    $obj->del();
    // 命名空间
    $obj = new \app\admin\controller\Index;
    $obj->del();
    // 系统函数
    $obj = controller('index/index');
    $obj->del();
}
```

### 5. 配置
#### 5.1 配置格式
    []
        新建配置文件
            return [];
            
#### 5.2 配置类型
##### 5.2.1 惯例配置
    tp\thinkphp\convention.php
    
##### 5.2.2 应用配置
    1. 对配置文件进行分目录配置
    2. 位置
        tp\addlication\database.php
        tp\applicarion\extra
        
##### 5.2.3 场景配置
    在不同环境下进行开发的配置
    在 tp\application\config.php
        应用模式状态
        'app_status' => 'office'
    在 tp\application\建立 home.php
                          office.php
                          
##### 5.2.4 模块配置
    在 tp\application\模块 建立config.php
    
##### 5.2.5 动态配置
    在控制器中随时配置
    config(名称,值);
    config::set(名称,值);
    
#### 5.3 配置读取
##### 5.3.1 config 系统类
 ```php
<?php
namespace app\index\controller;
use think\config;
class conf {
    public function read()
    {
        echo Config::get('name');
        echo \think\Config::get('name');
    }
}
```

##### 5.3.2 config() 系统方法
    echo config('name');
    
##### 5.3.3 二维读取
    echo config('database.type');
    
##### 5.3.4 扩展配置
    echo config(扩展文件名称配置文件);
    
##### 5.3.4 配置优先级
    动态配置 -> 模块配置 -> 场景配置 -> 扩展配置 -> 应用配置 -> 惯例配置
    
##### 5.3.5 加载顺序
    惯例配置 -> 应用配置 -> 扩展配置 -> 场景配置 -> 模块配置 -> 动态配置
    
#### 5.4 环境配置
##### 5.4.1 文件的创建
    在tp根目录中建立 .env(不要用中文)
        username = root
        [database]
        username = xxx
        password = xxxx
        
##### 5.4.2 读取
    \think\Env::get('name');
    \think\Env::get('user','该配置不存在');
    \think\Env::get('database.username');
    Env::get('name');
    Env::get('user','该配置不存在');
    Env::get('database.username');
    
##### 5.4.3 使用
    use think\Env;
    'username' => Env::get('username');
    
##### 5.4.4 错误调试
    'app_debug' => true;
    
### 6. 控制器
#### 6.1 定义
```php
<?php
namespace app\index\controller;
class Index {
    public function index()
    {
        
    }
}
```

#### 6.2 修改根命名空间
    app_namespace 配置参数改为 APP_NAMESPACE
        常量在入口文件中定义
        define('APP_NAMESPACE','app');
        
#### 6.3 初始化控制器
    use think\controller;
    public function __initialize()
    {
        echo '这是初始化方法';
    }
    
#### 6.4 配置方法
```php
protected $beforeActionList = [
    'first',
    'two'   => ['only'   => 'data'],        // 指定该方法只在谁前出现
    'three' => ['except' => 'index,data']   // 指定该方法不在谁前出现
];
```

#### 6.5 空操作
```php
public function __empty()
{
    echo "这是一个空操作";
}
```

#### 6.6 空控制器
```php
namespace app\index\controller;
use think\controller;
class Error extends controller
{
    public function __empty()
    {
    
    }
}
```

#### 6.7 存在的控制器/空操作
```php
class Index extends Error{}
```

#### 6.8 跳转
```php
// thinkphp|traits|controller|Jump.php
$this->success('跳转信息','跳转路径');
$this->error('跳转信息'); // 默认返回上一级页面
```

#### 6.9 跳转模板
    配置文件中指定的路径,默认跳转页面对应的模板文件
```php
'dispatch_success_tmpl' => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl'
'dispatch_error_tmpl' => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl'
```

##### 6.9.1 参数
    <!-- 页面提示信息 -->
    <?php echo $msg; ?>
    <!-- 返回code -->
    <?php echo $code; ?>
    <!-- 跳转等待时间 单位为秒 -->
    <?php echo $wait; ?>
    <!-- 跳转页面地址 -->
    <?php echo $url; ?>
    
##### 6.9.2 自定义模板
    在view下的public文件中新建
        success.html
        error.html
        'dispatch_success_tmpl' => 'public/success'
        'dispatch_errot_tmpl' => 'public/error'
        
##### 6.9.3 重定向
    \think\controller 类的redirect 方法
    $this->redirect('跳转地址',['id'=>2,'name'=>'names']);
    
### 7. 请求
#### 7.1 请求实例化
```php
// 类
use think\Request;
$request = Request::instace(); // 返回的都是对象
// 助手函数
$request = request(); // 返回的都是对象
```

#### 7.2 url路径信息
```php
echo 'domain:' . $request->domain(); // 获取当前域名
echo 'file:' . $request->baseFile(); // 获取当前入口文件
echo 'url:' .$request->url();        // 获取当前URL地址,不含域名
echo 'url with domain:' . $request->url(true);   // 获取完整URL
echo 'url without query:' . $request->baseUrl(); // 获取URL
echo 'root:' . $request->root();     // 获取URL访问Root地址,不含QUERY_STRING
echo 'root with domain:' . $request->root(true); // 获取URL访问的ROOT地址
echo 'pathinfo:' . $request->pathinfo();         // 获取URL地址中的PATH_INFO信息
echo 'pathinfo:' . $request->path();             // 获取URL地址中的PATH_INFO信息,不含后缀
echo 'ext:' . $request->ext();                   // 获取URL地址中的后缀信息
```

#### 7.3 获取模块/控制器/操作系统
```php
echo $request->model();
echo $request->controller();
echo $request->action();
```

#### 7.4 变量获取
##### 7.4.1 助手函数获取请求
    获取全部的get/post获取的参数
        $data = input('get.');
        $data = input('post.');
    获取get/post获取的参数中的user参数的值
        $data = input('get.');
        $data = inpyt('post.user');
    param 自动识别 GET | POST | PUT 请求
        $data = input('param.');
        $data = input('param.user');
    delete 请求
        $data = input('delete.');
        $data = input('delete.user');
    put 请求
        $data = input('put.');
        $data = input('put.user');
    获取SERVER变量
        Request::instance()->server('PHP_SELF'); // 获取某个server变量
        Request::instance()->server();           // 获取全部server变量
        input('server.PHP_SELF');
        input('server!');
        
##### 7.4.2 类的方式获取方式
        $request = Request::instance();
        $data = $request->delete();       // 获取全部
        $data = $request->delete('user'); // 获取某个
        
#### 7.5 请求伪装
    <input type="hidden" name="__method" value"PUT" >
    <input type="hidden" name="__method" value="DELETE" >
    
#### 7.6 变量过滤
##### 7.6.1 转义同时加密
    $request->filter('htmlspecialchars,md5');
    $data = input('param.');
    
##### 7.6.2 全部过滤
    $data = $request->param|get|post('','','htmlspecialchars,md5');
    
##### 7.6.3 单个过滤
    $data = $request->param|gte|post('user','','~,md5');
    
#### 7.7 获取全部变量
    $data = input('param.');
    $data = $request->only(['id']);  // 只要什么
    $data = $request->except('user');// 排除什么
    $data = $request->except(['user','ly'],请求类型);// 排除什么
    
#### 7.8 变量修饰符
| 参数 | 含义 |
| --- | --- |
| input() | 变量类型.变量名\|修饰符 |
| s | 强制转为字符型 |
| d | 强制转为整型  |
| b | 强制转为布尔型|
| a | 强制转为数组型|
| f | 强制转为浮点型|

    $data = input('post.user/d,b,a,f');
    
#### 7.9 判断请求类型
    Request::instance()->isPost();
    request->isPost();
    
#### 7.10 伪静态
    URL伪静态后缀(为了方便搜索引擎收录,seo优化)
    'url_html_suffix' => 'html'
    
#### 7.11 参数绑定
    按名称绑定,只与参数名称有关,与位置无关
        'url_param_type' => 0
    按顺序绑定,在地址栏没必要写参数名称
        'url_param_type' => 1
    默认值
        public(function c($id,$name=''))
        
### 8. 视图
#### 8.1 视图渲染
    助手函数
        return view();
    controller类
        use think\Controller;
        echo $this->fetch();
    view类(不建议使用)
        use think\View;
        $view = new View;
        echo $view->fetch();
        
#### 8.2 分配数据
```php
return view('',['n'=>$name]);
echo $this->fetch('',['n'=>$name]);
$view = new View;
echo $view->fetch('',['n'=>$name,'a'=>$age]);
// 分配数据
$this->assign(['n'=>$name,'a'=>$age]);
// 视图渲染
return view();
```

#### 8.3 调用视图渲染
    跨控制器调用视图
        return view('Requ/index');
    跨方法调用视图
        return view('add');
    跨模块调用视图
        return view('admin@Index/index');
        
#### 8.4 输出替换
```php
'view_replace_str' => [
    '__HCSS__' => '/tp/public/static/home/css',
],
```

### 9. 模板
    模板标签 {$n} 变量输出
    
#### 9.1 模板引擎标记
    'tpl_begin' => '<',  // 模板引擎普通标签开始标记
    'tpl_end'   => '>',  // 模板引擎普通标签结束标记
    
#### 9.2 标记库标签
    'taglib_begin' => '{',  // 标签库标签开始标记
    'taglib_end'   => '}',  // 标签库标签结束标记
    
#### 9.3 系统变量
    系统变量输出不需要提前赋值,可以直接在模板中输出,系统变量的输出通常以{$Think}开头
        ${Think.server.script_name} // 输出$_SERVER['SCRIPT_NAME']
        支持输出    $_SERVER $_ENV $_POST $_GET $_REQUEST $_SESSION $_COOKIE
    原样输出
        {literal}
            {$a=111}
        {/literal}
        
#### 9.4 模板布局
##### 9.4.1 全局配置方式
```php
// view文件夹下新建lagout.html模板
'template' => [
    'layout_on' => true,
    'layout_name' => 'layout'
];
namespace app\index\controller;
use think\Controller;
class User extends Controller 
{
    public function add()
    {
        return $this->fetch('add');
    }
}
// 经典写法
{ include file="public/header" /}
{ __CONTENT__ }
{ include file="public/footer" /}
```

##### 9.4.2 模板标签方式
    {layout name="layout" /} // 在user/index.html页面中引用
    
#### 9.5 模板布局(结构一样,内容不一样)
##### 9.5.1 在view中新建一个base.html
```php
<title>{block name="title"}标题{/block}</title>
{blokc name="menu"}菜单{/block}
{block name="left"}左边分栏{/block}   
{block name="main"}主内容{/block}   
{block name="right"}右边分栏{/block}   
{block name="footer"}底部{/block}   
```

##### 9.5.2 在base|index
```php
{extend name="base"}
{block name="title"}标题{/block}
{block name="menu"}菜单{/block}
{block name="left"}左边{/block}
{block name="main"}内容{/block}
{block name="right"}右边{/block}
{block name="footer"}
    {__block__}@ThinkPHP 版权所有
{/block}
```

#### 9.6 内置标签
##### 9.6.1 volist
| 参数 | 含义 |
| --- | --- |
| name | 获取模板变量 |
| id   | 模板变量的别名 |
| offset | 偏移量 |
| length | 长度 |

##### 9.6.2 foreach
| 参数 | 含义 |
| --- | --- |
| name | 获取模板变量 |
| item | 模板变量的别名 |

##### 9.6.3 for
    start="10" end="0" comparison=">" step="1" name="a"
    
#### 9.7 比较标签
| 参数 | 含义 |
| --- | --- |
| eq equal | 等于 |
| meq notequal | 不等于 |
| gt   | 大于 |
| egt  | 大于等于 |
| lt   | 小于 |
| elt  | 小于等于 |
| heq  | 恒等于 |
| nheq | 不恒等于 |

#### 9.8 条件标签
```php
{if condition = "($name == 1)OR($name > 100)"} value1
{else if condition = "$name eq 2" /} value2
{else if condition = "$name eq 3" /} value3
{else /} value4
{/if}

{switch name="name"}
{case value="1" break="0"}输出内容1{/case}
{case value="2"}输出内容2{/case}
{default /} 默认情况
{/switch}
```

### 10. 数据库
#### 10.1 配置文件(application/database.php)
```php
return [
    'type'     => 'mysql',                 // 数据库类型
    'hostname' => '127.0.0.1',             // 服务器地址 
    'database' => 'data_name',             // 数据库名
    'username' => 'root',                  // 用户名
    'password' => 'root',                  // 密码
    'hostport' => '3306',                  // 端口
    'dsn'      => '',                      // 连接DSN
    'params'   => [],                      // 数据库连接参数
    'charset'  => 'utf8',                  // 数据库编码默认采用utf-8
    'prefix'   => '',                      // 数据库表前缀
    'debug'    => true,                    // 数据库调试模式
    'deploy'   => 0,                       // 数据库部署方式 0集中式,单一服务器 1分布式,主从服务器
    'rw_separate' => false,                // 读写分离后,主服务器数量
    'master_num'  => 1,                    // 指定从服务器序号
    'slave_no'    => '',                   // 指定从服务器序号
    'fields_strict' => true,               // 是否严格检查字段是否存在
    'resultset_type'=> 'array',            // 数据集返回类型
    'auto_timestamp'=> false,              // 自动写入时间戳字段
    'datetime_format' => 'Y-m-d H:i:s',    // 时间字段取出后的默认时间格式
    'sql_explain'=>false                   // 是否需要进行SQL性能分析
];
```

#### 10.2 方法配置
 ```php
use think\Db;
$con = Db::connect([
    'type'     => 'mysql',                 // 数据库类型
    'hostname' => '127.0.0.1',             // 服务器地址 
    'database' => 'data_name',             // 数据库名
    'username' => 'root',                  // 用户名
    'password' => 'root',                  // 密码
    'hostport' => '3306',                  // 端口
    'dsn'      => '',                      // 连接DSN
    'params'   => [],                      // 数据库连接参数
    'charset'  => 'utf8'                   // 数据库编码默认采用utf-8
]);
```

#### 10.3 模板配置
```php
// query() 查询
$data = Db::query('select * from users where id=?',[11]);

$sql = "select * from users";
$data = Db::query($sql);
// execute() 增加 删除 修改
$res = Db::execute('insert into user(username) values(?)',['thinkphp']);
$res = Db::execute('insert into user(username) values(thinkphp)');
```

### 11. 模型
#### 11.1 定于
    在模块中创建model文件夹
    模型的名称一般与操作的表名称对应
```php
namespace app\index\controller;
use think\Controller;
class Mode extends Controller
{
    public function index()
    {
    
    }
}

// 使用命令行创建
// 1. 切换至项目所在的文件夹中
// 2. php think make:model index\User
```

#### 11.2 模型实例化
```php
use app\index\model\user as UserModel;
$model = new UserModel;
$model->a();

$model = new \app\index\model\User;
$model->a();
```

#### 11.3 模型属性
    指定主键
        protected $k = 'id';
    设置当前模型对应的完整数据表名称
        protected $table = 'user';
    模型连接数据库
        protected $connection = [];
        
#### 11.4 save() 方法
```php
// 实例化模型后调用save()方法表示新增
$user = new UserModel;
$user->username='add';
$user->save();

// 查询数据后调用save()方法表示更新
$data = UserModel::get(1);
$data->username = 'update';
$data->save();

// save() 方法传入更新条件后表示更新
$model->save(['id'=>1,'username'=>'update']);
```

#### 11.5 获取器
    当读取数据的时候调用模型类里面的方法
    
#### 11.6 修改器
    当手动赋值的时候自动调用模型中的方法
    
#### 11.7 数据完成
    在不需要手动赋值的情况下对紫都阿德值进行处理后写入数据库
    
### 12. 验证器
#### 12.1 控制器中
```php
use think\Validate;
$validate = new Validate([
    // 验证规则
    'username' => 'require|length:5,10|\w',
]);
// 验证判断
if(!$validate->check($data)) {
    dump($validate->getError());
}
```

#### 12.2 自定义验证器类
```php
// 新建validate文件夹
// 新建From.php文件
namespace app\index\validate;
use think\validate;
class From extends Vaildate
{
    // 规则
    protected $rule = [
        'username' => 'require|\w'
    ];
    
    // 提示信息
    protected $message = [
        'username.require' => '用户名不能为空'
    ];
    
    // 场景
}


// 控制器
$data = input('post.');
$validate = Loador::validate('From');
if(!$validate->check($data)) {
    dump($validate->getError());
}
```

### 13. 路由
#### 13.1 路由的作用
    简化URL路径, 方便记忆, 有利于搜索引擎优化
    
#### 13.2 入口文件
##### 13.2.1 前后分离
    在public中建立一个admin.php
    define('APP_PATH',__DIR__.'/../application/');
    require __DIR__.'/../thinkphp/start.php';
    
##### 13.2.2 模块绑定
    define('BION_MODULE','admin|index');
    
##### 13.2.3 URL地址的改变
    绑定前
        http://www.*.com/public/index.php/模块/控制器/方法
    绑定后
        http://www.*.com/public/index.php/控制器/方法
        
#### 13.3 隐藏前台入口文件
    开启apache的路由重写开启
        LoadModule rewrite_module modlues|mod_rewie.so
        将 # 去掉 重启 apache
    将 .htaccess 移动到public目录中
    
#### 13.4 后台入口的安全性
    MD5
    
#### 13.5 路由模式
    普通模式(完全关闭路由)
        'url_route_on'   => false,
        'url_route_must' => false,
    混合模式(有路由则路由, 没有则不使用)
        ''url_route_on'  => true,
        'url_route_must' => false,
    强制模式(必须使用路由, 没有则报错)
        'url_route_on'   => true,
        'url_route_must' => true,
        
#### 13.6 设置路由(动态单个注册)
    路由设置文件  application\route.php
    use think\Route;
    Route::rule();
    Route::rule(路由表达式, 路由地址, 请求类型, 路由参数(数组), 变量规则(数组));
    
##### 13.6.1 路由形式
    静态路由        Route::rule('a','index/a');
    带参数          Route::rule('course/:id','index/course');
    多个参数        Route::rule('time/:year/:month','index/time');
    全动态路由(不建议使用)    Route::rule(':a/:b','index/data');
    完全匹配路由     Route::rule('test$','index/test');
                      http://www.tp.com/test/add   不可以访问
                      http://www.tp.com/test       可以访问
    路由带额外参数    Route::rule('test','index/test?id=10&name=user');
    
##### 13.6.2 设置路由请求类型
```php
// get
Route::get('type','index/type');
Route::rule('type','index/type','get');

// post
Route::post('type','index/type');
Route::rule('type','index/type','post');

// get/post
Route::rule('type','index/type','get|post');

// 所有路由
Route::rule('type','index/type');

// put
Route::put('type','index/type');
Route::rule('type','index/type','put');

// delete
Route::delete('type','index/type');
Route::rule('type','index/type','delete');
```  

#### 13.7 设置路由(动态批量注册)
```php
Route::rule([
        '路由规则' => '路由地址和参数',
        '路由规则' => ['路由地址和参数', '匹配参数(数组)', '变量规则(数组)'],
    
        ],
        '',
        '请求类型',
        '匹配参数(数组)',
        '变量规则'
);

Route::rule([
    'a' => 'index/a',
    'b/:id' => 'index/b',
],'','get');

Route::get([
    'a' => 'index/a',
    'b/:id' => 'index/b',
]);
```

#### 13.8 设置路由(配置文件设置)
```php
return [
    'a' => 'index/a',
    'b/:id' => 'idnex/b'
];
```

#### 13.9 变量规则
    Route::rule('a/:id/:name','index/a','get',
        [],
        ['name'=>'\d+','id'=>'\d+']);
        
    Route::rule('a/:id','index/a','get',
            ['method'=>'get','ext'=>'html','https'=>true],
            ['id'=>'\d+']);
            
#### 13.10 快捷路由
```php
// 声明
Route::Controller('blog','index/blog');

// 控制器
class Blog
{
    public function getIndex()
    {
    
    }
    
    public function getAdd()
    {
    
    }
}

// 使用
// http://www.tp.com/blog/add
// http://www.tp.cim/blog/index
``` 

#### 13.11 URL生成
##### 13.11.1 系统类
    生成当前的URL Url::build('');
    跨控制器的URL Url::build('Index/index');
    跨方法       Url::build('a');
    跨模块       Url('/admin.php/index/index');
    
##### 13.11.2 跨方法
    echo url('a');
    echo url('Index/index');
    echo url('/admin.php/index/index');
    
##### 13.11.3 使用
```php
// 普通url
echo url('Index/index');
// 带参数
echo url('index/index',[
    'id'  => 10,
    'name'=> 'user'
]);
echo url('index/index','id=10&name=user');
// 带锚点
echo url('index/index/#mao',['name'=>10,'name'=>'user']);
// 带域名
echo url('index/index@www.tp.com',[
    'id'  => 10,
    'name'=> 'user'
]);
// 入口文件
Url::root('/index.php');
echo Url('index/index',[
    'id'  => 10,
    'name'=> 'user'
]);
``` 

#### 13.11.4 资源路由
    Route::resource('user','index/user');
    
### 14. 缓存
```php
'cache' => [
    'type' => 'File',           // 驱动方式
    'path' => CACHE_PATH.'/a',  // 缓存保存目录
    'prefix' => '',             // 缓存前缀
    'expirce'=> 0               // 缓存有效期, 0表示永久缓存
];

'session' => [
    'id'  => '',                // SESSION_ID的提交变量,解决flash上传跨域 
    'var_session_id' => '',     // SESSION前缀
    'prefix' => 'think',        // 驱动方式支持 redis、memcached
    'type'   => '',             
    'auto_start' => true        // 是否自动开启SESSION
];
```

### 15. 实例
#### 分页
    thinkphp/think/paginator/driver/Boostrap.php
    找到 render();
#### 验证码
```php
// 验证码扩展
// vendor/topthink/think-captcha/src/captcha.php

// 页面显示
<div>{:captcha_img()}</div>
<img src="{:captcha_src()}" alt="captcha" onclick="this.src='{:captcha_src()}?rand='+ Math.random() +'" />
<div><img src="{:captcha_src()}" alt="captcha" /></div>

// 验证码配置 在应用配置中 'captcha' => []
// 中文验证码
'useZh' => true,
'zhset' => '',
'fontttf' => '1.ttf',
// 中文验证码字体使用扩展包内 'think-captcha/assets/zhttfs' 字体文件
```

#### 文件上传
    所有控制器的路径和入口文件是同级的
    上传验证  文件大小、文件类型、文件后缀
        validate(['size'=>'15678','ext'=>'jpg,png,gif'])
    上传规则 文件夹
        rule('shal')
        data     根据日期和微秒数生成
        md5      对文件使用md5_file散列生成
        shal     对文件使用shal_file散列生成
        uniqid
    保留文件原名称
        move('.static/uploads',false,false);