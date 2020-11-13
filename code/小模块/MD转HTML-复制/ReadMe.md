# Markdown

***
# 渲染Markdown，自动增加目录 [![Join the chat at https://gitter.im/zhengxiaoyao0716/chatroom](https://badges.gitter.im/zhengxiaoyao0716/chatroom.svg)](https://gitter.im/zhengxiaoyao0716/chatroom?utm_source=share-link&utm_medium=link&utm_campaign=share-link)
## Render markdown file, auto add a float-fold TOC.


***
### 2018-01-30 更新！
停止更新！请移步 [Markplus - Markdown的全面强化](https://zhengxiaoyao0716.github.io/markplus/)

虽然现在（01-30日）Markplus还不够完善，但我会继续完善维护下去，至于这个项目，大概不会再有更新了。谢谢大家的支持。
***


***
## 一个工具性质的网页，可以渲染Markdown文件
## 并为H1、H2号标题自动增加一个浮动且自动折叠的TOC
## [Try it now](http://zhengxiaoyao0716.github.io/MarkedWithToc)<br />
## [试试看](http://temp.zheng0716.com/MarkedWithToc)<br />
    我提供了一份接口文档示范，[test_api.md]，你可以尝试把它拖进去看看
***
    2016/3/18: 注意，第一个一级标题会被无视，因为要作为文档标题嘛
    2016/3/17: 现在你可以将渲染好的html一键保存到本地了！
### Dark theme: 黑色主题预览效果
![Dark theme](http://zhengxiaoyao0716.github.io/MarkedWithToc/preview/dark.jpg)
### Light theme: 白色主题预览效果
![Light theme](http://zhengxiaoyao0716.github.io/MarkedWithToc/preview/light.jpg)
***
    虽然可以用它渲染任何遵循Markdown语法的文件
    但它更适合、或者说主要是为了渲染Http接口文档
## 因为我做了以下优化：
***
> 
#### 1、在jasonm23提供的css样式基础上，修改定制黑、白两套CSS样式，主要修改表格样式，明暗间隔以便区分，并适当调整字号，使更适合作为接口文档来阅读
#### 2、比起别的Markdown增加TOC的项目，我只为H1、H2号标题做导航，对于接口文档来说这足矣，太多的目录反而不适合
#### 3、导航目录是浮动在左侧的，不会随着文档滚动，失去焦点后自动折叠，这样更方便作为一份接口文档来查看

***
### 那么现在来试试拖拽.md文件来预览吧？这应该比上传到GitHub后查看方便许多
## [Try it now](http://zhengxiaoyao0716.github.io/MarkedWithToc)<br />
## [试试看](http://temp.zheng0716.com/MarkedWithToc)<br />
***
#### 如果你把该功能想整合进自己的网页里，那么需要引用[marked_with_toc.js](http://zhengxiaoyao0716.github.io/MarkedWithToc/static/js/marked_with_toc.js)、[dark](http://zhengxiaoyao0716.github.io/MarkedWithToc/static/css/markdown-dark.css)或[light](http://zhengxiaoyao0716.github.io/MarkedWithToc/static/css/markdown-dark.css)主题
#### 它依赖于[/chjj/marked](https://github.com/chjj/marked)渲染Markdown文本，你需要一起引用
