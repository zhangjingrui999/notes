### 安装
```html
<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
```
### 1. 响应式设计
```html
<div class="container"></div>
<style>
    .container {
        padding: 0 15px;
        margin: 0 auto;
    }
</style>

<h1 class="page-header"></h1>
<style>
    .page-header {
        margin: 40px 0 20px;
        padding-bottom: 9px;
        border-bottom: 1px solid #eee;
    }
</style>

<div class="row"></div>
<style>
    .row {
        margin: 0 -15px;
    }
</style>
```
### 2. 栅格系统
    将父块平均分为 12块, *代表几个块
| 值 | 含义 |
| --- | --- |
| col-md-* | 中等屏幕 |
| col-xs-* | 微小屏幕 |
| col-md-offset-* | 左外边距 *块 |
### 3. 排版
| class | 含义 | 样式 |
| --- | --- | --- |
| small | 标签 | font-size: 65%; color: #777; |
| lead | 段落样式 | margin-bottom: 20px; line-height: 1.4; font-weight: 300; |
| mark | 标签, 背景色 | padding:2em; background: #ff0 / #fcf8e3; |
| del  | 删除线 | |
| text-left | 文本左对齐 |
| text-right| 文本右对齐 |
| text-center | 文本居中对齐 |
| text-justify | 文本俩端对齐 |
| blockquote | 标签, 引用 |
| blockquote-reverse | 引用反转 |
| code | 标签 | padding: 2px 4px; font-size: 90%; color: #c7254e; background: #f9f2f4; border-radius: 4px; |
| kbd | 标签, 黑底白字 | padding: 2px 4px; font-size: 90%; color: #fff; background: #333; border-radius: 3px;|
### 4. 表格
| class | 含义 |
| --- | --- |
| table | 出现表格上的边线 |
| table-bordered | 出现所边线 |
| table-striped | 隔行换色 |
| table-hover | 鼠标移动特效 |
| table-condensed | 紧缩表格 |
| active, success, warning, danger, info | 表格颜色 |
| table-responsive | 响应式表格 |
| img-responsive | 响应式图片 |
| img-circle | 圆形图片 |
| img-rounded | 圆角样式 |
| img-thumbnail | 边框样式 |
### 5.表单
| class | 含义 |
| --- | --- |
| form-group | margin-bottom: 15px;|
| form-control | 文本与文本框成上下结构 |
| control-label | 水平表单 文本与文本框成左右结构 |
| form-inline | 左对齐并成为行快标签 |
| form-horizontal | |
#### 5.1 Input 边框颜色
| class | 含义 |
| --- | --- |
| has-success | |
| has-warning  | |
| has-error   | |
#### 5.2 表单图标
    has-feedback
        form-control-feedback
            glyphicon-ok             √
            glyphicon-remove         ❌
            glyphicon-star           ★
            glyphicon-warning-sign   三角警告
            glyphicon-addon          @
```html
<div class="form-group has-success has-feedback">
  <label class="control-label" for="inputSuccess2">Input with success</label>
  <input type="text" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status">
  <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
  <span id="inputSuccess2Status" class="sr-only">(success)</span>
</div>
```
#### 5.3 表单尺寸
| class | 含义 |
| --- | --- |
| input-sm | 小 30px |
| input-xs | 中 36px |
| input-lg | 大 46px |
### 6. 按钮
#### 6.1 标签
```html
    <input type="button">
    <button></button>
    <a href=""></a>
    <input type="submit" value="">
    <input type="reset" value="">
```
#### 6.2 类
```css
/*基类*/
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    text-align: center;
    border: 1px;
    border-right: 4px;
}
.btn-info {
    color: #fff;
    background-color: #5bc0de;
    border-color: #46b8da;
}
.btn-warning {
    color: #fff;
    background-color: #f0ad4e;
    border-color: #eea23b;
}
.btn-default {
    color: #333;
    background-color: #fff;
    border-color: #ccc;
}
.btn-primary {
    color: #fff;
    background-color: #337ab7;
    border-color: #2ebda4;
}
.btn-danger {
    color: #fff;
    background-color: #d9534f;
    border-color: #d43f3a;
}
.btn-success {
    color:#fff;
    background-color: #5cb85c;
    border-color: #4caeac;
}
.btn-lg {
    padding: 10px 16px;
    font-size: 18px;
    border-radius: 6px;
}
.btn-sm {
    padding: 5px 10px;
    font-size: 12px;
    border-radius: 3px;
}
.btn-xs {
    padding: 1px 5px;
    font-size: 12px;
    border-radius: 3px;
}
a {
    disabled: true; /* a链接表面禁用还能点 */
}
```
### 7. holder.js 占位图片
```html
<script src="https://cdn.bootcss.com/holder/2.9.4/holder.min.js"></script>
<img src="holder.js/300x200" alt="">
```
### 8. 辅组类
#### 8.1 文本颜色
    .text-muted
    .text-primary
    .text-success
    .text-info
    .text-warning
    .text-danger
#### 8.2 背景颜色
    .background-primary
    .background-success
    .background-info
    .background-warning
    .background-danger
#### 8.3 按钮
    .close  关闭按钮
    .caret  三角符号
#### 8.4 按钮组
    .btn-group
    .btn-toolbar    按钮工具栏
    .btn-group-lg   按钮组尺寸
    .btn-group-sm
    .btn-group-xs
    .btn-group      按钮组嵌套
        .btn-group
    .btn-group-vertical     垂直按钮组
    .btn-group-justified    俩端对齐的按钮组
#### 8.5 浮动
    .pull-left  左浮动
    .pull-right 右浮动
    .clear-fix  清除浮动
#### 8.6 块居中
    .center-block
#### 8.7 显示与隐藏
    .show
    .hidden
#### 8.8 字体图标
    .glyphicon 
    .glyphicon-superscript
#### 8.9 下拉菜单
    .dropdown
    .dropdown-toggle
    .dropdown-menu
    data-toggle="dropdown"
#### 8.10 输入框组
    .input-group
    .input-group-addon
    .input-group-lg
    .input-group-sm
### 9. 导航
    .nav    .nav-tabs   标签页
    .nav    .nav-pills  胶裹式
    .nav-stacked        垂直导航
    .nav-justifyied     俩端对齐
    .dropdown           下拉菜单
#### 9.1 导航条
    .navbar .navbar-default .navbak-inverse 
    .nav    .navbar-fixed-bottom .navbar-fixed-top
    .navbar-header .nav-brand .navbar-toggle
    .collapsed data-toggle="collapse" data-torget="#mybs"
    .icon-bar .navbar-collapse .navbar-nav .navbar-right .navbar-left
    .active .navbar-text .nav-bar-form .navbar-btn
#### 9.2 路径导航
    .breadcrumb
    .active
### 10. 分页
    .pagination
    .pagination-lg
    .pagination-sm
#### 10.1 翻页
    .page .previous .next
### 11.标签
    .label .label-primary .label-default .label-info .label-success .label-warning .label-danger
### 12. 其他
#### 12.1 徽章
    .badge
#### 12.2 巨幕
    .jumnotron
#### 12.3 页头
    .page-header
#### 12.4 缩略图
    .thumbnail
    .caption
#### 12.5 警告框
    .alert .alert-success .alert-info .alert-warning .alert-danget .alert-link .alert-dismissible data-dismiss="alert"
#### 12.6 进度条
    .progress .progress-bar .progress-bar-success .progress-bar-info .progress-bar-warning
    .active .progress-bar-danger .progress-bar-striped style="width:60%"
#### 12.7 媒体对象
    .media .media-left .media-right .media-top .media-bottom .media-body .media-middle
#### 12.8 列表组
    .list-group .list-group-item .list-group-item-info .list-group-item-success .list-group-item-warning
    .list-group-item-danger .list-group-item-heading .list-group-item-text .active
#### 12.9 画板
    .pabel .pabel-primary .pabel-success .pabel-warning .pabel-danger
    .pabel-info .pabel-heading .pabel-title .pabel-body .pabel-footer
#### 12.10 响应式的嵌入式页面比例
    .embed-responsive .embed-responsive-16by9 .embed-responsive-item .embed-responsive-4by3
#### 12.11 well
    .well .well-lg .well-sm
#### 12.12 模态框(modal)
    .modal .modal-dialog .modal-content .modal-header .modal-title .modal-body .modal-footer .modal-lg .modal-sm fode
    data-toggle="modal" data-target="#mymodal" data-dismiss="mymodal"