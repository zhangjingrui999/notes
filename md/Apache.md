* Apache HTTP Server（简称Apache）是Apache软件基金会的一个开放源码的网页服务器
* Apache HTTP服务器是一个模块化的服务器，源于NCSAhttpd服务器
* 可以运行在几乎所有广泛使用的计算机平台上，由于其跨平台和安全性被广泛使用
* 快速、可靠并且可通过简单的API扩充，将Perl/Python等解释器编译到服务器中。
* [收录版本2.4](http://httpd.apache.org/download.cgi#apache24)
<!--more-->

### 安装要求

* APR 和 APR-Util
    + 确保系统上已经安装了 APR 和 APR-Util。
    + 如果未安装，或者不想使用系统提供的版本，请从[Apache APR](http://apr.apache.org/)下载 APR 和 APR-Util 的最新版本。
    + 将它们解压到/httpd_source_tree_root/srclib/apr和/httpd_source_tree_root/srclib/apr-util （确保目录名称没有版本号 
      例如: APR 发行版必须在 /httpd_source_tree_root/srclib/apr/) 下并使用 ./configure's--with-included-apr 选项
    + 在某些平台上，可能必须安装相应的-dev软件包才能允许 httpd 针对安装的 APR 和 APR-Util 进行构建
* Perl 兼容的正则表达式库 (PCRE)
    + 这个库是必需的，但不再与 httpd 捆绑在一起
    + 从http://www.pcre.org下载源代码，或安装 Port 或 Package。
    + 如果系统找不到 PCRE 构建安装的 pcre-config 脚本，请使用--with-pcre参数指向它。
    + 在某些平台上，可能必须安装相应的-dev 软件包才能允许 httpd 针对您安装的 PCRE 进行构建。
* 磁盘空间
    + 确保至少有 50 MB 的可用临时可用磁盘空间。安装后，服务器占用大约 10 MB 的磁盘空间。
  根据选择的配置选项、任何第三方模块，还有在服务器上拥有的一个或多个网站的大小，实际的磁盘空间要求会有很大差异。
* ANSI-C 编译器和构建系统
    + 确保安装了 ANSI-C 编译器。如果您没有 GCC，那么至少要确保您的供应商的编译器符合 ANSI。此外，您PATH必须包含基本的构建工具，例如make.
* 准确计时
    + HTTP 协议的元素表示为一天中的时间。通常 基于网络时间协议 (NTP) 的程序ntpdate或xntpd程序用于此目的。有关 NTP 软件和公共时间服务器的更多详细信息，请参阅[NTP 主页](http://www.ntp.org/)。
* Perl 5 [可选]
    + 对于某些支持脚本，例如apxs或dbmmanage（用 Perl 编写的），需要 Perl 5 解释器（版本 5.003 或更新版本就足够了）。
    + 如果configure脚本未找到 Perl 5 解释器 ，将无法使用受影响的支持脚本。当然，仍然可以构建和使用 Apache httpd。 

### 安装

* Fedora/CentOS/Red Hat Enterprise Linux([文档](https://docs.fedoraproject.org/en-US/quick-docs/getting-started-with-apache-http-server/index.html))
```linux
    # 安装
    sudo yum install httpd
    # 启用
    sudo systemctl enable httpd
    # 启动
    sudo systemctl start httpd
    
    ps: 安装发行版的较新版本时将 yum 替换为 dnf。
```

* Ubuntu/Debian([文档](https://ubuntu.com/server/docs))
```linux
    # 安装
    sudo apt install apache2
    # 启动
    sudo service apache2 start
```

* 源
```linux
    # 下载
    http://httpd.apache.org/download.cgi
    
    
    # 解压 
    gzip -d httpd-NN.tar.gz
    tar xvf httpd-NN.tar
    cd httpd-NN
    
    
    # 配置
    ./configure --prefix=PREFIX
    
    
    # 编译
    # 请耐心等待，因为基本配置需要几分钟的时间来编译，而且时间会因硬件和启用的模块数量而有很大差异。
    make
    
    
    # 安装
    # 此步骤通常需要 root 权限，因为 PREFIX通常是具有受限写入权限的目录。
    # 如果正在升级，安装不会覆盖您的配置文件或文档。
    make install
    
    
    # 编辑配置
    vi PREFIX/conf/httpd.conf
    
    
    # 测试
    # 现在您可以通过立即运行来启动 Apache HTTP 服务器
    # 然后应该能够通过 URL 请求第一个文档http://localhost/
    PREFIX/bin/apachectl -k start
    # 然后通过运行再次停止服务器
    PREFIX/bin/apachectl -k stop
    
    
    ps: NN必须替换为当前版本号，并且PREFIX必须替换为服务器安装所在的文件系统路径。
        如果 未指定PREFIX，则默认为 /usr/local/apache2。
```

### configure配置[文档](http://httpd.apache.org/docs/2.4/en/programs/configure.html)
    需求配置 Apache 源代码树。这是使用configure包含在发行版根目录中的脚本完成的。
    （开发者下载Apache源代码树的未发行的版本将需要有 autoconf和libtool安装将需要运行buildconf下一个步骤之前，这是没有必要的官方版本。）
    要使用所有默认选项配置源树，只需键入./configure. 要更改默认选项，configure接受各种变量和命令行选项。
    最重要的选项是--prefix 稍后安装 Apache的位置，因为必须配置 Apache 才能使该位置正常工作。使用附加配置选项可以对文件位置进行更精细的控制。

    --enable-module=static    
    此时，还可以通过启用和禁用模块来指定要包含在 Apache 中的功能。默认情况下，Apache 附带了广泛的模块。
    它们将被编译为 可在运行时加载或卸载的共享对象 (DSO)。还可以选择使用选项静态编译模块 。

    --enable-modulemod_--disable-moduleconfigure
    使用该选项启用其他模块 ，其中 模块是删除字符串并将任何下划线转换为破折号的模块的名称 。
    同样，可以使用该选项禁用模块 。使用这些选项时要小心，因为如果指定的模块不存在，则无法警告您；它会简单地忽略该选项。

    此外，有时需要为 configure脚本提供有关编译器、库或头文件位置的额外信息。这是通过将环境变量或命令行选项传递给configure. 
    有关更多信息，请参阅 configure手册页。或者configure使用--help选项调用 。
    
    为了简要了解拥有的可能性，这里是一个典型示例，它/sw/pkg/apache使用特定的编译器和标志以及两个附加模块为安装树编译 Apachemod_ldap和 mod_lua：
    
    $ CC="pgcc" CFLAGS="-O2" \
    ./configure --prefix=/sw/pkg/apache \
    --enable-ldap=shared \
    --enable-lua=shared

    当configure运行它需要几分钟的时间，用于测试稍后将用于编译服务器系统，并构建Makefile文件对功能的可用性。
    手册页configure上提供了所有不同选项的详细信息configure。

#### 配置选项
* -C
  * --config-cache
    * 这是一个别名 --cache-file=config.cache
  * --cache-file=FILE
    * 测试结果将缓存在文件FILE 中。默认情况下禁用此选项。
* -d
  * --debug
    * don't remove temporary files
  * --recheck
    * 通过在相同条件下重新配置来更新$as_me
  * --file=FILE[:TEMPLATE]
    * 实例化配置文件file
  * --header=FILE[:TEMPLATE]
    * 实例化配置头FILE
* -h
  * --help [short|recursive]
    * 显示此帮助并退出
    * --help=short 显示特定于此包的选项
    * --help=recursive 显示所有包含的包的简短帮助
* -n
  * --no-create
    * 该configure脚本运行正常，但不创建输出文件。这对于在生成编译文件之前检查测试结果很有用。
  * --srcdir=DIR
    * 将目录DIR定义为源文件目录。默认为所在目录configure，或父目录。
* -q
  * --quiet, --silent
    * 不要打印' checking… '(在配置过程中)的消息
* -V
  * --version
    * 显示版本信息并退出
  * --config
    * 打印配置，然后退出

#### 安装目录
    这些选项定义安装目录。安装树取决于所选的布局。
* --prefix=PREFIX
  * 在PREFIX 中安装与体系结构无关的文件。默认安装目录设置为 /usr/local/apache2.
* --exec-prefix=EPREFIX
  * 在EPREFIX 中安装依赖于体系结构的文件。默认情况下，安装目录设置为 PREFIX目录。

### [conf配置](http://httpd.apache.org/docs/2.4/en/configuring.html)

### 特性
    1.支持最新的HTTP/1.1通信协议
    2.拥有简单而强有力的基于文件的配置过程
    3.支持通用网关接口
    4.支持基于IP和基于域名的虚拟主机
    5.支持多种方式的HTTP认证
    6.集成Perl处理模块
    7.集成代理服务器模块
    8.支持实时监视服务器状态和定制服务器日志
    9.支持服务器端包含指令(SSI)
    10.支持安全Socket层(SSL)
    11.提供用户会话过程的跟踪
    12.支持FastCGI
    13.通过第三方模块可以支持JavaServlets

### 相关模块
    - SSO Module - LemonLDAP
        LemonLdap 是 Apache 的一个实现了 Web SSO 的模块，可处理超过 20 万的用户
    - 


### 0. 经验技巧
#### 异常404
    * /routes/web.php 路由书写无误
    * 控制器、视图等 存在且拼写无误
```linux
    # 一般出现这种情况的都是apache/nginx配置出现问题
    
    ## nginx
    在location里面加上　try_files $uri $uri/ /index.php?$query_string;
    如果配置文件中存在　try_files $uri $uri/ =404;需要将它注释掉或者删掉，否则会报错
```

### 虚拟主机
```linux
# 1. apache 配置文件httpd.conf, 找到mod_rewrite.so, 去掉注释
# 2. apache 配置文件httpd.conf, 找到httpd-vhosts.conf, 去掉注释
# 3. httpd-vhosts.conf文件,配置本地虚拟主机路径和域名
	<VirtualHost *:80>
    		DocumentRoot    项目入口路径
    		ServerName      域名
    		<Directory      项目入口路径>
    		Options Indexes FollowSymlinks
    		AllowOverride   All
    		Require all granted
	</VirtualHost>
# 4. C:\Windows\System32\drivers\etchosts文件, 配置域名解析
	   例: 127.0.01	 www.baidu.com
# 5. 重启apache
```
