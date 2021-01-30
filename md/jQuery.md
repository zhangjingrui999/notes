### 安装
```html
// 百度
<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
// 又拍云
<script src="https://upcdn.b0.upaiyun.com/libs/jquery/jquery-2.0.2.min.js"></script>
// 新浪
<script src="https://lib.sinaapp.com/js/jquery/2.0.2/jquery-2.0.2.min.js"></script>
// Staticfile
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
// Google
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
```

### 1.核心函数
| 函数 | 含义 |
| --- | --- |
| jQuery(); | 获取jquery对象,用法和作用相同 |
| $();      | 区别jQuery()可防止$被占用而冲突 |
| get();    | 获取元素对象数组 |
| index();  | 本页面中某元素的第几个 |
| each();   | 循环 |
| length    | 获取目标元素的总个数(总长度) | 
| size();   | 此为方法,区别于 length属性 |
| data();   | 设置属性,类似attr,但比attr强大好用 |

```javascript
    jQuery('img').click(function() {});
    
    $('img').click(function() {});
    
    $('h1').get(1).outerHTML;
    
    $('h1').click(function() {
        console.log($(this).index('h1'));
    });
    
    $('h1').each(function() {
        $(this).attr({'n':key+1});
    });
    $('h1').click(function() {
        $(this).html($(this).attr('n'));
    })
```

### 2. 选择器
#### 2.1 常用
| 选择器 | 含义 | 范例 |
| ---  | --- | --- |
| #id    | id选择器 | $('#id) |
| .class | 类选择器 | ('.class') |
| ele    | 标签选择器 | $(’ele') |

#### 2.2 层级选择器
| 选择器 | 含义 | 范例 |
| --- | --- | --- |
| a b | 后代关系 | $('body h1')|
| a>b | 父子关系 | $('div>h1') |
| a+b | 弟关系   | $('div+h1') |
| a~b | 弟弟关系 | $('div~h1') |

#### 2.3 基本选择器
| 选择器 | 含义 | 范例 |
| --- | --- | --- |
| :first| 第一个   | $('h1:first') |
| :last | 最后一个 | $('h1:last')  |
| :eq() | 第n个,为负时倒序  | $('h1').eq(-1) |
| :not  | 除这个外的目标元素 | $('h1').not(:(eq(0))) |
| :even | 偶数,从0开始 | $('h1:even') |
| :odd  | 奇数,从0开始一般1显示 | $('h1:odd') |
| :gt() | 此下标之后的元素,不包括本下标 | $('h1').gt(0) |
| :lt() | 从头开始几个元素 | $('h1:lt(1)') |

#### 2.4 内容
| 选择器 | 含义 | 范例 |
| --- | --- | --- |
| :contains() | 关键字  | $("div:contains('text')") |
| :empty()    | 无值填补 | $('td:empty').html('')   |
| :has()      | 某父元素中有某子元素的元素 | $('div:has(p)') |
| :parent()   | ()的父元素 | $(this).parent() |

#### 2.5 属性
| 选择器 | 含义 | 范例 |
| --- | --- | --- |
| [key]     | 元素有这一属性| $("input[name]") |
| [key='']  | 属性等于''   | $("input[name='user']") |
| [key!=''] | 属性不等于'' | $("input[name!='user']")|
| [key$=''] | 属性以''结尾 | $("input[name$='r']")   |
| [key^=''] | 属性以''开头 | $("input[name^='u']")   |
| [key*=''] | 属性中有''  | $("input[name='s']")    |

#### 2.6 子元素
| 选择器 | 含义 | 范例 |
| --- | --- | --- |
| :first-child | 每个中的第一个  | $('div p:first-child')  |
| :last-child  | 每个中的最后一个 |$('div p:last-child')   |
| :nth-child() | 每个中的第几个  | $('div p:nth-child(2)') |
| :only-child  | 父标签中只有一个目标子标签 | $('div p:only-child') |

#### 2.7 表单
| 选择器 | 含义 | 范例 |
| --- | --- | --- |
| :input  | 表单中的input标签 | $('input').each |
| :checkbox|type中为checkbox的标签 | $(':checkbox').each |
| :button | type中为button的标签 | $(':button').each |
| :file   | type中为file的标签   | $(':file').each |
| :hidden | type中为hidden的标签 | $(':hidden').each |
| :radio  | type中为radio的标签  | $(':radio').each |
| :reset  | type中为reset的标签  | $(':reset').each |
| :submit | type中为submit的标签 | $(':submit').each |
| :text   | type中为text的标签   | $(':text').each |
| :password|type中为password的标签|$(':password').each |

#### 2.8 表单属性
| 选择器 | 含义 | 范例 |
| --- | --- | --- |
| :enabled | 表单中属性为enabled(启用) | $('option:enabled')  |
| :disabled| 表单中属性为disabled(禁用)| $('option:disabled') |
| :checkbox | 表单中属性为checkbox    | $('option:checkbox ')|
| :selected | 表单中属性为selected    | $('option:selected') |

#### 2.9 过滤
| 选择器 | 含义 | 范例 |
| --- | --- | --- |
| eq()   | 第几个   | $('h1').eq(1) |
| first()| 第一个   | $('h1').first() |
| last() | 最后一个 | $('h1').last() |
| not()  | 除了这个 | $('h1').not(1) |
| slice()| 从a到b,但不包括b | $('h1').slice(1,3) |

#### 2.10 查找
| 选择器 | 含义 | 范例 |
| --- | --- | --- |
| children() | 子元素    | $(this).children() |
| find() | 后代元素      | $(this).find() |
| next() | 下一个兄弟元素 | $(this).next() |
| prev() | 上一个兄弟元素 | $(this).prev() |
| parent()  | 父元素     | $(this).parent()  |
| parents() |祖先元素    | $(this).parents() |
| siblings()| 兄弟元素   | $(this).siblings()|

#### 2.11 串联
| 选择器 | 含义 | 范例 |
| --- | --- | --- |
| add() | 共同这一JS | $(this).add('h1').add('h2') |
| andSelf() | 全部  | $(this).children().andSelf()|

### 3. 属性
| 属性 | 含义 | 范例 |
| --- | --- | --- |
| attr() | 设置属性 | $('h1').attr({'n':1}) |
| obj.className |  类名 | |
| innerHTML | 网页中的值 | |
| textContent | 标签值 | $('h1').eq(1).text(val); |
| val | 获取value值,常用于表单中 | $("input[name='user']").val(); |

### 4. CSS样式
#### 4.1 方法
| 属性 | 含义 | 范例 |
| --- | --- | --- |
| css('width')  | 获取目标宽 | $('div').css('width') |
| css('height') | 获取目标高 | $('div').css('height')|

#### 4.2 CSS位置
| 属性 | 含义 |
| --- | --- |
| offset()   | 获取坐标 |
| position() | 相对父窗口获取坐标,父窗口要进行定位(但不必须) |
| scrollTop()| 获取滚动条的移动距离 |

```javascript
    x = $(this).offset().left; 
    y = $(this).offset().top; 
    
    x = $(this).position().left; 
    y = $(this).position().top;
    
    $(window).scroll(function() {
        $(window).scrollTop();
    });
```

```javascript
    // 回到顶部
    $(window).scroll(function() {
        len = $(this).scrollTop();
        if(len >= 200) {
            $('.top').show();
        } else {
            $('.top').hide();
        }
    });
    $('.top').click(function() {
        len = $(window).scrollTop();
        v = 50;
        sobj = setInterval(function() {
            len -= v;
            if(len <= 0) {
                len = 0;
                clearInterval(sobj);
            }
            $(window).scrollTop(len);
        },5);
    });
```

#### 4.3 CSS尺寸
| 属性 | 含义 |
| --- | --- |
| width() | 获取宽 | 
| height()| 获取高 |
| innerWidth() | 获取元素+内边距的宽 |
| innerHeight()| 获取元素+内边距的高 |
| outerWidth() | 获取元素+内边距+边框线的宽 |
| outerHeight()| 获取元素+内边距+边框线的高 |

### 5. 文档操作
#### 5.1 内部插入(在某一区域内插入元素)
| 属性 | 含义 |
| --- | --- |
| append()   | 将元素添加至末尾 |
| appendTo() | 同上,反向添加   |
| prepend()  | 将元素添加至头部 |
| prependTo()| 同上,反向添加   |

#### 5.2 外部插入(在某一区域前后插入元素)
| 属性 | 含义 |
| --- | --- |
| insertAfter() | 在区域前插入元素 |
| after()       | 同上,反向添加   |
| before()      | 在区域后插入元素 |
| insertBefore()| 同上,反向添加   |

#### 5.3 包裹
| 属性 | 含义 |
| --- | --- |
| wrap() | 在元素外添加标签 |
| wrapAll() | 全部添加 |
| wrapInner() | 在元素内部添加标签 |

#### 5.4 替换
| 属性 | 含义 | 范例 |
| --- | --- | --- |
| replaceAll() | 将此替换为    | $('<p>php</p>').replaceAll('span')  |
| replaceWith() | 将其他替换为 | $('span').replaceWith('<p>php</p>') |

#### 5.5 删除
| 属性 | 含义 |
| --- | --- |
| empty()  | 删除所有 |
| remove() | 删除对象但不保留事件和数据 |
| detach() | 删除但保留事件和数据 |

#### 5.6 复制
| 属性 | 含义 |
| --- | --- |
| clone() | 克隆文本 |
| cloneTrue | 克隆文本和事件 |

### 6. 页面载入
```javascript
// 全部加载完才触发特效
$('img').load(function() {
    w = $('img').width();
    h = $('img').height();
});
$(function() {
    
})
```

### 7. 事件
```javascript
$(obj).click(function() {
    
});
$(obj).click();  // 事件方法中绝对无代码
```

#### 7.1 事件切换
##### 7.1.1 移入/移出事件
```javascript
$('img').hover(
    // 移入
    function() {
        
    },
    // 移出
    function() {
      
    }
);
```

##### 7.1.2 toggle(1.8之后删除)

#### 7.2 事件处理
| 属性 | 含义 |
| --- | --- |
| on()  | 绑定事件 |
| off() | 接触事件 |
| one() | 一次绑定 |

#### 7.3 事件委派
| 属性 | 含义 | 范例 |
| --- | --- | --- |
| on()  | 代替live(),一直活着 | $(document).on('click','h1',function(){}); |
| off() | 代替die(), 立即死去 | $(document).off('click','h1'); |
| finish() | 立刻死去 | $(this).finish() |
| delay()  | 等待 | $(this).slideUp(1000).delay(100).slideDown(100) |

### 8. 特效
#### 8.1 基本
| 属性 | 含义 |
| --- | --- |
| show() | 显示 |
| hide() | 隐藏 |

#### 8.2 滑动
| 属性 | 含义 |
| --- | --- |
| slideUp() | 向上滑动 |
| slideDown() | 向下滑动 |
| slideUp(1000).delay(100).slideDown() | 上下联动 |
| slideToggle() | 滑动切换 |

#### 8.3 淡入淡出
| 属性 | 含义 | 范例 |
| --- | --- | --- |
| fadeIn()  | 淡入 | $('.textarea').fadeIn(1000) |
| fadeOut() | 淡出 | $('.textarea').fadeOut(1000) |
| fadeTo()  | 指定透明度 | $('.textarea').fadeTo(1000,0.5) |
| fadeToggle() | 切换淡入淡出 | $('.textarea').adeToggle(1000) |

#### 8.4 animate 自定义动画
```javascript
$('.jiu').hover(
    function() {
        $(this).animate({
            'margin-left':'80px'
        },500)
    },
    function() {
        $(this).animate({
            'margin-left':'0px'
        },500)
    }
);
```

### 9. 工具
| 属性 | 含义 | 范例 |
| --- | --- | --- |
| serialize() | 表单序列化 | $('form').serialize() |
| parseJSON() | JSON字符串转对象 | parseJSON(str) |
| stringifyJSON() | JSON对象转字符串 | stringifyJSON(obj) |
| isArray() | 是否时数组 | isArray(arr) |
| isFunction() | 是否是函数 | isFunction(fun) |
| isEmptyObject() | 是否是空对象 | isEmptyObject(obj) |
| type() | 返回对象数据类型 | |
| trim() | 取消左右空格 | |
| error()| 抛出错误信息 | |

### 10. ajax无刷新
```javascript
    // GET异步通讯
    $.get('index.php',{'id':1},function() {
    
    },'json');
    // POST异步通讯
    $.post('index.php',{'id':1},function() {
    
    },'json');
    // $.ajax
    $.ajax({
        url : 'index.php',
        type: 'get' / 'post',
        data: {'id':1},
        async: false / true,
        success:function(res) {
          
        },
        error:function(e) {
          
        }
    });
```

```javascript
// 无刷新登陆
$('.loginbtn').click(function() {
    $('.logindiv').show(1000);
    $('input:button').click(function() {
        userval = $("input[name='user']").val();
        passval = $("input[name='password']").val();
        $.ajax({
            url : 'check.php',
            type: 'post',
            async:true,
            data: $('form').serialize(),
            success:function(res) {
                if(res.code == 200) {
                    $('.logindiv').hide(1000,function() {
                        location.reload();
                    });
                }   
            },
            error:function(e) {
                $('.logindiv').append(e);
            }
        })
    });
});
```