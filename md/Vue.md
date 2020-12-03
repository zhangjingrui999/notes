[Vue文档](https://cn.vuejs.org/v2/guide/)
[Element文档](https://element.faas.ele.me/#/zh-CN/component/installation)
### 6. element-ui技巧
#### 6.1 table
```html
     <el-table
        :data="tableData" 
        class="info-table"
        style="width: 100%" 
        max-height="850" 
        tooltip-effect="dark"
        border 
        :cell-class-name="class1"
        @cell-click="click1"
        v-on:cell-click="click2"
        @selection-change="handleSelectionChange"
    >
        <!-- 多选 -->
        <el-table-column type="selection" width="55"></el-table-column>
        <!-- 序号 -->
        <el-table-column label="序号" type="index" width="67px"></el-table-column>
        <!-- 内容 -->
        <el-table-column label="状态" prop="status" width="100" fit="false"></el-table-column>
        <!-- Vue渲染 -->
        <el-table-column label="详情" prop="data_info" width="137" fit="false">
            <template slot-scope="scope">
                <router-link to="/info">
                    <div v-html="scope.row.data_info" @click="infoClick" class="info-class"></div>
                </router-link>
            </template>
        </el-table-column>
        <!-- Element-ui 自定义 -->
        <el-table-column label="姓名" width="180">
            <template slot-scope="scope">
                <el-popover trigger="hover" placement="top">
                    <p>姓名: {{ scope.row.name }}</p>
                    <p>住址: {{ scope.row.address }}</p>
                    <div slot="reference" class="name-wrapper" @click="nameClick">
                        <el-tag size="medium">{{ scope.row.name }}</el-tag>
                    </div>
                </el-popover>
            </template>
        </el-table-column>
        <!-- 操作 -->
        <el-table-column fixed="right" label="操作" width="120">
            <template slot-scope="scope">
                <el-button @click.native.prevent="deleteRow(scope.$index, tableData)" type="text" size="small">
                    移除
                </el-button>
            </template>
        </el-table-column>
    </el-table>

    <script>
        export default {
            data() {
                return {
                    tableData: [{
                        status: '0',
                        statusId: 1,
                        info: '',
                        name: '',
                        address: ''
                    }, {
                        status: '0',
                        statusId: 1,
                        info: '',
                        name: '',
                        address: ''
                    }]
                }
            },
            methods: {
                /* 多选方法 */
                handleSelectionChange(val) {
                    this.multipleSelection = val;
                },
                /* 操作 移除 */
                deleteRow(index, row) {
                    console.log(index, row);
                },
                /* 表头对单元格进行Class绑定 */
                class1({row, column, rowIndex, columnIndex}) {
                    if (columnIndex === 1) {
                        return 'index-class'
                    }
                    if (columnIndex === 2 && row.statusId === 1) {
                        return 'status-class'
                    }
                },
                /* 表头对单元格进行 @cell-click 绑定 */
                click1(row, column, event, cell) {},
                /* 表头对单元格进行 v-on:cell-click 绑定 */
                click2(row, column, event, cell) {},
                /* 单元格Vue自定义渲染 @click 绑定 */
                infoClick() {},
                /* Element-ui自定义渲染 @click 绑定 */
                nameClick() {}    
            }
        }
    </script>
```
#### 6.2 Form
```html
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
        <el-form-item label="输入框" prop="input">
            <el-input v-model="ruleForm.input"></el-input>
        </el-form-item>
        <el-form-item label="下拉菜单" prop="select">
            <el-select v-model="ruleForm.select" placeholder="请选择下拉菜单">
                <el-option label="菜单1" value="1"></el-option>
                <el-option label="菜单2" value="1"></el-option>
            </el-select>
        </el-form-item>
        <el-form-item label="时间选择器" required>
            <el-col :span="11">
                <el-form-item prop="date1">
                    <el-date-picker type="date" placeholder="选择日期" v-model="ruleForm.date1" style="width: 100%;"></el-date-picker>
                </el-form-item>
            </el-col>
            <el-col class="line" :span="2">-</el-col>
            <el-col :span="11">
                <el-form-item prop="date2">
                    <el-time-picker placeholder="选择时间" v-model="ruleForm.date2" style="width: 100%;"></el-time-picker>
                </el-form-item>
            </el-col>
        </el-form-item>
        <el-form-item label="滑动选项卡" prop="switch">
            <el-switch v-model="ruleForm.switch"></el-switch>
        </el-form-item>
        <el-form-item label="多选框" prop="checkbox">
            <el-checkbox-group v-model="ruleForm.checkbox">
                <el-checkbox label="多选框1" name="checkbox"></el-checkbox>
                <el-checkbox label="多选框2" name="checkbox"></el-checkbox>
                <el-checkbox label="多选框3" name="checkbox"></el-checkbox>
                <el-checkbox label="多选框4" name="checkbox"></el-checkbox>
            </el-checkbox-group>
        </el-form-item>
        <el-form-item label="单选框" prop="radio">
            <el-radio-group v-model="ruleForm.radio">
                <el-radio label="单选框1"></el-radio>
                <el-radio label="单选框2"></el-radio>
            </el-radio-group>
        </el-form-item>
        <el-form-item label="文本域" prop="textarea">
            <el-input type="textarea" v-model="ruleForm.textarea"></el-input>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="submitForm('ruleForm')">提交</el-button>
            <el-button @click="resetForm('ruleForm')">重置</el-button>
        </el-form-item>
    </el-form>
    <script>
        export default {
            data() {
                let validatePhone = (rule, value, callback) => {
                    if (!(/^1[3456789]\d{9}$/.test(value))) {
                        /* new Error() 中的值会替换 message的值 */
                        callback(new Error());
                    }
                };
                return {
                    /* 表单初始数据 */
                    ruleForm: {
                        input: '',
                        select: '',
                        date1: '',
                        date2: '',
                        switch: false,
                        checkbox: [],
                        radio: '',
                        textarea: ''
                    },
                    /* 表单验证规则 */
                    rules: {
                        input: [
                            { required: true, message: '请输入输入框文本', trigger: 'blur' },
                            { min: 3, max: 5, message: '长度在 3 到 11 个字符', trigger: 'blur' },
                            {validator: validatePhone, message: '请输入正确的手机号码', trigger: 'blur'}
                        ],
                        select: [
                            { required: true, message: '请选择下拉菜单选项', trigger: 'change' }
                        ],
                        date1: [
                            { type: 'date', required: true, message: '请选择日期', trigger: 'change' }
                        ],
                        date2: [
                            { type: 'date', required: true, message: '请选择时间', trigger: 'change' }
                        ],
                        checkbox: [
                            { type: 'array', required: true, message: '请至少选择一个多选框', trigger: 'change' }
                        ],
                        radio: [
                            { required: true, message: '请选择单选框', trigger: 'change' }
                        ],
                        textarea: [
                            { required: true, message: '请填写文本域文本', trigger: 'blur' }
                        ]
                    }
                };
            },
            methods: {
                submitForm(formName) {
                    this.$refs[formName].validate((valid) => {
                        if (valid) {
                            alert('submit!');
                        } else {
                            console.log('error submit!!');
                            return false;
                        }
                    });
                },
                resetForm(formName) {
                    /* 清除有验证规则的输入数据 */
                    this.$refs[formName].resetFields();
                    /* 清除所有表单数据 */
                    this.ruleForm = {};
                }
            }
        }
    </script>
```
#### 6.3 dialog(弹窗) 
```html
    <el-dialog
        title="提示"
        width="30%"
        :visible.sync="显示方法回调"
        :before-close="关闭方法回调">
        <span>这是一段信息</span>
        <span slot="footer" class="dialog-footer">
            <el-button @click="dialogVisible = false">取 消</el-button>
            <el-button type="primary" @click="dialogVisible = false">确 定</el-button>
        </span>
    </el-dialog>
```
#### 6.4 上传
```html
    <el-upload
        action="https://上传接口"
        list-type="text/picture/picture-card 文件列表类型"
        :on-preview="点击文件列表中已上传的文件时"
        :on-remove="文件列表移除文件时"
        :on-success="文件上传成功时"
        :on-error="文件上传失败时"
        :on-progress="文件上传时">
        <i class="el-icon-plus"></i>
    </el-upload>
    <el-dialog :visible.sync="dialogVisible">
        <img width="100%" :src="dialogImageUrl" alt="">
    </el-dialog>

    <script>
        export default {
            data() {
                return {
                    dialogImageUrl: '',
                    dialogVisible: false
                };
            },
            methods: {}
        }
    </script>
```


### 5. 渲染绑定
#### 5.1 渲染
##### 5.1.1 条件渲染
```html
    <template>
        <div id="id-name">
            <div v-show="">true加载 / false 不加载</div>
            
            <div v-if="">true显示</div>
            <div v-else>false显示</div>
        <div>
    </template>
```
##### 5.1.2 循环渲染
```html
    <template>
        <div id="id-name">
            <div v-for="(item, index) in list" :key="index" :index="index" @click="click(index)">
                {{item}}
                <div v-for="(item2, index2) in item" :key="index2" :index="index2" @click="click(index2)">{{item2}}</div>
            </div>
        <div>
    </template>
```
#### 5.2 Class绑定
```html
    <template>
        <div id="id-name">
            <div class="class1">普通绑定</div>
            <div :class="isClass ? 'class1' : 'class2' ">三元绑定</div>
            <div :class="[isClass1 ? 'class1' : 'class2',
                         isClass2 ? 'class3' : 'class4' ]">
                三元数组绑定             
            </div>
            <div :class="{class1: isClass}">Vue绑定</div>
            <div :class="{class1: isClass1', class2: isClass2">Vue数组绑定</div>
            <div :class="classObject">对象绑定</div>
            <div :class="classObject1">对象计算绑定</div>
            
        <div>
    </template>

    <script>
        export default {
            name : 'id-name',
            data() {
                classObject: {
                    isClass1: true,
                    'isClass': null
                },
                classObject1: function {
                    return {
                      active: this.isActive && !this.error,
                      'text-danger': this.error && this.error.type === 'fatal'
                    }
                },
                return {}
            }
        }
    </script>
```
#### 5.3 Click绑定
```html
    <template>
        <div id="id-name">
            <div @click="divClick">点击方法</div>
            <div @click=" isShow = true ">点击处理</div>
        <div>
    </template>

    <script>
        export default {
            name : 'id-name',
            data() {
                return {
                    isShow: true
                }
            },
            methods: {
                divClick() {
                    console.log('div被点击');
                }   
            }   
        }
    </script>
```
#### 5.4 其他
```html
    <template>
        <div id="id-name">
            <div :style=""></div>
            <img :src="" alt="" />
            <a :href=""></a>
        <div>
    </template>

    <script>
        export default {
            name : 'id-name',
            data() {
                return {}
            }
        }
    </script>
```


### 4. 组件通信
#### 4.1 父包含子
```html
    <!-- 父 -->
    <template>
        <div id="father">
            <Child></Child>
        <div>
    </template>
    <script>
        import Child from 'child'
        export default {
            /* 注册组件 */ 
            components:{
                Child,
            },
        name : 'father',
    }
	</script>

    <!-- 子 -->
    <template>
        <div id="child">
        <div>
    </template>
    <script>
        export default {
            name : 'child',
        }
	</script>
```
#### 4.2 router-link(路由包含)
```html
    <router-link to="/child"></router-link>
    <router-view></router-view>
```
#### 4.3 父子通信
```html
    <!-- 父 -->
    <template>
        <div id="father">
            <Child :valName="valName" @valName2="valName2"></Child>
        <div>
    </template>
    <script>
        import Child from 'child'
        export default {
            /* 注册组件 */ 
            components:{
                Child,
            },
        name : 'father',
        methods: {
            valName2(val) {
                this.valName = val;
            }
        }   
    }
    </script>

    <!-- 子 -->
    <template>
        <div id="child">
             引入方法1 {{valName}}
             引入方法2 {{valName1}}
        <div>
    </template>
    <script>
        export default {
            name : 'child',
            data() {
                return {
                    valName1: this.valName
                }       
            },
            /* 父传子 */
            props:['valName'],
            methods: {
                valClick() {
                    /* 子传父 */
                    this.$emit('valName2', '');
                }
            },
        }
    </script>
```
#### 4.4 兄弟通信
```html
    <!-- 父 -->
    <template>
        <div id="father">
            <Child1 :valName1="valName1" @valName2="valName2"></Child1>
            <Child2 :valName2="valName2" @valName="valName1"></Child2>
        <div>
    </template>
    <script>
        import Child1 from 'child1'
        import Child2 from 'child2'
        export default {
            /* 注册组件 */ 
            components:{
                Child1,
                Child2,
            },
        name : 'father',
        methods: {
            valName1(val) {
                this.valName2 = val;
            },
            valName2(val) {
                this.valName1 = val;
            }
        }   
    }
    </script>

    <!-- 子1 -->
    <template>
        <div id="child1">
             引入方法1 {{valName}}
             引入方法2 {{valName1}}
        <div>
    </template>
    <script>
        export default {
            name : 'child1',
            data() {
                return {
                    valName: this.valName1
                }       
            },
            /* 父传子 */
            props:['valName1'],
            methods: {
                valClick() {
                    /* 子传父 */
                    this.$emit('valName2', '');
                }
            },
        }
    </script>

    <!-- 子2 -->
    <template>
        <div id="child2">
             引入方法1 {{valName}}
             引入方法2 {{valName2}}
        <div>
    </template>
    <script>
        export default {
            name : 'child2',
            data() {
                return {
                    valName: this.valName2
                }       
            },
            /* 父传子 */
            props:['valName2'],
            methods: {
                valClick() {
                    /* 子传父 */
                    this.$emit('valName1', '');
                }
            },
        }
    </script>
```


### 3. 结构
#### 3.1 目录
> **project-name**------> 项目目录
> + build       ------> webpack相关配置
> > * build.js              ------>生产环境构建代码 
> > * check-versions.js     ------>检查node和npm版本的 
> > * utils.js              ------>构建工具相关
> > * vue-loader.conf.js    ------>css加载器设置
> > * webpack.base.conf.js  ------>webpack基本配置
> > * webpack.dev.conf.js   ------>webpack开发环境配置
> > * webpack.prod.conf.js  ------>webpack生产环境配置
> + config      ------> vue基本配置文件,(监听端口,打包输出等相关配置)
> > * dev.env.js            -------> 开发环境变量
> > * index.html              -------> 项目的一些配置变量
> > * peod.env.js           -------> 生产环境变量
> > * test-env.js           -------> 生产环境变量
> + dist        ------> 运行npm run build后的产物,即线上的项目
> + node_modules------> 依赖npm install下载
> + src         ------> 代码编写文件
> > * assets                -------> 静态资源,js,css,img可以放在这里的
> > * components            -------> 公用组件存放的地方,.vue文件
> > * pages                 -------> 页面存放的地方
> > * router                -------> 路由文件夹
> > > * index.html                    -------> 路由配置页面
> > * app.vue               -------> 项目主组件,所有页面都在里面进行切换
> > * main.js               -------> 入口文件
> + static      ------> 静态资源
> + test        ------> 单元测试,webpack搭建项目的时候选择no,避免产生大量警告
> + .babelrc    ------> es6语法编译配置
> + .editorconfig------> 定义代码格式
> + .postcssrc.js------> 转换css工具
> + index.html   ------> 页面入口
> + package.json ------> 项目基本信息(模块,项目名称,版本)
> + readme.md    ------> 项目说明文件 
#### 3.2 文件
```html
	<template>
		<div id="id-name"><div>
	</template>

	<script>
        import 组件 from '组件路径'
		export default {
            /* 注册组件 */ 
            components:{
                组件,
            },
			name : 'id-name',
			data() {
				return {
				    // 页面数据
                    v1: '',
                    v2: [
                        {},
                    ],
                    v3: {
                        [
                            {}
                        ]      
                    }   
                }
			},
            /* [生命周期及钩子](https://www.cnblogs.com/xiaobaibubai/p/8383952.html) */
            methods: { /* 方法 */ },
            beforeCreate: function () {
                console.group('beforeCreate 创建前状态===============》');
                console.log("%c%s", "color:red","el     : " + this.$el); //undefined
                console.log("%c%s", "color:red","data   : " + this.$data); //undefined
                console.log("%c%s", "color:red","message: " + this.message);//undefined
            },
            created: function () {
                console.group('created 创建完毕状态===============》');
            },
            beforeMount: function () {
                console.group('beforeMount 挂载前状态===============》');
                console.log("%c%s", "color:green","el     : " + (this.$el)); //已被初始化
                console.log(this.$el); // 当前挂在的元素
                console.log("%c%s", "color:green","data   : " + this.$data); //已被初始化
                console.log("%c%s", "color:green","message: " + this.message); //已被初始化
            },
            mounted: function () {
                console.group('mounted 挂载结束状态===============》');
                console.log("%c%s", "color:green","el     : " + this.$el); //已被初始化
                console.log(this.$el);
                console.log("%c%s", "color:green","data   : " + this.$data); //已被初始化
                console.log("%c%s", "color:green","message: " + this.message); //已被初始化
            },
            beforeUpdate: function () {
                console.group('beforeUpdate 更新前状态===============》'); //这里指的是页面渲染新数据之前
                console.log("%c%s", "color:green","el     : " + this.$el);
                console.log(this.$el);
                console.log("%c%s", "color:green","data   : " + this.$data);
                console.log("%c%s", "color:green","message: " + this.message);
            },
            updated: function () {
                console.group('updated 更新完成状态===============》');
                console.log("%c%s", "color:green","el     : " + this.$el);
                console.log(this.$el);
                console.log("%c%s", "color:green","data   : " + this.$data);
                console.log("%c%s", "color:green","message: " + this.message);
            },
            beforeDestroy: function () {
                console.group('beforeDestroy 销毁前状态===============》');
                console.log("%c%s", "color:red","el     : " + this.$el);
                console.log(this.$el);
                console.log("%c%s", "color:red","data   : " + this.$data);
                console.log("%c%s", "color:red","message: " + this.message);
            },
            destroyed: function () {
                console.group('destroyed 销毁完成状态===============》');
                console.log("%c%s", "color:red","el     : " + this.$el);
                console.log(this.$el);
                console.log("%c%s", "color:red","data   : " + this.$data);
                console.log("%c%s", "color:red","message: " + this.message)
            }
		}
	</script>

	<style scoped>
        /* 当前组件CSS,只在本组件生效 */
    <style>

    <style>
        /* 普通CSS,加载后的页面均会生效 */
        /* element-ui 原生样式在此才会生效 */
    </style>
```

### 2. 插件
#### 2.1 axios[^ajax请求用的]
```shell script
    npm install vue-axios
    npm install axios
```
#### 2.2 swiper插件
```shell script
    npm install vue-awesome-swiper --save
    
    # main.js
    import VueAwesomeSwiper from 'vue-awesome-swiper'
    import 'swiper/dist/css/swiper.css'
    Vue.use(VueAwesomeSwiper)
```
#### 2.3 [element-ui](https://element.faas.ele.me/#/zh-CN/component/layout)
```shell script
    npm install element-ui --save
    
    # main.js
    import ElementUI from 'element-ui';
    import 'element-ui/lib/theme-chalk/index.css';
    Vue.use(ElementUI)
```
#### 2.4 element-ui 富文本编辑器
```shell script
    npm install vue-quill-editor
    
    # **.vue(需要引用的组件页面)
    import { quillEditor } from 'vue-quill-editor'
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'
    
    # 同页面组件注册
    components: {
        quillEditor
    }
    
    # 视图
    <quill-editor ref="text" v-model="content" class="myQuillEditor" :options="editorOption" />

    # 基本配置
    data () {
      return {
          content: '',
          editorOption: {} 
      }
    },
    methods: {
        submit () {
            console.log(this.$refs.text.value)
        }
    }
    // editorOption里是放图片上传配置参数用的，例如：
    // action:  '/api/product/richtext_img_upload.do',  // 必填参数 图片上传地址
    // methods: 'post',  // 必填参数 图片上传方式
    // token: '',  // 可选参数 如果需要token验证，假设你的token有存放在sessionStorage
    // name: 'upload_file',  // 必填参数 文件的参数名
    // size: 500,  // 可选参数   图片大小，单位为Kb, 1M = 1024Kb
    // accept: 'multipart/form-data, image/png, image/gif, image/jpeg, image/bmp, image/x-icon,image/jpg'  // 可选 可上传的图片格式
```
##### 2.4.1 JS汉化
```javascript
    // quill-title.js 汉化js
    const titleConfig = {
        'ql-bold': '加粗',
        'ql-color': '颜色',
        'ql-font': '字体',
        'ql-code': '插入代码',
        'ql-italic': '斜体',
        'ql-link': '添加链接',
        'ql-background': '背景颜色',
        'ql-size': '字体大小',
        'ql-strike': '删除线',
        'ql-script': '上标/下标',
        'ql-underline': '下划线',
        'ql-blockquote': '引用',
        'ql-header': '标题',
        'ql-indent': '缩进',
        'ql-list': '列表',
        'ql-align': '文本对齐',
        'ql-direction': '文本方向',
        'ql-code-block': '代码块',
        'ql-formula': '公式',
        'ql-image': '图片',
        'ql-video': '视频',
        'ql-clean': '清除字体样式'
    }
    /*
    *   title 鼠标悬停提示
    *   innerHTML 文本
    *   innerHTML += 文本加图片
    */
    export function addQuillTitle () {
        const oToolBar = document.querySelector('.ql-toolbar');
        if(oToolBar == null ) {
            return false;
        }
        const aButton = oToolBar.querySelectorAll('button'),
            aSelect = oToolBar.querySelectorAll('select')
        aButton.forEach(function (item) {
            if (item.className === 'ql-script') {
                item.value === 'sub' ? item.title = '下标' : item.title = '上标'
            } else if (item.className === 'ql-indent') {
                item.value === '+1' ? item.title = '向右缩进' : item.title = '向左缩进'
            } else if(item.className === 'ql-picker-options') {
    
            } else {
                item.title = titleConfig[item.classList[0]]
            }
        })
        aSelect.forEach(function (item) {
            item.parentNode.title = titleConfig[item.classList[0]]
        })
    }

    // 调用页
    import {addQuillTitle} from 'quill-title'

    // 组件注册
    components: {
        addQuillTitle,
    },

    // 钩子调用
    created() {
        addQuillTitle();
    }
```
##### 2.4.2 CSS汉化
```css
    .ql-size .ql-picker-label,.ql-header .ql-picker-label,.ql-font .ql-picker-label {
        border: none;
        outline: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ql-color .ql-picker-label svg, .ql-background .ql-picker-label svg, .ql-align .ql-picker-label svg{
        vertical-align: top;
    }

    .ql-snow .ql-picker.ql-size .ql-picker-label::before,
    .ql-snow .ql-picker.ql-size .ql-picker-item::before {
        content: '文本大小';
    }
    .ql-snow .ql-picker.ql-size .ql-picker-label::before,
    .ql-snow .ql-picker.ql-size .ql-picker-item::before {
        content: '14px';
    }
    .ql-snow .ql-picker.ql-size .ql-picker-label[data-value=small]::before,
    .ql-snow .ql-picker.ql-size .ql-picker-item[data-value=small]::before {
        content: '10px';
    }
    .ql-snow .ql-picker.ql-size .ql-picker-label[data-value=large]::before,
    .ql-snow .ql-picker.ql-size .ql-picker-item[data-value=large]::before {
        content: '18px';
    }
    .ql-snow .ql-picker.ql-size .ql-picker-label[data-value=huge]::before,
    .ql-snow .ql-picker.ql-size .ql-picker-item[data-value=huge]::before {
        content: '32px';
    }

    .ql-snow .ql-picker.ql-header .ql-picker-label::before,
    .ql-snow .ql-picker.ql-header .ql-picker-item::before {
        content: '标题大小';
    }
    .ql-snow .ql-picker.ql-header .ql-picker-label[data-value="1"]::before,
    .ql-snow .ql-picker.ql-header .ql-picker-item[data-value="1"]::before {
        content: '标题1';
    }
    .ql-snow .ql-picker.ql-header .ql-picker-label[data-value="2"]::before,
    .ql-snow .ql-picker.ql-header .ql-picker-item[data-value="2"]::before {
        content: '标题2';
    }
    .ql-snow .ql-picker.ql-header .ql-picker-label[data-value="3"]::before,
    .ql-snow .ql-picker.ql-header .ql-picker-item[data-value="3"]::before {
        content: '标题3';
    }
    .ql-snow .ql-picker.ql-header .ql-picker-label[data-value="4"]::before,
    .ql-snow .ql-picker.ql-header .ql-picker-item[data-value="4"]::before {
        content: '标题4';
    }
    .ql-snow .ql-picker.ql-header .ql-picker-label[data-value="5"]::before,
    .ql-snow .ql-picker.ql-header .ql-picker-item[data-value="5"]::before {
        content: '标题5';
    }
    .ql-snow .ql-picker.ql-header .ql-picker-label[data-value="6"]::before,
    .ql-snow .ql-picker.ql-header .ql-picker-item[data-value="6"]::before {
        content: '标题6';
    }

    .ql-snow .ql-picker.ql-font .ql-picker-label::before,
    .ql-snow .ql-picker.ql-font .ql-picker-item::before {
        content: '标准字体';
    }
    .ql-snow .ql-picker.ql-font .ql-picker-label[data-value=serif]::before,
    .ql-snow .ql-picker.ql-font .ql-picker-item[data-value=serif]::before {
        content: '衬线字体';
    }
    .ql-snow .ql-picker.ql-font .ql-picker-label[data-value=monospace]::before,
    .ql-snow .ql-picker.ql-font .ql-picker-item[data-value=monospace]::before {
        content: '等宽字体';
    }
```
#### 2.5 [滑块验证](https://yimijianfang.github.io/vue-drag-verify/#/dragimgchip)
```shell script
    npm install vue-drag-verify-img-chip
    
    # **.vue(需要引用的组件页面)
    import DragVerify from "./DragVerify";

    # 同页面组件注册
    components: {
        DragVerify
    }

    # 视图
    <el-row>
          <drag-verify-img-chip 
                ref="sss"
                :imgsrc="t3"
                :isPassing.sync="isPassing"
                :showRefresh="true"
                :barWidth="40"
                text="请按住滑块拖动"
                successText="验证通过"
                handlerIcon="el-icon-d-arrow-right"
                successIcon="el-icon-circle-check"
                @refresh="reimg"
                @passcallback="pass"
          >
          </drag-verify-img-chip>
          <el-button type="primary" @click="reset">还原</el-button>
    </el-row>

    # 回调
    refresh         点击刷新回调
    passcallback    验证通过回调
    passfail        验证失败回调
```
#### 2.6 vuex
```shell script
    npm install vuex --save
```
#### 2.7 图标库[font-awesome](http://fontawesome.dashgame.com)
```shell script
    npm install vuex --save
```


### 1. 安装
```shell script
    # 1. 安装node.js
    
    # 查看 node/npm版本信息
    node -v
    npm -v

    # 2. 更新npm依赖 
    npm install

    # 3. 安装webpack
    npm install webpack
    npm install webpack-cli

    # 4. 安装Vue
    npm install vue
    npm install vue-cli

    # 查看Vue版本信息
    vue -V

    # 5. 初始化Vue项目
    vue init webpack *项目名

    # 6. 本地运行
    npm run dev

    # 7. 项目打包(生成dist文件)
    npm run build
```    