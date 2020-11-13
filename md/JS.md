### 0. 经验技巧
#### js判断指定class是否存在
```javascript
    function hasClass(element, cls) {
     return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
    }
    hasClass(document.querySelector("html"), 'no-js');

    // jQuery
    // 1. 使用is(‘.classname’)的方法
    $('div').is('.redColor')
    // 2. 使用hasClass(‘classname’)的方法(注意jquery的低版本可能是hasClass(‘.classname’))
    $('div').hasClass('redColor')
```
#### input 单选框选中和取消
```html 
    <input type="radio" name="auto_login" id="auto_login" value="1" onclick="if(this.c==1){this.c=0;this.checked=0}else this.c=1">
    <label for="auto_login" >下次自动登录</label>
```
#### input框手机号输入
```html
    <style>
        /*去除input type:"number" 的控制按钮*/
        input::-webkit-outer-spin-button, input::-webkit-inner-spin-button {
            -webkit-appearance:none
        }
        input[type="number"] {
            -moz-appearance:textfield
        }
    </style>
    <!--手机号输入框-->
    <input id="tel" name="tel" placeholder="请输入手机号" autocomplete="off" type="number">
    <script>
        // 手机号输入监听
        $('#tel').bind('input propertychange', function () {
            $(this).val($(this).val().replace(/-/g, ''));
            if ($(this).val().length > 11) {
                // 超过11位数时截取到11位
                $(this).val($(this).val().substr(0, 11));
            }
        });
        // 禁止键盘的“-”，“.”等符号按键事件
        $(document).keydown(function (event) {
            if (event.keyCode === "107" || event.keyCode === "109" || event.keyCode === "110" || event.keyCode === "189" || event.keyCode === "190" || event.keyCode === "229") {
                event.preventDefault();
            }
        });
    </script>
```
### 1.基础
#### 1.1 解析器
    JS解析器内置于浏览器内部中
#### 1.2 存放位置
##### 1.2.1 内部
    <body> 之后 </html>之前
```html
<body>
    <script>
        alert('body');
    </script>
</body>
<script>
    alert('/body');
</script>
</html>
```
##### 1.2.2 外部
    js代码另存一个后缀为 .js 的文件中,然后通过网页进行调用
    <script src=""></script>
##### 1.2.3 内联
    <div onlick="alert(123)"></div>
#### 1.3 注释
    //    单行注释
    /**/  多行注释
#### 1.4 互动框
| 类型 | 代码 |
| --- | --- |
| 警告 | alert()   |
| 确认 | confirm() |
| 提示 | prompt()  |
### 2. 变量
#### 2.1 变量类型
| 类型 | 标识符 |
| --- | --- |
| 整型   | int |
| 浮点型 | float |
| 字符串 | string|
| 布尔型 | bool  |
| null  | null  |
| 这不是一个数字 | NaN |
| 未定义 | undefined |
| 数组   | array    |
| 对象   | object   |
| json  | |
    对象的特殊性
        基于对象
            alert(document);
        创建对象
            1). 类
                function Person() {
                    return this;
                }
            2). 对象
                obj = new Person();
        json对象
            obj = {'name':'user','age':20};
#### 2.2 定义变量
    var str = 'string';
    let arr = [0,1];
#### 2.3 输出变量
| 函数 | 含义 |
| --- | --- |
| alert()          | 以弹窗输出 |
| document.write() | 网页输出 |
| document.title() | 网页标题输出 |
| console.log()    | 在F12调试器中输出 |
#### 2.4 类型测试
| 函数 | 含义 |
| --- | --- |
| typeof()        | 判断变量类型 |
| arr.constructor | 查询arr的构造函数 |
| arr instanceof Array | 判断arr是否为数组类型 |
#### 2.5 变量转换
##### 2.5.1 强制转换
| 函数 | 含义 |
| --- | --- |
| parseInt()| 强制转为整型 |
| parseFloat() | 强制转为浮点型 |
| Number()  | 转为数字 |
| String()  | 转为字符串 |
| Boolean() | 转为布尔型 0 '' 0.0 null NaN undefined |
| eval()    | 执行表达式字符串 |
##### 2.5.2 自动转换类型
| 实现 | 含义 |
| --- | --- |
| !! | 转为布尔 |
| number+'' | 整型转字符串 |
| str - 0   | 字符串转整型 |
| eval('('+{'name':'user'}+')') | json字符串转json对象 |
### 3. 运算符
#### 3.1 一元运算符
| 运算符 | 含义 |
| --- | --- |
| ++| 自增1 |
| --| 自减1 |
#### 3.2 二元运算符
##### 3.2.1 数学运算符
| 运算符 | 含义 |
| --- | --- |
| + | 加 |
| - | 减 |
| * | 乘 |
| / | 除 |
| % | 取余|
##### 3.2.2 逻辑运算符
| 运算符 | 含义 |
| --- | --- |
| && | 与 |
| &#124;&#124; | 或 |
| ! | 非 |
##### 3.2.3 比较运算符
| 运算符 | 含义 |
| --- | --- |
| >  | 大于 |
| <  | 小于 |
| == | 等于 |
| >= | 大于等于 |
| <= | 小于等于|
##### 3.2.3 三元运算符
    ? :
##### 3.2.4 其他
###### 3.2.4.1 in 判断是否存在
```javascript
    obj = {'name1':'user1','name1':'user2'};
    if('name1' in obj) {
        return true;
    }
    for(key in obj) {
        console.log(key,obj[key]);
    }
```
###### 3.2.4.2 instanceof 判断是否是其抽象类
```javascript
    arr = [1,2,3];
    if(arr instanceof  Array) {}
```
###### 3.2.4.3 delete 删除变量
```javascript
    arr = [1,2,3];
    delete arr[0];
```
#### 3.3 var
    函数内部有var的变量为局部变量
    函数内部没有var的变量围为全局变量
    函数外部的变量为全局变量,一般不带var
### 4. 流程控制及循环
#### 4.1 if else
```javascript
if(true) {

} else if(true) {

} else {    

}   
``` 
#### 4.2 switch
```javascript
switch (res) {
    case '' :
        break;
    case '' :
        break;
    default :
}
```
#### 4.3 while
```javascript
while (条件) {

};
```
#### 4.4 do()while
```javascript
do{

} while (条件) {}
```
#### 4.5 for
```javascript
arr = [1,2,3];
for(i=0;i<arr.length;i++) {
    console.log(i,arr[i]);
}
for(key in arr) {
    console.log(key,arr[key]);
}
```
### 5. 函数
#### 5.1 匿名函数
```javascript
fun = function(val='') {
    return val;
}
```
#### 5.2 普通函数
```javascript
function fun() {
  
}
```
#### 5.3 回调函数
    一个函数的参数是另一个函数的名字
```javascript
function fun (i,j,f) {
    return f(i,j);
}
function sum (a,b) {
    return a+b;
}
console.log(fun(1,j,sum));
```
### 6. 内置对象
#### 6.1 数学
##### 6.1.1 属性
| 代码 | 含义 |
| --- | --- |
| Math.PI | 圆周率 |
##### 6.1.2 方法
| 代码 | 含义 |
| --- | --- |
| Math.ceil() | 上取整 | 
| Math.floor()| 下取整 |
| Math.round()| 四舍五入 |
| Math.random()| 随机数 |
| Math.max()  | 最大值 |
| Math.min()  | 最小值 |

```javascript
// 数组中随机抽取图片
arr = ['1.png','2.png','3.png'];
key = Math.floor(Math.random() * arr.length);
document.getElementById('imgid').src = arr[key];
```
#### 6.2 日期
##### 6.2.1 生成
```javascript
time = new Date();
```
##### 6.2.2 方法
| 代码 | 含义 |
| --- | --- |
| time.getFullYear() | 年 |
| time.getMonth() | 月 |
| time.getDate()  | 日 |
| time.getHours() | 时 |
| time.getMinutes()| 分 |
| time.getSeconds()| 秒 |
| time.getDay()   | 周 |
| time.getMilliseconds() | 毫秒 |
| time.getTime() | 时间戳 |
| time.toTimeString() | 时间部分转为字符串 |
| time.toDateString() | 日期部分转为字符串 |
| time.toLocaleString() | 时间本地化 |

```javascript
// 秒表
function setTime() {
    time = new Date();
    hour = time.getHours();
    minute = time.getMinutes();
    second = time.getSeconds();
    if(second < 10) {
        second = '0' + second;
    }
    
    timestr = hour + ':' + minute + ':' + second;
    document.getElementById('timeId').innerHTML = timestr;
}

setTime();
sobj = setInterval(function() {
    setTime();
},1000);
```
```javascript
// 超时器
timeId = document.getElementById('timeId');
setTimeout(function() {
    location = 'person.html';
},3000);
```
```javascript
// 超时器
timeId = document.getElementById('timeId');
n = 3;
setInterval(function() {
    n--;
    if(n <= 0) {
        location = 'person.html';
    } else {
        timeId.innerHTML = n;
    }
},1000);
```
#### 6.3 数组
##### 6.3.1 属性
| 属性 | 含义 |
| --- | --- |
| constructor | 返回对创建此对象的数组函数的引用 |
| prototype   | 向对象添加属性 |
| length      | 长度 |
##### 6.3.2 方法
| 方法 | 含义 |
| --- | --- |
| concat() | 合并数组 |
| join()   | 将数组合并为字符串 |
| pop()    | 弹出数组的尾值 |
| push()   | 数组尾部添加值,并返回数组长度 |
| shift()  | 弹出数组头值 |
| unshift()| 数组头部添加值,并返回数组长度 |
| slice()  | 从a截取到b,但不包括b |
| splice() | 从a截取b个,影响原数组 |
| sort()   | 排序 |
| reverse()| 数组反转 |
```javascript
// 打乱数组
function shuffle(a) {
   var len = a.length;
   for(var i=0;i<len;i++){
       var end = len - 1 ;
       var index = (Math.random()*(end + 1)) >> 0;
       var t = a[end];
       a[end] = a[index];
       a[index] = t;
   }
   return a;
};
```
#### 6.4 字符串
##### 6.4.1 属性
| 属性 | 含义 |
| --- | --- |
| length | 长度 |
##### 6.4.2 方法
| 方法 | 含义 |
| --- | --- |
| concat() | 连接字符串 |
| indexOf() | 字符第一次出现的下标 |
| lastIndexOf() | 字符最后一次出现的下标 |
| slice()  | 从a截取到b,但不包括b |
| substr() | 从a截取b个 |
| toLowerCase() | 大写转小写 |
| toUpperCase() | 小写转大写 |

```javascript
// 输入值秒转大写
inputId = document.getElementById('inputId');
inputId.keyup = function() {
    this.value = this.value.toUpperCase();
} 
```
### 7. 正则表达式方法
| 方法 | 含义 |
| --- | --- |
| split()  | 将字符串以()分隔为数组 |
| search() | 字符串第一次出现的下标 |
| replace()| 正则替换 |
| match()  | 将字符串按类型匹配 |

```javascript
// 当鼠标离开文本框时判断格式
inputId = document.getElementById('inputId');
errorId = document.getElementById('errorId');
inputId.onblur = function() {
    val = this.value;
    arr = val.match("|^\d{11}|");
    if(arr) {
        errorId.style.display = 'none';
        inputId.outlineWidth = '0px';
    } else {
        errorId.style.display = 'inline';
        inputId.style.outlineColor = '#f00';
        inputId.style.outlineWidth = '2px';
        inputId.style.outlineStyle = 'solid';
    }
}
```
### 8. 平台提供的对象(浏览器 window)
#### 8.1 BOM browser(浏览器对象)
##### 8.1.1 Window
###### 8.1.1.1 属性
    frames  窗口数组 window.top.frames
    top     顶级窗口 [window.top]location = 'login.php'
###### 8.1.1.2 方法
| 方法 | 含义 |
| --- | --- |
| open()         | 在新标签/窗口打开链接 |
| alert()        |  |
| confirm()      |  |
| prompt()       |  |
| setInterval()  |  |
| clearInterval()|  |
| setTimeout()   |  |
| clearTimeout() |  |
##### 8.1.2 navigator 对象
###### 8.1.2.1 属性
    userAgent   获取浏览器类型
    info = navgiator.userAgent;
    navgiator.appName   获取客户端浏览器名称
    window.status = ""  浏览器状态栏放入一条消息
###### 8.1.2.2 浏览器类型
| 英文名 | 中文名 | 内核 |
| --- | --- | --- |
| GooGle | 谷歌 | Chrome |
| Firefox| 火狐 | Firefox |
| IE | IE | Trident |
##### 8.1.3 screen 对象
    获取浏览器的宽高，即分辨率
| 属性 | 含义 |
| --- | --- |
| availHeight |  |
| availWidth  |  |
| height |  |
| width  |  |
##### 8.1.4 history 历史
| 方法 | 含义 |
| --- | --- |
| .back() | 后退一个历史 |
| .forward() | 前进一个历史 |
| .go(+/- 1) | 前进/后退一个历史 |  
#### 8.1.5 location 对象(地址栏对象)
##### 8.1.5.1 属性
| 属性 | 含义 |
| --- | --- |
| hash | 获取URL里的锚点 |
| host | 主机名 |
| href | 当前的URL地址 |
| pathname | .html 页面的名称 |
| protocol | 协议 http:// |
| search | 参数 ?id=1&name=1
##### 8.1.5.2 方法
| 方法 | 含义 |
| --- | --- |
| reload() | 加载(刷新)页面 |
#### 8.2 DOM　document 标签对象
##### 8.2.1 获取DOM元素对象
    document
    document.documentElememt
    document.head
    document.title
    document.body
##### 8.2.2 获取元素对象方法
| 方法 | 含义 |
| --- | --- |
| document.getElementById() | 获取ID |
| document.getElementsByTagName() | 获取标签名 |
| document.getElementsByClassName() | 获取类名 |
| document.getElementsByName | 获取name |
##### 8.2.3 元素对象标准属性
###### 8.2.3.1 标准属性
| 属性 | 含义 |
| --- | --- |
| id  |  |
| class |  |
| type  |  |
| name  |  |
| value |  |
| style |  |
###### 8.2.3.2 非标准属性(默认得不到)
| 属性 | 含义 |
| --- | --- |
| age  |  |
| sex |  |
| num  |  |
| score  |  |
###### 8.2.3.4 元素对象共用属性
| 属性 | 含义 |
| --- | --- |
| tagName     | 标签名 |
| innerHTML   | 双标签名和文本 |
| outerHTML   | 单标签和文本 |
| textContent | 文本 |
###### 8.2.3.3 标准/非标准属性获得
    getAttribute(key);
    setAttribute(key,val);
### 9. 事件
#### 9.1 鼠标事件
| 事件 | 含义 |
| --- | --- |
| onclick      | 鼠标单击 |
| ondblclick   | 鼠标双击 |
| onmouseenter | 鼠标移入 |
| onmouseleave | 鼠标移出 |
| onmousemove  | 鼠标移动 |
```javascript
// 鼠标移入移出特效
hobj = document.getElementsByTagName('h1');
for(i=0;i<hobj.length;i++) {
    hobj[i].onmouseenter = function() {
        this.style.color = '#fff';
        this.style.background = '#888';
    }
    hobjp[i].onmouseleave = function() {
        this.style.color = '#000';
        this.style.background = '#fff';
    } 
}
```
```javascript
// 鼠标移动
imgId = document.getElementById('imgId');
document.onmousemove = function(event) {
    imgId.style.display = 'inline-block';
    x = event.clientX + 50;
    y = event.clientY + 50;
    imgId.style.left  = x+'px';
    imgId.style.right = y+'px';
}
```
```javascript
// 循环点击换色
objs = document.getElementsByTagName('h1');
for(i=0;i<objs.length;i++) {
    objs[i].setAttribute('s',0);
    objs[i].onclick = function() {
        s = this.getAttribute('s');
        if(s == 1) {
            this.setAttribute('s',0);
            this.style.color = '#000';
            this.style.background = '#fff';
        } else {
            this.setAttribute('s',1);
            this.style.color = '#fff';
            this.style.background = '#888';
        }
    }
}
```
```javascript
// 点击换行号
objs = document.getElementsByTagName('h1');
for(i=0;i<objs.length;i++) {
    objs[i].setAttribute('n',i+1);
    objs[i].setAttribute('s',0);
    objs[i].setAttribute('src',objs[i].innerHTML);
    objs[i].onclick = function() {
        s = this.getAttribute('s');
        if(s == 1) {
            this.setAttribute('s',0);
            src = this.getAttribute('src');
            this.innerHTML = src;
        } else {
            this.setAttribute('s',1);
            n = this.getAttribute('n');
            this.innerHTML = n;
        }
    }
}
```
```javascript
// 点击标题切换内容(下拉列表缩放)
hobjs = document.getElementsByTagName('h1');
pobjs = document.getElementsByTagName('p');
for(i=0;i<hobjs.length;i++) {
    hobjs[i].id = i;
    hobjs[i].setAttribute('s',0);
    pobjs[i].id = 'p' + i;
    hobjs[i].onclick = function() {
        s = this.getAttribute('s');
        hid = this.id;
        pid = 'p' + hid;
        if(s == 1) {
            this.setAttribute('s',0);
            id(pid).style.display = 'block';
        } else {
            this.setAttribute('s',1);
            id(pid).style.display = 'none';    
        }   
    }
} 
```
```javascript
// 全选
checkobjs = document.getElementsByClassName('checkbox');
id('all').onclick = function() {
    for(i=0;i<checkobjs.length;i++) {
        checkobjs[i].checked = true;
    }
}
// 全不选
id('noall').onclick = function() {
    for(i=0;i<checkobjs.length;i++) {
        checkobjs[i].checked = false;
    }  
}
// 反选
id('unall').onclick = function() {
    for(i=0;i<checkobjs.length;i++) {
        checkobjs[i] != checkobjs[i].checked;
    }
}
```
```javascript
// 水果选择1
id('s1').options(2).selected = true;
id('btn').onclick = function() {
    sid = id('s1').selectedIndex;
    opt = id('s1').options[sid];
    optclone = opt.cloneNode(true);
    id('s2').add(optclone);
}
// 水果选择2
id('btn').onclick = function() {
    sid = id('s1').selectedIndex;
    opt = id('s1').options[sid];
    id('s2').add(opt);
}
id('del').onclick = function() {
    s2id = id('s2').selectedIndex;
    id('s2').remove(s2id);
}
```
#### 9.2 键盘事件
| 事件 | 含义 |
| --- | --- |
| onkeydown     | 键盘按下 |
| onkeyup       | 键盘弹起 |
| event.keyCode | 接收输入的键盘码(非事件) |
```javascript
$(document).keydown(function(event){
    if(event.keyCode == 13){
        alert('你按下了Enter'); 
    }
});
```
#### 9.3 表单事件
| 事件 | 含义 |
| --- | --- |
| onfocus  | 获得焦点 |
| onblur   | 失去焦点 |
| onchange | 改变值  |
| onselect | 全部选中 |
| onsubmit | 点击提交 |
| onreset  | 点击重置 |

```html
<select id="sid"></select>
<h1 id="hid"></h1>
<script>
    $('#sid').onchange = function() {
        $('hid').innerHTML = this.value;
    }
</script>
```
#### 9.4 其他事件
| 事件 | 含义 |
| --- | --- |
| onload   | 加载完毕 |
| onerror  | 错误 |
| onresize | 窗口发生变化  |
| onscroll | 屏幕滚动条移动距离 |
#### 9.5 事件方法(默认发生)
| 事件 | 含义 |
| --- | --- |
| select()| 全部选中 |
| blur()  | 失去焦点 |
| focus() | 获得焦点 |
| click() | 单击 |
| submit()| 提交 |
| reset() | 重置 |
| input() | input框发生变化 |
### 10. Ajax 无刷新通讯技术
#### 10.1 流程
    php -> js -> ajax -> php
#### 10.2 ajax对象
    创建  ajax = new XMLHttpRequest();
    准备  ajax.open();
    发送  ajax.send();
    获取  ajax.responseText;
    渲染  id('div').innerHTML = res;
#### 10.3 方法
    xhr.send();     参数为POST字符串,仅用于POST请求
    xhr.open(method,url,'async');
| 属性 | 含义 |
| --- | --- |
| method | 请求的类型 GET / POST | 
| url    | 请求路径 |
| async  | true(同步) / false(异步) |
    
#### 10.4 提交数据
##### 10.4.1 GET
    open('get','index.php?id=1&name=2',asyns);
##### 10.4.2 POST
    open('post','index.php',async);
    xhr.setRequestHeader('Content-type','application/X-www-form-urlencoded');
    xhr.send('id=1&name=2');
##### 10.4.3 通讯阶段
    要状态检测到 onreadystatechange 的时机必须是异步通讯
    ajax异步中要拿后端返回数据, 必须结合状态检测
```javascript
ajax.onreadystatechange = function() {
    if(ajax.readystate == 4 & ajax.status == 200) {
        id('art').innerHTML = ajax.responseText;
    }
}
```
#### 10.5 onreadystatechange事件
##### 10.5.1 readystate
| 状态码 | 含义 |
| ---   | --- |
| 0 | 请求初始化 | 
| 1 | 服务器连接已建立 |
| 2 | 请求已接收 |
| 3 | 请求处理中 |
| 4 | 请求已完成且响应已就绪 |
##### 10.5.2 status
| 响应码 | 含义 |
| ---   | --- |
| 200 | 数据响应完毕 | 
| 304 | 建议从缓存中获取 |
| 404 | 页面找不到 |
```javascript
// GET
id('get').onclick = function() {
    ajax = new XMLHttpRequest();
    ajax.open('get','get.php',false);
    ajax.send();
    str = ajax.responseText;
    id('art').innerHTML = str;
}
```
```javascript
// POST
id('get').onclick = function() {
    ajax = new XMLHttpRequest();
    ajax.open('post','index.php',true);
    xhr.setRequestHeader('Content-type','application/X-www-form-urlencoded');
    ajax.send('id=1&name=2');
    str = ajax.responseText;
    id('art').innerHTML = str;
}
```
```javascript
// 同步
    ajax = new XMLHttpRequest();
    ajax.open('get','get.php',false);
    ajax.send();
    str = ajax.responseText;
    id('art').innerHTML = str;
    id('load').style.display = 'inline';
```
```javascript
// 异步
id('get').onclick = function() {
    ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if(ajax.readystate == 4 & ajax.status == 200) {
            id('art').innerHTML = ajax.responseText;
        }
    }
    ajax.open('get','get.php',true);
    ajax.send();
    id('load').style.display = 'inline';
} 
```