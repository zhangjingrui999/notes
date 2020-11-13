### 1. 虚拟主机
```linux
<VirtualHost *:80>
    DocumentRoot    项目入口路径
    ServerName      域名
    <Directory      项目入口路径>
    Options Indexes FollowSymlinks
    AllowOverride   All
    Require all granted
</VirtualHost>
```