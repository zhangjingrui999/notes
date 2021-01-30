### 1. 环境
#### 1.1 流程
    客户端 -> 浏览器 -> 网址 -> DNS -> IP -> 端口 -> web服务器 -> PHP脚本 -> PHP解析器 -> 数据库 -> 处理数据 -> 形成HTML文档 -> 浏览器 -> 用户
    
#### 1.2 Windows配置
    域名解析文件(C:/windows/system32/drivers/etc/hosts)
        修改此文件可改变域名的解析的IP地址
        127.0.0.1 #IP地址,此为本机   localhost # 域名

    运行 -> cmd -> net stop  apache24   // 关闭apache
               -> net start apache24   // 启动apache
               -> net stop  mysql57    // 关闭数据库
               -> net start mysql57    // 启动数据库

    我的电脑 -> 右键 -> 管理 -> 服务 -> apache24/mysql57  // 管理apache及数据库等服务项
    
### 2. 变量
#### 2.1 作用
    灵活 重用
    
#### 2.2 变量类型
| 类型 | 符号 |     |
| --- | --- | --- |
| 整型   | int      | 标准类型 |
| 浮点型 | float    | 标准类型 |
| 字符串 | string   | 标准类型 |
| 布尔型 | bool     | 标准类型 |
| 数组   | array    | 复合类型 |
| 对象   | object   | 复合类型 |
| 资源   | resource | 特殊类型 |
| null  | null     | 特殊类型 |

#### 2.3 字符串解析变量(单双引号的应用)
    echo "My {$string}!";
    echo "My ".$string."!";
    echo 'My '.$string.'!';

    双引号可以解析变量
    双引号不可以解析变量
    双引号变量尽量用 {} 括起来
    双引号中只是解析变量并不会执行表达式，要执行用 . 连接
    单引号和双引号要交叉使用
    单双引号在引用时要用 \ 把特殊性取消掉
    
#### 2.4 打印数组
```php
    echo "<pre>";
    print_r();
    echo "</pre>>";
```

#### 2.5 变量测试
    var_dump(); // 打印 值及值的类型
    
#### 2.6 对象定义
    类   class Class_name{}
    对象 $obj = new Class_name();
    
#### 2.7 为空
    empty() // 检测变量是否为空 null 0 '0' '' false 0.0 []
    isset() // 检测变量是否存在 undefined null
    
#### 2.8 变量类型转换
    gettype();  判断变量类型(不会输出,或用 echo 输出)
    
##### 2.8.1 变量类型自动转换
    字符串 -> 整型   $str='10'; echo($str+20); 30
    整型 -> 字符串   $str=10; echo($str.'20'); 1020
    所有类型 -> 布尔型  自动转换为 0/1
    
##### 2.8.2 变量强制转换
| 函数 | 含义 |
| --- | --- |
| (int) | 强制转为整型 |
| (float) | 强制转为浮点型 |
| (bool)  | 强制转为布尔型 |
| (string)| 强制转为字符型 |
| (array) | 强制转为数组 |
| (object)| 强制转为对象 |

#### 2.9 变量的精确测试
| 函数 | 含义 |
| --- | --- |
| is_int() | 是否为整型 0/1 |
| is_float() | 是否为浮点型 0/1 |
| is_bool()  | 是否为布尔型 0/1 |
| is_string()| 是否为字符型 0/1 |
| is_array() | 是否为数组 0/1 |
| is_object()| 是否为对象 0/1 |
| is_null()  | 是否为空值 0/1 |
| is_resource() | 是否为资源 0/1 |
| is_scalar()| 是否为标量 0/1 |
| is_callable() | 是否为函数 0/1 |

### 3. 常量
    定义 define(大写字母,值);
    输出 echo 大写字母;
    测试 defined(大写字母);
    
#### 3.1 预定义常量
| 预定义常量 | 含义 |
| --- | --- |
| __LINE__ | 行号 |
| __FILE__ | 系统绝对路径 |
| __FUNCTION__ | 函数 |
| M_PI | 圆周率 |

### 4. 运算符
#### 4.1 一元运算符
    ++ -- 自增自减,不会改变bool的值
    
#### 4.2 二元运算符
    数学 + - * / %
    逻辑 
        &&  前面为真才会执行后面
        ||  前面为假才会执行后面
    赋值 = += -= *= /= %= .=
    比较 > < == >= <= != === !==
```php
$a = 1;
$b = 0;
if( $a && ++$b) {
    echo 'true<br/>';
    echo($a.':'.$b);
}else{
    echo 'false<br/>';
    echo($a.':'.$b);
}
```

#### 4.3 三元运算符
    ... ? true : flase;
    ... ?: flase;
    
#### 4.4 运算符优先级(递减,可用()提高优先级)
    一元 ++ --
    数学 + - * / %
    比较 > < == >= <= != === !==
    位   & |
    逻辑 && ||
    三元 ? :  
    赋值 = += -= *= /= %= .=
    
### 5. 流程控制
```php
if(true) {
    
} elseif (true) {

} else {

}

switch(true) {
    case '' :
        break;
    case '' :
        break;
    default:
}

while (true) {

}

do{

}while(true);

for(;;) {

}

foreach ($data as $d => $value) {

}

foreach ($data as $value) {

}

// continue;
// 结束本轮循环开始下一轮

// 跳转至相应位置,并终止循环等流程控制
goto less;

less:
```

### 6. 函数
| 函数 | 含义 |
| --- | --- |
| function_exists() | 判断函数有没有被定义 |
| method_exists()   | 判断类内的方法存不存在 |
| is_callable()     | 检测参数是否为合法的可调用结构 |

    系统函数    phpinfo()
    自定义函数  function name() {
                // code  
              }
    函数调用    name();
    
#### 6.1 变量作用域
    全局变量    函数外面的变量,只能在函数外使用
    局部变量    函数里面的变量,只能在函数里面使用
    global    可以打通变量作用域使得全局变量和局部变量通用
    static    依附于相同函数多次调用时累计加减
    
#### 6.2 函数输出结果
```php
// 函数体内输出
function f1($i,$j) {
    echo $i+$j;
}

// 函数体外输出
function f2($i,$j) {
    return $i+$j;
}
```

#### 6.3 参数使用
```php
function show($i,$j=2) {
    return $i+$j;
}
show(10,20);

// 同地址参数 $i = &$i
function show2(&$i) {
    return $i++;
}
```

#### 6.4 可变参数个数的函数
    func_num_args   实参个数
    func_get_arg    返回某一个实参,必须事实参数组的索引
    func_get_args   返回实参数组
    
#### 6.5 回调函数是另一个函数的名字

#### 6.6 变量函数
```php
function show() {
    // echo
}
$str = 'show';
$str();
```

#### 6.7 递归函数
    函数自己调用自己,不可出现递归死循环
    用途
        统计目录大小
        复制目录
        移动文件
        删除目录
```php
    $a =3;
    function sum($a) {
        echo "{$a}<br />";
        if($a > 1) {
            sum($a--);
        }
        echo "{$a}<br />";
    }
    sum($a);
/*
sum(3) {
    echo 3;
    sum(2) {
        echo 2;
        sum(1) {
            echo 1;
            echo 1;
        }
        echo 2;
    }
    echo 3;
}
*/
```

### 7. 文件包含
    include  当包含文件有问题时,错误级别warning,但不会终止脚本执行
    include_once 只包含一次
    require  当包含文件有问题时,错误级别error,终止脚本执行
    require_once 只包含一次
    
### 8. 数组
#### 8.1 定义
    $arr = array(1,2,3); 因apache版本兼容,推荐使用
    $arr = [1,3,5];
    print_r($arr); 
    var_dump($arr);
        key value
        下标 值
        键   值
        
#### 8.2 类型
#### 8.2.1 维度
    一维  $arr = [1,2,3];
    二维  $arr = [
            1,
            [1,2]
         ];
    多维  $arr = [
            ['1',2,3],
            [
                [1,2,3],
                [1,2,3]
            ]
         ];
         
#### 8.2.2 下标
    索引数组    下标为数字
    关联数组    下标为字符串
    混合数组    数字和字符串混合
    
#### 8.3 取/赋值
    echo $arr[2][2][1];
    
    $arr[2][2][0] = 'linux';
    1. 无下标,系统默认下标从0开始递增
    2. 下标允许为空
    
#### 8.4 遍历
```php
for(;;) {}

while(list($x,$y) = each($arr)) {
    echo "{$x} ==> {$y}";
}

foreach ($arr as $key => $value) {
    echo "{$x} ==> {$y}";
}
``` 

### 9. 超全局数组
| 数组 | 含义 |
| --- | --- |
| $_GET  | 接收地址栏中传递给脚本的参数 |
| $_POST | 接收表单传过来的POST数据   |
| $_REQUEST | $_GET \/ $_POST     |
| $GLOBALS  | 接收 get post cookie files数组 |
| $_SERVER['SERVER_NAME']    | 域名 |
| $_SERVER['SERVER_SOFTWARE']| PHP软件平台  |
| $_SERVER['SERVER_PORT']    | WEB服务器端口|
| $_SERVER['SERVER_ROOT']    | 网站根目录   |
| $_SERVER['REQUEST_SCHEME'] | 访问协议(http/s) |
| $_SERVER['SCRIPT_FILENAME']| 脚本系统路径 |
| $_SERVER['QUERY_STRING']   | 脚本参数    |
| $_SERVER['REQUEST_URL']    | URL地址    |
| $_SERVER['SCRIPT_NAME']    | 脚本网站路径 |
| $_SERVER['PHP_SELF']       | 脚本网站路径 | 
| $_SERVER['HTTP_USER_AGENT']| 客户端浏览器信息 |
| $_SERVER['REMOTE_ADDR']    | 客户端IP |

### 10. 系统函数
#### 10.1 数组键值操作函数
| 函数 | 含义 |
| --- | --- |
| array_values($arr) | 获取数组中的值 |
| array_keys($arr)   | 获取数组中的键 |
| key() | 获取当前指针所在的键,配合 next()使用可遍历数组 |
| current() | 获取当前指针所在的值,配合 next()使用可遍历数组 |
| array_flip($arr)   | 键值对调 |
| in_array(str,$arr) | 检查一个值是否在数组中 |
| array_search(str,$arr) | 搜索指定的值,并返回键 |
| array_key_exists(str,$arr) | 检查一个键是否在数组中 |
| array_reverse($arr,[true]) | 数组中的值反排序[键值保持映射] |

#### 10.2 统计数组的元素和唯一性
| 函数 | 含义 |
| --- | --- |
| count($arr,[1]) | 统计数组的值的个数,当有参数1时为递归统计且次维数组本身算1 |
| array_count_values($arr,[str]) | 统计数组中某个值出现的次数 |
| array_unique($arr)    | 删除数组中重复的值 |
| array_filter($arr)    | 删除数组中值为0,为空的 |
| array_map(函数名,$arr) | 将回调函数作用到数组值中|

#### 10.3 数组的排序函数(改变原数组)
| 函数 | 含义 |
| --- | --- |
| sort($arr,[SORT_NUMERIC \| SORT_REGULAR \| SORT_STRING ])   | 按值升序,不保留key [按数值 \| 按ASCII \| 人的认知] |
| rsort($arr)  | 按值降序,不保留key |
| asort($arr)  | 按值升序,保留key  |
| arsort($arr) | 按值降序,保留key  |
| ksort($arr)  | 按键升序,保留key  |
| krsort($arr) | 按键降序,保留key  |
| natsort($arr)| 按值自然数升序    |
| natcasesort($arr) | 忽略大小写,按值自然数升序 |
| array_multisort($arr,$arr) | 用前数组对后数组进行排序 |
| usort($arr,funName) | 用户自定义排序 /

#### 10.4 数组截取合并
| 函数 | 含义 |
| --- | --- |
| array_slice($arr,下标,个数) | 从下标开始截取值 |
| array_splice($arr,下标,个数)| 从下标截取值,并删除相应值 |
| array_combine($arr,$rra)  | 合并数组,$arr为键 $rra为值 |
| array_merge($arr,$rra)    | 合并,键值相同,后面覆盖前面 |
| array_merge_recursive($arr,$rra) | 合并,键值相同,形成键数组 |
| array_intersect() | 数组交集 |
| array_intersect_key() | 返回数组,并返回第一个数组中相同值后 最短数组的长度的值 |
| array_intersect_ukey()| 用户自定义比较函数 |
| array_intersect_assoc() | 数组交集,考虑键值 |
| array_diff() | 数组差集 |
| array_diff_assoc() | 数组差集,考虑键值 |

#### 10.5 数组分割和连接
| 函数 | 含义 |
| --- | --- |
| join($arr) | 把数组连接成字符串 |
| explode(str,$arr) | 把字符串按 str 分割为数组 |
| str_split($str,[num]) | 将字符串按[num长度]分割为数组 |

#### 10.6 数组与数据结构(改变原数组)
| 函数 | 含义 |
| --- | --- |
| array_pop($arr)      | 弹出最后一个值,并返回弹出值 |
| array_push($arr,str) | 在最后压入一个值,并返回数组长度 |
| array_shift($arr)    | 弹出第一个值,返回弹出值,原数组重新排序 |
| array_unshift($arr,str) | 在前面插入一个值,并返回数组长度 |
| array_rand($arr,[int]) | 随机取出int个键,默认为1 |
| shuffle($arr)    | 打乱数组   |
| array_sum($arr)  | 计算值之和 |
| range(str1,str2) | 创建一个包含从 str1 到 str2 之间的元素范围的数组 |
| array_walk($arr,funName) | 向函数递归传入值 |
| array_chunk($arr,num) | 将数组分为 num 份,最后一份不足则少 |

#### 10.7 移动数组指针
| 函数 | 含义 |
| --- | --- |
| next() | 移动到下一位 | 
| prev() | 移动到上一位 |
| reset()| 移动到第一位 |
| end()  | 移动到最后位 |

### 11. 字符串
    定义 $str = "";
    输出 echo $str;
        print $str;
        var_dump($str); 输出值类型
        exit($str);     输出后结束脚本
        die($str);      输出后结束脚本
        printf('%s$d%f',$a,$b,$c);          按格式输出
        $str = sprintf('%s%d%f',$a,$b,$c);  不能直接输出,只返回数据
        
#### 11.1 去除空格和字符串填补函数
| 函数 | 含义 |
| --- | --- |
| ltrim($str) | 去除左侧空格 |
| rtrim($str) | 去除右侧空格 |
| trim($str)  | 去除左右空格 |
| str_pad($str,num,'',STR_PAD_BOTH) | 将''添加num次到$str俩端,默认(STR_PAD_LEFT 左端,STR_PAD_RIGHT 右端) |
| str_repeat($str,num) | 字符串重复   |

#### 11.2 字符串大小写转换
| 函数 | 含义 |
| --- | --- |
| strtoupper($str) | 小写转大写 |
| strtolower($str) | 大写转小写 |
| ucfirst($str)    | 首字母大写 |
| ucwords($str)    | 单词首字母大写 |

#### 11.3 字符串格式化
| 函数 | 含义 |
| --- | --- |
| strlen($str) | 字符串长度 |
| strrev($str) | 字符串翻转 |
| number_format($arr,num) | 格式化数字字符串 |
| md5($str) | 以MD5加密一个字符串,输出32位 |
| str_shuffle($str) | 随机输出字符串 |
| strcmp() | 区分大小写判断两个字符串; 相等 返回0,左大 返回1,右大 返回-1 |
| strcasecmp() | 不区分大小写判断两个字符串; 相等 返回0,左大 返回1,右大 返回-1 |
| strspn() | 返回左字符串的字符在右字符串中的个数 |
| strcspn() | 返回左字符串的字符不在右字符串中的个数 |
| count_chars() | 返回字符串中字符的出现频次 |
| str_word_count() | 返回字符串中的单词总数 |

#### 11.4 字符串的截取
| 函数 | 含义 |
| --- | --- |
| strstr($str,$s) | 返回$s后的字符串 | 
| substr($str,下标,个数)    | 单字符截取 |
| mb_substr($str,下标,个数) | 多字符截取 |
| substr_count($str,$s) | 返回$s在字符串中的出现次数 |
| substr_replace($str,$s,i,ii) | 将i到ii的$str替换为$s |
| strpos($str,'')  | 查找第一次出现的位置 |
| strrpos($str,'') | 查找最后一次出现的位置 |
| str_replace('old','new',$str) | 字符串的替换 |

#### 11.5 与html标签相关联的字符串函数
| 函数 | 含义 |
| --- | --- |
| nl2br($str) | 把\n转成br标签 |
| addslashes($str)  | 使用反斜线引用字符串 |
| stripslashes($str)| 取消addslashes默认添加的\ |
| htmlentities() | 解特殊字符 |
| htmlspecialchars($str) | 转实体, . < > & |
| htmlspecialchars_decode($str) | 解实体, . < > & |
| strip_tags($str,'<>')  | 去掉html标签,'<>'中是可保留的 |
| strtr($html,$arr) | 将HTML中的数组键替换为数组值 |
| strip_tags($html,[<>]) | 删除字符串中的[]标签,只保留文本 |
| strtok($str,$info) | 通过info对字符串进行拆分,需要连续调用 |
| escapeshellarg() | 单引号转义字符串 |
| escapeshellcmd() | 转义可能危险的字符 |

#### 11.6 路径处理函数
| 函数 | 含义 |
| --- | --- |
| dirname($str)  | 输出路径的目录部分 |
| basename($str) | 输出路径的文件部分 |
| pathinfo($str) | 路径解析 |
| parse_url($str)| URL解析 |
| parse_str($str)| 把查询字符串解析到变量中 |
| realpath()     | 将传入的路径转为绝对路径 |

### 12. 正则表达式
#### 12.1 原子(匹配实物的最小单元)
| 原子 | 含义 |
| --- | --- |
| .   | 任意一个字符 |
| a-z | a-z中任意一个字母 |
| 0-9 | 0-9中任意一个数字 |
| \d  | 匹配数字 |
| \D  | 匹配非数字|
| \w  | 匹配字符  |
| \W  | 匹配非字符 |
| \s  | 匹配空格  |
| \S  | 匹配非空格 |
| \b  | 匹配边界  |
| \B  | 匹配非边界|

#### 12.2 转义符
    \. \* \+ \? \| \^ \$ \[\] \{\} \(\)
    
#### 12.3 元字符(修饰原子)
    * 0个或多个     + 1个或多个     ? 0个或1个
    | ^ $ \b \B [] [^] {m} {m,n} {m,} ()
    
#### 12.4 模式修正符(修饰原子符和元子符)
| 修正符 | 含义 |
| --- | --- |
| U | 非贪婪模式 |
| m | 正则中单行视为多行 |
| i | 忽略大小写 |
| s | 可匹配换行符 |
| e | 替换的时候,可以让字符串变成表达式去执行 |
* e 在7以上版本停用, 改用preg_replace_callback

#### 12.5 正则函数
| 函数 | 含义 |
| --- | --- |
| preg_match() | 匹配一次,返回值是匹配次数 |
| preg_match_all($ptn,$str,$arr) | 逐行匹配,返回值是匹配次数 |
| preg_replace($ptn,$rep,$str)   | 正则替换 |
| preg_replace_callback($btn,$str,$arr) | 代替7以前的e模式修正符 |
| preg_split($ptn,$str) | 正则分割 |
| preg_grep($ptn,$arr)  | 一维数组搜索 |
```php
// 手机号码
$str = '13312345678';
$ptn = '/^ \d{11} $/';
preg_match($ptn,$str,$arr);


// 邮箱
$str = '123@qq.com';
$ptn = '/^ \w+@\w+\.(com|net|cn) $/';
preg_match($ptn,$str,$arr);


// URL格式
$str = 'www.baidu.com';
$ptn = '/^ (\w+\.)?\w+\.\w+(\.\w+)? $/';
preg_match($ptn,$str,$arr);


// 验证码1
$arr = array_merge(range(0-9),range(a-z),range(A-Z));
shuffle($arr);
$arr = array_slice($arr,0,6);
$verify = join('',$arr);


// 验证码2
$arr = range(0,9);
for($i=0;$i<6;$i++) {
    $str = array_rand($arr);
}
echo $str;
```

### 13. 数学函数
| 函数 | 含义 |
| --- | --- |
| round() | 四舍五入 |
| min() | 最小值 |
| max() | 最大值 |
| mt_rand() | 随机值 |
| ceil()  | 上取整 |
| floor() | 下取整 |

### 14. 时间函数
| 函数 | 含义 |
| --- | --- |
| time() | 时间戳 |
| mktime([H],[i],[s],[m],[d],[Y]) | 获取指定日期时间戳 |
| date() | 时间戳转日期 |
| strtotime() | 日期转时间戳 |
| checkdate(month,day,year) | 判断日期是否有效 |
| gettimeofday() | 返回当前时间的数组 |
| getdate() | 返回对用户友好时间数组 |
| setDate() | 设置date日期对象 |
| modify() | 修改date对象 |
| setTime() | 设置时分秒 |
| ->diff()  | 计算日期之差 | 
| setlocale() | 设置时间环境 zh_CN.b3212简体中文 |
| strftime() | 根据时间环境,格式化本地日期和时间 |
| getlastmod() | 返回该页面的最后修改时间和日期信息,配合date()使用 |

    a - "am" 或是 "pm"
    A - "AM" 或是 "PM"
    d - 几日，bai二位数字，若不足二位则前面du补零; 如: "01" 至 "31"
    D - 星期几，三个英文字母; 如: "Fri"
    F - 月份，英文全名; 如: "January"
    h - 12 小时制的小时; 如: "01" 至 "12"
    H - 24 小时制的小时; 如: "00" 至 "23"
    g - 12 小时制的小时，不足二位不补零; 如: "1" 至 12"
    G - 24 小时制的小时，不足二位不补零; 如: "0" 至 "23"
    i - 分钟; 如: "00" 至 "59"
    j - 几日，二位数字，若不足二位不补零; 如: "1" 至 "31"
    l - 星期几，英文全名; 如: "Friday"
    m - 月份，二位数字，若不足二位则在前面补零; 如: "01" 至 "12"
    n - 月份，二位数字，若不足二位则不补零; 如: "1" 至 "12"
    M - 月份，三个英文字母; 如: "Jan"
    s - 秒; 如: "00" 至 "59"
    S - 字尾加英文序数，二个英文字母; 如: "th"，"nd"
    t - 指定月份的天数; 如: "28" 至 "31"
    U - 总秒数
    w - 数字型的星期几，如: "0" (星期日) 至 "6" (星期六)
    Y - 年，四位数字; 如: "1999"
    y - 年，二位数字; 如: "99"
    z - 一年中的第几天; 如: "0" 至 "365"
    
```php
<?php
    $year = $_GET['Y'] ?: date('Y');
    $month = $_GET['m']?: date('m');
    $days = date('t',strtotime("{$year}-{$month}"));
    $week = date('w',strtotime("{$year}-{$month}-1"));
    $first = 1-$week;
    $nextMonth = $month+1;
    $prevYear  = $year;
    $prevMonth = $month-1;

    if($nextMonth > 12) {
        $nextYear = $year + 1;
        $nextMonth=1;
    }
    if($prevMonth < 1) {
        $prevMonth = 12;
        $prevYear = $year - 1;
    }

    $time = new DateTime('2020-12-31');
    $times = new DateTime('today');
    $span = $time->diff($times);
    echo "{$span->format('%d')}"    

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>万年历</title>
</head>
<body>
    <table width="1000px" border="1px" cellspacing="0" align="center">
        <caption>万年历<?php echo "{$year}年{$month}月" ?></caption>
        <tr>
            <th>周日</th>
            <th>周一</th>
            <th>周二</th>
            <th>周三</th>
            <th>周四</th>
            <th>周五</th>
            <th>周六</th>
        </tr>
        <?php
            for($i=$first;$i<=$days;) {
                echo '<tr>';
                for($j=0;$j<7;$j++) {
                    if($i>$days || $i<1) {
                        echo '<td></td>';
                    } else {
                        echo "<td>{$i}</td>";
                    }
                    $i++;
                }
                echo '</tr>';
            }
        ?>
    </table>
    <p>
        <a href="./index.php?Y=<?php echo $prevYear; ?>&m=<?php echo $prevMonth; ?>">上一月</a>
        <a href="./index.php?Y=<?php echo $nextYear; ?>&m=<?php echo $nextMonth; ?>">下一月</a>
    </p>
</body>
</html>
```

#### 14.1 更改时区
    php.ini
    date.timezone = PRC
    重启web服务器
    
#### 14.2 不修改配置文件
    查看 ini_get()
    修改 ini_set()
    修改时区
        date_default_timezone_set('PRC');
        date_default_timezone_get();
        
### 15. 错误级别
#### 15.1 默认的报错设置项
    error_reporting = E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
    
#### 15.2 报错级别
| 设置项 | 含义 |
| --- | --- |
| E_NOTICE | 错误提示 |
| E_DEPRECATED | 已弃用 |
| E_WARNING | 警告 |
| E_ERROR | 错误 |
| E_PARSE | 语法 |

#### 15.3 PHP脚本执行过程
    1. 语法检测
        parse
    2. 脚本执行
        notice
        warning
        error
        
#### 15.4 函数
| 函数 | 含义 |
| --- | --- |
| error_get_last() | 返回最后出现的错误类型、消息、文件、行号|

### 16. 图片处理
```php
// 1. 创建画布资源
    $img = imagecreatetruecolor(x,y);
// 2. 准备颜色
    $red = imagecolorallocate($img,255,0,0);   // 红色
    $green = imagecolorallocate($img,0,255,0); // 绿色
    $blue = imagecolorallocate($img,0,0,255);  // 蓝色
// 3. 在画布上画字符串
    $str = '字符串';
    imagettftext($img,50,0,100,170,$blue,'字体',$str);
// 4. 在浏览器上输出
    header('content-type:image/png');
    imagepng($img);
// 5. 保存图片
    imagepng($img,'a.png');
// 6. 释放画布资源
    imagedestroy($img);
// 7. html中使用PHP输出图片
    <img src="index.php" />
// 画点
    imagesetpixel($img,250,150,$white);
// 画点干扰素
    for($i=0;$i<1000;$i++) {
        $x = mt_rand(0,500);
        $y = mt_rand(0,300);
        imagesetpixel($img,$x,$y,$blue);
    }
// 画线
    imageline($img,0,0,500,300,$blue);
// 画线干扰素
    for($i=0;$i<1000;$i++) {
        $x1 = mt_rand(0,500);
        $y1 = mt_rand(0,300);
        $x2 = mt_rand(0,500);
        $y2 = mt_rand(0,300);
        imageline($img,$x1,$y1,$x2,$y2,$blue);
    }
// 画矩形
    imagerectangle($img,100,100,400,200,$blue);
// 画填充额矩形
    imagefilledrectangle($img,100,100,400,200,$blue);
// 画矩形干扰素
    for($i=0;$i<100;$i++) {
        $x1 = mt_rand(0,500);
        $y1 = mt_rand(0,300);
        $x2 = mt_rand(0,500);
        $y2 = mt_rand(0,300);
        imagerectangle($img,$x1,$y1,$x2,$y2);
    }
// 画多边形(填充)
    $arr = [n1,n2];
    imagefilledpolygon($img,$arr,n,$red);
// 多边形干扰素
    for($i=0;$i<100;$i++) {
        $arr = [mt_rand(0,500),n组];
        imagepolygon($img,$arr,n,$red);
    }
// 画椭圆
    imageellipse($img,250,150,50,50,$blue);
// 填充椭圆
    imagefilledellipse($img,250,150,50,50,$blue);
// 椭圆干扰素
    for($i=0;$i<100;$i++) {
        imageellipse($img,mt_rand(0,500),mt_rand(0,300),mt_rand(0,500),mt_rand(0,300),$blue);
    }
// 画弧线
    imagearc($img,250,150,200,200,0,80,$blue);
// 画填充弧线
    imagefilledarc($img,250,150,200,200,0,80,$blue,IMG_ARC_PIE);
    // $img, (250,150) 圆心坐标  
    // 200圆的X轴, 200圆的Y轴,
    // 0 与X轴的相离角度 ,80 弧线角度 
// 图片裁剪
    imagecopyresampled($dst,$src,0,0,200,200,500,312,500,312);
// 图片水印
    imagecopy($底图,$水印图,$水印X轴坐标,$水印Y轴坐标,$坐标点在水印图的X轴坐标,$坐标点在水印图的Y轴坐标,$水印图画布宽,$水印图画布高);
```

#### 16.1 图片缩放
```php
function thumb($srcimg,$pre,$dstw,$dsth) {
    $info = getimagesize($srcimg);
    $srcw = $info[0];
    $srch = $info[1];
    $src  = imagecreatefromjpeg($srcimg);
    $scale = max($srcw/$dstw,$srch/$dsth);
    $dstw = floor($srcw/$scale);
    $dsth = floor($srch/$scale);
    $dst  = imagecreatetruecolor($dstw,$dsth);
    imagecopyresampled($dst,$src,0,0,0,0,$dstw,$dsth,$srcw,$srch);
    $dir = dirname($srcimg);
    $img = $pre.baseanme($srcimg);
    $save = $dir.'/'.$img;
    imagejpeg($dst,$save);  
}
thumb('img/cn.jpg','md_',500,500);
```

### 17. [文件处理函数](https://www.w3school.com.cn/php/php_ref_filesystem.asp)
| 函数 | 含义 |
| --- | --- |
| filetype() | 测试文件或目录 |
| is_dir()   | 判断是否是目录 |
| is_file()  | 判断是否是文件 |
| file_exists()  | 判断目录是否存在 |
| filesize() | 文件大小 |
| disk_free_space() | 返回指定目录所在磁盘的可用空间(字节) /1048576(MB) |
| disk_total_space()| 返回指定目录所在磁盘的总空间(字节) /1048576(MB) |
| unlink()   | 文件删除 |
| copy(old,new)  | 文件复制 |
| rename(old,new)| 文件重命名|
| fwrite(file,str)  | 写入文件 |
| fread(file,length)| 读取文件 |
| fgets() | 从文件指针中读取一行 |
| fgetss() | 从文件指针中读取一行,并去除标签 |
| fgetc() | 一次读取一个字符 |
| fopen(src,rwx) | 打开文件, r只读 w只写 a追加写入 r+先读取后追加写入 w+先写空,然后写新东西,后面同时可以读刚才写入的东西 | 
| fclose()   | 关闭文件 |
| readfile() | 读取整个文件 |
| file() | 将文件读取到数组中  |
| file_get_contents() | 将文件读取到字符串中 |
| file_put_contents() | 文件写入 |
| file_put_contents(文件,内容,FILE_APPEND) | 追加写入 |
| mkdir() | 创建目录 |
| rmdir() | 删除目录 |
| scandir() | 遍历目录 |
| fileatime() | 返回文件最后访问时间戳 |
| filectime() | 返回文件最后改变时间戳 |
| filemtime() | 返回文件最后修改时间戳 |
| touch() | 设置文件最后的修改和访问时间|
| frof() | 判断文件是否到达 EOF末尾 |
| readdir() | 返回目录内容 |
| closedir()| 关闭目录 |

```php
// 遍历目录
$od  = opendir($dir);
while(readdir($od)) {
    if($od != '.' && $od != '..'){}
}
closedir($od);

// 移动目录
delDir(); // [递归]删除目录
copyDir();// [递归]复制目录
```

#### 17.1 文件上传
    单图上传表单
        method = 'post';
        enctype = 'multipart/form-data';
        <input type='file' name='file'>
    文件上传把控类型
        in_array($ext,$allow);
    文件上传把控大小
        表单允许的最大值        post_max_size = 8M;       // 可在pnp.ini中修改
        文件上传框允许的最大值   upload_max_filesize = 2M; // 可在php.ini中修改
        图片或文件不能大于1M    $max = 1 * 1024 * 1024;
        
#### 17.2 多文件上传
    表单  <input type='file' name='file[]' accept='image/*' multiple>
    上传脚本
        for($i=0;$i<$tot;$i++) {
            $src = $_FILES['file']['tmp_name'][$i];
        }
        
#### 17.3 文件上传错误
| 错误 | 含义 |
| --- | --- |
| 0 | 上传正常 |
| 1 | 上传文件大小超过配置文件中upload_max_filesize上限 |
| 2 | 上传文件大小超过配置文件中max_file_size上限 |
| 3 | 上传中断 |
| 4 | 没有上传任何东西 |
| 6 | 临时目录不存在 |
| 7 | 无法写入到磁盘 |
| 8 | PHP配置错误 |
| $FILES为空数组 | 文件大小超过POST限制 |

#### 17.4 文件下载
```php
header("content-type:application/octet-stream");
headre("content-disposition:attachment;filenname={$img}");
header("content-length:{$size}");
readfile($file);
```

#### 17.5 函数
| 函数 | 含义 |
| --- | --- |
| is_uploaded_file()| 判断是否已上传文件 |
| move_uploaded_file() | 移动已上传文件 |

### 18. 网页数据采集
#### 18.1 集体采集
```php
    $file = "www.baidu.com";
    $html = file_get_contents($file);
    file_get_contents('a.html',$html);
```

#### 18.2 单独采集
```php
    $file = "www.baidu.com";
    $html = file_get_contents($file);
    $ptn  = '/<div><span>(*)<\/span><\/div>/iU';
    preng_match_all($ptn,$html,$ms);
    echo "<pre>";
    print_r($ms[]);
    echo "</pre>";
```

### 19. OOP 面向对象
    OOP(Object_Oriented Programming) 面向对象式编程语言
    
#### 19.1 特性
    封装  继承  多态
    
#### 19.2 目标
    重用  灵活  扩展
    
#### 19.3 类定义
```php
class Person{
    // 特征
    public $name;
    // 行为
    public function say()
    {
        // code
    }
}

// 产生对象
$obj = new Person();
```

#### 19.4 类命名规范(严格驼峰式)
```php
class Person 
{
    // 类特征(属性)
    public $name;
    // 魔术方法
    public function __construct($n) {
        $this->name = $n;
    }
    // 类行为(方法)
    public function say()
    {
        echo '今天天气不错';
    }
    // 类消亡
    public function __destruct(){
        // TODO: Implement __destruct() method.
        echo '死亡';
    }
}

$obj = new Person('张');
echo $obj->name;
echo '<br>';
$obj->say();
```

#### 19.5 类的组成成员
    属性(变量)  方法(函数)
    
#### 19.6 对项链
    $obj->say()->eat()->sleep();
    
#### 19.7 类继承特性
    1. 父类(person)
        class Person{}
    2. 子类(It)
        class It extends Person
        {
            parson::__construct();
        }
        
#### 19.8 类封装特性
    1. public   公开的
        子类可以访问
        类外可以访问
    2. protected 被保护的
        子类可以访问
        类外不可访问
    3. private   私有的
        子类不可访问
        类外不可访问
        
#### 19.9 抽象方法(没有方法体的方法)
    abstract public function show();
    当子类继承父类后,即使子类没有完善,也没有错误
    当子类完善抽象方法后,就能使用这个方法
    
#### 19.10 接口(只含有抽象方法的类)
```php
//  当父类为一个接口时,子类必须完全实现父类的功能,当然子类可以添加新的方法
    interface Person
    {
        public function say();
        public function show();
    }
    class Usb implements Person
    {
        public function say() {};
        public function show() {};
        public function play() {};
    }
```

#### 19。11 多态
    因为函数在使用类或对象时可以设置参数类型,而把一批对象区别对待
    可将没有继承父类的子类挡住
```php
    interface Usb
    {
        public function load();
        public function run();
    }
    
    class UsbPan implements Usb
    {
        public function load {};
        public function run {};
    }

    class UsbDisk
    {
        public function load {};
        public function run {};
    }

    $pan = new UsbPan();
    $disk = new UsbDisk();
    function useusb(Usb $usbobj) { // 通过()中识别是否继父类
        $usbobj->load();
        $usbobj->run();
    }
    Useusb($pan);
```

#### 辅助函数
| 函数 | 含义 |
| --- | --- |
| class_alias() | 类别名 |
| class_exists()| 类存在 |
| get_class($obj) | 返回对象所实例化的类名 |
| get_class_methods() | 以数组的形式返回类中所有有访问权限的方法及函数 |
| get_class_vars() | 以数组的形式返回类中所有有访问权限的属性及值 |
| get_declared_classes() | 以数组的形式返回当前执行脚本中的所有类名 |
| get_object_vars($obj) | 以数组的形式返回对象所实例化的类中所有有访问权限的属性及值 |
| get_parent_class() | 返回类的父类名 |
| interface_exists() | 判断接口是否定义 |
| is_a($obj,$claName)| 判断对象是否和类有关系 |
| is_subclass_of($obj,$claName) | 判断对象是否类的子类实例化 |
| method_exists($obj,$fun) | 判断对象中是否有指定方法 |

### 20. 魔术方法(自动调用)
| 方法 | 含义 |
| --- | --- |
| __construct | 构造函数 |
| __destruct  | 析构函数 |
| __toString  | 对象转字符串 |
| __Call      | 调用不存在的方法 |
| __get       | 访问无权操作/不存在的方法 |
| __set       | 修改无权操作/不存在的方法 |
| __isset     | 调用无权限/不存在的方法   |
| __unset     | 当删除无权限/不存在的方法 |
| __autoload()| 全局自动引用 |
| __clone() | 克隆类时执行 |

### 21. 关键字
    const   类常量,可以修饰属性,类似于define
    final   最终版本,后面的类的方法无法对此类/方法进行修改
    static  静态成员,可以修饰属性和方法
    clone   克隆一个对象并继承属性值
    namespace 命名空间,防止类同名覆盖
    instanceof 判断一个对象是否为类的实例、类的子类、某个特定接口
    
#### 22 命名空间
    namespace home;
    必须写到最前面,前面不能有任何形式的输出,不能有任何PHP代码
    一个文件包含多个文件,多个文件中会存在函数名、类名、变量名冲突的问题
    用命名空间可形成虚假目录,从而区分重名内容
    命名规范：严格驼峰式写法
    
    __NAMESPACE__   得到当前空间名
    
    相对空间
        非限定名称   HOST;
        限定名称     Sub\HOST;
    绝对空间(完全限定名称)
        \Sub\HOST;
        
```php
<?php
namesapce think;

class Think
{
    const A = 'root';
    const B = '123';
    static public $pass = '123';
    echo Person::$pass; // 可直接调用属性
    static public function sum($i,$j) {
        return $i+$j;
    }
    echo Person::$pass; // 可直接调用方法
}
```

### 23. 绝对/相对目录
#### 23.1 PHP
    绝对目录
        C:\appache\www\PHP\index.php
    相对目录
        index.php    当前目录
        ./index.php  当前目录
        ../index.php 上级目录
        
#### 23.2 HTML
    绝对目录
        /html/index.jpg
        /html/index.js
        /html/index.css
    相对目录
        index.jpg       当前目录
        ./index.jpg     当前目录
        ../index.jpg    上级目录
        
### 24. 动态语言特征
    函数 
    类
    常量
        const HOST = '132';
        constant('HOST');
        
### 25. PDO类
    PDO     php data object     php数据对象,php数据库抽象层
    DSN     data source name    数据源名称
    query()     查询操作    $obj=$pdo->query($sql);
    exec()      增删改查    $obj=$pdo->exex($sql);
    lastInserId()   返回新增数据ID
    errorCode() 获取跟数据库句柄上一次操作相关的SQLSTATE $pdo->errorCode();
        若上一次操作正确,则输出 00000
        若上一次操作错误,则输出 42s02
    errorInfo() 错误信息
    beginTransaction();
    commit()    事务提交
    rollBack()  事务回滚
    set(get)Attribute() 设置/得到全局属性
    
#### 25.1 PDO对象实例化
    $pdo = new PDO('mysql:host=localhost;dbname=mydb','root','root');
    
#### 25.2 设置字符集
##### 25.2.1 服务器、数据库、表的字符集
    character-set-sever = utf8
    server Characterset: utf8
    Db Characterset: utf8
    
##### 25.2.2 要求的客户端字符集和连接字符集
    default-character-set = utf8
    Client Characterset: utf8
    Conn. characterset: urf8
    
#### 25.3 Statement类(预处理类)
    在PDO主类中有一 prepave();专门用来得到一个预处理对象
| 函数 | 含义 |
| --- | --- |
| execute() | 执行一个预处理语句 |
| rowCount()| 得到影响行数 |
| columnCount() | 得到结果集中的列数 |
| fetch()       | 得到结果集中第一条的数据 |
| fetchAll()    | 得到查询结果集中所有数据 |
| fetchColumn() | 从结果集中的下一行返回单独的一列 |
| bindValue()   | 处理预处理,使其更灵活 |

#### 25.4 预处理机制
    1. 速度: 第一次预先准备好一条sql语句,后面执行相同sql的情况则不需要重复请求发送
    2. 安全: 因速度的特点,减少了sql请求的机会,从而减少了危险的可能
    3. 灵活: 预处理绑值
    

#### 25.5 PDO操作MySql
```php
// 1.连接mysql
    // new PDO('数据库地址=IP,数据库名=数据库名字','用户名','密码');
    $pdo = new PDO('mysql:host=localhost;dbname=mydb','root','root');
    // 数据库数据以utf-8存取
    $pdo->exec('set names utf8');
// 2.准备SQL语句
    $sql="select * from table_name";
// 3.请求
    // pdo发送sql语句到mysql服务器,mysql把pdo发送的sql请求的结果返回给php
    $res = $pdo->query($sql);
// 4.处理结果集
    $rows = $res->fetchAll(PDO::FETCH_ASSOC);
```
    
### 26. PHP异常捕捉技术
    异常抛出点开始会阻止后方的执行(try中)
    
```php
try {
    // 检测程序是否会抛出异常错误
    $error = 'Always throw this error';
    throw new Exception($error);
} catch (

Exception $e) {
    echo $e;
    echo $e->getMessage();  // 返回传递给构造函数的消息
    echo $e->getCode();     // 获取错误代码
    echo $e->getFile();     // 获取错误文件
    echo $e->getLine();     // 获取错误行号
    echo $e->getPrevious(); // 返回前一个异常
    echo $e->getTrace();    // 返回错误数组
}

try {
    // 任务1
    // 任务2
    // 事务处理: 提交并结束 commit
} catch (PDOException $e) {
    // 事务处理: 回滚并结束 rollBack
}
```

### 27. 多页面共享
#### 27.1 Cookie
    cookie数据是由服务器通过setcookie设置或存在客户端浏览器内部
    客户端每次访问该网站任何一个页面时都会带上自己的cookie数据
    服务器每接收到客户端到来的cookie数据,会第一时间放到自己的$_COOKIE数组中
    cookie数据主要是由 name, value, domain, expires, path组成
```php
// cookie设置                                        
  setcookie('name','value',time()+3600,'/'); 
// cookie读取                                           
  print_r($_COOKIE);                             
// cookie删除                                           
  setcookie('name','',time()-1,'/');             
```   

#### 27.2 Session
    客户端访问服务器,先通过 session_start 检测卡号
    if(有卡){
        直接去读取卡号的数据并读入到$_SESSION数组中,
    } else {
        没有卡号,直接办一张空卡
        卡中没有任何数据并读到$_SESSION数组中
    }
    服务器上生成session时会把该卡号往客户端cookie中存一份
    每次客户端访问服务器都会cookie中的PHPSESSID卡号去访问,每次都要通过session_start的检测
    如果客户端带给服务器的卡号是存在的,则直接读取服务器上该卡号里面的数据并读入$_SESSION数组中
    session数据存在客户端的cookie数据默认过期时间为会话结束,即关闭浏览器或人为F12调试器中删除
    下次访问服务器,服务器会给客户办一张新卡,那么上一张卡会作废,同时服务器会检测半个小时后把上一张带数据全部销毁
```php
// session开启
    session_start();
// session设置
    $_SESSION['username'] = 'user1';
// session读取
    print_r($_SESSION);
// session删除(单独出现时,不可删除,其余可以)
    // 删除全部客户端的cookie
        setcookie('PHPSESSID','',time()-1,'/');
    // 清空服务器的$_SESSION
        $_SESSION = array();
    // 销毁服务器上对应的session数据
        session_destroy();
```

### heredoc文本输出
    开始标识符必须有 <<<
    开始和结束标识符必须相同,且可自定义
    结束标识符必须在新一行的开始位置
    $变量解析
```php
echo <<<EXCERPT
            <div style="width:500px;height:200px;background: #ccc">1321332</div>
            <span>7879</span>
EXCERPT;
```

### Nowdoc 文本输出
    开始标识符必须有 <<<
    开始表示符用单引号包含
    开始和结束标识符必须相同,且可自定义
    结束标识符必须在新一行的开始位置
    $变量不解析
```php
echo <<<'EXCERPT'
            <div style="width:500px;height:200px;background: #ccc">1321332</div>
            <span>$a</span>
EXCERPT;
```

### 程序执行函数
#### exec()
    执行服务器脚本
    $arr = exec('**.pl',$array);
    foreach($array)
    
#### system()
    linux   system('ls -1 ./**/')'
            system('**.pl',$array);
    windows system('dir .\**\');
    
#### passthru() 返回二进制输出
    GIF转PNG
    header('ContentType:image/png');
    passthru('giftopnm cover.gif | pnmtopng > cover.png'); 
* [图像包](http://netpbm.sourceforge.net)

#### \` ` 执行shell命令
    print('%s',`date`); // 2020-*-* *:*:*
    
    shell_exec() 代替 ``
        print('%s',shell_exec('date')); // 2020-*-* *:*:*
        
### Filter验证扩展
| 值 | 含义 |
| --- | --- |
| FILTER_VALIDATE_BOOLEAN | 布尔值 |
| FILTER_VALIDATE_EMAIL | 电子邮件地址 |
| FILTER_VALIDATE_FLOAT | 浮点数 |
| FILTER_VALIDATE_INT | 整数 |
| FILTER_VALIDATE_IP  | IP地址 |
| FILTER_VALIDATE_IPV6| IPV6地址 |
| FILTER_VALIDATE_REGEXP | 正则表达式 |
| FILTER_VALIDATE_URL | URL |
```php
$ipAddress = '192.168.0.1';
if(filter_var($ipAddress,FILTER_VALIDATE_IP,FILTER_VALIDATE_IPV6))
{}
```

### DNS
| 函数 | 含义 |
| --- | --- |
| checkdnsrr(hostname,[type]) | 判断域名是否存在 |
| dns_get_record(hostname,[DNS_*]) | 返回域名相关的数组 |
| getmxrr(hostname,$arr) | 获取域名所指定主机的MX记录 |

### 服务
| 函数 | 含义 |
| --- | --- |
| getservbyname("http",("tcp" \| "udp")) | 获取服务端口 |
| getservbyport("80",("tcp" \| "udp")) | 获取端口服务名 |
| fsockopen(hostname,端口) | 建立套接字连接 |

```php
// 套接字链接请求
        $hostname = 'www.baidu.com';
        $http = fsockopen($hostname,80);
        
        $req = "GET / HTTP/1.1\r\n";
        $req .= "Host: {$hostname}\r\n";
        $req .= "Connection: Close\r\n\r\n";

        fputs($http,$req);

        while(!feof($http))
        {
            echo fgets($http,1024);
        }

        fclose($http);

// 端口扫描器
        // 将脚本最大执行时间 延长至120
        ini_set("max_execution_time",120);

        // 定义扫描范围
        $rangeStart = 0;
        $rangeStop = 1024;

        // 定义被扫描服务器
        $target = "localhost";

        // 建立端口值数组
        $range = range($rangeStart,$rangeStop);

        // 执行扫描
        foreach ($range as $port)
        {
            $result = @fsockopen($target,$port,$errno,$errst,1);
            if($result)
            {
                echo "port: {$port}<br />";
            }
        }
```

### 邮件
| ini设置 | 值 | 含义 |
| --- | --- | --- |
| SMTP | localhost | 邮件发送代理服务器,只于windows有关  |
| sendmail_from | string | 消息首部的From字段 |
| sendmail_paht | string | 设置到 sendmail 二进制程序的路径,(UNIX) |
| smtp_port | 25 | 端口 |
| mail.force_extra_paranmeters | string | 传递额外的参数 |

```php
    mail('jieshou@**.com',"subject",'body',"From:send@***.com\r\n");
```

### 常见网络任务
#### 连接服务器
```php
    // ping那个服务器
    $server = "www.baidu.com";
    
    // ping 服务器多少次
    $count = 3;
    
    // 执行任务
    echo "<pre>";
    system("/bin/ping -c {$count} {$server}");
    echo "</pre>";

    // 杀死任务
    system("killall -q ping");
```

#### 创建端口扫描器
```php
    $target = "www.example.com";
    echo "<pre>";
    system("/usr/bin/namp {$target}");
    echo "</pre>";

    // 杀死任务
    system("killall -q namp");
```

#### 创建子网转换器
```php
    if (isset($_POST['submit']))
    {
        // 连结IP组成部分并转换为IPv4格式
        $ip = implode('.',$_POST['ip']);
        $ip = ip2long($ip);
    
        // 连结网络掩码组成部分并转换为IPv4格式
        $netmask = implode('.',$_POST['sm']);
        $netmask = ip2long($netmask);
        
        // 计算网络地址
        $na= (Sip & snetmask);
        //计算广播地址
        $ba = $na | (~ $netmask) ;
        
        //重转换地址为点格式并显示
        echo "Addressing Information: <br />";
        echo "<ul>";
        echo "<li>IP Address: ". long2ip($ip) ."</1i>";
        echo "<li>Subnet Mask:". long2ip($netmask) ."</1i>";
        echo "<li>Network Address: " . long2ip($na) . "</1i>" ;
        echo "<li>Broadcast Address: " . long2ip($ba) ."</li>";
        echo "<1i>Total Available Hosts:". ($ba - $na - 1) . "</1i>";
        echo "<li>Host Range: ". long2ip($na + 1). ”1ong2ip($ba - 1)."</li>";
        echo "</u1>" ;
    }
```

#### 测试用户带宽
```php
    // 检索要发送给用户的数组
    $data = file_get_contents("**file");
    // 确定数据总大小,以千字节为单位
    $fsize = filesize("**file") / 1024;
    // 确定起始时间
    $start = time();
    // 发送数据给用户
    echo "<!-- data -->";
    // 确定终止时间
    $stop = time();
    // 计算发送数据所耗时间
    $duration = $stop - $start;
    // 用文件大小除以传输时间(秒)
    $speed = round($fsize / $duration);
    // 显示计算出的速度(Kbit/s)
    echo "speed {$speed} KB/sec";
```