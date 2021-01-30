### 0. 经验技巧
#### layer分页
```javascript
    layui.use('laypage', function(){
        let laypage = layui.laypage;

        //执行一个laypage实例
        laypage.render({
            elem: 'page'  // domID
            ,count: 50    // 数据总数
            ,limit: 5     // 每页限数
            ,limits: [10, 20, 30, 40, 50] // 修改每页限数
            ,groups: 4    // 联系显示页数
            ,layout: [    // 分页生效组件
                'count',  // 总条目输区域              
                'prev',   // 上一页区域
                'page',   // 分页区域
                'next',   // 下一页区域
                'limit',  // 条目选项区域
                'refresh',// 页面刷新区域
                'skip'    // 快捷跳页区域
            ],jump: function(obj, first){  // 跳转属性
                //obj包含了当前分页的所有参数，比如：
                console.log(obj.curr); //得到当前页，以便向服务端请求对应页的数据。
                console.log(obj.limit); //得到每页显示的条数

                //首次不执行
                if(!first){
                    //do something
                }
            }
        });
    });
```

#### layer单选框选中取消
```javascript
    $('.submit_radio input').on('click',function () {
        let check = $(this).attr('data-check');
        if(check === "false"){
            $('.submit_radio input').each(function (i, input) {
                $(input).attr('data-check', "false");
            })
            $(this).attr('data-check', "true");
            $(this).prop('checked', true);
            layui.form.render();
        } else{
            $('.submit_radio input').each(function (i,input) {
                $(input).attr('data-check', "false");
            })
            $(this).prop('checked', false);
            layui.form.render();
        }
    })
```

#### layer提示框
```javascript
    //eg1
    layer.msg('只想弱弱提示');
    //eg2
    layer.msg('有表情地提示', {icon: 6}); 
    //eg3
    layer.msg('关闭后想做些什么', function(){
      //do something
    }); 
    //eg
    layer.msg('同上', {
      icon: 1,
      time: 2000 //2秒关闭（如果不配置，默认是3秒）
    }, function(){
      //do something
    });   

    // icon
    /*
        1 绿色对号
        2 红色叉号
        3 黄色问号
        4 灰色小锁
        5 红色哭脸
        6 绿色笑脸
        7 黄色叹号
    */
```

#### 弹出层不屏幕居中或不显示
    用layer做操作结果提示时，发现如果页面超出屏幕的高度时，弹出的提示不是屏幕居中，而是在页面高度的中间，如果一个页面的高度比较大，就看不到提示了。
    还有一种情况是Layer弹出窗口只显示遮罩层，没有显示窗口（IFrame）    

```html
    <!-- 方法一 -->
    <!DOCTYPE HTML>
    <!--
        <!DOCTYPE> 声明必须是 HTML 文档的第一行，位于 <html> 标签之前。
        <!DOCTYPE> 声明不是 HTML 标签；它是指示 web 浏览器关于页面使用哪个 HTML 版本进行编写的指令。
        在 HTML 4.01 中，<!DOCTYPE> 声明引用 DTD，因为 HTML 4.01 基于 SGML。DTD 规定了标记语言的规则，这样浏览器才能正确地呈现内容。
        HTML5 不基于 SGML，所以不需要引用 DTD。
    -->

    <style>
    /* 方法二 */
    body {
        height: 100%;
    }
    
    /* 方法三 */
    body {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }
    </style>
```