### 0. 经验技巧
#### select及option样式更改
```html
    
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> 自定义下拉框</title>
        <link rel="stylesheet" href="https://www.jq22.com/jquery/font-awesome.4.6.0.css">
        <script src="https://www.jq22.com/jquery/jquery-1.10.2.js"></script>
        <style>
           .select-menu-ul{
                list-style:none;
                opacity:0;
                display:none;
                text-align:left;
                background:#fff;
                position:absolute;
                z-index:1;
            }
            .select-menu-ul li:hover{
                background:#f2f2f2;
                
            }
            .select-menu-div{
                position:relative;
            }
            .select-this{
                background:#5FB878;
            }
            .select-this:hover{
                 background:#5FB878!important;
            }
            .select-menu i{
                margin-right:5px;
                position:absolute;
                right:0;
                top:7px;
            }
            .select-menu-input{
                margin-left:3%;
                border:0;
                height:29px;
                cursor:pointer;
                user-select:none;
            }
            .select-menu-i{
                transform:rotate(180deg);
            }
            .select-menu i{
                -webkit-transition: all 0.4s ease;
                -o-transition: all 0.4s ease;
                transition: all 0.4s ease;
            }
        </style>
    </head>
    <body>
        <div class="select-menu">
            <div class="select-menu-div">
                <input name="No1" id="No1" readonly class="select-menu-input" />
                <i class="fa fa-caret-down"></i>
            </div>
            <ul class="select-menu-ul">
                <li class="select-this">橘子</li>
                <li>橘子</li>
                <li>橘子</li>
            </ul>
        </div>
    </body>
    <script>
        $(function(){
            selectMenu(0);
            function selectMenu(index){
                $(".select-menu-input").eq(index).val($(".select-this").eq(index).html());//在输入框中自动填充第一个选项的值
                $(".select-menu-div").eq(index).on("click",function(e){
                    e.stopPropagation();
                    if($(".select-menu-ul").eq(index).css("display")==="block"){
                        $(".select-menu-ul").eq(index).hide();
                        $(".select-menu-div").eq(index).find("i").removeClass("select-menu-i");
                        $(".select-menu-ul").eq(index).animate({marginTop:"50px",opacity:"0"},"fast");
                    }else{
                        $(".select-menu-ul").eq(index).show();
                        $(".select-menu-div").eq(index).find("i").addClass("select-menu-i");
                        $(".select-menu-ul").eq(index).animate({marginTop:"5px",opacity:"1"},"fast");
                    }
                    for(var i=0;i<$(".select-menu-ul").length;i++){
                        if(i!==index&& $(".select-menu-ul").eq(i).css("display")==="block"){
                            $(".select-menu-ul").eq(i).hide();
                            $(".select-menu-div").eq(i).find("i").removeClass("select-menu-i");
                            $(".select-menu-ul").eq(i).animate({marginTop:"50px",opacity:"0"},"fast");
                        }
                    }
                });
                $(".select-menu-ul").eq(index).on("click","li",function(){//给下拉选项绑定点击事件
                    $(".select-menu-input").eq(index).val($(this).html());//把被点击的选项的值填入输入框中
                    $(".select-menu-div").eq(index).click();
                    $(this).siblings(".select-this").removeClass("select-this");
                    $(this).addClass("select-this");
                });
                $("body").on("click",function(event){
                    event.stopPropagation();
                    if($(".select-menu-ul").eq(index).css("display")==="block"){
                        $(".select-menu-ul").eq(index).hide();
                        $(".select-menu-div").eq(index).find("i").removeClass("select-menu-i");
                        $(".select-menu-ul").eq(index).animate({marginTop:"50px",opacity:"0"},"fast");
                    }
                });
            }
        })
    </script>
</html>
```
#### 自适应布局
```html
    <!-- 页面等比缩放，一般不会变形   -->
    <meta name="viewport" content="width=1202">
    <!-- 页面像素等比缩放，同上二选一   -->
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=0.1">
    <!--style-->
    <style>
        div {
            width: auto;
            width: 100%;
            min-width: 1200px;
            max-width: 1920px;
            font-size: 1em;    /* 可选 */
            font-size: 1rem;   /* 可选 */
            
            display: flex;
            flex-flow:row nowrap; /* 可选 */
            justify-content: space-between; /* 可选 */
        }
    </style>
```

#### 全局属性
```html
    <style>
        /*去除下列元素的内外边距*/
        body,ul,li,a,img,p,input {
            margin:0;
            padding:0;
        }
        /*去除列表样式*/
        ul,ol,li {
            list-style:none;
        }
        /*去除a链接字体颜色及下划线*/
        a:link , a:visited {
            color:#000;
            text-decoration:none;
        }
        /*设置全局字体大小*/
        body {
            font-size: 14px;
        }
        /*设置全局图片默认大小*/
        img {
            width: auto;
            height:auto;
            max-width: 100%;
            max-height:100%;
        }
        /*去除下列元素聚焦框*/
        input,select,textarea {
            outline: none;
        }
        /*设置字体全局主题色*/
        .font_color {
            color: #000;
        }
        /*设置背景全局主题色*/
        .bag_color {
            background: #fff;
        }
        /*设置底板全局色*/
        .body_color {
            background: #f1f1f1;
        }
        /*设置全局分割线样式*/
        .clear_line {
            background: #c0c0c0;
        }
    </style>
```
### Flex 布局
#### 标签
    响应式弹性布局,webkit内核加 -webkit前缀
```css
/* 块标签 */
view{
    display:flex;
}
/* 行标签 */
h1{
    display: inline-block;
}
```
#### 主轴(X)
| 属性 | 值  | 含义 |
| --- | --- | --- |
| flex-direction | row         | 左浮 |
| 决定项目的排列顺序| row-reverse | 右浮 |
|                | column      | 垂直自适应排列 |
|                | column-reverse | 反垂直自适应排列 |
| flex-wrap      | nowrap      | 不换行,默认效果 |
| 换行方式        | wrap        | 宽不足,换下行 |
|                | wrap-reverse| 反转换行 | 
| flex-flow      |[direction] [wrap] | 简写: 浮动 换行 |
### 对齐方式
#### 主轴(默认水平,column后为垂直)
| 属性 | 值  | 含义 |
| --- | --- | --- |
| justify-content | flex-start    | 左端(开始)对齐 |
|                 | flex-end      | 右端(结束)对齐 |
|                 | center        | 居中 |
|                 | space-between | 俩端对齐 |
|                 | space-around  | 俩端居中对齐 |
#### 交叉轴
| 属性 | 值  | 含义 |
| --- | --- | --- |
| align-items | flex-start | 上对齐 |
|             | flex-end   | 下对齐 |
|             | center     | 居中 |
|             | stretch    | 自适应(没有高时铺满) |
|             | baseline   | 第一行文字底端对齐 |
#### 多轴(单轴时无效)
| align-content | flex-start    | 所有项目顶端对齐 |
|               | flex-end      | 所有项目底部对齐 |
|               | center        | 所有项目垂直居中 |
|               | space-between | 垂直俩端对齐 |
|               | space-around  | 垂直居中俩端分散 |
|               | stretch       | 自适应(没有高时铺满) |
### 项目属性
| 属性 | 值  | 含义 |
| --- | --- | --- |
| order       | (int)num    | 排序 |
| flex-grow   | (int)num    | 以倍数放大，但不会超出容器 |
| flex-shrink | (int)num    | 缩小 |
| flex-basis  | (int/%)num  | 项目占据主轴空间 |
| align-self  | flex-start  | 上端对齐,取代align-items |
|             | flex-end    | 下端对齐 |
|             | center      | 居中 |
|             | auto        | 继承父属性,没有时等同于stretch |
### box-sizing
| 值  | 含义 |
| --- | --- |
| content-box | w / h = center; padding + margin另算,不适合UI图开发 |
| border-box  |	w / h = center + padding + margin | 
| inherit	  | 继承 |
### 1. HTML标准网页
```html
<!-- 让浏览器用H5的引擎来解析，避免兼容性问题 -->
<!doctype html> 
<html lang="en">
    <!-- 头文件 -->
    <head>
        <!-- 文档编码格式 -->
        <meta charset="UTF-8"> 
        <!-- 文档描述 -->
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- 为搜索引擎定义关键词 -->
        <meta name="keywords" content="HTML, CSS, XML, XHTML, JavaScript">
        <!-- 为网页定义描述内容 -->
        <meta name="description" content="免费 Web & 编程 教程">
        <!-- 定义网页作者 -->
        <meta name="author" content="username">
        <!-- 每30秒钟刷新当前页面 -->
        <meta http-equiv="refresh" content="30">
        <!-- 文档标题 -->
        <title>Document</title>
        <!-- CSS样式 -->
        <style></style>
        <!-- JS样式  -->
        <script></script>       
    </head>
    <!-- 主体内容 -->
    <body>
        <!--header 头部-->
        <!--nav    导航-->
        <!--section 区块、段落-->
        <!--footer  底部-->
    </body>
</html>
```
### 2. 标签
    所有标签的共同属性：id,title,class, 当一个标签不给定颜色时是无色透明的
#### 2.1 实体标签
    无法在浏览器\网页中直接显示
| 值  | 含义 |
| --- | --- |
| &lt; | <  |
| &gt; | >  |
| &laquo; | << |
| &raquo; | >> |
| &nbsp;  | 空格 |
| &times; | ×,模拟叉号 |
#### 2.2 无意义标签
```html
    <span></span>   <!-- 无意义行标签 -->
    <div></div>     <!-- 无意义块标签，当块标签进行定位时，无法独占一行 -->
```
#### 2.3 Display 行块标签属性
| 值  | 含义 |
| --- | --- |
| block        | 块标签，有宽高，独占一行，定位时独占一行特性消失 |
| inline       | 行标签，无宽，有高，不能独占一行 |
| inline-block | 行块标签，有宽高，不能独占一行 |
#### 2.4 格式标签
```html
    <i></i>             斜体文本
    <b></b>             粗体文本
    <big></big>         大号字体
    <p></p>             段落
    <q></q>             文本双引号
    <s></s>             删除线
    <u></u>             下划线
    <br>                换行
    <nobr></nobr>       不换行
    <hr>                导航线
    <center></center>   居中
    <pre></pre>         按源代码显示
    <ul>                无序列表
        <li></li>
    </ul>
    <ol>                有序列表
        <li></li>
    </ol>
    <dl>                自定义列表
        <dt></dt>       自定义列表标题
        <dd></dd>       自定义列表内容
    </dl>
```
#### 2.5 音频标签
```html
    <audio src="路径" controls出现控件 loop单曲循环 autoplay自动播放></audio>
```
#### 2.6 视频标签
```html
    <video src="路径" controls出现控件 height loop单视频循环 autoplay自动播放></video>
```
#### 2.7 图片标签
```html
    <img src="图片路径" alt="图片加载失败显示" title="图片标题" width="宽" height="高" usemap="热点地图">
```
#### 2.8 热点地图
    现已基本不再使用，改用div和canvas代替
```html
    <area shape="circle" coords="Y,X,R" href="网址" target="打开方式" alt="加载失败显示">
```
#### 2.9 a链接代替热点地图
```html
    <img src="" alt="">
    <a href="网址" target="打开方式"></a>
    <style>
        a {
            width: 10px;
            height:10px;
            display: block;      // 强制转化为块标签，即div块
            position:absolute;   // 绝对定位sssss
            left: 10px;
            right:10px;
        }
    </style>
```
### 3. 颜色
| 表示 | 格式 |
| --- | --- |
| 英文 | red green blue |
| 十进制 | rgb(255,0,0) rgb(0,255,0) rgb(0,0,255) |
| 十六进制 | #fff #0f0 #00f |
### 4. URL
#### 4.1 解析类型
| 值   | 含义 |
| --- | --- | 
| http:// | 访问协议 |
| https://| 安全访问协议 |
| www.*.* | 目标网址域名 |
| /index.php | 网站脚本目录 |
| ?id=1   | 脚本参数 |
#### 4.2 Target 打开方式
| 值   | 含义 |
| --- | --- | 
| _self   | 本窗口 |
| _blank  | 新窗口 |
| _parent | 父窗口 |
| _top    | 顶窗口 |
| 窗口名称  | 某窗口 |
| 内嵌窗口(iframe) | |
#### 4.3 锚点链接
    由 #name 跳转至 name,当跨页面时为 页面路径#name
    ```html
        <a href="[url.html]#name"></a>
        <a name="name"></a>
    ```
#### 4.4 数据传输入库流程
    表单数据 -> 脚本 -> 数据库 -> 脚本 -> 页面渲染
### 5. Frame框架(可用后台框架的开发)
#### 5.1 架构
```html
    <frameset rows="" border="" bordercolor="">
        <frame src="" name="">
        <frameset cols="">
            <frame src="" name="" noresize="">
            <frame src="" name="">
        </frameset>
    </frameset>
```
#### 5.2 frameset属性
| 属性 | 值  | 含义 |
| --- | --- | --- |
| cols | (int)num | 横向分隔 |
| rows | (int)num | 纵向分隔 |
| border |        | 边框大小 |
| frameborder | bool | 是否有边框 |
| bordercolor | bool | 边框颜色  |
#### 5.3 frame属性
| 属性 | 值  | 含义 |
| --- | --- | --- |
| name      |     | 名字 |
| src       |     |  路径 |
| noresize   |     | 不可改动大小 |
| scrolling | yes | 显示滚动条 |
| scrolling | no  | 不显示滚动条 |
| scrolling | auto| 根据文本大小自适应显示滚动条(默认) |
### 6. Table 表格
    表格中有多少<tr>就有多少行，每个<tr>中有多少<td>就代表有多少列
```html
    <table>             // 表格
        <tr>            // 行
            <th></th>   // 表格列标题
        </tr>
        <tr>
            <td></td>   // 单元格内容
        </tr>
    </table>
```
#### 6.1 table属性
| 属性 | 值  | 含义 |
| --- | --- | --- |
| width 丨height | px | 像素 |
|             | %  | 百分比 |
|             | vw | 视口宽度的1% |
|             | vh | 视口高度的1% |
|             | vmin | 选取vw和vh中最小的那个 |
|             | vmax | 选取vw和vh中最大的那个 |
| border      |      | 边框 |
| bordercolor | #    | 边框颜色 |
| align | left   | 左对齐 |
|       | right  | 右对齐 |
|       | center | 居中   |  
| cellspacing |  | 单元格外边距 |
| cellpadding |  | 单元格内边距 |
| caption     | string | 表名 |
#### 6.2 tr属性
| 属性 | 值  | 含义 |
| --- | --- | --- |
| align | left   | 左对齐 |
|       | right  | 右对齐 |
|       | center | 居中  |
| valign| top    | 对内容进行上对齐 |
|       | middle | 对内容进行居中对齐（默认值）|
|       | bottom | 对内容进行下对齐 |
|       | baseline | 与基线对齐 |
#### 6.3 td属性
| 属性 | 值  | 含义 |
| --- | --- | --- |
| width | px/%   | 宽 |
| height| px/%   | 高 |
| align | left   | 左对齐 |
|       | right  | 右对齐 |
|       | center | 居中  |
|       | justify| 对行进行伸展，这样每行都可以有相等的长度（就像在报纸和杂志中）|
|       | char   | 将内容对准指定字符 |
| valign| top    | 对内容进行上对齐 |
|       | middle | 对内容进行居中对齐（默认值）|
|       | bottom | 对内容进行下对齐 |
|       | baseline | 与基线对齐 |
|colspan| int(num) | 单元格横合并 |
|rowspan| int(num) | 单元格纵合并 |
### 7. Form 表单
#### 7.1 标签架构
```html
    <form action="提交脚本 / javaScript:"
          method ="get / post"
          enctype="multipart/form-data">
        <select name="" >                    // 下拉菜单 required:必选
            <option value="" disabled selected hidden></option> // 提示词
            <option value=""></option>      // 下拉菜单选项
        </select>

        <textarea></textarea>               // 文本域，按原格式输出，标签中不要有空格

        <fieldset>
            <legend>标题</legend>
        </fieldset>

        <input type="text">          // 文本框
        <input type="password">      // 密码框
        <input type="radio">         // 单选框
        <input type="hidden">        // 隐藏域，不显示
        <input type="button">        // 死按钮
        <input type="checkbox" name="name[]">     // 多选框
        <input type="image" src="" alt="">        // 图片提交按钮
        <input type="file">                       // 文件提交按钮
        <input type="reset">         // 重置按钮
        <input type="submit">        // 提交按钮

        <button></button>            // 提交按钮
    </form>
```
#### 7.2 input属性
| 属性 | 值  | 含义 |
| --- | --- | --- |
| type| string | 框类型 |
| name| string | 字段名,name[]为多选字段 |
| value | string | 默认值 |
| placeholder | string | 背景提示词 |
| src         | string | 图片路径，image专属  |
| maxlength   | int(num) | 最大长度 |
| required    |        | 规定文本区域是必填的 |
| valign  | top    | 对内容进行上对齐 |
| outline | none   | 去除聚焦边框 |
| readonly|        | 只读,可带值 |
| disabled|        | 只读,不可带值|
| contenteditable ||是否可以进行编辑|
#### 7.3 select属性
| 属性 | 含义 |
| --- | --- |
| multiple | 允许select进行多选，需要配合name[]使用 |
| size     | 同时展示个数 |
| required | 规定文本区域是必选的 |
#### 7.4 textarea属性
| 属性 | 值  | 含义 |
| --- | --- | --- |
| autofocus | | 规定在页面加载后文本区域自动获得焦点 |
| cols      | | 规定文本区内的字符可见宽度 |
| rows      | | 规定文本区内的字符可见行数 |
| disabled  | | 规定禁用该文本区 |
| form      | | 规定文本区域所属的一个或多个表单 |
| maxlength | int(num) | 最大长度 |
| required  |          | 规定文本区域是必填的 |
| wrap      | soft     | 当在表单中提交时，textarea 中的文本不换行,默认值 |
|           | hard     | 当在表单中提交时，textarea 中的文本换行（包含换行符,当使用 "hard" 时，必须规定 cols 属性 |
| resize    | none     | 彻底禁用拖动 |
| min-height min-width max-height max-width || 组合使用(右下角的拖动图标依然存在) |
#### 8. a链接
| 属性 | 值  | 含义 |
| --- | --- | --- |
| text-decoration | none | 消除下划线 |
### 9. li
| 属性 | 值  | 含义 |
| --- | --- | --- |
| list-style-type | none | 消除小圆点 |
### 10. img
| 属性 | 值  | 含义 |
| --- | --- | --- |
| vertical-align | baseline | 默认 元素放置在父元素的基线上 |
|                | sub	   | 垂直对齐文本的下标 |
|                | super   | 垂直对齐文本的上标 |
|                | top	   | 把元素的顶端与行中最高元素的顶端对齐 |
|                | text-top| 把元素的顶端与父元素字体的顶端对齐  |
|                | middle  | 把此元素放置在父元素的中部 |
|                | bottom  | 把元素的顶端与行中最低的元素的顶端对齐 |
|                | text-bottom | 把元素的底端与父元素字体的底端对齐 |
|                | length  | |
|                | %	   | 使用 "line-height" 属性的百分比值来排列此元素 允许使用负值 |
|                | inherit | 规定应该从父元素继承 vertical-align 属性的值 |
### 11. Canvas
| 属性 | 值  | 含义 |
| --- | --- | --- |
| moveTo(x,y) | | 起始坐标点 |
| lineTo(x,y) | | 后续坐标点 |
| stroke() |    | 渲染 |
| fillStyle | (color) | 填充 |
| fillRect(x,y,w,h) | | 填充矩形 |
| strokeStyle | (color) | 描边 |
| strokeRect(x,y,w,h) | | 描边矩形 |
```html
<html lang="">
    <head>
        <title>canvas</title>
        <style>
            #c1 {
                margin-left: 500px;
                border:1px solid #f00
            }
        </style>
        <script>
            window.onload = function() {
                // 获取canvas对象
                let c1 =  document.getElementById('c1');
                if(c1.getContext) {
                    // 创建2D画布
                    let c1text = c1.getContext("2d");
                    // 起始点
                    c1text.moveTo(50,100);
                    // 下一点
                    c1text.lineTo(150,100);
                    // 下一点
                    c1text.lineTo(50,100);
                    // 渲染
                    c1text.stroke();
                }
            }
        </script>
    </head>
    <body>
        <canvas id="c1"></canvas>
    </body>
</html>
```