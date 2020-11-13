 #vue-cli 项目步骤

### 1.安装vue-cli
    cnpm install vue-cli
### 2.初始化webpack
    vue init webpack my-project
    
    安装的时候后三个都选no,安装了router就好 要不然会出事情的...警告一大堆
### 3.切换目录
    cd my-project
### 4.下载依赖
    cnpm install   
### 5.运行
    npm run dev  //这是云行测试的
    
    npm run build //打包好会出现一个新的文件,丢到服务器就好.暂时忘了...完了补上是啥文件    ####dist文件
### 6.安装axios[^ajax请求用的]
    cnpm install vue-axios
    cnpm install axios
### 7.需要的话安装swiper插件
    cnpm install vue-awesome-swiper --save
    
    引入swiper
    
    main.js全局引入
    
    import VueAwesomeSwiper from 'vue-awesome-swiper'
    
    import 'swiper/dist/css/swiper.css'
    
    Vue.use(VueAwesomeSwiper)
### 8.引入element-ui
	cnpm install element-ui --save
	
	main.js
	
### 9.引入vuex
	cnpm install vuex --save
	
### 10.图标库font-awesome
	cnpm install font-awesome --save
[font-awesome](http://fontawesome.dashgame.com/)
	
	
[安装的时候搜一下咋用吧](https://github.com/davecat/vue-awesome-swiper/blob/master/README.md)

### 路由问题
```javascript
import Vue from 'vue';
import vueRouter from 'vue-router';
Vue.use(vueRouter);
let router = new vueRouter({
	mode:'history',
	routes:[
		{
			path: '/home',
			component: r => require(['../components/Home/HomePage/HomePage'], r)  // 异步加载组件
		},
	]
});
```

### 查看是否安装完成
    到package.json查看dependencies里面有没有版本信息
***

# vue结构介绍
## cli目录结构
> **my-project**------> 项目目录
> + build       ------> webpack相关配置
> > * build.js              ------>生产环境构建代码 
> > * check-versions.js     ------>检查node和npm版本的 
> > * utils.js              ------>构建工具相关
> > * vue-loader.conf.js    ------>css加载器设置,我的css放在static里面build的时候就找不到了,........迷茫,以后解决了再放吧
> > * webpack.base.conf.js  ------>webpack基本配置
> > * webpack.dev.conf.js   ------>webpack开发环境配置
> > * webpack.prod.conf.js  ------>webpack生产环境配置
> + config      ------> vue基本配置文件,(监听端口,打包输出等相关配置)
> > * dev.env.js            -------> 开发环境变量
> > * index.html              -------> 项目的一些配置变量
> > * peod.env.js           -------> 生产环境变量
> > * test-env.js           -------> 生产环境变量
> + dist        ------> 运行npm run build后的产物,对,就是线上的项目
> + node_modules------> 依赖npm install下载的,搭建的时候莫得,项目的灵魂
> + src         ------> 代码聚集的,最常打开的文件夹,木有之一,必进代码就在这里写
> > * assets                -------> 静态资源,js,css可以放在这里的
> > * components            -------> 公用组件存放的地方,.vue文件
> > * pages                 -------> 页面存放的地方,我直接都在公用里面写了...哈哈哈...虽说是新手,不过懒得改了
> > * router                -------> 路由文件夹
> > > * index.html                    -------> 路由配置页面
> > * app.vue               -------> 项目主组件,所有页面都在里面进行切换
> > * main.js               -------> 入口文件
> + static      ------> 静态资源,说白了就是个放图片的
> + test        ------> 单元测试,webpack搭建项目的时候应该会问按不按这个,直接no,报错木得,警告一大推,
> + .babelrc    ------> es6语法编译配置,用来转换成浏览器看得懂的样子
> + .editorconfig------> 定义代码格式 打开看看就知道了,里面有缩进配置...
> + .postcssrc.js------> 转换css工具
> + index.html   ------> 页面入口,没毛病吧...
> + package.json------> 项目基本信息(模块,项目名称,版本)
> + readme       ------> 项目说明文件.md很性感 

## **页面详细**
#### 一个标准的vue页面
```html
	<template>
		<div><div> / 这里的div是唯一的 , 也就是所只能有一个打的div包住了写,一个下面只能有一个跟节点-->
	</template>

	<script>
		export default {
			name : '',
			data() {
				return {}
			}
		}
	</script>

	<style scoped><style>
	<!-- scoped 表示样式只能用于当前的组件里面-->
```

***

# 一.项目遇到的问题
## 1.公用文件位置
    所有公用的js,css,img 放到../static中 assets就是个坑,一直报错mmp
## 2.**移动端底部导航栏**
### **所用知识点**
    父子组件之间的通讯
### **简略代码**
#### foot.vue
```html
<div class="item" @click="hrefMain(index)" v-for="(item,index) in itemList" :key="index" :class="footerItem == index? 'active' : ' '">
	<router-link :to="item.url">
		<!-- 这里的router-就是a链接 :to表示跳转的页面-->
		<img :src="item.img" v-if="footerItem != index" class="foot-icon">
		<img :src="item.onimg" v-if="footerItem == index" class="foot-icon">
		<div class="item-name">{{item.name}}</div>
	</router-link>
</div>
```
```javascript
<script>
export default{
	name: 'foot',
	props:['footerName'], //引用父元素的数据
	data () {
		return {
			itemList: [],
			footerItem: 0 //用来判断的一个值
		}
	},
	mounted () {
		this.footerItem = this.footerName //设置父组件传回来的值
	},
	methods:{
		hrefMain(index){
			this.footerItem = index; //点击设置,跳转了就
		}
	}
}
</script>
```
#### index.vue  
```html
<common-footer footerName='0'></common-footer>
<!--  Name 就是要传给子组件的值  -->
```
```javascript
import CommonFooter from '@/components/foot'; //引入foot

components: { //把组件包起来
  CommonFooter
}
```
### **父可以传多个值**
<common-header headName='页面title' headIndex="true"></common-header>
<!--  index 有就是true 不传就是false 可以判断一下头上的返回按键出不出来 (机智的一批)  -->
## 3.**背景图片报错问题**
```html
<div :style="{backgroundImage: 'url(../../static/img/querybg-icon.png)'}"></div>
<!-- 标签里写 -->
```
## 4.**时间戳转换--动态字符串**   
```javascript
filters: {
  /* 格式化时间戳 */
  formatDate (val) {
	const date = new Date(val);
	const year = date.getFullYear();
	const month = date.getMonth() > 9 ? date.getMonth() + 1 : `0${date.getMonth() + 1}`;
	const day = date.getDate() > 9 ? date.getDate() + 1 : `0${date.getDate() + 1}`;
	return `${year}-${month}-${day}`;
	//这里是es6语法里面的动态字符串  相当于一个变量拼接
	console.log(val);
  }
},
```
## 5.**关于input取值问题**
```html
<input type="date" v-model="startTime" @input="startVal(startTime)">
<!-- 顺便一体这里面的值页面显示是'/',打印出来是'-'.神奇 -->
<!-- @input这是做搜索的,值一发生变化就动 -->
```
```javascript
methods: {
	startVal(val) {
	  let staTime = this.startTime;
	}
}
```
## 6.**标签取值问题**
#### 想太多,自己搞个e一级一级往下找
```html
<button  @click="getData($event,'100')">点我</button>
<!-- 第一种 -->
<button data-num="100" @click="getData($event)">点我</button>
<!-- 第二种-->
<button data-num="100" ref="dataNum"  @click="getData($event)">点我</button>
```
```javascript
//第一种 -->
let number = e.target.getAttribute('data-num');
//第二种
let number = this.$refs.dataNum.dataset.num;
```
## 7.**跳转带参数问题**
```html
<button data-num="100" @click="getData($event)">点我</button>
```
```javascript
this.$router.push({ name: 'subscribe', params: { num: this.$refs.dataNum.dataset.num }})
//下个页面接受时
this.$route.params.num
```
## 8.**切换类名**
```html
<div class="mark-fuck" :class="{greenAct: item.greenTrue, redAct: item.redTrue}">
<!-- 当对的时候就显示这个类名) -->
``` 
## 9.**vuex的使用**
### 9.0 *安装准备*
	安装vuex		cnpm install vuex --save
	
	main.js
	
	import store from './store.js'//这是新建了仓库后直接引入仓库
	
	new Vue({
	  store,//这个不太懂...反正放里面,无关紧要,url也不是放在这里,哈哈,懂了吧,要跟着我路由老大哥走
	  el: '#app',
	  router,
	  components: { App },
	  template: '<App/>'
	})
### 9.1 *了解vuex作用*
	Vuex 是一个专为 Vue.js 应用程序开发的状态管理模式。它采用集中式存储管理应用的所有组件的状态，并以相应的规则保证状态以一种可预测的方式发生变化(这是人家官网写的)
	多组件共享状态,就是建一个仓库js把你要的全局变量放进去(是不是很好理解)
### 9.2 *了解vuex概念*
![官网图片](https://vuex.vuejs.org/vuex.png)

	黑色的按钮不要看,不重要
	
	**Active** 			动作,在这个里面写要执行的动作
	
	**Mutations** 		 执行动作的,就是赋值,定义数据
	
	**State** 			 仓库,你的变量存放位置
	
	**Vue components** 	你的组件,这不解释
	
	流程:
	组件通过事件触发 -> 通过组件触发的动作 -> 到执行,赋值 -> 数据返回到你的页面
	
	很迷茫,我也迷!!!.上代码
### 9.3 **代码讲解**
#### store.js   这是你的vuex配置页面
```javascript
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

//中间的操作区域

//创建一个对象 
const store = new Vuex.Store({
	// 这个里面放你要返回到页面上的一些东西 -->
})

export default store;
//把这个对象返回出去
```
#### 9.3.1 4端代码,三个小块,总和一块,,,,下面的javascript都是store.js里面的
##### 6.3.1.0 定义数据,然后页面拿到这个数据
```HTML
<!-- html -->
<template>
	<div id="index">
		<p>{{count}}</p>
	</div>
</template>

<script>
import {mapState} from 'vuex'
export default {
	name: '',
	data(){
		return : {}
	},
	//第一种获取方法....其实三种都是用 computed这个百度一下,计算属性
	computed: {
		count() {
			return this.$Store.state.count;
			//store.js中已经把Vuex挂载到vue上面了,直接用
			//Vue.use(Vuex)懂?
		}
	},
	//上面通过计算属性吧count得到
	//下面使用的是vuex的     辅助函数   常用
	//辅助函数 mapState
	computed: mapState([
		'count'
	])
	//上面这种方法可以获取到,但是在往里面写就不能用了...所以下面一种写法
	computed: {
		...mapState([
			'count'
		]),
		fun(){这个里面还可以进行别的操作,比较nice,强推}
	}
}
</script>
```
```javascript
//先定义一个变量
//js
var state = {
	count: 1 //token变量
}

const store = new Vuex.Store({
	state,//写在这个对象中
	//或者 state = state 上面的更方便
})
```
##### 6.3.1.1 辅助函数 mapGetters
```html
<script>
import {mapGetters} from 'vuex'
	computed: {
		...mapGetters([
			'count'//这里是哪个函数名
		])
	}
}
</script>
```
```javascript
var getters = {
	//定义一个函数
	count(state){
		return state.count;
	}
}

const store = new Vuex.Store({
	getters,
})
```

##### 6.3.1.1 辅助函数 mapActions  //动作
```html
<!-- html -->
<template>
	<div id="index">
		<!--哈哈哈,做一个万恶的加减 -->
		<el-button type="danger" @click="add">加</el-button>
		<el-button type="warning" @click="del">减</el-button>
		<p>{{count}}</p>
	</div>
</template>

<script>
import {mapGetters,mapActions} from 'vuex'
export default {
	name: '',
	data(){
		return : {}
	},
	computed: {
		...mapGetters([
		  'count'
		])
	},
	methods: {
		...mapActions([
			'add',//上面的点击事件看见了吧,这个是store.js的方法,点他
			'del'
		]),
	}
}
</script>
```
```javascript
//js
//建一个对象,这个名字貌似都有规定...
var actions = {
	//add(context){
		//console.log(context)
		//打印一下这个,看看里面有啥
		//commit		函数
		//dispatch		函数
		//getters		对象
		//rootGetters	对象
		//rootState		对象
		//state			对象
		//这就有意思了,下面要用一个es6的语法写,我也不知道,人家文档上面是下面哪种写法,哈哈哈哈哈哈,一脸懵逼,哈哈哈,咯
	//}
	add({commit,state}){
		commit('add')//这个是调用下一个要讲的改变数据
	},
	del({commit,state}){
		commit('del')
	}
}

const store = new Vuex.Store({
	getters,
	actions,//这个东西不要忘了,很关键,很烦
})
```

##### 6.3.1.1 mutations  //改变数据
```html
<!-- html -->
<template>
	<div id="index">
		<el-button type="danger" @click="add">加</el-button>
		<el-button type="warning" @click="del">减</el-button>
		<p>{{count}}</p>
	</div>
</template>

<script>
//和上面的一样
import {mapGetters,mapActions} from 'vuex'
export default {
	name: '',
	data(){
		return : {}
	},
	computed: {
		...mapGetters([
		  'count'
		])
	},
	methods: {
		...mapActions([
			'add',
			'del'
		]),
	}
}
</script>
```
```javascript
//js
//再建一个对象,这个名字坑定有规定...
var actions = {
  add({commit,state}){
    commit('add')
  },
  del({commit,state}) {
    commit('del')
  }
}

var mutations = {
	add(state){
		//进行操作
		state.count++ 
	},
	del(state){
		//这种当然要做个三元判断下了
		state.count == 1 ? 1 : state.count--
	}
}

const store = new Vuex.Store({
	getters,
	actions,//这个东西不要忘了,很关键,很烦
	mutations//这个也加上
})
//可以试一下,加减可以用了
```

##### 6.3.1.1 关键,最总要的获取token,这是重点,也是我学习这个的原因
```html
<!-- html -->
<template>
	<div id="index">
		<el-button type="danger" @click="get">加</el-button>
		<p>{{token}}</p>
	</div>
</template>

<script>
//和上面的一样
import {mapGetters,mapActions} from 'vuex'
export default {
	name: '',
	data(){
		return : {}
	},
	computed: {
		...mapGetters([
		  'token'
		])
	},
	methods: {
		...mapActions([
			'add',
		]),
		get(){
			var token = 100
			//这个网上说多少带点异步
			this.$store.dispatch('add',token)
			//这个是同步的
			this.$store.commit('add',token)
			//看项目,选取一个用
		}
	}
}
</script>
```
```javascript
//js
//仓库,全局的数据
var state = {
	token = '';
}

var getters = {
	token() {
		return state.token;
	} 
}

var actions = {
	//token为参数
	add({commit,state},token){
		commit('add',token)
		//执行赋值里面的add
	}
}

var mutations = {
	add(state,token) {
		state.token = token
	}
}

const store = new Vuex.Store({
  state,
  getters,
  actions,
  mutations
})

//获取token,这是点击获取的,上了项目后在进行补充
```
## 10.**用resource发送jsonp请求**
```html
<!-- html -->
<button @click="getJsonp">发送jsonP请求</button>
```
```javascript
//js
methods: {
	getJsonp() {
		this.$http.jsonp('https://sp0.baidu.com/5a1Faz8AA54nxGko9WTAnF6hhy/su',{
			params: {
				wd: a
			},
			jsonp: 'cb'//这个是百度jsonp的参数名
		}).then(res => {})
		.catch(err => {})
	}
}
```

# 二. **关于打包的问题**
## 打包命令
    npm run build
## 页面找不到问题
    config -> index.html -> build{}
    assetsPublicPath : './'    //这里   原来是'/',前面加个点  
	
## 打包后文件在本地打不开问题
    cnpm install http-server //相当于在本地搭一个环境  
## 打包成app后点击物理返回键直接退出,安装mui检测返回按键
    cnpm install --save vue-awesome-mui
    
    #main.js
    import Mui from 'vue-awesome-mui';
    
    Vue.use(Mui);
    
```javascript
//index.html
<script type="text/javascript">
  mui.init({
	keyEventBind: {
	  backbutton: true, //关闭back按键监听
	}
  })
  //首页返回键处理
  // 处理逻辑： 1s内，连续两次按返回键，则退出应用；
  var first = null;
  mui.back = function(){
	// 首次按键， 提示 再按一次退出应用
	if(!first){
	  first = new Date().getTime();//记录第一次按下回退键的时间
	  history.go(-1); // 回退到上一页
	  setTimeout(function(){
		//1s 后清除
		first = null;
	  }, 1000);

	}else{
	  if(new Date().getTime() - first < 1000){
		//如果两次按下的时间小于1s
		plus.runtime.quit(); //那么就退出app
	  }
	}
  }
</script>
```
#新建vue-vli3
