### 1. 引擎
#### 1.1 myisam
    t1.frm : 8594 -> 8594
    t2.MYD : 0    -> 200
    t3.MYI : 1024 -> 2048
    
#### 1.2 innodb
    stu.frm : 8594 -> 8594
    stu.idb : 98304-> 98304
    ibdatal : 12582912 -> 12582912
    
                t1表                  t2表
        frm     iab      其余数据      iab      frm
        字段     索引      ibdatal     索引      字段
                部分数据    公共区      部分数据
    OPTIMIIE    TABLE   TABLE.name  // 可压缩ibdatal空间
    
### 2. mysql基本(?show 获取sql命令帮助)
| 命令 | 含义 |
| --- | --- |
| mysql -u username -p password | 直接登陆 |
| mysql -u username -p password database_name | 直接登陆数据库 |
| show databases; | 查看数据库 |
| create database database_name; | 创建数据库 |
| use database_name; | 进入数据库 | 
| show tables; | 查看表 |
| create table table_name(frm1,frm2,frm3); | 创建表 |
| desc table_name; | 查看表字段 |
| \c | 退出错误模式 |
| select * from table_name; | 查看表数据 |
| select * from table_name where name="user" \G; | 查看表数据,行列对调 |
| desc select * from table_name where id =1 \G; | 获取一条SQL语句执行效率 |
| delete from table_name; | 删除表数据 |
| rename table table_name to table_names; | 修改表名 |
| drop table table_name; | 删除表 |
| drop database database_name; | 删除数据库 |
| exit | 退出数据库 |

### 3. 表字段类型
#### 3.1 数值
    tinyint
        有符号 -128 -- 127
        无符号 0 -- 225
        空间   1B
    smallint
        有符号 -32768 -- 32767
        无符号 0 -- 65535
        空间   2B
    mediumint
        有符号 -8388608 -- 8388607
        无符号 0 -- 16777215
        空间   3B
    int
        有符号 -2147483648 -- 2147486347
        无符号 0 -- 4294967295
        空间   4B
    bigint
        有符号 -9223372036854775808 -- 9223372036854775807
        无符号 0 -- 18446744073709551615
        空间   8B
    
    数值提示
        后面圆括号的数字不是最大长度, 是zerofill打开的情况下, 不够规定的长度则左侧补0
        int类型数字大小只受系统决定, 默认情况下: -2亿 到 2亿, 无符号: 0 到 4亿
        
#### 3.2 字符串
    char(M)
        长度 0 -- 1255
        空间 M
    varcahr(M)
        长度 0 -- 65535
        空间 L+1
    tinytext
        长度 0 -- 255
        空间 L+1
    text
        长度 0 -- 65535
        空间 L+2
    mediumtext
        长度 0 -- 16777215
        空间 L+3
    longtext
        长度 0 -- 4294967295
        空间 L+4
        
    字符串提示
        char(250)类型必须是固定长度, 存储空间为250B
        varchar(250)类型是固定长度, 也可以是可变长度, 存储空间为实际长度+1
        
#### 3.3 日期和时间(int)
    系统默认是有日期类型, 比如: date
    实际中因为日期和时间要通用, 所以统一使用int类型
    
    datetime 存储日期
        范围 1000-01-01 00:00:00.000000 - 9999-12-31 23:59:59.999999;
        空间 8个字节
        [current_timestamp] 默认当前时间(5.6以上)
        
    timestamp 存储时间戳(查询时自动转为日期)
        范围 1970-01-01 00:00:01.000000 - 2038-01-19 03:14:07.999999
        空间 4个字节
        [current_timestamp] 默认当前时间
        
### 4. mysql 字段管理
#### 增
| 命令 | 含义 |
| --- | --- |
| after table table_name add 字段名 属性; | 新增字段 |
| after table table_name add 字段名 属性 first; | 在最前面插入一个字段 |
| after table table_name add 字段名 属性 after 某字段; | 在某字段后面新增字段 |

#### 删
| 命令 | 含义 |
| --- | --- |
| alter table table_name drop 字段名; | 删除字段 |

#### 改
| 命令 | 含义 |
| --- | --- |
| alter table table_name change 字段名 新字段名 属性; | 修改字段名及属性 |
| alter table table_name modify 字段名 属性; | 修改属性 |

#### 查
| 命令 | 含义 |
| --- | --- |
| desc table_name; | 查看字段属性 |

### 5. 字段属性
| 属性 | 含义 |
| --- | --- |
| zerofill | 数值左侧补0 |
| unsigned | 无符号 |
| default  | 改变字段默认值 |
| null     | 字段值允许为空 |
| nut null | 字段值不允许为空 |
| auto_increment | 主键值自增, 但须先给字段加主键 |

```mysql
    create table table_name(
        name varchar(20) not null,
        id int unsigned not null,
        age tinyint unsigned not null
    );
```

### 6. 索引管理(词典=索引值)<加快检索速度>
#### 主键索引(PRI 内容唯一索引)
| 命令 | 含义 |
| --- | --- |
| alter table table_name add primary key(id); | 添加 |
| alter table table_name drop primary key; | 删除 |
| desc table_name; | 查看 |

#### 唯一索引(UNI)
| 命令 | 含义 |
| --- | --- | 
| alter table table_name add unique uni_字段; | 添加 |
| alter table table_name drop index uni_字段; | 删除 |
| desc table_name;| 查看 |    

#### 普通索引(MUL)
| 命令 | 含义 |
| --- | --- |
| alter table table_name add index ind_字段; | 添加 |
| alter table table_name drop index ind_字段; | 删除 |
| desc table; | 查看 |

```mysql
# id主键, 自增
# 所有列列类型匹配
# 所有列列属性匹配
# 所有列设置成 not null

create table table_name(
    id int unsigned not null auto_increment primary key,
    name varchar(20) not null,
    age tinyint not null
);
```
### 7. 结构化查询语言SQL的四个部分
    DDL 数据定义语言 create drop alter  
    DML 数据操作语言 insert update delete
    DQL 数据查询语言 select
    DCL 数据控制语言 gront commit rollback
    
### 8. SQL 简单操作
    * 增 insert
        insert into table_name(name) values('user');
    * 删 delete
        删除所有
            delete from table_name; 不含id
            truncate table_name;    包含id
        删除某一条
            delete from table_name where id = 1;
        删除id1-3
            delete from table_name where id>=1 and id<=3;
            delete from table_name where id between 1 and 3;
        删除id1,3,5
            delete from table_name where id = 1 or id = 3 or id = 5;
            delete from table_name where id in(1,3,5);
    * 改 update
        修改所有
            update table_name set username="user1";
        修改某一条(可用于删除某个字段的某一个值)
            update table_name set username="user1" where id = 2;
        修改某一条中的多个字段的数据
            update table_name set username="user1",age=20 where id = 5;
    * 查 select
        查所有
            select * from table_name;
        查某一条数据
            select * from table_name where id = 1;
        查符合条件数据对应列的数据
            select name from table_name where id = 3;
        字段别名
            select name as user from table_name;
            select name user from table_name;
        消除重复值(distinct)
            select distinct username,password from table_name;
        查询空值(null)
            select * from table_name where user is null;
            select * from table_name where user is not null;
        模糊查询(like)
            select * from table_name where user like '%se%';
        排序(order by)
            升序
                select * from table_name order by id;
                select * from table_name order by id asc;
            降序
                select * from table_name order by id desc;
            随机
                select * from order by rand();
                select * from order by rand() limit 3;
            限制输出个数(limit)
                第一条
                    select * from table_name limit 1;
                最后一条
                    select * from table_name order by id desc limit 1;
                取前3条
                    select * from table_name limit 3;
                从第二个开始取三条
                    select * from table_name limit 1,3;
                    
### 9. mysql 常用函数
| 函数 | 含义 | 范例 |
| --- | --- | --- |
| rand()  | 0-1之间的随机数 | |
| concat()| 字符串连接 | select concat('id:',id,'title:',title) id,title from table_name; |
| count() | 统计 | select count(*) from table_name; |
| sum()   | 求和 | select sum(id) from table_name;  | 
| avg()   | 平均值 | select avg(id) from table_name;|
| max()   | 最大值 | select max(id) from table_name;|
| min()   | 最小值 | select min(id) from table_name;|
| group by| 分组聚合| select class,sum(if(score>=60,1,0)) yes,sum(if(score<60,1,0)) no from table_name group by class; |

### 10. 多表查询
    * 普通查询(常用)
        select student.id,student.name,c.username from student,class where student.class_id = class.id;
    * 嵌套查询(已被普通替代)
        select * from student where class_id in(select id from class);
    * 链接查询
        内链接(被普通代替) inner join on
            select student.id,student.name,class.name from student
                inner join class on status.class_id = class.id;
        左链接(常用) left join on
            select student.id,student.name,if(class.name is not null,class.name,'none_class') name from student
                left join class on student.class_id = class.id;
        右链接(已被左链接代替) right join on
            select student.id,student.name,if(class.name is not null,class.name,'none_class') name from class
                right join student on student.class_id = class.id;
                
### 11. 多表之间的关系
* 一对一
* 一对多
* 多对多