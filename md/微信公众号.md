### 运行机制
    用户在公众号上发送消息 -> 微信服务器 -> 开发者服务器 -> 微信服务器 -> 反馈用户
### 各公众号区别
    订阅号: 提供咨询,在订阅号文件夹中存在
    服务号: 提供服务,在会话列表中存在
    企业号: 企业内部使用,类似QQ群
### 自定义菜单
    一级菜单 最多三个,每个最多四个汉字(多出部分以 ... 代替)
    二级菜单 最多五个,每个最多七个汉字(多出部分以 ... 代替)
### 验证消息准确性
```php
<?php
    class Wx
    {
        public function valid()
        {
            $signature = $_GET['signature']; // 微信加密签名
            $timestamp = $_GET['timestamp']; // 时间戳
            $nonce = $_GET['nonce'];         // nonce随机数
            $echostr = $_GET['echostr'];     // 随机字符串
            define('TOKEN','gh');            // token 签名
            $tmpArr = array(TOKEN,$timestamp,$nonce); // 将token、timestamp、nonce 三个参数进行字典排序
            sort($tmpArr,SORT_STRING);       // 进行字典排序
            $newStr = sha1(join($tmpArr));   // 将三个字符串拼接成一个字符串进行 sha1 加密
            if($signature == $newStr)
            {
                echo $echostr; // 若确认此次GET请求来自微信服务器,原样返回echostr参数内容,则接入生效
            }
            // 获取加密后的字符串可与signature对比,标识该请求来源于微信
        }
    }
```