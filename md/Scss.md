[文档](https://sass-lang.com/documentation)
### 1. 起源
    CSS不是一种编程语言。
    你可以用它开发网页样式，但是没法用它编程。也就是说，CSS基本上是设计师的工具，不是程序员的工具。在程序员眼里，CSS是一件很麻烦的东西。它没有变量，也没有条件语句，只是一行行单纯的描述，写起来相当费事。
    很自然地，有人就开始为CSS加入编程元素，这被叫做"CSS预处理器"（css preprocessor）。它的基本思想是，用一种专门的编程语言，进行网页样式设计，然后再编译成正常的CSS文件。

### 2. 安装和使用
#### 2.1 安装
    SASS是Ruby语言写的，但是两者的语法没有关系。不懂Ruby，照样使用。只是必须先安装Ruby，然后再安装SASS。
    假定你已经安装好了Ruby，接着在命令行输入下面的命令：
        gem install sass    // Vue中可直接执行命令 无视Ruby
        
#### 2.2 使用
    SASS文件就是普通的文本文件，里面可以直接使用CSS语法。文件后缀名是.scss，意思为Sassy CSS。
    下面的命令，可以在屏幕上显示.scss文件转化的css代码。（假设文件名为test。）
        sass test.scss
    如果要将显示结果保存成文件，后面再跟一个.css文件名。
        sass test.scss test.css

### 3. 基本用法
#### 3.1 变量
    SASS允许使用变量，所有变量以$开头。
    如果变量需要镶嵌在字符串之中，就必须需要写在#{}之中。
    
```scss
    $blue : #1875e7;    
    div {
        color : $blue;
    }
    
    $side : left;
    .rounded {
        border-#{$side}-radius: 5px;
    }
```
#### 3.2 计算
    SASS允许在代码中使用算式

```scss
    $var: 10;
    body {
        margin: (14px/2);
        top: 50px + 100px;
        right: $var * 10%;
    }
```

#### 3.3 嵌套
    SASS允许选择器嵌套
    
```scss
    div {
        p {
            // 等同于 div p {}
        }
        
        &:hover {
            // 等同于 div:hover {}
        }
    
        border: {
            color: #000; // 等同于 border-color
        }
    }
```

#### 3.4 注释
    标准的CSS注释 /* comment */ ，会保留到编译后的文件
    单行注释 // comment，只保留在SASS源文件中，编译后被省略。
    在/*后面加一个感叹号，表示这是"重要注释"。即使是压缩模式编译，也会保留这行注释，通常可以用于声明版权信息。
    
```scss
/*!
    重要注释！
*/
```
    
### 4. 代码的重用
#### 4.1 继承
    SASS允许一个选择器，继承另一个选择器

```scss
    .class1 {
        border: 1px solid #ddd;
    }
    .class2 {
        @extend .class1;
        font-size:120%;
    }
```

#### 4.2 Mixin
    Mixin有点像C语言的宏（macro），是可以重用的代码块。

```scss
    @mixin left {
        float: left;
        margin-left: 10px;
    }
    div {
        @include left;
    }
    
    @mixin right($value: 10px) {
        float: left;
        margin-right: $value;
    }
    
    div {
        @include right(20px);
    }

    // 生成浏览器前缀
    @mixin rounded($vert, $horz, $radius: 10px) {
　　　　border-#{$vert}-#{$horz}-radius: $radius;
　　　　-moz-border-radius-#{$vert}#{$horz}: $radius;
　　　　-webkit-border-#{$vert}-#{$horz}-radius: $radius;
　　}

    li {
        @include rounded(top, left);
    }
```

#### 4.3 颜色函数
    SASS提供了一些内置的颜色函数，以便生成系列颜色。
    
```scss
    lighten(#cc3, 10%) // #d6d65c
    darken(#cc3, 10%)  // #a3a329
    grayscale(#cc3)   // #808080
    complement(#cc3)  // #33c
```

#### 4.4 插入文件
    @import命令，用来插入外部文件。
    如果插入的是.css文件，则等同于css的import命令。
    
```scss
    @import "path/filename.scss";
    @import "foo.css";
```

### 5. 高级用法
#### 5.1 条件语句
    @if 可以用来判断
    @else 与之配套

```scss
    p {
        @if lightness($color) > 30% {
            font-color: #000;
    　　} @else {
            font-color: #fff;
    　　}
　　}
```

#### 5.2 循环语句
    SASS支持for循环

```scss
    @for $i from 1 to 10 {
        .border-#{$i} {
            border: #{$i}px solid blue;
        }
　　}
```
    
    SASS支持while循环
    
```scss
    $i: 6;
　　@while $i > 0 {
　　　　.item-#{$i} { width: 2em * $i; }
　　　　$i: $i - 2;
　　}
```

    each命令，作用与for类似
    
```scss
    @each $member in a, b, c, d {
        .#{$member} {
            background-image: url("/image/#{$member}.jpg");
        }
　　}
```

#### 5.3 自定义函数
    SASS允许用户编写自己的函数。
    
```scss
    @function double($n) {
        @return $n * 2;
    }
    
    #sidebar {
        width: double(5px);
    }
```