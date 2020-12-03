### 5. docker-compose 一键安装镜像
[现有镜像](../code/框架代码包/docker-compose)
    
    进入docker-compose文件夹
    docker-compose up

### 4. 命令
#### 4.1 docker
| 命令 | 含义 |
| --- | --- |
| docker info | docker详细信息 | |
#### 4.2 镜像
| 命令 | 含义 |
| --- | --- |
| docker images | 列出本地主机上的镜像 |
| docker pull [name] | 获取一个新的镜像 |
| docker search [name] | 搜索适合的[name]镜像 |
| docker rmi [name/ID] | 删除符合[name或ID]的镜像 |
    REPOSITORY: 表示镜像的仓库源
    TAG:        镜像的标签
    IMAGE ID:   镜像ID
    CREATED:    镜像创建时间
    SIZE:       镜像大小
     
     mkdir -p /home/nginx/conf.d &&
     mkdir -p /home/nginx/www && 
     mkdir -p /home/docker/nginx/www &&
     cd /home/nginx/conf.d && sudo touch default.conf

    docker run --name php-test -d \
        -v /home/nginx/www:/home/docker/nginx/www/html:ro \
        bitnami/php-fpm:latest
        
    /home/nginx/conf.d/default.conf
    
    docker run --name nginx-test -p 80:80 -d \
        -v /home/nginx/www:/home/docker/nginx/www/html:ro \
        -v /home/nginx/conf.d:/etc/nginx/conf.d:ro \
        --link php-test:php \
        nginx
        
        /opt/bitnami/php/etc/php.ini
        /opt/bitnami/php/bin/phpize
        ./configure --with-php-config=/opt/bitnami/php/bin/php-config
    make && make install
#### 4.3 容器  
| 命令 | 含义 |
| --- | --- |
| dockers ps -a | 获取当前节点所有容器 |
| docker [start/stop/restart] | 管理容器生命周期 |
| docker logs <ID/Name> | 查看容器日志 |
| docker inspect [ID] | 查看容器详细信息 |
| docker exec -it <ID/Name> /bin/bash | 进入容器 |
| docker rm -f <ID/Name> | 删除容器 |
| docker top <ID/Name> | 显示容器中正在运行的进程 |

### 3. windows10(家庭版) 安装docker
#### 3.1 windows10开启Hyper-v
```shell script
    # 1. 是否开启虚拟化
    任务管理器 -> 性能

    # 2. 将 win10 家庭版伪装成专业版系统，通过 Docker 的系统检测
    # CMD(管理员)
    REG ADD "HKEY_LOCAL_MACHINE\software\Microsoft\Windows NT\CurrentVersion" /v EditionId /T REG_EXPAND_SZ /d Professional /F
    
    # 3. 启动 Hyper-V 功能
    # cmd 查看是否可以安装
      systeminfo
    # 新建Hyper-V.cmd，添加将如下代码
      pushd "%~dp0"
      dir /b %SystemRoot%\servicing\Packages\*Hyper-V*.mum >hyper-v.txt
      for /f %%i in ('findstr /i . hyper-v.txt 2^>nul') do dism /online /norestart /add-package:"%SystemRoot%\servicing\Packages\%%i"
      del hyper-v.txt
      Dism /online /enable-feature /featurename:Microsoft-Hyper-V-All /LimitAccess /ALL
    # 以管理员身份运行 Hyper-V.cmd 文件，这个过程中不要关闭窗口或者关机，在最末处输入：Y，电脑自动重启，进行配置更新
    # 控制面板 -> 程序 -> windows功能
      勾选Hyper-v
```
#### 3.2 安装[docker](https://hub.docker.com/editions/community/docker-ce-desktop-windows/)
    双击打开
    
    选项
        开启 windows Hyper-V组件 不选
        下载 wsl2组件            勾选
        添加桌面快捷方式
        
    启动时错误
    
        错误1
            System.InvalidOperationException:
            Failed to set version to docker-desktop: exit code: -1
        解决方法
            CMD(管理员)
            netsh winsock reset
            
    更改Docker镜像目录
        1. 停止docker
            通过windows系统的界面操作停止
            
            # 查看docker状态(cmd)
            wsl --list -v
            
            NAME                   STATE           VERSION
            * docker-desktop         Running         2
              docker-desktop-data    Running         2
        2. 备份导出目前已有的数据(cmd)
            # 将目前已有的数据备份到D:\Docker\wsl\data\目录下，并命名为docker-desktop-data.tar
            wsl --export docker-desktop-data "D:\Docker\wsl\data\docker-desktop-data.tar"
            
            # 查看导出的备份
            dir D:\Docker\wsl\data\
        3. 删除原有数据(cmd)
            wsl --unregister docker-desktop-data
            
            # 查看docker状态(cmd)
            wsl --list -v
            
            NAME              STATE           VERSION
            * docker-desktop    Stopped         2
        4. 导入数据到新盘(cmd)
            wsl --import docker-desktop-data "D:\Docker\wsl\data" "D:\Docker\wsl\data\docker-desktop-data.tar" --version 2
            
            #查看docker状态(cmd)
            wsl --list -v
            
            NAME                   STATE           VERSION
            * docker-desktop         Stopped         2
              docker-desktop-data    Stopped         2
        5. 启动Docker
#### 3.3 [阿里云docker加速器](https://cr.console.aliyun.com/cn-hangzhou/instances/mirrors)      
    settings
        Docker Engine
            "registry-mirrors": [
                "https://vzdxa911.mirror.aliyuncs.com"
            ],


### 2. Centos8.2安装Docker-CE
    如果使用超级管理员登录，不需要在命令前加sudo
#### 2.1 移除已安装的docker(若没有则跳过此步骤)
```shell script
 sudo yum remove docker \
                  docker-client \
                  docker-client-latest \
                  docker-common \
                  docker-latest \
                  docker-latest-logrotate \
                  docker-logrotate \
                  docker-engine
```
   
#### 2.2 安装必要的一些系统工具
    sudo yum install -y yum-utils device-mapper-persistent-data lvm2
#### 2.3 添加软件源信息(由于国内使用官网的太慢,这里使用阿里的资源库来加速)
    sudo yum-config-manager --add-repo http://mirrors.aliyun.com/docker-ce/linux/centos/docker-ce.repo
#### 2.4 更新 yum 缓存
    sudo yum makecache
#### 2.5 更新并安装Docker-CE
    sudo yum -y install docker-ce
    
    安装docker命令时出错,提示：containerd.io版本过低。具体如下：
        Last metadata expiration check: 0:00:12 ago on Fri 13 Nov 2020 01:42:08 PM CST.
        Error: 
         Problem: package docker-ce-3:19.03.13-3.el7.x86_64 requires containerd.io >= 1.2.2-3, but none of the providers can be installed
          - cannot install the best candidate for the job
          - package containerd.io-1.2.10-3.2.el7.x86_64 is filtered out by modular filtering
          - package containerd.io-1.2.13-3.1.el7.x86_64 is filtered out by modular filtering
          - package containerd.io-1.2.13-3.2.el7.x86_64 is filtered out by modular filtering
          - package containerd.io-1.2.2-3.3.el7.x86_64 is filtered out by modular filtering
          - package containerd.io-1.2.2-3.el7.x86_64 is filtered out by modular filtering
          - package containerd.io-1.2.4-3.1.el7.x86_64 is filtered out by modular filtering
          - package containerd.io-1.2.5-3.1.el7.x86_64 is filtered out by modular filtering
          - package containerd.io-1.2.6-3.3.el7.x86_64 is filtered out by modular filtering
          - package containerd.io-1.3.7-3.1.el7.x86_64 is filtered out by modular filtering
        (try to add '--skip-broken' to skip uninstallable packages or '--nobest' to use not only best candidate packages)
    解决方法：
        单独安装 containerd.io
        yum -y install https://download.docker.com/linux/fedora/30/x86_64/stable/Packages/containerd.io-1.2.6-3.3.fc30.x86_64.rpm
        之后重新执行
        sudo yum -y install docker-ce
#### 2.6 安装时出现下面的错误
    Error: transaction check vs depsolve:rpmlib(PayloadIsZstd) <= 5.4.18-1is needed by 
    containerd.io-1.2.10-3.2.fc31.x86_64To diagnose the problem, try running: 'rpm -Va --nofiles --nodigest'.
    You probably have corrupted RPMDB, running 'rpm --rebuilddb' might fix the issue
    
    这个是一般是版本依赖冲突，或者版本过高的问题，换为1.2.6-3.3版本即可
    
    
### 1. 概述
    从 2017 年 3 月开始 docker 在原来的基础上分为两个分支版本: Docker CE 和 Docker EE。
    Docker CE 即社区免费版，Docker EE 即企业版，强调安全，但需付费使用。
    
    Docker官网地址：https://www.docker.com
    Docker软件镜像查询地址：https://hub.docker.com/