### 函数
#### getApp
    提供全局函数，可以获取到小程序实例，只在app.js中定义，且只能有一个，不能私自调用生命周期
```js
    // 页面实例化
    var app = getApp();
    app.yzm();
```

#### 事件
##### 绑定事件 bindtap
    <view id="tapTest" data-hi="WeChat" bindtap="tapName"> Click me! </view>
    
```js
// 在相应的Page定义中写上相应的事件处理函数，参数是event
Page({
    tapName: function(event) {
        console.log(event);
        /* 打印值如下
            {
                "type":"tap",
                "timeStamp":895,
                "target": {
                    "id": "tapTest",
                    "dataset":  {
                        "hi":"WeChat"
                    }
                },
                "currentTarget":  {
                    "id": "tapTest",
                    "dataset": {
                        "hi":"WeChat"
                    }
                },
                "detail": {
                    "x":53,
                    "y":14
                },
                "touches":[{
                    "identifier":0,
                    "pageX":53,
                    "pageY":14,
                    "clientX":53,
                    "clientY":14
                }],
                "changedTouches":[{
                    "identifier":0,
                    "pageX":53,
                    "pageY":14,
                    "clientX":53,
                    "clientY":14
                }]
            } 
        */
        /* 获取设置的参数
            event.target.id
            event.target.dataset.*
            event.currentTarget.id
            event.currentTarget.dataset.*
        */
    }
})
```

### 二维数组
```js
    page({
        a: [
            [{id:1},{id:11}],
            [{id:2},{id:22}],
            [{id:3},{id:33}]
        ]
    })
```
```html
    wx:for="{{ a }}"
        wx:for="{{ item }}"
            {{ item.id }}
```

### 流程控制
#### If else
```html
    <view wx:if="{{ true }}"></view>
    <view wx:elif="{{ true }}"></view>
    <view wx:else></view>
```

#### For 循环
```html
    <view wx:for="{{ arr }}" wx:key="string | *this" wx:for-index="index" wx:for-item="item">
        {{ index }} {{ item }}
    </view>
```

#### Block 无意义标签
```html
    <block wx:for="{{ arr }}">
        <view>{{ index }}</view>
        <view>{{ item }}</view>
    </block>
    <block wx:if="{{ true }}">
        <view></view>
    </block>
```

### 模板
#### 模板的使用
```html
    <template name="temp_name"></template> // 定义
    <template is="temp_name"></template>   // 引用
    <template is="temp_name" data="{{ ...data }}" /> // 数据   ...将一个对象展开 
```

#### 引用外部模板
```html
    <import src="url" />  // 动态引用
    <include src="url" /> // 静态引用
```

### 组件
#### hover(适用于view)
| 属性 | 值  | 含义 |
| --- | --- | --- |
| hover           | (bool)   |  |
| hover-class     | (string) | 点击后触发class样式(短暂) |
| hover-stay-time | (int)num | 保留num毫秒 |
| hoer-start-time | (int)num | 点击num毫秒后触发 |

#### scroll-view 滚动(要有宽高)
```html
<scroller-view>
    <swiper-item><img src="" alt=""></swiper-item>
</scroller-view>
```

| 属性 | 值  | 默认值 | 含义 |
| --- | --- | ---  | --- |
| scroll-x	            | boolean	    | false | 允许横向滚动 |
| scroll-y	            | boolean	    | false	| 允许纵向滚动 |
| upper-threshold	    | number/string	| 50	| 距顶部/左边多远时，触发 scrolltoupper 事件 |
| lower-threshold	    | number/string	| 50	| 距底部/右边多远时，触发 scrolltolower 事件 |
| scroll-top	        | number/string	|	    | 设置竖向滚动条位置 |
| scroll-left	        | number/string	|	    | 设置横向滚动条位置 |
| scroll-into-view	    | string		|    	| 值应为某子元素id（id不能以数字开头）。设置哪个方向可滚动，则在哪个方向滚动到该元素 |
| scroll-with-animation	| boolean	    | false	| 在设置滚动条位置时使用动画过渡 |
| enable-back-to-top	| boolean	    | false	| iOS点击顶部状态栏、安卓双击标题栏时，滚动条返回顶部，只支持竖向 |
| enable-flex	        | boolean	    | false	| 启用 flexbox 布局。开启后，当前节点声明了 display: flex 就会成为 flex container，并作用于其孩子节点 |
| scroll-anchoring      | boolean	    | false	| 开启 scroll anchoring 特性，即控制滚动位置不随内容变化而抖动，仅在 iOS 下生效，安卓下可参考 CSS overflow-anchor 属性 |
| refresher-enabled	    | boolean	    | false	| 开启自定义下拉刷新 |
| refresher-threshold	| number	    | 45	| 设置自定义下拉刷新阈值 |
| refresher-default-style |	string	    | black | 设置自定义下拉刷新默认样式，支持设置 black white none， none 表示不使用默认样式 |
| refresher-background	| string	    | #FFF  | 设置自定义下拉刷新区域背景颜色 |
| refresher-triggered	| boolean	    | false | 设置当前下拉刷新状态，true 表示下拉刷新已经被触发，false 表示下拉刷新未被触发 |
| bindscrolltoupper	    | eventhandle	|		| 滚动到顶部/左边时触发 |
| bindscrolltolower	    | eventhandle	|		| 滚动到底部/右边时触发 |
| bindscroll	        | eventhandle	|		| 滚动时触发，event.detail = {scrollLeft, scrollTop, scrollHeight, scrollWidth, deltaX, deltaY} |
| bindrefresherpulling	| eventhandle	|		| 自定义下拉刷新控件被下拉 |
| bindrefresherrefresh	| eventhandle   |	    | 自定义下拉刷新被触发 |
| bindrefresherrestore	| eventhandle	|		| 自定义下拉刷新被复位 |
| bindrefresherabort	| eventhandle	|		| 自定义下拉刷新被中止 |

#### Icon 微信小图标
```html
    <icon type="" size="" color=""></icon>
```
| 值  | 含义 |
| --- | --- |
| success           | 成功,    绿底白字    |
| success_no_circle | 已选择,   白底绿字   |
| info              | 提示,    蓝底白字    |
| warn              | 强烈警告, 红底白字    |
| waiting           | 等待,    蓝底白字    |
| cancel            | 错误,    红边白底红字 |
| download          | 下载,    绿底白字    |
| search            | 搜索,    白底灰字    |
| clear             | 清除,    灰底白字    |

#### Text 文本
```html
    <text></text>   <!-- 类似P标签 -->
```
| 属性 | 值  | 默认值 | 含义 |
| --- | --- | ---  | --- |
| selectable | bool   | false | 文本是否可选 |
| space      | string |		  |	显示连续空格 |
| decode	 | bool   |	false |	是否解码    |

#### Progress 进度条
```html
    <progress></progress>
```
| 属性 | 值  | 默认值 | 含义 |
| --- | --- | ---  | --- |
| percent	    | number		|         | 百分比0~100 |
| show-info	    | boolean	    | false	  | 在进度条右侧显示百分比 |
| border-radius	| number/string	| 0		  | 圆角大小 |
| font-size	    | number/string	| 16	  | 右侧百分比字体大小 |
| stroke-width	| number/string	| 6		  | 进度条线的宽度 |
| color	        | string	    | #09BB07 |	进度条颜色(请使用activeColor) |
| activeColor	| string	    | #09BB07 | 已选择的进度条的颜色 |
| backgroundColor |	string	    | #EBEBEB | 未选择的进度条的颜色 |
| active	    |  boolean	    | false	  | 进度条从左往右的动画 |
| active-mode	| string	    | backwards	| backwards: 动画从头播; forwards: 动画从上次结束点接着播 |
| duration	    | number	    | 30	  |	进度增加1%所需毫秒数 |
| bindactiveend	| eventhandle	| 	      |	动画完成事件 |

#### Button 组件
| 属性 | 值  | 默认值 | 含义 |
| --- | --- | ---  | --- |
| size	                 | string	   | default		| 按钮的大小 |
|                        |             | mini	        | 小尺寸 |
| type	                 | string	   | default		| 按钮的样式类型 |
|                        |             | primary 	    | 绿色 |
|                        |             | default	    | 白色 |
|                        |             | warn	        | 红色 |
| plain	                 | boolean	   | false		    | 按钮是否镂空,背景色透明 |
| disabled	             | boolean	   | false		    | 是否禁用 |
| loading	             | boolean	   | false		    | 名称前是否带 loading 图标 |
| form-type	             | string	   |		        | 用于 form 组件,点击分别会触发 form 组件的 submit/reset 事件 |
|                        |             | submit	        | 提交表单 |
|                        |             | reset	        | 重置表单 |
| open-type	             | string	   |	            | 微信开放能力 |
|                        |             | contact	    | 打开客服会话,如果用户在会话中点击消息卡片后返回小程序,可以从 bindcontact 回调中获得具体信息,具体说明 |
|                        |             | share	        | 触发用户转发,使用前建议先阅读使用指引 |
|                        |             | getPhoneNumber | 获取用户手机号,可以从bindgetphonenumber回调中获取到用户信息,具体说明 |
|                        |             | getUserInfo	| 获取用户信息,可以从bindgetuserinfo回调中获取到用户信息 |
|                        |             | launchApp	    | 打开APP，可以通过app-parameter属性设定向APP传的参数具体说明 |
|                        |             | openSetting	| 打开授权设置页 |
|                        |             | feedback	    | 打开“意见反馈”页面，用户可提交反馈内容并上传日志,开发者可以登录小程序管理后台后进入左侧菜单“客服反馈”页面获取到反馈内容 |
| hover-class	         | string	   | button-hover   | 指定按钮按下去的样式类。当 hover-class="none" 时,没有点击态效果 |
| hover-stop-propagation | boolean	   | false		    | 指定是否阻止本节点的祖先节点出现点击态 |
| hover-start-time	     | number	   | 20		        | 按住后多久出现点击态，单位毫秒 |
| hover-stay-time	     | number	   | 70		        | 手指松开后点击态保留时间，单位毫秒 |
| lang	                 | string	   | en		        | 指定返回用户信息的语言，en 英文 |
|                        |             | zh_CN          | 简体中文 |
|                        |             | zh_TW          | 繁体中文 |
| session-from	         | string	   | 		        | 会话来源，open-type="contact"时有效 |
| send-message-title	 | string	   | 当前标题		    | 会话内消息卡片标题，open-type="contact"时有效 |
| send-message-path	     | string	   | 当前分享路径	    | 会话内消息卡片点击跳转小程序路径，open-type="contact"时有效 |
| send-message-img	     | string	   | 截图		    | 会话内消息卡片图片，open-type="contact"时有效 |
| app-parameter	         | string	   |		        | 打开 APP 时，向 APP 传递的参数，open-type=launchApp时有效 |
| show-message-card	     | boolean	   | false		    | 是否显示会话内消息卡片，设置此参数为 true，用户进入客服会话会在右下角显示"可能要发送的小程序"提示，用户点击后可以快速发送小程序消息，open-type="contact"时有效 |
| bindgetuserinfo	     | eventhandle |			    | 用户点击该按钮时，会返回获取到的用户信息，回调的detail数据与wx.getUserInfo返回的一致，open-type="getUserInfo"时有效 |
| bindcontact	         | eventhandle |			    | 客服消息回调，open-type="contact"时有效 |
| bindgetphonenumber	 | eventhandle |			    | 获取用户手机号回调，open-type=getPhoneNumber时有效 |
| binderror	             | eventhandle |			    | 当使用开放能力时，发生错误的回调，open-type=launchApp时有效 |
| bindopensetting	     | eventhandle |			    | 在打开授权设置页后回调，open-type=openSetting时有效 |
| bindlaunchapp	         | eventhandle | 		        | 打开 APP 成功的回调，open-type=launchApp时有效 |

#### Form 表单组件
```html
<form action="">
    <input type="text">
    <checkbox-group>
        <checkbox></checkbox>
    </checkbox-group>
    <radio-group>
        <radio></radio>
    </radio-group>
    <picker></picker>
    <slider></slider>
    <switch></switch>
    <textarea name="" id="" cols="30" rows="10"></textarea>
</form>
```
| 属性 | 值  | 默认值 | 含义 |
| --- | --- | ---  | --- |
| report-submit	        | boolean	      | false | 是否返回 formId 用于发送模板消息	1.0.0 |
| report-submit-timeout	| number	      | 0	  | 等待一段时间（毫秒数）以确认 formId 是否生效。如果未指定这个参数，formId 有很小的概率是无效的（如遇到网络失败的情况）。指定这个参数将可以检测 formId 是否有效，以这个参数的时间作为这项检测的超时时间。如果失败，将返回 requestFormId:fail 开头的 formId |
| bindsubmit	        | eventhandle	  | 	  | 携带 form 中的数据触发 submit 事件，event.detail = {value : {'name': 'value'} , formId: ''} |
| bindreset	            | eventhandle	  |	      | 表单重置时会触发 reset 事件	1.0.0 |
| e.detail.value        | 获取 input 中的值 |       | |

##### Input 输入框组件
```html
    <input type="text">
```
| 属性 | 值  | 含义 |
| --- | --- | --- |
| name              |
| type              | text   | 文本输入建 |
|                   | number | 数字输入键 |
|                   | digit  | 带小数点输入键 |
|                   | idcard | 身份证输入键 |
| password          | true   | 开启密码输入框 |
| placeholder       |        | 背景提示词 |
| placeholder-style |        | 背景提示词颜色 |
| maxlength         |        | 最大输入长度 |
| cursor-spacing    |        | 指定光标与键盘的距离 |
| focus             | true   | 自动聚焦 |
| confirm-type      |        | 键盘右下角按钮文字 |
|                   | send   | 右小角-发送 |
|                   | search | 右下角-搜素 |
|                   | next   | 右下角-下一个 |
|                   | go     | 右下角-前往 |
|                   | done   | 右下角-完成 |
| confirm-hold      | true   | 点击键盘右下角按钮时,收起键盘 |
| bindfocus         |        | 输入框聚焦时触发 |
| bindblur          |        | 输入框失焦时触发 |
| bindconfirm       |        | 点击完成按钮时触发 |
| bindinput         |        | 当输入时，触发input事件,处理函数可直接return一个字符串替换输入框内容 |

##### Checkbox 复选框组件
```html
<checkbox-group bindchange="EventHandle"> 
    <checkbox></checkbox>
</checkbox-group>
<!-- checkbox-group中选中项发生改变时触发 change 事件，detail = {value:[选中的checkbox的value的数组]} -->
```
| 属性 | 值  | 默认值 | 含义 |
| --- | --- | ---  | --- |
| value	   | string  |		   | checkbox标识,选中时触发checkbox-group的 change 事件,并携带 checkbox 的 value |
| disabled | boolean | false   | 是否禁用 |
| checked  | boolean | false   | 当前是否选中,可用来设置默认选中 |
| color	   | string	 | #09BB07 | checkbox的颜色,同css的color |

##### Radio 单选框组件
```html
<radio-group bindchange="EventHandle">
    <radio></radio>
</radio-group>
<!-- radio-group中选中项发生改变时触发 change 事件，detail = {value:[选中的radio的value的数组]} -->
```
| 属性 | 值  | 默认值 | 含义 |
| --- | --- | ---  | --- |
| value	   | string	 |	       | radio 标识。当该radio 选中时，radio-group 的 change 事件会携带radio的value |
| checked  | boolean | false   | 当前是否选中 |
| disabled | boolean | false   | 是否禁用 |
| color	   | string	 | #09BB07 | radio的颜色，同css的color |

##### Picker 滚动选择器组件
```html
<picker></picker>
```
| 属性 | 值  | 默认值 | 含义 |
| --- | --- | ---  | --- |
| header-text |	string		|               | 选择器的标题，仅安卓可用 |
| mode	      | string	    | selector      | 选择器类型,普通选择器 |
|             |             | multiSelector | 多列选择器 |
|             |             | time	        | 时间选择器 |
|             |             | date	        | 日期选择器 |
|             |             | region	    | 省市区选择器 |
| disabled	  | boolean	    | false		    | 是否禁用 |
| bindcancel  |	eventhandle |			    | 取消选择时触发 |

###### 普通选择器 mode = selector
| 属性 | 值  | 默认值 | 含义 |
| --- | --- | ---  | --- |
| range      | array/object | array	[] | mode 为 selector 或 multiSelector 时，range 有效 |
| range-key  | string		|          | 当 range 是一个 Object Array 时，通过 range-key 来指定 Object 中 key 的值作为选择器显示内容 |
| value	     | number	    | 0	       | 表示选择了 range 中的第几个（下标从 0 开始） |
| bindchange | eventhandle	|	       | value改变时触发 change 事件，event.detail = {value} |

###### 多列选择器 mode = multiSelector
| 属性 | 值  | 默认值 | 含义 |
| --- | --- | ---  | --- |
| range	           | array/object | array [] | mode 为 selector 或 multiSelector 时，range 有效 |
| range-key	       | string		  |          | 当 range 是一个 Object Array 时，通过 range-key 来指定 Object 中 key 的值作为选择器显示内容 |
| value	           | array	      | []	     | 表示选择了 range 中的第几个（下标从 0 开始）|
| bindchange	   | eventhandle  |		     | value 改变时触发 change 事件，event.detail = {value} |
| bindcolumnchange | eventhandle  |		     | 列改变时触发 |

###### 时间选择器 mode = time
| 属性 | 值  | 含义 |
| --- | --- | --- |
| value	     | string	   | 表示选中的时间，格式为"hh:mm" |
| start	     | string	   | 表示有效时间范围的开始，字符串格式为"hh:mm" |
| end	     | string	   | 表示有效时间范围的结束，字符串格式为"hh:mm" |
| bindchange | eventhandle | value 改变时触发 change 事件，event.detail = {value} |

###### 日期选择器 mode = date
| 属性 | 值  | 含义 |
| --- | --- | --- |
| value	     | string	   | 当天表示选中的日期，格式为"YYYY-MM-DD" |
| start	     | string	   | 表示有效日期范围的开始，字符串格式为"YYYY-MM-DD" |
| end	     | string	   | 表示有效日期范围的结束，字符串格式为"YYYY-MM-DD" |
| fields	 | string	   | day	有效值 year,month,day，表示选择器的粒度 |
| bindchange | eventhandle | value 改变时触发 change 事件，event.detail = {value} |

###### 省市区选择器 mode = region
| 属性 | 值  | 默认值 | 含义 |
| --- | --- | ---  | --- |
| value	      | array	    | [] | 表示选中的省市区，默认选中每一列的第一个值 |
| custom-item |	string		|    | 可为每一列的顶部添加一个自定义的项 |
| bindchange  | eventhandle |	 | value 改变时触发 change 事件，event.detail = {value, code, postcode}，其中字段 code 是统计用区划代码，postcode 是邮政编码 |

##### Slider 滑动选择器组件
```html
<slider></slider>
```
| 属性 | 值  | 默认值 | 含义 |
| --- | --- | ---  | --- |
| min	          | number	    | 0		  | 最小值 |
| max	          | number	    | 100	  |	最大值 |
| step	          | number	    | 1		  | 步长，取值必须大于 0，并且可被(max - min)整除 |
| disabled	      | boolean	    | false	  | 是否禁用 |
| value	          | number	    | 0		  | 当前取值 |
| color	          | color	    | #e9e9e9 |	背景条的颜色（请使用 backgroundColor）|
| selected-color  |	color	    | #1aad19 |	已选择的颜色（请使用 activeColor） |
| activeColor	  | color	    | #1aad19 |	已选择的颜色 |
| backgroundColor |	color	    | #e9e9e9 |	背景条的颜色 |
| block-size	  | number	    | 28	  | 滑块的大小，取值范围为 12 - 28 |
| block-color	  | color	    | #ffffff |	滑块的颜色 |
| show-value	  | boolean	    | false	  | 是否显示当前 value |
| bindchange	  | eventhandle |		  |	完成一次拖动后触发的事件，event.detail = {value} |
| bindchanging	  | eventhandle |		  |	拖动过程中触发的事件，event.detail = {value} |

##### Switch 开关选择器组件
```html
<swith></swith>
```
| 属性 | 值  | 默认值 | 含义 |
| --- | --- | ---  | --- |
| checked	 | boolean	   | false	 | 是否选中 |
| disabled	 | boolean	   | false	 | 是否禁用 |
| type	     | string	   | switch	 | 样式，有效值: switch, checkbox |
| color	     | string	   | #04BE02 | switch 的颜色,同css的color     |
| bindchange | eventhandle |		 | checked 改变时触发 change 事件，event.detail={ value} |

##### Textarea 文本域组件
```html
    <textarea name="" id="" cols="30" rows="10"></textarea>
```
| 属性 | 值  | 默认值 | 含义 |
| --- | --- | ---  | --- |
| value	            | string  |		        | 输入框的内容 |
| placeholder	    | string  |			    | 输入框为空时占位符 |
| placeholder-style	| string  |			    | 指定 placeholder 的样式，目前仅支持color,font-size和font-weight |
| placeholder-class	| string  |	textarea-placeholder | 指定 placeholder 的样式类 |
| disabled	        | boolean |	false		| 是否禁用 |
| maxlength	        | number  |	140		    | 最大输入长度，设置为 -1 的时候不限制最大长度 |
| auto-focus	    | boolean |	false		| 自动聚焦，拉起键盘 |
| focus	            | boolean |	false		| 获取焦点 |
| auto-height     	| boolean |	false		| 是否自动增高，设置auto-height时，style.height不生效 |
| fixed	            | boolean |	false		| 如果 textarea 是在一个 position:fixed 的区域，需要显示指定属性 fixed 为 true |
| cursor-spacing	| number  |	0		    | 指定光标与键盘的距离。取textarea距离底部的距离和cursor-spacing指定的距离的最小值作为光标与键盘的距离 |
| cursor	        | number  |	-1		    | 指定focus时的光标位置 |
| show-confirm-bar  | boolean |	true		| 是否显示键盘上方带有”完成“按钮那一栏 |
| selection-start	| number  |	-1		    | 光标起始位置，自动聚集时有效，需与selection-end搭配使用 |
| selection-end	    | number  |	-1		    | 光标结束位置，自动聚集时有效，需与selection-start搭配使用 |
| adjust-position	| boolean | true		| 键盘弹起时，是否自动上推页面 |
| hold-keyboard	    | boolean | false 		| focus时，点击页面的时候不收起键盘 |
| disable-default-padding |	boolean | false|是否去掉 iOS 下的默认内边距 |
| bindfocus	        | eventhandle		 |  | 输入框聚焦时触发，event.detail = { value, height }，height 为键盘高度 |
| bindblur	        | eventhandle		 |  | 输入框失去焦点时触发，event.detail = {value, cursor} |
| bindlinechange	| eventhandle		 |  | 输入框行数变化时调用，event.detail = {height: 0, heightRpx: 0, lineCount: 0} |
| bindinput	        | eventhandle		 |  | 当键盘输入时，触发 input 事件，event.detail = {value, cursor, keyCode}，keyCode 为键值，目前工具还不支持返回keyCode参数。bindinput 处理函数的返回值并不会反映到 textarea 上 |
| bindconfirm	    | eventhandle		 |  | 点击完成时， 触发 confirm 事件，event.detail = {value: value} |
| bindkeyboardheightchange | eventhandle |  | 键盘高度发生变化的时候触发此事件，event.detail = {height: height, duration: duration} |

### Navigator 导航
```html
<navigator></navigator>
```
| 属性 | 值  | 默认值 | 含义 |
| --- | --- | ---  | --- |
| target	   | string | self		  | 在哪个目标上发生跳转，默认当前小程序 |
|              |        | miniProgram | 其它小程序 |
| url	       | string |		      | 当前小程序内的跳转链接 |
| open-type	   | string	|        	  | 跳转方式 |
|              |        | navigate	  | 保留当前页面跳转，使用wx.navigateBack返回  对应wx.navigateTo 或 wx.navigateToMiniProgram 的功能 |
|              |        | redirect	  | 关闭当前页面跳转  对应wx.redirectTo 的功能 |
|              |        | switchTab	  | 跳转至tabBar页面,并关闭其他非tabBar页面  对应 wx.switchTab 的功能 |
|              |        | reLaunch    |	关闭所有页面,并打开某个页面  对应 wx.reLaunch 的功能 |
|              |        | navigateBack| 返回上一个页面  对应 wx.navigateBack 的功能 |
|              |        | exit        |	退出小程序，target="miniProgram"时生效 |
| delta	       | number	| 1	    	  | 当 open-type 为 'navigateBack' 时有效，表示回退的层数 |
| app-id	   | string	|	          |	当target="miniProgram"时有效，要打开的小程序 appId |
| path	       | string |		      | 当target="miniProgram"时有效，打开的页面路径，如果为空则打开首页 |
| extra-data   | object	|	          |	当target="miniProgram"时有效，需要传递给目标小程序的数据，目标小程序可在 App.onLaunch()，App.onShow() 中获取到这份数据 |
| version	   | string | release     | 当target="miniProgram"时有效，要打开的小程序版本 |
|              |        | develop     |	开发版 |
|              |        | trial       |	体验版 |
|              |        | release     |	正式版，仅在当前小程序为开发版或体验版时此参数有效；如果当前小程序是正式版，则打开的小程序必定是正式版 |
| hover-class  | string | navigator-hover  | 指定点击时的样式类，当hover-class="none"时，没有点击态效果 |
| hover-stop-propagation | boolean | false | 指定是否阻止本节点的祖先节点出现点击态 |
| hover-start-time | number	| 50      |	按住后多久出现点击态，单位毫秒 |
| hover-stay-time  | number | 600     |	手指松开后点击态保留时间，单位毫秒 |
| bindsuccess  | string |		      |	当target="miniProgram"时有效，跳转小程序成功 |
| bindfail	   | string |		      |	当target="miniProgram"时有效，跳转小程序失败 |
| bindcomplete | string |		      |	当target="miniProgram"时有效，跳转小程序完成 |

### 小程序错误码
#### errcode
```tetx
    '-1'    => '{"errMsg":"system error","errDesc":"系统繁忙，此时请开发者稍候再试"}',
    '40009' => '{"errMsg":"Invalid image size","errDesc":"图片大小为0或者超过1M"}',
    '40097' => '{"errMsg":"invalid args","errDesc":"参数不正确，请参考字段要求检查json 字段"}',
    '65104' => '{"errMsg":"invalid category","errDesc":"门店的类型不合法，必须严格按照附表的分类填写"}',
    '65105' => '{"errMsg":"invalid photo url","errDesc":"图片url 不合法，必须使用接口1 的图片上传接口所获取的url"}',
    '65106' => '{"errMsg":"poi audit state must be approved","errDesc":"门店状态必须未审核通过"}',
    '65107' => '{"errMsg":"not allow modify","errDesc":"扩展字段为不允许修改的状态"}',
    '65109' => '{"errMsg":"invalid business","errDesc":"门店名为空"}',
    '65110' => '{"errMsg":"invalid address","errDesc":"门店所在详细街道地址为空"}',
    '65111' => '{"errMsg":"invalid telephone","errDesc":"门店的电话为空"}',
    '65112' => '{"errMsg":"invalid city","errDesc":"门店所在的城市为空"}',
    '65113' => '{"errMsg":"invalid province","errDesc":"门店所在的省份为空"}',
    '65114' => '{"errMsg":"empty photo list","errDesc":"图片列表为空"}',
    '65115' => '{"errMsg":"invalid poi id","errDesc":"poi_id 不正确"}',
    '0'     => '{"errMsg":"","errDesc":"请求成功"}',
    '40001' => '{"errMsg":"","errDesc":"获取 access_token 时 AppSecret 错误，或者 access_token 无效。请开发者认真比对 AppSecret 的正确性，或查看是否正在为恰当的公众号调用接口"}',
    '40002' => '{"errMsg":"","errDesc":"不合法的凭证类型"}',
    '40003' => '{"errMsg":"","errDesc":"不合法的 OpenID ，请开发者确认 OpenID （该用户）是否已关注公众号，或是否是其他公众号的 OpenID"}',
    '40004' => '{"errMsg":"","errDesc":"不合法的媒体文件类型"}',
    '40005' => '{"errMsg":"","errDesc":"不合法的文件类型"}',
    '40006' => '{"errMsg":"","errDesc":"不合法的文件大小"}',
    '40007' => '{"errMsg":"","errDesc":"不合法的媒体文件 id"}',
    '40008' => '{"errMsg":"","errDesc":"不合法的消息类型"}',
    '40010' => '{"errMsg":"","errDesc":"不合法的语音文件大小"}',
    '40011' => '{"errMsg":"","errDesc":"不合法的视频文件大小"}',
    '40012' => '{"errMsg":"","errDesc":"不合法的缩略图文件大小"}',
    '40013' => '{"errMsg":"","errDesc":"不合法的 AppID ，请开发者检查 AppID 的正确性，避免异常字符，注意大小写"}',
    '40014' => '{"errMsg":"","errDesc":"不合法的 access_token ，请开发者认真比对 access_token 的有效性（如是否过期），或查看是否正在为恰当的公众号调用接口"}',
    '40015' => '{"errMsg":"","errDesc":"不合法的菜单类型"}',
    '40016' => '{"errMsg":"","errDesc":"不合法的按钮个数"}',
    '40017' => '{"errMsg":"","errDesc":"不合法的按钮个数"}',
    '40018' => '{"errMsg":"","errDesc":"不合法的按钮名字长度"}',
    '40019' => '{"errMsg":"","errDesc":"不合法的按钮 KEY 长度"}',
    '40020' => '{"errMsg":"","errDesc":"不合法的按钮 URL 长度"}',
    '40021' => '{"errMsg":"","errDesc":"不合法的菜单版本号"}',
    '40022' => '{"errMsg":"","errDesc":"不合法的子菜单级数"}',
    '40023' => '{"errMsg":"","errDesc":"不合法的子菜单按钮个数"}',
    '40024' => '{"errMsg":"","errDesc":"不合法的子菜单按钮类型"}',
    '40025' => '{"errMsg":"","errDesc":"不合法的子菜单按钮名字长度"}',
    '40026' => '{"errMsg":"","errDesc":"不合法的子菜单按钮 KEY 长度"}',
    '40027' => '{"errMsg":"","errDesc":"不合法的子菜单按钮 URL 长度"}',
    '40028' => '{"errMsg":"","errDesc":"不合法的自定义菜单使用用户"}',
    '40029' => '{"errMsg":"","errDesc":"不合法的 oauth_code"}',
    '40030' => '{"errMsg":"","errDesc":"不合法的 refresh_token"}',
    '40031' => '{"errMsg":"","errDesc":"不合法的 openid 列表"}',
    '40032' => '{"errMsg":"","errDesc":"不合法的 openid 列表长度"}',
    '40033' => '{"errMsg":"","errDesc":"不合法的请求字符，不能包含 \uxxxx 格式的字符"}',
    '40035' => '{"errMsg":"","errDesc":"不合法的参数"}',
    '40038' => '{"errMsg":"","errDesc":"不合法的请求格式"}',
    '40039' => '{"errMsg":"","errDesc":"不合法的 URL 长度"}',
    '40050' => '{"errMsg":"","errDesc":"不合法的分组 id"}',
    '40051' => '{"errMsg":"","errDesc":"分组名字不合法"}',
    '40060' => '{"errMsg":"","errDesc":"删除单篇图文时，指定的 article_idx 不合法"}',
    '40117' => '{"errMsg":"","errDesc":"分组名字不合法"}',
    '40118' => '{"errMsg":"","errDesc":"media_id 大小不合法"}',
    '40119' => '{"errMsg":"","errDesc":"button 类型错误"}',
    '40120' => '{"errMsg":"","errDesc":"button 类型错误"}',
    '40121' => '{"errMsg":"","errDesc":"不合法的 media_id 类型"}',
    '40132' => '{"errMsg":"","errDesc":"微信号不合法"}',
    '40137' => '{"errMsg":"","errDesc":"不支持的图片格式"}',
    '40155' => '{"errMsg":"","errDesc":"请勿添加其他公众号的主页链接"}',
    '41001' => '{"errMsg":"","errDesc":"缺少 access_token 参数"}',
    '41002' => '{"errMsg":"","errDesc":"缺少 appid 参数"}',
    '41003' => '{"errMsg":"","errDesc":"缺少 refresh_token 参数"}',
    '41004' => '{"errMsg":"","errDesc":"缺少 secret 参数"}',
    '41005' => '{"errMsg":"","errDesc":"缺少多媒体文件数据"}',
    '41006' => '{"errMsg":"","errDesc":"缺少 media_id 参数"}',
    '41007' => '{"errMsg":"","errDesc":"缺少子菜单数据"}',
    '41008' => '{"errMsg":"","errDesc":"缺少 oauth code"}',
    '41009' => '{"errMsg":"","errDesc":"缺少 openid"}',
    '42001' => '{"errMsg":"","errDesc":"access_token 超时，请检查 access_token 的有效期，请参考基础支持 - 获取 access_token 中，对 access_token 的详细机制说明"}',
    '42002' => '{"errMsg":"","errDesc":"refresh_token 超时"}',
    '42003' => '{"errMsg":"","errDesc":"oauth_code 超时"}',
    '42007' => '{"errMsg":"","errDesc":"用户修改微信密码， accesstoken 和 refreshtoken 失效，需要重新授权"}',
    '43001' => '{"errMsg":"","errDesc":"需要 GET 请求"}',
    '43002' => '{"errMsg":"","errDesc":"需要 POST 请求"}',
    '43003' => '{"errMsg":"","errDesc":"需要 HTTPS 请求"}',
    '43004' => '{"errMsg":"","errDesc":"需要接收者关注"}',
    '43005' => '{"errMsg":"","errDesc":"需要好友关系"}',
    '43019' => '{"errMsg":"","errDesc":"需要将接收者从黑名单中移除"}',
    '44001' => '{"errMsg":"","errDesc":"多媒体文件为空"}',
    '44002' => '{"errMsg":"","errDesc":"POST 的数据包为空"}',
    '44003' => '{"errMsg":"","errDesc":"图文消息内容为空"}',
    '44004' => '{"errMsg":"","errDesc":"文本消息内容为空"}',
    '45001' => '{"errMsg":"","errDesc":"多媒体文件大小超过限制"}',
    '45002' => '{"errMsg":"","errDesc":"消息内容超过限制"}',
    '45003' => '{"errMsg":"","errDesc":"标题字段超过限制"}',
    '45004' => '{"errMsg":"","errDesc":"描述字段超过限制"}',
    '45005' => '{"errMsg":"","errDesc":"链接字段超过限制"}',
    '45006' => '{"errMsg":"","errDesc":"图片链接字段超过限制"}',
    '45007' => '{"errMsg":"","errDesc":"语音播放时间超过限制"}',
    '45008' => '{"errMsg":"","errDesc":"图文消息超过限制"}',
    '45009' => '{"errMsg":"","errDesc":"接口调用超过限制"}',
    '45010' => '{"errMsg":"","errDesc":"创建菜单个数超过限制"}',
    '45011' => '{"errMsg":"","errDesc":"API 调用太频繁，请稍候再试"}',
    '45015' => '{"errMsg":"","errDesc":"回复时间超过限制"}',
    '45016' => '{"errMsg":"","errDesc":"系统分组，不允许修改"}',
    '45017' => '{"errMsg":"","errDesc":"分组名字过长"}',
    '45018' => '{"errMsg":"","errDesc":"分组数量超过上限"}',
    '45047' => '{"errMsg":"","errDesc":"客服接口下行条数超过上限"}',
    '46001' => '{"errMsg":"","errDesc":"不存在媒体数据"}',
    '46002' => '{"errMsg":"","errDesc":"不存在的菜单版本"}',
    '46003' => '{"errMsg":"","errDesc":"不存在的菜单数据"}',
    '46004' => '{"errMsg":"","errDesc":"不存在的用户"}',
    '47001' => '{"errMsg":"","errDesc":"解析 JSON/XML 内容错误"}',
    '48001' => '{"errMsg":"","errDesc":"api 功能未授权，请确认公众号已获得该接口，可以在公众平台官网 - 开发者中心页中查看接口权限"}',
    '48002' => '{"errMsg":"","errDesc":"粉丝拒收消息（粉丝在公众号选项中，关闭了 “ 接收消息 ” ）"}',
    '48004' => '{"errMsg":"","errDesc":"api 接口被封禁，请登录 mp.weixin.qq.com 查看详情"}',
    '48005' => '{"errMsg":"","errDesc":"api 禁止删除被自动回复和自定义菜单引用的素材"}',
    '48006' => '{"errMsg":"","errDesc":"api 禁止清零调用次数，因为清零次数达到上限"}',
    '48008' => '{"errMsg":"","errDesc":"没有该类型消息的发送权限"}',
    '50001' => '{"errMsg":"","errDesc":"用户未授权该 api"}',
    '50002' => '{"errMsg":"","errDesc":"用户受限，可能是违规后接口被封禁"}',
    '50005' => '{"errMsg":"","errDesc":"用户未关注公众号"}',
    '61451' => '{"errMsg":"","errDesc":"参数错误 (invalid parameter)"}',
    '61452' => '{"errMsg":"","errDesc":"无效客服账号 (invalid kf_account)"}',
    '61453' => '{"errMsg":"","errDesc":"客服帐号已存在 (kf_account exsited)"}',
    '61454' => '{"errMsg":"","errDesc":"客服帐号名长度超过限制 ( 仅允许 10 个英文字符，不包括 @ 及 @ 后的公众号的微信号 )(invalid kf_acount length)"}',
    '61455' => '{"errMsg":"","errDesc":"客服帐号名包含非法字符 ( 仅允许英文 + 数字 )(illegal character in kf_account)"}',
    '61456' => '{"errMsg":"","errDesc":"客服帐号个数超过限制 (10 个客服账号 )(kf_account count exceeded)"}',
    '61457' => '{"errMsg":"","errDesc":"无效头像文件类型 (invalid file type)"}',
    '61450' => '{"errMsg":"","errDesc":"系统错误 (system error)"}',
    '61500' => '{"errMsg":"","errDesc":"日期格式错误"}',
    '65301' => '{"errMsg":"","errDesc":"不存在此 menuid 对应的个性化菜单"}',
    '65302' => '{"errMsg":"","errDesc":"没有相应的用户"}',
    '65303' => '{"errMsg":"","errDesc":"没有默认菜单，不能创建个性化菜单"}',
    '65304' => '{"errMsg":"","errDesc":"MatchRule 信息为空"}',
    '65305' => '{"errMsg":"","errDesc":"个性化菜单数量受限"}',
    '65306' => '{"errMsg":"","errDesc":"不支持个性化菜单的帐号"}',
    '65307' => '{"errMsg":"","errDesc":"个性化菜单信息为空"}',
    '65308' => '{"errMsg":"","errDesc":"包含没有响应类型的 button"}',
    '65309' => '{"errMsg":"","errDesc":"个性化菜单开关处于关闭状态"}',
    '65310' => '{"errMsg":"","errDesc":"填写了省份或城市信息，国家信息不能为空"}',
    '65311' => '{"errMsg":"","errDesc":"填写了城市信息，省份信息不能为空"}',
    '65312' => '{"errMsg":"","errDesc":"不合法的国家信息"}',
    '65313' => '{"errMsg":"","errDesc":"不合法的省份信息"}',
    '65314' => '{"errMsg":"","errDesc":"不合法的城市信息"}',
    '65316' => '{"errMsg":"","errDesc":"该公众号的菜单设置了过多的域名外跳（最多跳转到 3 个域名的链接）"}',
    '65317' => '{"errMsg":"","errDesc":"不合法的 URL"}',
    '9001001' => '{"errMsg":"","errDesc":"POST 数据参数不合法"}',
    '9001002' => '{"errMsg":"","errDesc":"远端服务不可用"}',
    '9001003' => '{"errMsg":"","errDesc":"Ticket 不合法"}',
    '9001004' => '{"errMsg":"","errDesc":"获取摇周边用户信息失败"}',
    '9001005' => '{"errMsg":"","errDesc":"获取商户信息失败"}',
    '9001006' => '{"errMsg":"","errDesc":"获取 OpenID 失败"}',
    '9001007' => '{"errMsg":"","errDesc":"上传文件缺失"}',
    '9001008' => '{"errMsg":"","errDesc":"上传素材的文件类型不合法"}',
    '9001009' => '{"errMsg":"","errDesc":"上传素材的文件尺寸不合法"}',
    '9001010' => '{"errMsg":"","errDesc":"上传失败"}',
    '9001020' => '{"errMsg":"","errDesc":"帐号不合法"}',
    '9001021' => '{"errMsg":"","errDesc":"已有设备激活率低于 50% ，不能新增设备"}',
    '9001022' => '{"errMsg":"","errDesc":"设备申请数不合法，必须为大于 0 的数字"}',
    '9001023' => '{"errMsg":"","errDesc":"已存在审核中的设备 ID 申请"}',
    '9001024' => '{"errMsg":"","errDesc":"一次查询设备 ID 数量不能超过 50"}',
    '9001025' => '{"errMsg":"","errDesc":"设备 ID 不合法"}',
    '9001026' => '{"errMsg":"","errDesc":"页面 ID 不合法"}',
    '9001027' => '{"errMsg":"","errDesc":"页面参数不合法"}',
    '9001028' => '{"errMsg":"","errDesc":"一次删除页面 ID 数量不能超过 10"}',
    '9001029' => '{"errMsg":"","errDesc":"页面已应用在设备中，请先解除应用关系再删除"}',
    '9001030' => '{"errMsg":"","errDesc":"一次查询页面 ID 数量不能超过 50"}',
    '9001031' => '{"errMsg":"","errDesc":"时间区间不合法"}',
    '9001032' => '{"errMsg":"","errDesc":"保存设备与页面的绑定关系参数错误"}',
    '9001033' => '{"errMsg":"","errDesc":"门店 ID 不合法"}',
    '9001034' => '{"errMsg":"","errDesc":"设备备注信息过长"}',
    '9001035' => '{"errMsg":"","errDesc":"设备申请参数不合法"}',
    '9001036' => '{"errMsg":"","errDesc":"查询起始值 begin 不合法"}'
```
#### API errcode
```text
    '0'=> '请求成功'
    '-1'=> '系统错误',
    '-1000' => '系统错误',	
    '40014' => 'AccessToken 不合法',	
    '40097' => '请求参数错误',	
    '40101' => '缺少必填参数',	
    '41001' => '缺少AccessToken',	
    '42001' => 'AccessToken过期',	
    '43002' => 'HTTP METHOD 错误',	
    '44002' => 'POST BODY 为空',
    '47001' => 'POST BODY 格式错误'	
```

#### 云开发
```text
    -1	通用错误
    -401001	SDK 通用错误：无权限使用 API
    -401002	SDK 通用错误：API 传入参数错误
    -401003	SDK 通用错误：API 传入参数类型错误
    -402001	SDK 数据库错误：检测到循环引用
    -402002	SDK 数据库错误：初始化监听失败
    -402003	SDK 数据库错误：重连 WebSocket 失败
    -402004	SDK 数据库错误：重建监听失败
    -402005	SDK 数据库错误：关闭监听失败
    -402006	SDK 数据库错误：收到服务器错误信息
    -402007	SDK 数据库错误：从服务器收到非法数据
    -402008	SDK 数据库错误：WebSocket 连接异常
    -402009	SDK 数据库错误：WebSocket 连接断开
    -402010	SDK 数据库错误：检查包序失败
    -402011	SDK 数据库错误：未知异常
    -501001	云资源通用错误：云端系统错误
    -403001	SDK 文件存储错误：上传的文件超出大小上限
    -404001	SDK 云函数错误：云函数调用内部失败：空回包
    -404002	SDK 云函数错误：云函数调用内部失败：空 eventid
    -404003	SDK 云函数错误：云函数调用内部失败：空 pollurl
    -404004	SDK 云函数错误：云函数调用内部失败：空 poll 结果 json
    -404005	SDK 云函数错误：云函数调用失败：超出最大正常结果轮询尝试次数
    -404006	SDK 云函数错误：云函数调用内部失败：空 base resp
    -404007	SDK 云函数错误：云函数调用失败：baseresponse.errcode 非 0
    -404008	SDK 云函数错误：云函数调用失败：v1 轮询状态码异常
    -404009	SDK 云函数错误：云函数调用内部失败：轮询处理异常
    -404010	SDK 云函数错误：云函数调用失败：轮询结果已超时过期1
    -404011	SDK 云函数错误：云函数调用失败：函数执行失败
    -404012	SDK 云函数错误：云函数调用失败：超出最大轮询超时后尝试次数2
    -40400x	SDK 云函数错误：云函数调用失败
    -404011	SDK 云函数错误：云函数执行失败
    -501002	云资源通用错误：云端响应超时
    -501003	云资源通用错误：请求次数超出环境配额
    -501004	云资源通用错误：请求并发数超出环境配额
    -501005	云资源通用错误：环境信息异常
    -501007	云资源通用错误：参数错误
    -501009	云资源通用错误：操作的资源对象非法或不存在
    -501015	云资源通用错误：读请求次数配额耗尽
    -501016	云资源通用错误：写请求次数配额耗尽
    -501017	云资源通用错误：磁盘耗尽
    -501018	云资源通用错误：资源不可用
    -501019	云资源通用错误：未授权操作
    -501020	云资源通用错误：未知参数错误
    -501021	云资源通用错误：操作不支持
    -502001	云资源数据库错误：数据库请求失败
    -502002	云资源数据库错误：非法的数据库指令
    -502003	云资源数据库错误：无权限操作数据库
    -502005	云资源数据库错误：集合不存在
    -502010	云资源数据库错误：操作失败
    -502011	云资源数据库错误：操作超时
    -502012	云资源数据库错误：插入失败
    -502013	云资源数据库错误：创建集合失败
    -502014	云资源数据库错误：删除数据失败
    -502015	云资源数据库错误：查询数据失败
    -503001	云资源文件存储错误：云文件请求失败
    -503002	云资源文件存储错误：无权限访问云文件
    -503003	云资源文件存储错误：文件不存在
    -503003	云资源文件存储错误：非法签名
    -504001	云资源云函数错误：云函数调用失败
    -504002	云资源云函数错误：云函数执行失败
    -601001	微信后台通用错误：系统错误
    -601002	微信后台通用错误：系统参数错误
    -601003	微信后台通用错误：系统网络错误
    -604001	微信后台云函数错误：回包大小超过 1M
    -604100	微信后台云函数错误：API 不存在
    -604101	微信后台云函数错误：无权限调用此 API
    -604102	微信后台云函数错误：调用超时
    -604103	微信后台云函数错误：云调用系统错误
    -604104	微信后台云函数错误：非法调用来源
    -604101	微信后台云函数错误：调用系统错误
    -605101	微信后台 HTTP API 错误：查询语句解析失败
```

### 其他
#### 微信小程序幕层禁止滑动
    1.在幕层最外层view中加入 catchtouchmove="preventTouchMove"
    2.JS中写入空白函数      preventTouchMove:function(e){};
