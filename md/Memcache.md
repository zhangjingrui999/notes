### memcache
#### 优点 
    1.快速缓存
    2.跨域登录
#### 缺点
    1.复杂的数据存取的操作
    2.不能永久保存数据
#### 安装
##### window下如何安装memcache服务器
    安装
        memcached.exe -d install
    卸载
        memcached.exe -d uninstall
    启动
        memcached.exe -d start
    停止
        memcached.exe -d stop
    调优安装
        "C:\memcache\memcached.exe" -m 2048 -u root -l 192.168.20.2 -p 10000 -d runservice 
#### linux下如何安装memcache服务器
    安装
        ./configure && make && make install
    启动
        memcache -d -m 2048 -u root -l 192.168.20.1 -p 10000
    停止
        pkill memcached
### 查看memcache服务状态
#### windows
    1.查端口 netstat -ano|find “10000”
    2.查进程 tasklist|find “memcache”
#### linux
    1.查端口 netstat -tunpl |grep 10000
    2.查进程 pstree|grep memcache
### 命令
#### 增
    set name 0 3600 5
    user1
#### 查
    stats
    get name
    stats items
    stats cachedump 1 0
#### 删
    delete name
#### 改
    replace name 0 3600 4
    user
### php安装memcache模块
#### window
    1.把php_memcache.dll拷贝到php中ext扩展模块包中
    2.修改php.ini配置文件把memcache设置
    extension=php_memcache.dll
    3.重启apache服务
    4.写查看php信息的脚本(info.php):
    <?php
    phpinfo();
    ?>
    5.ctrl+f查找memcache扩展
#### linux
    1.安装memcache扩展包(c语言)
    1)/usr/local/php/bin/phpize
    生成configure脚本
    2)./configure --enable-memcache --with-php-config=/usr/local/php/php-config
    生成配置脚本
    3)make
    编译
    4)make install
    安装
### php下操作memcache
    1.连接memcache服务器
        $mem=new Memcache;
        $mem->connect("192.168.20.1","10000");
    2.增
        $mem->set('name','user1');
    3.删
        $mem->delete('name');
    4.改
        $mem->set('age',200);
    5.查
        echo $mem->get('age');
    6.查看状态
        $arr=$mem->getStats();
    7.清空
        $mem->flush();
### 用法
#### php在用户登录时把session保存到一个共享的memcache服务器上
    1.session.save_handler = memcache
    2.session.save_path = "tcp://192.168.20.1:10000"