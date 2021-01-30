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