### 命令
    
### Centos8.2安装Docker-CE
    如果使用超级管理员登录，不需要在命令前加sudo
#### 移除已安装的docker(若没有则跳过此步骤)
    sudo yum remove docker \
                      docker-client \
                      docker-client-latest \
                      docker-common \
                      docker-latest \
                      docker-latest-logrotate \
                      docker-logrotate \
                      docker-engine
#### 安装必要的一些系统工具
    sudo yum install -y yum-utils device-mapper-persistent-data lvm2
#### 添加软件源信息(由于国内使用官网的太慢,这里使用阿里的资源库来加速)
    sudo yum-config-manager --add-repo http://mirrors.aliyun.com/docker-ce/linux/centos/docker-ce.repo
#### 更新 yum 缓存
    sudo yum makecache
#### 更新并安装Docker-CE
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
#### 安装时出现下面的错误
----
    Error: transaction check vs depsolve:rpmlib(PayloadIsZstd) <= 5.4.18-1is needed by 
    containerd.io-1.2.10-3.2.fc31.x86_64To diagnose the problem, try running: 'rpm -Va --nofiles --nodigest'.
    You probably have corrupted RPMDB, running 'rpm --rebuilddb' might fix the issue
    
    这个是一般是版本依赖冲突，或者版本过高的问题，换为1.2.6-3.3版本即可
----
### 概述
    从 2017 年 3 月开始 docker 在原来的基础上分为两个分支版本: Docker CE 和 Docker EE。
    Docker CE 即社区免费版，Docker EE 即企业版，强调安全，但需付费使用。
    
    Docker官网地址：https://www.docker.com
    Docker软件镜像查询地址：https://hub.docker.com/