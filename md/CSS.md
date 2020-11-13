### 0. 经验技巧
### 1. Css样式放置位置
    1. 外部 <link rel="stylesheet" href="路径">
    2. 内部 <style></style>
    3. 内联 style=""
### 2. Css优先级
    同一优先级时先后覆盖，!important为最优先级别
    外部 = 内部 < 类 < id < 内联
### 3. 选择器
#### 3.1 常用选择器
    类(.*) > 标签 > id(#*)
#### 3.2 伪类选择器
| 属性 | 含义 |
| --- | --- |
| :hover | 当鼠标放到其上时触发 |
| :focus | 获得/失去焦点 |
| ::selection  | 文字选中样式(存在兼容问题) |
| :after | 元素之后 content为必须属性 |
| :before| 元素之前 content为必须属性 |
#### 3.3 基本选择器
| 属性 | 含义 |
| --- | --- |
| :first-child  | 第一个符合条件的标签 |
| :first-letter | 所有符合条件标签的首字符 只能用于块级元素(包括display:[inline-]block;)|
| :first-line   | 所有符合条件的标签 |
| :last-child   | 最后一个符合条件的标签 |
| :nth-child()  | 第()个符合条件的标签 |
    :first-letter适用的属性
        font
        color
        background
        margin
        padding
        border
        text-decoration
        vertical-align(仅当float为none的时候)
        text-transform
        line-height
        float
        clear
```html
<body>
    <div> div:nth-child(1) | div:first-child </div>
    <p> p:nth-child(2) </p>
    <div> div:nth-child(3) </div>
    <span> span:nth-child(4) | span:last-child </span>
</body>
```
#### 3.4 层次选择器
| 属性 | 含义 |
| --- | --- |
| a, b  | 组合标签 选中 a和b |
| a  b  | 关联标签 选中 a下的b |
| a> b  | 父子标签 选中 a和a下的b |
| a+ b  | 兄弟标签 选中 a后面的b |
#### 3.5 属性选择器
| 属性 | 含义 |
| --- | --- |
| [*=""]  | *值 |
| [*~=""] | *值中包含的任意单词 |
| [*^=""] | *值的首单词 |
| [*$=""] | *值任意尾字符串 |
| [**=""] | *值中包含任意字符串r |
### 4. Font 字体
#### 4.1 字体样式
| 属性 | 值  | 含义 |
| --- | --- | --- |
| font-family | 字体     | 字体样式(宋，楷，黑等) |
| font-size   | px      | 字体大小 |
| font-style  | italic  | 斜体 |
|             | oblique | 倾斜 |
|             | normal  | 去除斜体 |
|             | inherit | 规定从父元素中继承 |
| font-weight | bold    | 粗体 |
|             | inherit | 规定从父元素中继承 |
| font        | small-caps | 小型字符 |
| color       | #          |字体颜色 |
| [-webkit-,-moz-,-ms-]user-select | none | 字体无法选中 |
| @font-face{font-family: 字体;src: url();} | | 调用外部字体 |
#### 4.2 文本样式
| 属性 | 值  | 含义 |
| --- | --- | --- |
| user-select    | none         | 禁止选中文字 |
| letter-spacing | px           | 字符间距 |
| word-spacing   | px           | 单词间距 |
| text-transform | none	        | 默认 定义带有小写字母和大写字母的标准的文本 |
|                | capitalize	| 文本中的每个单词以大写字母开头 |
|                | uppercase	| 定义仅有大写字母 |
|                | lowercase	| 定义无大写字母，仅有小写字母 |
|                | inherit	    | 规定应该从父元素继承 text-transform 属性的值 |
| text-decoration| none         | 默认 |
|                | underline    | 下划线 |
|                | overline     | 上划线 |
|                | line-through | 删除线 |
|                | blink        | 文本闪烁 |
| text-align     | left         | 左对齐 |
|                | right        | 右对齐 |
|                | center       | 居中对齐 |
|                | justify       | 俩端对齐 |
| text-shadow    | x y px #     | 文本阴影(X轴 Y轴 距离 颜色) |
| text-indent    | px           | 文本首行缩进 |
| line-height    | px           | 设置行高，当行高与块高相同时文字会居中 |
| word-break     | break-all    | 强制文本折行(不保留单词) |
|                | break-word   | 强制文本折行(保留单词) |
| white-space    | nowrap       | 强制文本不换行 |
| text-overflow  | ellipsis     | 文本越界变省略号(...)|
```css
    /* 单行文本越界省略号 */
    .one {
        overflow: hidden;
        white-space:nowrap;
        text-overflow: ellipsis;
    }

    /* 多行文本越界省略号 */
    .three {
        /*必须结合的属性 ，将对象作为弹性伸缩盒子模型显示*/
        display: -webkit-box;
        /*必须结合的属性 ，设置或检索伸缩盒对象的子元素的排列方式 */
        -webkit-box-orient: vertical;
        /*限制在一个块元素显示的文本的行数*/
        -webkit-line-clamp: 3;
        overflow: hidden;
    }

    /* 背景提示词样式更改 */
    ::-webkit-input-placeholder { /* WebKit, Blink, Edge */
        color:    #909;
    }
    :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
       color:    #909;
    }
    ::-moz-placeholder { /* Mozilla Firefox 19+ */
       color:    #909;
    }
    :-ms-input-placeholder { /* Internet Explorer 10-11 */
       color:    #909;
    }
```
### 5. Border 边框
| 属性 | 值  | 含义 |
| --- | --- | --- |
| border-style | hidden            | 隐藏 |
|              | dotted            | 虚线 |
|              | double            | 双线 |
|              | dashed            | 横线 |
|              | solid             | 实线 |
|              | groove            | 凹槽线 |
|              | ridge             | 凸槽线 |
|              | inset             | 内侧 |
|              | outset            | 外侧 |
| border-width | px                | 边框粗细 |
| border-color | #                 | 边框颜色 |
| border-radius| px px px px       | 边框圆角，最大值为高的一半 |
| border-shadow| x y px #          | 边框阴影 |
| border-image | url() px px round | 边框图片 |
|              | stretch           | 边框图片拉伸 |
|              | repeat            | 边框图片重复 |
| border       | px style color    | 缩写 |
|              | px style rgba(0,0,0,0) | 透明边框 |
| outline      | px style #        | 轮廓样式 |
| outline-offset | px              | 轮廓距离 |
| -moz-outline-radius | px         | 圆角轮廓(目前仅限于火狐浏览器) |
### 6. Background 背景样式
| 属性 | 值  | 含义 |
| --- | --- | --- |
| background | linear-gradient(direction,color-stop1, color-stop2...) | 渐变色 (用角度值指定渐变的角度（或方向）,用于指定渐变的起止颜色) |
|            | linear-gradient(color1 width,color2 width)             | 渐变色 |
| background-color | #     | 背景颜色 |
| background-image | url() | 背景图片 |
| background-repent| repeat| 背景重复，默认 |
|                  | no-repeat | 背景不重复|
| background-attachment | fixed| 固定，不动|
| background-position| px px   | 背景图定位|
|                    | % %     | |
|                    | left,bottom,right,top| |
| background-color   | hsla(色调,饱和度 %,亮度 %,不透明度 0.*) | 背景色 |
| background-size    | x y        | 背景图大小  |
| background-origin  | border-box | 背景图像相对于边框盒来定位   |
|                    | padding-box| 背景图像相对于内边距框来定位 |
|                    | content-box| 背景图像相对于内容框来定位   |
| opacity            | 0.1-1      | 背景色透明  |
### 7. Cursor 鼠标样式
| 值  | 含义 |
| --- | --- |
| crosshair | 十字 |
| pointer   | 小手 |
| text      | 文本 |
| default   | 默认 |
| help      | 帮助 |
### 8. Overflow 滚动条
| 属性 | 值  | 含义 |
| --- | --- | --- |
| overflow | visible | 显示越界文本，有滚动条 |
|          | hidden  | 不显示越界文本，无滚动条 |
|          | scroll  | 出现滚动条 |
|          | auto    | 当文本越界时出现滚动条 |
|    -y(x) | visible | y(x) 轴显示滚动条 |
|          | hidden  | y(x) 轴不显示滚动条 |
### 9. 显示与隐藏
| 属性 | 值  | 含义 |
| --- | --- | --- |
| display  | block | 不占位显示 |
|          | inline| 不占位显示 |
|          | block-inline | 不占位显示 |
|          | none    | 不占位隐藏 |
|visibility| visible | 占位显示  |
|          | hidden  | 占位隐藏  |
### 10. 边距
#### 10.1 Margin 外边距(左右相加，上下取大)
| 属性 | 值  | 含义 |
| --- | --- | --- |
| margin-left  | px | 左边距 |
| margin-right | px | 右边距 |
| margin-top   | px | 上边距 |
| margin-bottom| px | 下边距 |
#### 10.2 Padding 内边距(相加与原长)
| 属性 | 值  | 含义 |
| --- | --- | --- |
| padding-left  | px | 左边距 |
| padding-right | px | 右边距 |
| padding-top   | px | 上边距 |
| padding-bottom| px | 下边距 |
#### 10.3 缩写
| 属性 | 值  | 含义 |
| --- | --- | --- |
| px          | px | 上右左下 |
| px px       | px | 上下 左右 |
| px px px    | px | 上 左右 下 |
| px px px px | px | 上 右 下 左 |
### 11. 浮动
#### 11.1 Float 浮动
    基于z轴向上浮动，当某元素浮动后，后面元素的按照自然文档流的顺序占用
| 属性 | 值  | 含义 |
| --- | --- | --- |
| float | left  | 左浮动 |
|       | right | 右浮动 |
|z-index| number| 提高元素浮动等级 |
#### 11. Clear 清除浮动
| 值  | 含义 |
| --- | --- |
| left | 禁止在左端浮动 |
| right| 禁止在右端浮动 |
| both | 禁止俩端浮动，可用于防止元素高为0 |
### 12. Position 定位
| 属性 | 值  | 含义 |
| --- | --- | --- |
| position | absolute | 相对于文档流进行 绝对定位 |
|          | relative | 相对于出现点进行 相对定位 |
|          | fixed    | 相对于屏幕域进行 固定定位 |
|          | sticky   | 当元素Y轴高度小于父元素Y轴高度时进行 固定定位 |
| top    | px px | |
| left   | px px | |
| right  | px px | |
| bottom | px px | |
### 13. 多栏样式
| 属性 | 值  | 含义 |
| --- | --- | --- |
| column-count | num | 分为num栏 |
| column-gap   | px  | 分栏距离  |
| column-rule  | px style # | 分栏线样式 |
### 14. 2D样式
| 属性 | 值  | 含义 |
| --- | --- | --- |
| translate(px,px) | | 以左上角为坐标进行移动 |
| transform   | rotate(deg) | 顺时针旋转 deg度 |
### 15. 3D样式
| 属性 | 值  | 含义 |
| --- | --- | --- |
| transform | rotateX(deg) | 绕X轴旋转deg度 |
| transform | rotateY(deg) | 绕Y轴旋转deg度 |
| transform | rotateZ(deg) | 绕Z轴旋转deg度 |
### 16. 过渡动画
| 属性 | 值  | 含义 |
| --- | --- | --- |
| transition-property | property | 定义应用过渡效果的 CSS 属性名称列表，列表以逗号分隔 |
|                     | none	 | 没有属性会获得过渡效果   |
|                     | all	     | 所有属性都将获得过渡效果 | 
| transition-duration | time     | 规定完成过渡效果需要花费的时间（以秒s或毫秒ms计） |
| transition-timing-function | linear | 规定以相同速度开始至结束的过渡效果（等于 cubic-bezier(0,0,1,1)）|
|                            | ease	  | 规定慢速开始，然后变快，然后慢速结束的过渡效果（cubic-bezier(0.25,0.1,0.25,1)）|
|                            | ease-in	|规定以慢速开始的过渡效果（等于 cubic-bezier(0.42,0,1,1)） |
|                            | ease-out	| 规定以慢速结束的过渡效果（等于 cubic-bezier(0,0,0.58,1)）|
|                            | ease-in-out | 规定以慢速开始和结束的过渡效果（等于 cubic-bezier(0.42,0,0.58,1)）|
|                            | cubic-bezier(n,n,n,n) | 在 cubic-bezier 函数中定义自己的值。可能的值是 0 至 1 之间的数值 |
| transition-delay    | time | 规定在过渡效果开始之前需要等待的时间，以秒s或毫秒ms计 |
| transition | property duration timing-function delay | 缩写 |