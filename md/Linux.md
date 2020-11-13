### 1. Linux 历史
#### 1.1 Linux 发展史
    1. 丹尼斯·李奇、肯·汤姆森  unix之父,linux的前身
    2. 李纳斯  linux之父
#### 1.2 Linux与Windows的区别
    1. Linux 免费开源
    2. Linux 消耗资源少
    3. Linux 安全
### 2. [Linux 系统](http://www.runoob.com/linux/linux-tutorial.html)
#### 2.1 多用户(设置默认进入字符界面)
| 命令 | 含义 |
| --- | --- |
| ctrl+shift+alt+[F1-F6] | 图形界面到字符界面 |
| alt+F7 | 字符界面到图形界面 | 
| alt+[F1-F6] | 字符界面之间切换 |   
#### 2.2 网络适配器
| 属性 | 含义 |
| --- | --- |
| 桥接 | 本地连接 |
| NAT | 网卡8(相当于虚拟机创建的一块本地连接) |
| host-only | 网卡一 |
#### 2.3 IP
| 命令 | 含义 |
| --- | --- |
| ifconfig | 查看IP |
| ifconfig eth0 IP 子网掩码 | 临时修改IP | 
| vi /etc/sysconfig/network-scripts/ifcfg-eth0 | 永久修改IP |
| service network restart(is) | 重启IP |
#### 2.4 快照
    备份存档
#### 2.5 目录结构
> + bin         // 存放普通用户使用的指令
> + sbin        // 存放超级用户的使用指令
> + dev         // 存放硬件设备
> + home        // 普通用户家目录
> + root        // 超级用户家目录
> + lost+ found // 碎片存放目录
> + tmp         // 临时目录
> + var         // 存放缓存目录
> + boot        // 存放启动进程文件
> + etc         // 存放配置文件
> + lib         // 存放库文件
> + mount       // 挂载目录
> + mnt         // 测试目录
> + usr         // 存放非操作系统文件
### 3. 基础命令
| 命令 | 含义 |
| --- | --- |
| cd   | 切换目录 |
| cd - | 切换最近使用的俩次目录 | 
| cd ..| 切换上级目录 |
| pwd  | 查看所在目录 |
| ls   | 查看目录 |
| ls --help | 指令帮助文档 |
| vi   | 编辑文件 |
| init 6 | 重启 |
| init 0 | 关机 |
| clear  | 清空界面 |
### 4. 文件
| 命令 | 含义 |
| --- | --- |
| touch  文件名 | 创建 |
| rm -rf 文件名 | 删除 | 
| cp -r 源文件 目标文件 | 复制 |
| mv 源文件 目标文件 | 移动(剪切) |
| vi/vim | 编辑文件 |
| less   | 查看文件 |
| cat 文件名称 \| grep 查找内容 | 查找内容 |
| more 文件名称(空格-页,回车-行,q-退出) | 查看文件 |
| head -n 行数 文件名 | 查看文件头部 |
| tail -n 行数 文件名 | 查看文件底部 |
| find 搜素范围 -name 文件名称 | 搜索文件,返回其路径 |
| updatedb       | 创建或更新 slocate/locate 命令所必需的数据库文件 |
| locate 文件名称 | 检测一个文件是否存在 |
### 5. 目录
| 命令 | 含义 |
| --- | --- |
| mkdir  目录名            | 创建 |
| mkdir  -p 目录1/目录2    | 递归创建,创建目录1并在目录1下创建目录2 | 
| mkdir {目录1/目录2}/目录3 | 同时创建,在目录1和目录2下分别创建目录3 |
| rm -rf 目录名            | 删除目录及包含文件 |
| cp -r 源目录 目标目录      | 复制 |
| mv 源目录 目标目录         | 移动(剪切) |
| tree                    | 查看目录结构,需要单独安装 |
### 6. 用户管理
| 命令 | 含义 |
| --- | --- |
| useradd  用户名称 | 创建用户 |
| password 用户名称 | 设置密码 | 
| userdel  用户名称 | 删除用户 |
| vi /etc/passwd  | 修改用户信息 |
| vi /etc/shadow  | 修改用户密码 |
| vi /etc/group   | 修改用户组信息 |
#### 6.1 用户权限管理
#### 6.2 原理
    每个文件拥有一个所属用户和所属组,对应UGO,不属于该文件所属用户或所属组使用O来表示
    在Linux系统中,可以通过ls –l查看peter.net目录的详细属性
    例如: drwxrwxr-x   2 peter1 peter1 4096 Dec 10 01:36 peter.net
    1.d 表示目录,同一位置如果为-则表示普通文件
    2.rwxrwxr-x 表示三种角色的权限,每三位为一种角色,依次为u,g,o权限,如上则表示user的权限为rwx,group的权限为rwx,other的权限为r-x
    3.2表示文件夹的链接数量,可理解为该目录下子目录的数量
    4.从左到右,第一个peter1表示该用户名,第二个peter1则为组名,其他人角色默认不显示
    5.4096表示该文件夹占据的字节数
    6.Dec 10 01:36 表示文件创建或者修改的时间
    7.peter.net 为目录的名,或者文件名
#### 6.3 权限类型
| 命令 | 含义 |
| --- | --- |
| r   | 文件: 读取文件    目录: 查看目录 |
| w   | 文件: 写入文件    目录: 创建目录 |
| x   | 文件: 执行       目录: 切换    |
| rwx | 文件: 所有者权限(u)--读写权限 |
| r_x | 文件: 所属组权限(g)--只读权限 |
| r__ | 文件: 其他人权限(o)         |
#### 6.4 [Chmod 权限设置](http://www.cnblogs.com/fengdejiyixx/p/10773731.html)
| 命令 | 含义 |
| --- | --- |
| chmod  –R  u+rwx  文件名 | 授予用户 拥有 rwx 权限 |
| chmod  –R  g+rwx  文件名 | 授予组  拥有 rwx 权限 |
| chmod  –R  u+rwx,g+rwx,o+rwx  文件名 | 授予用户、组、其他人 拥有 rwx 权限 |
| chmod  –R  u=rx,g=rx,o=rx  文件名    | 授予用户、组、其他人 只有 rx  权限 |
| chmod  –R  u-w  文件名 |撤销用户 拥有 w 权限 |
| chmod  –R  u-x,g-x,o-x 文件名 | 撤销用户、组、其他人 拥有 x 权限 |
| chmod  –R  755 文件名 | 授予用户 拥有 rwx 权限 |
| chmod  –R  775 文件名 | 授予组  拥有 rwx 权限 |
| chmod  –R  777 文件名 | 授予用户、组、其他人 拥有 rwx 权限 |

    Linux权限可以将rwx用二进制来表示,其中有权限用1表示,没有权限用0表示
    Linux权限用二进制显示如下
    rwx=111
    r-x=101
    r--=100
    依次类推,转化为十进制,对应十进制结果显示如下
    rwx=111=4+2+1=7
    r-x=101=4+0+1=5
    rw-=110=4+4+0=6
    r--=100=4+0+0=4
#### 6.5 Sudo 权限设置
| 参数 | 含义 |
| --- | --- |
| V  | 显示版本编号 |
| -h | 会显示版本编号及指令的使用方式说明 |
| -l | 显示出自己（执行 sudo 的使用者）的权限 |
| -v | 因为 sudo 在第一次执行时或是在 N 分钟内没有执行（N 预设为五）会问密码,这个参数是重新做一次确认,如果超过 N 分钟,也会问密码 |
| -k | 将会强迫使用者在下一次执行 sudo 时问密码（不论有没有超过 N 分钟）|
| -b | 将要执行的指令放在背景执行 |
| -p | prompt 可以更改问密码的提示语,其中 %u 会代换为使用者的帐号名称, %h 会显示主机名称 |
| -u | username/#uid 不加此参数,代表要以 root 的身份执行指令,而加了此参数,可以以 username 的身份执行指令（#uid 为该 username 的使用者号码）|
| -s | 执行环境变数中的 SHELL 所指定的 shell ,或是 /etc/passwd 里所指定的 shell |
| -H | 将环境变数中的 HOME （家目录）指定为要变更身份的使用者家目录（如不加 -u 参数就是系统管理者 root ） |
| command | 要以系统管理者身份（或以 -u 更改为其他人）执行的指令 |
#### 6.6 [Acl 权限设置](http://www.cnblogs.com/ysocean/p/7801329.html#_label0)
| 命令 | 含义 |
| --- | --- |
| setfacl -m u:用户名:权限 指定文件名 | 给用户设定 ACL 权限 |
| setfacl -m g:组名:权限  指定文件名  | 给组设定 ACL 权限  |
| getfacl 文件名                   | 查看 ACL 权限      |
| setfacl -m m:权限 文件名          | 最大有效权限 mask   |
| setfacl -x u:用户名 文件名         | 删除指定用户的 ACL 权限 |
| setfacl -x g:组名 文件名           | 删除指定用户组的 ACL 权限 |
| setfacl -b 文件名                  | 删除文件的所有 ACL 权限 |
| setfacl -m u:用户名:权限 -R 文件名   | 通过加上选项 -R 递归设定文件的 ACL 权限,所有的子目录和子文件也会拥有相同的 ACL 权限 |
| setfacl -m d:u:用户名:权限 文件名    | 如果给父目录设定了默认的 ACL 权限,那么父目录中所有新建的子文件会继承父目录的 ACL 权限 |
### 7. 程序安装
#### 7.1 Yum 安装
| 命令 | 含义 |
| --- | --- |
| yum check-update      | 列出所有可更新的软件清单命令 |
| yum update            | 更新所有软件命令 |
| yum install 程序名     | 仅安装指定的软件命令 |
| yum update 程序名      | 仅更新指定的软件命令 |
| yum list              | 出所有可安裝的软件清单命令 |
| yum remove 程序名      |  删除软件包命令 |
| yum search 程序名       | 查找软件包 命令 |
| yum clean packages     | 清除缓存目录下的软件包 |
| yum clean headers      | 清除缓存目录下的 headers |
| yum clean oldheaders   | 清除缓存目录下旧的 headers |
| yum clean, yum clean all (= yum clean packages; yum clean oldheaders) / 清除缓存目录下的软件包及旧的headers |
#### 7.2 [Rpm 安装](http://www.runoob.com/linux/linux-comm-rpm.html)
    一下流程可能有误,暂时无法确定
    1. 准备yum源
    2. 挂载 mount /dev/cdrom/media
    3. 查看挂载 df -h
    4. 关闭网络仓库 mv Contos-Base.repo Contos-Base
    5. 卸载 umout /media
    6. 随机启动
        vi /etc/fstab
           /dev/cdrom /media is09660
    7. 修改配置
        [c5-media]
            baseurl=file::///media/     // 指定仓库
            gpgcheck=0                  // 关闭签名
            enabled=1                   // 开启仓库
    8. 安装 rpm -ivh *.rpm
### 8. 压缩包管理
#### 8.1 tar.gz
| 命令 | 含义 |
| --- | --- |
| tar czf 压缩包名 被压缩文件[目录]名 | 压缩 |
| tar ft  压缩包名                 | 查看 |
| tar zxf 压缩包名                 | 解压 |
#### 8.2 zip
| 命令 | 含义 |
| --- | --- |
| zip -r   压缩包名 被压缩文件[目录]名 | 压缩 |
| unzip -l 压缩包名                 | 查看 |
| unzip    压缩包名                 | 解压 |
### 9. 别名管理
| 命令 | 含义 |
| --- | --- |
| alias         | 查看 |
| alias w='a b' | 创建 |
| unalias w     | 删除 |
### 10. Shell 技巧
| 命令 | 含义 |
| --- | --- |
| tab | 自动补全 |
| \|  | 管道符  |
| !*  | 执行最近一次以 '*' 开头的命令 |