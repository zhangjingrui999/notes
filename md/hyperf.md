[文档](https://hyperf.wiki/2.0/#/README)
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
     * @Controller()
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
### 1. 概述
    Hyperf 是基于 Swoole 4.5+ 实现的高性能、高灵活性的 PHP 协程框架，内置协程服务器及大量常用的组件，性能较传统基于 PHP-FPM 的框架有质的提升，提供超高性能的同时，也保持着极其灵活的可扩展性，标准组件均基于 PSR 标准 实现，基于强大的依赖注入设计，保证了绝大部分组件或类都是 可替换 与 可复用 的。
    框架组件库除了常见的协程版的 MySQL 客户端、Redis 客户端，还为您准备了协程版的 Eloquent ORM、WebSocket 服务端及客户端、JSON RPC 服务端及客户端、GRPC 服务端及客户端、Zipkin/Jaeger (OpenTracing) 客户端、Guzzle HTTP 客户端、Elasticsearch 客户端、Consul 客户端、ETCD 客户端、AMQP 组件、Apollo 配置中心、阿里云 ACM 应用配置管理、ETCD 配置中心、基于令牌桶算法的限流器、通用连接池、熔断器、Swagger 文档生成、Swoole Tracker、视图引擎、Snowflake 全局 ID 生成器 等组件，省去了自己实现对应协程版本的麻烦。
    Hyperf 还提供了 基于 PSR-11 的依赖注入容器、注解、AOP 面向切面编程、基于 PSR-15 的中间件、自定义进程、基于 PSR-14 的事件管理器、Redis/RabbitMQ 消息队列、自动模型缓存、基于 PSR-16 的缓存、Crontab 秒级定时任务、国际化、Validation 表单验证器 等非常便捷的功能，满足丰富的技术场景和业务场景，开箱即用。