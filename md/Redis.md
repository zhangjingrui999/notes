### 1. 概述
    开源的、构建于内存的数据结构数据库;
    常被用作与数据存储、缓存处理和消息处理;
    支持多种数据结构类型;
    原子化操作;	
    简单易用的主从复制功能;
    支持Lua脚本的运行;
    支持LRU缓存算法剔除策略的控制;
    支持事务处理;
    支持不同级别的磁盘持久化处理策略;
    支持通过哨兵和Redis Cluster提供自动分区的高可用服务。
    极高的读写性能
    丰富的数据类型
    原子性操作
    支持主从热备
    丰富的特性
#### 1.1 支持的后端语言 
    C
    Java
    Lua
    PHP
    Python
    Node.js
#### 1.2 高性能缓存
    缓存是Redis最常见的应用场景;
    Redis读写性能优异;
    取代memcached;
    缓存数据;
    缓存Page;
    缓存会话信息session等
#### 1.3 多类型数据结构
| 数据结构 | 含义 |
| --- | --- |
| string | 存储短信验证码，配置信息等 |
| hash	 | 存储用户信息，商品详情，文章信息等 |
| list	 | 有序、如省市区表、字典表等、最新数据信息，消息队列等 |
| set 	 | 集合，唯一性，存储Facebook粉丝、查询共同好友、推荐好友等操作 |
| sorted set  | 有序集合、可以根据顺序列出排行榜数据 |
| HyperLogLog |	计算基数，例如计算庞大的用户数据中，有多少种不同的用户爱好，来自多少个不同的省市 |
| Pub/Sub	  | 构建一个频道聊天系统，例如某些应用网站的业务咨询系统 |
#### 1.4 分布式锁
    Redis分布式;
    高并发下的数据一致性问题;
    单线程;
    用作分布式锁;
    性能优秀，不会成为性能瓶颈
#### 1.5 自动过期
    Redis的键可以设置过期时长;
    一段时间以后自动删除。
#### 1.6 高并发和海量数据的处理
    支持主从热备，保证可用性;
    分片应用应对高并发的请求
#### 1.7 数据持久化
    数据构建于内存当中;
    可进行缓存的设置;
    也可进行数据的持久化存储
### 2. 下载与安装
    官方提供了几款PHP客户端，包括amphp/redis、phpredis、Predis、Rediska。
    官方推荐的两款客户端，phpredis、Predis。
    phpredis是一个二进制版本的PHP客户端，按照的说法，效率要比Predis高。这个版本支持作为Session的Handler。这个扩展的优点在于无需加载任何外部文件，使用比较方便。
    Predis是一个灵活和特性完备（PHP>5.3）的支持Redis的PHP客户端。
        优点就是无须安装PHP扩展包，直接加载使用即可，在保证PHP版本在5.3版本之上的情况下，即使迁移服务器也不收影响。
        缺点就是性能相较于phpredis较差。
```linux
    Windows版本
    下载：https://github.com/MicrosoftArchive/redis/releases
    安装：下载、解压、运行服务端、客户端
    服务端：redis-server.exe [ redis.windows.conf ]
    客户端：redis-cli.exe -h [ IP | 127.0.0.1 ] -p [ 端口 | 6379 ] [ 防中文乱码 | --raw ]	
    
    
    Linux版本
    下载：https://github.com/MicrosoftArchive/redis/releases
    安装：
    下载 	# wget http://download.redis.io/releases/redis-4.0.8.tar.gz
    解压 	# tar xzf redis-4.0.8.tar.gz
    编译 	# cd redis-4.0.8
            # make
            # make install PREFIX=/usr/local/redis
    服务端   # redis-server [ redis.conf ]
    客户端   # redis-cli –h [ IP | 127.0.0.1 ] -p [ 端口 | 6379 ] [ 防中文乱码 | --raw ]

    
    PHP客户端的安装
    下载：
        直接通过官网链接地址：https://redis.io/clients#php
        可以找到phpredis的下载地址，该客户端维护在github上。
        github地址：https://github.com/phpredis/phpredis
    安装：
        由于是PHP的源代码扩展包，因此我们需要手动编译安装：
        首先为源树构建扩展：
            phpize
            ./configure [--enable-redis-igbinary] [--enable-redis-lzf [--with-liblzf[=DIR]]]
            make && make install
            编辑php.ini文件，启用redis模块
            重启php-fpm和Nginx
    测试：
        php –m
        或者phpinfo()
        查看是否已经加载phpredis扩展模块。
        编写程序，测试是否可以连接Redis服务器，测试写入数据。
```
### 3. 命令
#### 3.1 连接
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| echo | echo message | 打印一个特定的信息 message ，测试时使用 | message 自身 |
| ping | ping | 使用客户端向 Redis 服务器发送一个 PING ，如果服务器运作正常的话，会返回一个 PONG | 如果连接正常就返回一个 PONG ，否则返回一个连接错误 |
| quit | quit |	请求服务器关闭与当前客户端的连接 一旦所有等待中的回复(如果有的话)顺利写入到客户端，连接就会被关闭 | 总是返回 OK (但是不会被打印显示，因为当时 Redis-cli 已经退出) |
| select | select index | 切换到指定的数据库，数据库索引号 index 用数字值指定，以 0 作为起始索引值 默认使用 0 号数据库 | 返回值：OK |
| auth | auth password | 通过设置配置文件中 requirepass 项的值(使用命令 CONFIG SET requirepass password )，可以使用密码来保护 Redis 服务器 | 返回值：密码匹配时返回 OK ，否则返回一个错误 |
    ping 
        1.通常用于测试与服务器的连接是否仍然生效，或者用于测量延迟值

    auth
        1.如果开启了密码保护的话，在每次连接 Redis 服务器之后，就要使用 AUTH 命令解锁，解锁之后才能使用其他 Redis 命令
        2.如果 AUTH 命令给定的密码 password 和配置文件中的密码相符的话，服务器会返回 OK 并开始接受命令输入
        3.另一方面，假如密码不匹配的话，服务器将返回一个错误，并要求客户端需重新输入密码
        4.因为 Redis 高性能的特点，在很短时间内尝试猜测非常多个密码是有可能的，因此请确保使用的密码足够复杂和足够长，以免遭受密码猜测攻击
#### 3.2 服务器
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| CONFIG GET | CONFIG GET parameter | CONFIG GET 命令用于取得运行中的 Redis 服务器的配置参数(configuration parameters) | 给定配置参数的值 |
| CONFIG RESETSTAT | CONFIG RESETSTAT | 重置 INFO 命令中的某些统计数据  | 总是返回 OK |
| CONFIG SET | CONFIG SET parameter value | 动态地调整 Redis 服务器的配置(configuration)而无须重启 | 当设置成功时返回 OK ，否则返回一个错误 |
| CONFIG REWRITE | CONFIG REWRITE | 对启动 Redis 服务器时所指定的 redis.conf 文件进行改写 | 一个状态值：如果配置重写成功则返回 OK ，失败则返回一个错误 |
| CLIENT LIST | CLIENT LIST | 以人类可读的格式，返回所有连接到服务器的客户端信息和统计数据 | 命令返回多行字符串 |
| CLIENT SETNAME | CLIENT SETNAME connection-name | 为当前连接分配一个名字 | 设置成功时返回 OK |
| CLIENT GETNAME | CLIENT GETNAME | 返回 CLIENT SETNAME 命令为连接设置的名字 | 返回名字 |
| CLIENT KILL | CLIENT KILL ip:port | 关闭地址为 ip:port 的客户端 | 当指定的客户端存在，且被成功关闭时，返回 OK |
| DBSIZE | DBSIZE | 返回当前数据库的 key 的数量 | 返回当前数据库的 key 的数量 |
| FLUSHDB | FLUSHDB | 清空当前数据库中的所有 key 此命令从不失败 | 总是返回 OK |
| FLUSHALL | FLUSHALL | 清空整个 Redis 服务器的数据(删除所有数据库的所有 key ) 此命令从不失败 | 总是返回 OK |
| INFO | INFO [section] | 以一种易于解释（parse）且易于阅读的格式，返回关于 Redis 服务器的各种信息和统计数值 | 返回相关信息 |
| MONITOR | MONITOR | 实时打印出 Redis 服务器接收到的命令，调试用 | 总是返回 OK 
| TIME | TIME | 返回当前服务器时间 | 一个包含两个字符串的列表： 第一个字符串是当前时间(以 UNIX 时间戳格式表示)，而第二个字符串是当前这一秒钟已经逝去的微秒数 |
| SHUTDOWN | SHUTDOWN [SAVE\|NOSAVE] | 停止所有客户端 | 执行失败时返回错误 |

    CONFIG GET
        1.CONFIG GET 接受单个参数 parameter 作为搜索关键字，查找所有匹配的配置参数，其中参数和值以“键-值对”(key-value pairs)的方式排列
        2.比如执行 CONFIG GET s* 命令，服务器就会返回所有以 s 开头的配置参数及参数的值
        3.所有被 CONFIG SET 所支持的配置参数都可以在配置文件 redis.conf 中找到，不过 CONFIG GET 和 CONFIG SET 使用的格式和 redis.conf 文件所使用的格式有以下两点不同:
            3.1) 10kb 、 2gb 这些在配置文件中所使用的储存单位缩写，不可以用在 CONFIG 命令中， 
                CONFIG SET 的值只能通过数字值显式地设定 像 CONFIG SET xxx 1k 这样的命令是错误的，正确的格式是 CONFIG SET xxx 1000
            3.2) save 选项在 redis.conf 中是用多行文字储存的，但在 CONFIG GET 命令中，它只打印一行文字
    
    CONFIG RESETSTAT
        1.Keyspace hits (键空间命中次数)
        2.Keyspace misses (键空间不命中次数)
        3.Number of commands processed (执行命令的次数)
        4.Number of connections received (连接服务器的次数)
        5.Number of expired keys (过期key的数量)
        6.Number of rejected connections (被拒绝的连接数量)
        7.Latest fork(2) time(最后执行 fork(2) 的时间)
        8.The aof_delayed_fsync counter(aof_delayed_fsync 计数器的值)
    
    CONFIG SET
        1.可以使用它修改配置参数，或者改变 Redis 的持久化(Persistence)方式
        2.CONFIG SET 可以修改的配置参数可以使用命令 CONFIG GET * 来列出，所有被 CONFIG SET 修改的配置参数都会立即生效
    
    CONFIG REWRITE
        1.因为 CONFIG SET 命令可以对服务器的当前配置进行修改， 而修改后的配置可能和 redis.conf 文件中所描述的配置不一样
            CONFIG REWRITE 的作用就是通过尽可能少的修改， 将服务器当前所使用的配置记录到 redis.conf 文件中
        2.重写会以非常保守的方式进行：
            2.1) 原有 redis.conf 文件的整体结构和注释会被尽可能地保留。
            2.2) 如果一个选项已经存在于原有 redis.conf 文件中 ， 那么对该选项的重写会在选项原本所在的位置（行号）上进行。
            2.3) 如果一个选项不存在于原有 redis.conf 文件中， 并且该选项被设置为默认值， 那么重写程序不会将这个选项添加到重写后的 redis.conf 文件中。
            2.4) 如果一个选项不存在于原有 redis.conf 文件中， 并且该选项被设置为非默认值， 那么这个选项将被添加到重写后的 redis.conf 文件的末尾。
            2.5) 未使用的行会被留白。 
                比如说， 如果在原有 redis.conf 文件上设置了数个关于 save 选项的参数， 但现在将这些 save 参数的一个或全部都关闭了， 那么这些不再使用的参数原本所在的行就会变成空白的
        3.即使启动服务器时所指定的 redis.conf 文件已经不再存在， CONFIG REWRITE 命令也可以重新构建并生成出一个新的 redis.conf 文件。
        4.另一方面， 如果启动服务器时没有载入 redis.conf 文件， 那么执行 CONFIG REWRITE 命令将引发一个错误。
        5.对 redis.conf 文件的重写是原子性的， 
            并且是一致的： 如果重写出错或重写期间服务器崩溃， 那么重写失败， 原有 redis.conf 文件不会被修改。 如果重写成功， 那么 redis.conf 文件为重写后的新文件
    
    CLIENT GETNAME
        1.因为新创建的连接默认是没有名字的， 对于没有名字的连接， CLIENT GETNAME 返回空白回复
    
    CLIENT KILL
        1.ip:port 应该和 CLIENT LIST 命令输出的其中一行匹配
    
    SHUTDOWN
        1.如果有至少一个保存点在等待，执行 SAVE 命令
        2.如果 AOF 选项被打开，更新 AOF 文件
        3.关闭 redis 服务器(server)

### 4. 字符型
#### 4.1 定义
    String类型是Redis能与键关联的最简单的数据类型，它是Memcached当中仅有的数据类型，因此可以很快地被初学者学习。
    Redis的Key名称也是一个字符串，当我们使用字符串类型作为其对应的值时，我们可以根据Key名称来查找映射对应的值。
    Redis字符串是二进制安全的，这意味着一个Redis字符串能包含任意类型的数据，例如： 一张JPEG格式的图片或者一个序列化的Ruby对象。
    一个字符串类型的值最多能存储512MB的内容。
#### 4.2 应用场景
| 应用场景 |
| ---    |
| 用户签到 |
| 分布式锁 |
| 防止重复提交 |
| 统计活跃用户 |
| 用户在线状态 |
| 每天注册用户数 |
| 统计网站访问者数量 |
| 高速缓存会话控制数据 |
| 高速缓存HTML片段或者页面 |
| 限制API在某一时段的访问次数 |
| 高速缓存关系型数据库查询的数据结果 |
| 存储设置固定格式的字符串序列（例如：时间序列）|
#### 4.3 设置
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| SET | SET key value [EX seconds] [PX milliseconds] [NX\|XX] | 给一个key添加字符串类型的值，如果该key已经存在，值会被新值覆盖，不论是什么类型的key SET设置后的键，之前的生存时间会被丢弃 | 如果设置成功，返回OK 如果设置失败，返回nil |
| MSET | MSET key value [key value ...] | 同时设置多个key，如果key存在会覆盖 MSET是原子的，所有键会同时设置成功或者失败 | 成功返回ok |
| SETEX | SETEX key seconds value | 给一个键设置为字符串类型，并指定生存时间（单位：秒）该命令是原子的，如果设置失败或者指定生存时间失败，会恢复初始状态 | 如果设置成功，返回OK 如果设置失败，返回错误信息 |
| PSETEX| PSETEX key milliseconds value | 给一个键设置为字符串类型，并指定生存时间（单位：毫秒）该命令是原子的，如果设置失败或者指定生存时间失败，会恢复初始状态 | 如果设置成功，返回OK 如果设置失败，返回错误信息 |
| SETNX | SETNX key value | 如果key不存在，将其设置为字符串类型 | 如果设置成功，返回1 如果设置失败，返回0 |
| MSETNX | MSETNX key value [key value ...] | 同时设置多个key，如果其中一个key存在则设置失败，不考虑其他键是否存在 MSETNX是原子的，所有键会同时设置成功或者失败 | 如果所有键设置成功返回1 如果所有键设置失败返回0 |
| SETRANGE | SETRANGE key offset value | 修改或者设置一个键的字符串类型值的内容 | 成功返回字符串长度，失败返回错误信息 |
| APPEND | APPEND key value | 如果key存在，则在后面追加value的内容 如果key不存在，会创建一个key，并设置其值为空字符串，并在后追加value的内容 | 追加成功以后的字符串长度 |

	SET
	    选项：EX seconds（生存时间：秒） / PX milliseconds（生存时间：毫秒） / NX（仅在键不存在时设置） / XX（仅在键存在时设置）
    
    SETRANGE
        如果键不存在，就设置一个新的，并且补充offset个NULL，再加入value，换句话说，值为 “offset个NULL+value”。
        如果键已经存在，从该键值offset处开始插入value，如果offset的值大于该键字符串长度，用NULL补充到该长度，再末尾插入value。
		注意事项：offset最大值229 -1（536870911）。
#### 4.4 查询
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| GET | GET key | 查询key的值 | 如果键不存在，返回nil 如果key不是String类型，返回错误信息 |
| MGET| MGET key [key …] | 查询所有key的值 | 列出所有键的值，绝不会执行失败，如果键是String类型，返回其值，如果键不存在或者不是String类型，返回 nil |
| GETRANGE | GETRANGE key start end | 查询一个字符串的子串，子串的内容取决于start和end（两个参数都必需） | 如果key存在，返回字符串的子串内容，如果key不存在，返回空字符串，如果key不是String类型，返回错误信息 |
| STRLEN | STRLEN key | 返回key的字符串长度 | 字符串长度，如果key不存在返回0，如果不是字符串类型，返回错误信息 |
| GETSET | GETSET key value | 原子地给一个key设置value并且将旧值返回 应用场景：获取计数器并且重置为0 | 如果key不是字符串类型，返回一个错误 |

    GETRANGE
        start和end可以为负数
        -1代表最后一个字符，-2代表倒数第二个字符 
#### 4.5 键的计数操作
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| INCR | INCR key | 将 key 中储存的数字值增一 | 如果值包含错误的类型，或字符串类型的值不能表示为数字，返回一个错误  如果执行成功，返回执行 INCR 命令之后 key 的值 |
| INCRBY | INCRBY key increment  | 将 key 所储存的值加上增量 increment | 如果值包含错误的类型，或字符串类型的值不能表示为数字，返回一个错误 如果执行成功，返回执行 INCRBY 命令之后 key 的值 |
| INCRBYFLOAT | INCRBYFLOAT key increment  | 为 key 中所储存的值加上浮点数增量 increment | 执行成功返回更新以后的值 |
| DECR | DECR key | 将 key 中储存的数字值减一 | 如果值包含错误的类型，或字符串类型的值不能表示为数字，返回一个错误 如果执行成功，返回执行 DECR 命令之后 key 的值 |
| DECRBY | DECRBY key increment | 将 key 所储存的值加上增量 decrement | 如果值包含错误的类型，或字符串类型的值不能表示为数字，返回一个错误 如果执行成功，返回执行 DECRBY 命令之后 key 的值 |

    key
        如果 key 不存在，那么 key 的值会先被初始化为 0，然后再执行 INCR 操作
        本操作的值限制在 64 位(bit)有符号数字表示之内。Key的值必须是整型
        
	INCRBY
		如果 key 不存在，那么 key 的值会先被初始化为 0 ，然后再执行 INCRBY 命令。
		本操作的值限制在 64 位(bit)有符号数字表示之内。Key的值必须是整型。

	INCRBYFLOAT
		如果 key 不存在，那么 INCRBYFLOAT 会先将 key 的值设为 0 ，再执行加法操作。可以使用科学计数法

	DECR
        如果 key 不存在，那么 key 的值会先被初始化为 0，然后再执行 DECR 操作。
        本操作的值限制在 64 位(bit)有符号数字表示之内。Key的值必须是整型。

	DECRBY
        如果 key 不存在，那么 key 的值会先被初始化为 0 ，然后再执行 DECRBY 命令。
        本操作的值限制在 64 位(bit)有符号数字表示之内。Key的值必须是整型。
#### 4.6 键的二进制操作
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| SETBIT | SETBIT key offset value | 对 key 所储存的字符串值 | 当 key 不存在时，自动生成一个新的字符串值 指定偏移量原来储存的位 |
| GETBIT | GETBIT key offset | 对 key 所储存的字符串值，获取指定偏移量上的位(bit) | 当 offset 比字符串值的长度大，或者 key 不存在时，返回 0  字符串值指定偏移量上的位(bit) |
| BITCOUNT | BITCOUNT key [start] [end] | 计算给定字符串中，被设置为 1 的比特位的数量 | 不存在的 key 被当成是空字符串来处理 |
| BITOP | BITOP operation destkey key [key ...] | 对一个或多个保存二进制位的字符串 key 进行位元操作，并将结果保存到 destkey 上 | 保存到 destkey 的字符串的长度，和输入 key 中最长的字符串长度相等 |
| BITPOS | BITPOS key bit [start] [end] | 返回字符串里面第一个被设置为1或者0的bit位 | 命令返回字符串里面第一个被设置为1或者0的bit位 |
| BITFIELD | BITFIELD key [GET type offset] [SET type offset value] [INCRBY type offset increment] [OVERFLOW WRAP\|SAT\|FAIL] | 本命令会把Redis字符串当作位数组，并能对变长位宽和任意未字节对齐的指定整型位域进行寻址 | |
    
    SETBIT
        设置或清除指定偏移量上的位(bit),位的设置或清除取决于 value 参数，可以是 0 也可以是 1 
        字符串会进行伸展(grown)以确保它可以将 value 保存在指定的偏移量上。
        当字符串值进行伸展时，空白位置以 0 填充。offset 参数必须大于或等于 0 ，小于 2^32 (bit 映射被限制在 512 MB 之内)。
    
    BITCOUNT
        一般情况下，给定的整个字符串都会被进行计数，通过指定额外的 start 或 end 参数，可以让计数只在特定的位上进行。
        不存在的 key 被当成是空字符串来处理，因此对一个不存在的 key 进行 BITCOUNT 操作，结果为 0 / 被设置为 1 的位的数量。
    
    BITOP
        OPERATION：
            可以是 AND 、 OR 、 NOT 、 XOR 这四种操作中的任意一种。
            除了 NOT 操作之外，其他操作都可以接受一个或多个 key 作为输入。
        注意：当 BITOP 处理不同长度的字符串时，较短的那个字符串所缺少的部分会被看作 0 。空的 key 也被看作是包含 0 的字符串序列。
    
    BITPOS
        如果我们在空字符串或者0字节的字符串里面查找bit为1的内容，那么结果将返回-1。
    
    BITFIELD
        在实践中，可以使用该命令对一个有符号的5位整型数的1234位设置指定值，也可以对一个31位无符号整型数的4567位进行取值。
        类似地，在对指定的整数进行自增和自减操作，本命令可以提供有保证的、可配置的上溢和下溢处理操作。
        返回值：
            GET 当前偏移位置所在的值。
            SET 当前偏移量的旧值。
            INCRBY 当前偏移量的旧值。
            Nil 设置失败。
            值的类型有误或者命令语法有误返回错误。
### 5. Hash
#### 5.1 定义
    Redis 中的 Hash 类型可以看成是具有 String key 和 String value 的 map 容器。
    该类型非常适合存储对象信息。
    每一个 Hash 可以存储 4294967295 个键值对
#### 5.2 应用场景
| 应用场景 |
| ---    |
| 会员信息 |
| 用户购物车数据 |
#### 5.3 设置
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| HSET | HSETNX key field value | 将哈希表 key 中的域 field 的值设为 value | 1 0 |
| HSETNX | HSETNX key field value | 将哈希表 key 中的域 field 的值设置为 value ，当且仅当域 field 不存在 | 1 0 |
| HMSET  | HMSET key field value [field value ...] | 同时将多个 field-value (域-值)对设置到哈希表 key 中 | ok error |
| HINCRBY | HINCRBY key field increment | 为哈希表 key 中的域 field 的值加上增量 increment | 返回执行 HINCRBY 命令之后，哈希表 key 中域 field 的值 |
| HINCRBYFLOAT | HINCRBYFLOAT key field increment | 为哈希表 key 中的域 field 的值加上浮点数增量 increment | 执行加法操作之后 field 域的值 |

    HSET
        如果 key 不存在，一个新的哈希表被创建并进行 HSET 操作
        如果域 field 已经存在于哈希表中，旧值将被覆盖
        如果 field 是哈希表中的一个新建域，并且值设置成功，返回 1 
        如果哈希表中域 field 已经存在且旧值已被新值覆盖，返回 0
  
    HSETNX
        若域 field 已经存在，该操作无效
        如果 key 不存在，一个新哈希表被创建并执行 HSETNX 命令
        设置成功，返回 1 
        如果给定域已经存在且没有操作被执行，返回 0
  
  	HMSET
        此命令会覆盖哈希表中已存在的域
        如果 key 不存在，一个空哈希表被创建并执行 HMSET 操作
        如果命令执行成功，返回 OK
        当 key 不是哈希表(hash)类型时，返回一个错误
  
  	HINCRBY
        为哈希表 key 中的域 field 的值加上增量 increment
        增量也可以为负数，相当于对给定域进行减法操作
        如果 key 不存在，一个新的哈希表被创建并执行 HINCRBY 命令
        如果域 field 不存在，那么在执行命令前，域的值被初始化为 0 
        对一个储存字符串值的域 field 执行 HINCRBY 命令将造成一个错误
        本操作的值被限制在 64 位(bit)有符号数字表示之内
  
  	HINCRBYFLOAT
        如果哈希表中没有域 field ，那么 HINCRBYFLOAT 会先将域 field 的值设为 0 ，然后再执行加法操作
        如果键 key 不存在，那么 HINCRBYFLOAT 会先创建一个哈希表，再创建域 field ，最后再执行加法操作
        域 field 的值不是字符串类型 或者域 field 当前的值或给定的增量 increment 不能解释(parse)为双精度浮点数 返回错误
#### 5.4 查询
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| HGET | HGET key field | 返回哈希表 key 中给定域 field 的值 | 返回给定域的值 当给定域不存在或是给定 key 不存在时，返回 nil |
| HGETALL | HGETALL key | 返回哈希表 key 中，所有的域和值 | 以列表形式返回哈希表的域和域的值 若 key 不存在，返回空列表 |
| HMGET | HMGET key field [field ...] | 返回哈希表 key 中，一个或多个给定域的值 | 一个包含多个给定域的关联值的表，表值的排列顺序和给定域参数的请求顺序一样 |
| HKEYS | HKEYS key | 返回哈希表 key 中的所有域 | 一个包含哈希表中所有域的表 当 key 不存在时，返回一个空表 |
| HEXISTS | HVALS key field | 查看哈希表 key 中，给定域 field 是否存在 | 如果哈希表含有给定域，返回 1 如果哈希表不含有给定域，或 key 不存在，返回 0 |
| HLEN | HLEN key | 返回哈希表 key 中域的数量 | 哈希表中域的数量 当 key 不存在时，返回 0 |
| HSTRLEN | HSTRLEN key field | 返回哈希表 key 中， 与给定域 field 相关联的值的字符串长度(string length) | 返回一个整数 如果给定的键或者域不存在， 那么命令返回 0 |
	HGETALL
        在返回值里，紧跟每个域名(field name)之后是域的值(value)，所以返回值的长度是哈希表大小的两倍

	HMGET	
        如果给定的域不存在于哈希表，那么返回一个 nil 值
#### 5.5 键的计数操作
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| HDEL | HDEL key field [field …] | 删除哈希表 key 中的一个或多个指定域，不存在的域将被忽略 | 被成功移除的域的数量，不包括被忽略的域 |
### 6. List
#### 6.1 定义
    Redis列表是简单的字符串列表，按照插入顺序排序。
    可以添加一个元素到列表的头部（左边）或者尾部（右边）。
    一个列表最多可以包含 232 - 1 个元素 (4294967295, 每个列表超过40亿个元素)。
#### 6.2 应用场景
| 应用场景 |
| --- |
| 粉丝列表 |
| 时间轴（Timeline）|
| 最新文章 |
| 消息队列 |
#### 6.3 设置
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| LPUSH | LPUSH key value [value ...] | 将一个或多个值 value 插入到列表 key 的表头 | 执行 LPUSH 命令后，列表的长度；如果key不是列表，返回一个错误 |
| LPUSHX | LPUSHX key value | 将值 value 插入到列表 key 的表头，当且仅当 key 存在并且是一个列表 和 LPUSH 命令相反，当 key 不存在时， LPUSHX 命令什么也不做 | LPUSHX 命令执行之后，表的长度 |
| LINSERT | LINSERT key BEFORE\|AFTER pivot value | 将值 value 插入到列表 key 当中，位于值 pivot 之前或之后 | 如果命令执行成功，返回插入操作完成之后，列表的长度；如果没有找到 pivot ，返回 -1；如果 key 不存在或为空列表，返回 0 |
| LSET | LSET key index value | 将列表 key 下标为 index 的元素的值设置为 value | 操作成功返回 ok ，否则返回错误信息 |
| RPUSH | RPUSH key value [value …] | 将一个或多个值 value 插入到列表 key 的表尾(最右边) | 执行 RPUSH 操作后，表的长度 |
| RPUSHX | RPUSHX key value | 将值 value 插入到列表 key 的表尾，当且仅当 key 存在并且是一个列表 和 RPUSH 命令相反，当 key 不存在时， RPUSHX 命令什么也不做 | 执行 RPUSHX 操作后，表的长度 |

    LPUSH	
        如有多个 value 值，那么各个 value 值按从左到右的顺序依次插入到表头
        操作为原子性操作，如果 key 不存在，一个空列表会被创建并执行 LPUSH 操作

    LINSERT
        当 pivot 不存在于列表 key 时，不执行任何操作
        当 key 不存在时， key 被视为空列表，不执行任何操作
        
    LSET
        当 index 参数超出范围，或对一个空列表( key 不存在)进行 LSET 时，返回一个错误
        当 key 不存在时， key 被视为空列表，不执行任何操作

	RPUSH
        如有多个 value 值，那么各个 value 值按从左到右的顺序依次插入到表尾
        如果 key 不存在，一个空列表会被创建并执行 RPUSH 操作
#### 6.4 查询
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| LINDEX | LINDEX key index | 返回列表 key 中，下标为 index 的元素，0为第一个元素，-1为最后一个元素 列表中下标为 index 的元素 | 如果 index 参数的值不在列表的区间范围内(out of range)，返回 nil |
| LLEN | LLEN key | 返回列表 key 的长度 | 如果 key 不存在，则 key 被解释为一个空列表，返回 0  列表 key 的长度 |
| LRANGE | LRANGE key start stop |  返回列表 key 中指定区间内的元素，区间以偏移量 start 和 stop 指定| 一个列表，包含指定区间内的元素 超出范围的下标值不会引起错误 |
    
    LRANGE
        下标(index)参数 start 和 stop 都以 0 为底
        你也可以使用负数下标，以 -1 表示列表的最后一个元素
#### 6.5 删除操作
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| LPOP | LPOP key | 移除并返回列表 key 的头元素 | 列表的头元素 当 key 不存在时，返回 nil |
| LREM | LREM key count value | 根据参数 count 的值，移除列表中与参数 value 相等的元素 | 被移除元素的数量 |
| LTRIM| LTRIM key start stop | 对一个列表进行修剪(trim)，就是说，让列表只保留指定区间内的元素，不在指定区间之内的元素都将被删除 | 命令执行成功时，返回 ok |
| RPOP | RPOP key | 移除并返回列表 key 的尾元素 | 列表的尾元素 当 key 不存在时，返回 nil |
| RPOPLPUSH | RPOPLPUSH source destination | | 返回被弹出的元素 |
    LREM
        count > 0 : 从表头开始向表尾搜索，移除与 value 相等的元素，数量为 count；
        count < 0 : 从表尾开始向表头搜索，移除与 value 相等的元素，数量为 count 的绝对值；
        count = 0 : 移除表中所有与 value 相等的值

    RPOPLPUSH
        命令 RPOPLPUSH 在一个原子时间内，执行以下两个动作：
            将列表 source 中的最后一个元素(尾元素)弹出，并返回给客户端；
            将 source 弹出的元素插入到列表 destination ，作为 destination 列表的的头元素
#### 6.6 阻塞式操作
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| BLPOP | BLPOP key [key …] timeout | BLPOP 是列表的阻塞式(blocking)弹出原语，LPOP 命令的阻塞版本，当给定列表内没有任何元素可供弹出的时候，连接将被 BLPOP 命令阻塞，直到等待超时或发现可弹出元素为止 | 被弹出的元素 |
| BRPOP | BRPOP key [key …] timeout | BRPOP 除了弹出元素的位置和 BLPOP 不同之外，其他表现一致 |  假如在指定时间内没有任何元素被弹出，则返回一个 nil 和等待时长 反之，返回一个含有两个元素的列表，第一个元素是被弹出元素所属的 key ，第二个元素是被弹出元素的值 |
| BRPOPLPUSH | BRPOPLPUSH source destination timeout | BRPOPLPUSH 是 RPOPLPUSH 的阻塞版本 | 假如在指定时间内没有任何元素被弹出，则返回一个 nil 和等待时长 反之，返回一个含有两个元素的列表，第一个元素是被弹出元素的值，第二个元素是等待时长 |
    
    BRPOPLPUSH
        当给定列表 source 不为空时， BRPOPLPUSH 的表现和 RPOPLPUSH 一样
        当列表 source 为空时， BRPOPLPUSH 命令将阻塞连接，直到等待超时，或有另一个客户端对 source 执行 LPUSH 或 RPUSH 命令为止
        超时参数 timeout 接受一个以秒为单位的数字作为值。超时参数设为 0 表示阻塞时间可以无限期延长(block indefinitely)
### 7. Set集合
#### 7.1 di定义
    Redis 的 Set 是 String 类型的无序集合。
    集合成员是唯一的，这就意味着集合中不能出现重复的数据。
    集合中最大的成员数为 232 - 1 (4294967295, 每个集合可存储40多亿个成员)。
#### 7.2 应用场景
| 应用场景 |
| --- |
| 共同好友 |
| 好友推荐 |
#### 7.3 设置
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| SADD | SADD key member [member ...] | 将一个或多个 member 元素加入到集合 key 当中，已经存在于集合的 member 元素将被忽略 | 被添加到集合中的新元素的数量，不包括被忽略的元素 |

    假如 key 不存在，则创建一个只包含 member 元素作成员的集合
    当 key 不是集合类型时，返回一个错误
#### 7.4 查询
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| SCARD | SCARD key | 返回集合 key 的基数(集合中元素的数量) | 集合的基数, 当 key 不存在时，返回 0 |
| SMEMBERS | SMEMBERS key | 返回集合 key 中的所有成员,不存在的 key 被视为空集合 | 集合中的所有成员 |
| SISMEMBER| SISMEMBER key member | 判断 member 元素是否集合 key 的成员 | 如果 member 元素是集合的成员，返回 1,如果 member 元素不是集合的成员，或 key 不存在，返回 0 |
| SRANDMEMBER | SRANDMEMBER key [count] | 如果命令执行时，只提供了 key 参数，那么返回集合中的一个随机元素 | 只提供 key 参数时，返回一个元素；如果集合为空，返回 nil | 如果提供了 count 参数，那么返回一个数组；如果集合为空，返回空数组 |
| SSCAN | SSCAN key cursor [MATCH pattern] [COUNT count] | 用于迭代集合键中的元素 | 集合成员 |
#### 7.5 集合类型键之间的关系
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| SDIFF | SDIFF key [key …] | 返回一个集合的全部成员，该集合是所有给定集合之间的差集 存在的 key 被视为空集 | 一个包含差集成员的列表 |
| SDIFFSTORE | SDIFFSTORE destination key [key …] | 这个命令的作用和 SDIFF 类似，但它将结果保存到 destination 集合，而不是简单地返回结果集 | 结果集中的元素数量 |
| SINTER | SINTER key [key …] | 返回一个集合的全部成员，该集合是所有给定集合的交集 | 交集成员的列表 |
| SINTERSTORE | SINTERSTORE destination key [key …] | 这个命令类似于 SINTER 命令，但它将结果保存到 destination 集合，而不是简单地返回结果集 | 结果集中的成员数量 |
| SUNION | SUNION key [key …] | 返回一个集合的全部成员，该集合是所有给定集合的并集 不存在的 key 被视为空集 | 并集成员的列表 |
| SUNIONSTORE | SUNIONSTORE destination key [key …] | 这个命令类似于 SUNION 命令，但它将结果保存到 destination 集合，而不是简单地返回结果集 | 结果集中的成员数量 |
     
    SDIFFSTORE
        如果 destination 集合已经存在，则将其覆盖
        destination 可以是 key 本身
  
    SINTER 
        不存在的 key 被视为空集
        当给定集合当中有一个空集时，结果也为空集(根据集合运算定律)
  
  	SINTERSTORE
        如果 destination 集合已经存在，则将其覆盖
        destination 可以是 key 本身
  
    SUNIONSTORE
        如果 destination 集合已经存在，则将其覆盖
        destination 可以是 key 本身
#### 7.6 删除
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| SPOP |  SPOP key | 移除并返回集合中的一个随机元素 | 被移除的随机元素 当 key 不存在或 key 是空集时，返回 nil |
| SREM | SREM key member [member …] | 移除集合 key 中的一个或多个 member 元素，不存在的 member 元素会被忽略 当 key 不是集合类型，返回一个错误 | 被成功移除的元素的数量，不包括被忽略的元素 |
| SMOVE | SMOVE source destination member | 将 member 元素从 source 集合移动到 destination 集合 | 如果 member 元素被成功移除，返回 1 |

    SMOVE
        SMOVE 是原子性操作
        如果 source 集合不存在或不包含指定的 member 元素，则 SMOVE 命令不执行任何操作，仅返回 0 。
        当 destination 集合已经包含 member 元素时， SMOVE 命令只是简单地将 source 集合中的 member 元素删除
        如果 member 元素不是 source 集合的成员，并且没有任何操作对 destination 集合执行，那么返回 0
        当 source 或 destination 不是集合类型时，返回一个错误
### 8. Zset有序集合
#### 8.1 定义
    Redis 有序集合和集合一样，也是string类型元素的集合，且不允许重复的成员。
    不同的是每个元素都会关联一个double类型的分数。
    Redis正是通过分数来为集合中的成员进行从小到大的排序。
    有序集合的成员是唯一的,但分数(score)却可以重复。
    集合中最大的成员数为 232 - 1 (4294967295, 每个集合可存储40多亿个成员)。
#### 8.2 应用场景
| 应用场景 |
| --- |
| 排行榜 |
#### 8.3 设置
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| ZADD | ZADD key score member [[score member] [score member] ...] | 将一个或多个 member 元素及其 score 值加入到有序集 key 当中 | 被成功添加的新成员的数量，不包括那些被更新的、已经存在的成员 |
| ZINCRBY | ZINCRBY key increment member | 为有序集 key 的成员 member 的 score 值加上增量 increment （可负）当 key 不存在，或 member 不是 key 的成员时，ZINCRBY 等同于 ZADD | 当 key 不是有序集类型时，返回一个错误。member 成员的新 score 值，以字符串形式表示 |

    ZADD
        如果某个 member 已经是有序集的成员，那么更新这个 member 的 score 值，并通过重新插入这个 member 元素，来保证该 member 在正确的位置上。
        score 值可以是整数值或双精度浮点数。
        如果 key 不存在，则创建一个空的有序集并执行 ZADD 操作。
        当 key 存在但不是有序集类型时，返回一个错误。
#### 8.4 查询
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| ZCARD | ZCARD key | 返回有序集合 key 的基数(有序集合中元素的数量) | 当 key 存在且是有序集类型时，返回有序集的基数 当 key 不存在时，返回 0 |
| ZCOUNT | ZCOUNT key min max | 返回有序集 key 中， score 值在 min 和 max 之间(默认包括 score 值等于 min 或 max )的成员的数量 | score 值在 min 和 max 之间的成员的数量 |
| ZRANGE | ZRANGE key start stop [WITHSCORES] | 返回返回有序集 key 中，指定区间内的成员 | 其中成员的位置按 score 值递增(从小到大)来排序 | 指定区间内，带有 score 值(可选)的有序集成员的列表 |
| ZRANGEBYSCORE | ZRANGEBYSCORE key min max [WITHSCORES] [LIMIT offset count] | 返回有序集 key 中，所有 score 值介于 min 和 max 之间(包括等于 min 或 max )的成员。有序集成员按 score 值递增(从小到大)次序排列 | 指定区间内，带有 score 值(可选)的有序集成员的列表 |
| ZRANK | ZRANK key member | 返回有序集 key 中成员 member 的排名。其中有序集成员按 score 值递增(从小到大)顺序排列 | 如果 member 是有序集 key 的成员，返回 member 的排名 |
| ZREVRANGE | ZREVRANGE key start stop [WITHSCORES] | 返回有序集 key 中，指定区间内的成员 其中成员的位置按 score 值递减(从大到小)来排列 | 指定区间内，带有 score 值(可选)的有序集成员的列表 | 
| ZREVRANGEBYSCORE | ZREVRANGEBYSCORE key max min [WITHSCORES] [LIMIT offset count] | 返回有序集 key 中， score 值介于 max 和 min 之间(默认包括等于 max 或 min )的所有的成员。有序集成员按 score 值递减(从大到小)的次序排列 | 指定区间内，带有 score 值(可选)的有序集成员的列表 |
| ZREVRANK | ZREVRANK key member | 返回有序集 key 中成员 member 的排名。其中有序集成员按 score 值递减(从大到小)排序 | 如果 member 是有序集 key 的成员，返回 member 的排名 |
| ZSCORE | ZSCORE key member | 返回有序集 key 中，成员 member 的 score 值 如果 member 元素不是有序集 key 的成员，或 key 不存在，返回 nil | member 成员的 score 值，以字符串形式表示 |
| ZSCAN | ZSCAN key cursor [MATCH pattern] [COUNT count] | 用于迭代有序集合键中的元素 | 有序集合成员 |
| ZRANGEBYLEX | ZRANGEBYLEX key min max [LIMIT offset count] | 当有序集合的所有成员都具有相同的分值时， 有序集合的元素会根据成员的字典序（lexicographical ordering）来进行排序， 而这个命令则可以返回给定的有序集合键 key 中， 值介于 min 和 max 之间的成员 | 数组回复：一个列表，列表里面包含了有序集合在指定范围内的成员 |
| ZLEXCOUNT | ZLEXCOUNT key min max | 对于一个所有成员的分值都相同的有序集合键 key 来说， 这个命令会返回该集合中， 成员介于 min 和 max 范围内的元素数量 | 整数回复：指定范围内的元素数量 |
    ZRANK
        排名以 0 为底，也就是说， score 值最小的成员排名为 0 。
        如果 member 不是有序集 key 的成员，返回 nil 。

    ZREVRANK
        ZREVRANK key member
        排名以 0 为底，也就是说， score 值最大的成员排名为 0 。
        如果 member 不是有序集 key 的成员，返回 nil 。
### 9. 键
#### 9.1 键名查询
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| KEYS | KEYS pattern | 返回匹配模式的所有键名 | 返回匹配模式的所有键名 |
| EXISTS | EXISTS key [key ...] | 检查给定 key 是否存在 | 1 代表存在 0 代表不存在 |
| SCAN | SCAN cursor [MATCH pattern] [COUNT count] | SCAN 命令每次被调用之后， 都会向用户返回一个新的游标， 用户在下次迭代时需要使用这个新游标作为 SCAN 命令的游标参数， 以此来延续之前的迭代过程 | 完整遍历的数据 |
| RANDOMKEY | RANDOMKEY | 从当前数据库随机返回一个键名 | 键名 |
| TYPE | TYPE key | 查询键的类型 | 返回存储在键的值的类型的字符串表示形式。 可以返回的不同类型是：string，list，set，zset和hash |
| OBJECT | OBJECT subcommand [arguments [arguments ...]] | 从内部察看给定 key 的 Redis 对象 | REFCOUNT 和 IDLETIME 返回数字 / ENCODING 返回相应的编码类型 |
    KEYS Pattern的用法：
        ?
        *
        [ae]
        [^ae]
        [a-c]

    OBJECT 子命令：
        OBJECT REFCOUNT <key>
        OBJECT ENCODING <key>
        OBJECT IDLETIME <key>
#### 9.2 键的重命名操作
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| RENAME | RENAME key newkey | 将 key 改名为 newkey | 当 key 和 newkey 相同，或者 key 不存在时，返回一个错误 |
| RENAMENX | RENAMENX key newkey | 当且仅当 newkey 不存在时，将 key 改名为 newkey | 当 key 不存在时，返回一个错误, 当修改成功时，返回 1, 如果 newkey 已经存在，返回 0 |
    RENAME
        当 newkey 已经存在时， RENAME 命令将覆盖旧值。
        改名成功时提示 OK ，失败时候返回一个错误。
#### 9.3 键的修改最后访问时间
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| TOUCH | TOUCH key [key ...] | 修改key的最后访问时间为当前时间 | 返回设置成功的键的数量 |
#### 9.4 键的删除操作
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |	
| DEL | DEL key [key ...] | 删除指定的键 | 返回删除的键的数量 |
| UNLINK | UNLINK key [key ...] | 非阻塞删除指定的键 | 返回删除的键的数量 |
#### 9.5 键的过期时长的设定
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |	
| EXPIRE | EXPIRE key seconds | 为给定 key 设置生存时间，当 key 过期时(生存时间为 0 )，它会被自动删除 | 设置成功返回 1 ，否则返回 0 |
| EXPIREAT | EXPIREAT key timestamp | EXPIREAT 的作用和 EXPIRE 类似，都用于为 key 设置生存时间 | 如果生存时间设置成功，返回 1 当 key 不存在或没办法设置生存时间，返回 0 |
| PEXPIRE | PEXPIRE key milliseconds | 使用方法与EXPIRE一致，但是时间是毫秒 | 设置成功返回 1 ，否则返回 0 |
| PEXPIREAT | PEXPIREAT key milliseconds-timestamp | 与EXPIREAT 使用方法一致，时间为时间戳毫秒 | 如果生存时间设置成功，返回 1 当 key 不存在或没办法设置生存时间，返回 0 |
    EXPIREAT
        不同在于 EXPIREAT 命令接受的时间参数是 UNIX 时间戳(unix timestamp)
#### 9.6 键的过期时长的查询
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |	
| TTL | TTL key | 以秒为单位，返回给定 key 的剩余生存时间(TTL, time to live) | 以秒为单位，返回 key 的剩余生存时间 |
| PTTL | PTTL key | 这个命令类似于 TTL 命令，但它以毫秒为单位返回 key 的剩余生存时间，而不是像 TTL 命令那样，以秒为单位 | 以毫秒为单位，返回 key 的剩余生存时间 |
    TTL
        当 key 不存在时，返回 -2 。
        当 key 存在但没有设置剩余生存时间时，返回 -1 。

	PTTL
        当 key 不存在时，返回 -2 。
        当 key 存在但没有设置剩余生存时间时，返回 -1 。
#### 9.7 键的过期时长的取消
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |	
| PERSIST | PERSIST key | 移除给定 key 的生存时间，将这个 key 转换成持久的 | 当生存时间移除成功时，返回 1 如果 key 不存在或 key 没有设置生存时间，返回 0 |
#### 9.8 键的序列化操作
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| DUMP | DUMP key | 序列化给定 key ，并返回被序列化的值。序列化的值不包括任何生存时间信息 | 如果 key 不存在，那么返回 nil 否则，返回序列化之后的值 |
| RESTORE | RESTORE key ttl serialized-value [REPLACE] | 反序列化给定的序列化值，并将它和给定的 key 关联。参数 ttl 以毫秒为单位为 key 设置生存时间；如果 ttl 为 0 ，那么不设置生存时间 | 如果反序列化成功那么返回 OK ，否则返回一个错误 |
#### 9.9 键的排序操作
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| SORT | SORT key [BY pattern] [LIMIT offset count] [GET pattern [GET pattern ...]] [ASC|DESC] [ALPHA] [STORE destination] | 返回或保存给定列表、集合、有序集合 key 中经过排序的元素。排序默认以数字作为对象，值被解释为双精度浮点数，然后进行比较 | 没有使用 STORE 参数，返回列表形式的排序结果 使用 STORE 参数，返回排序结果的元素数量 |
#### 9.10 单个实例内多库间的数据迁移操作
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| MOVE | MOVE key db | 将当前数据库的 key 移动到给定的数据库 db 当中。如果当前数据库(源数据库)和给定数据库(目标数据库)有相同名字的给定 key ，或者 key 不存在于当前数据库，那么 MOVE 没有任何效果 | 移动成功返回 1 ，失败则返回 0 |
#### 9.11 多个实例间的数据迁移操作
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| MIGRATE | MIGRATE host port key destination-db timeout [COPY] [REPLACE] | 将 key 原子性地从当前实例传送到目标实例的指定数据库上，一旦传送成功， key 保证会出现在目标实例上，而当前实例上的 key d会被删除。这个命令是一个原子操作，它在执行的时候会阻塞进行迁移的两个实例，直到以下任意结果发生：迁移成功，迁移失败，等待超时 | 迁移成功时返回 OK ，否则返回相应的错误 |
### 10. 订阅与发布
#### 10.1 定义
    Redis 通过 PUBLISH 、 SUBSCRIBE 等命令实现了订阅与发布模式；
    这个功能提供两种信息机制， 分别是订阅/发布到频道和订阅/发布到模式。
#### 10.1 频道的订阅与信息发送
    Redis 的 SUBSCRIBE 命令可以让客户端订阅任意数量的频道， 每当有新信息发送到被订阅的频道时， 信息就会被发送给所有订阅指定频道的客户端
#### 10.2 订阅频道
    每个 Redis 服务器进程都维持着一个表示服务器状态的 redis.h/redisServer 结构， 结构的 pubsub_channels 属性是一个字典， 这个字典就用于保存订阅频道的信息；
    其中，字典的键为正在被订阅的频道， 而字典的值则是一个链表， 链表中保存了所有订阅这个频道的客户端；
    当客户端调用 SUBSCRIBE 命令时， 程序就将客户端和要订阅的频道在 pubsub_channels 字典中关联起来；
    通过 pubsub_channels 字典， 程序只要检查某个频道是否为字典的键， 就可以知道该频道是否正在被客户端订阅； 只要取出某个键的值， 就可以得到所有订阅该频道的客户端的信息
#### 10.3 发送信息到频道
    当调用 PUBLISH channel message 命令， 程序首先根据 channel 定位到字典的键， 然后将信息发送给字典值链表中的所有客户端。
#### 10.4 退订频道
    使用 UNSUBSCRIBE 命令可以退订指定的频道， 这个命令执行的是订阅的反操作： 它从 pubsub_channels 字典的给定频道（键）中， 删除关于当前客户端的信息， 这样被退订频道的信息就不会再发送给这个客户端。
#### 10.5 模式的订阅与信息发送
    当使用 PUBLISH 命令发送信息到某个频道时， 不仅所有订阅该频道的客户端会收到信息， 如果有某个/某些模式和这个频道匹配的话， 那么所有订阅这个/这些频道的客户端也同样会收到信息。
#### 10.6订阅模式
	redisServer.pubsub_patterns 属性是一个链表，链表中保存着所有和模式相关的信息：
		struct redisServer {
		    // ...
		    list *pubsub_patterns;
		    // ...
		};

	链表中的每个节点都包含一个 redis.h/pubsubPattern 结构：
		typedef struct pubsubPattern {
		    redisClient *client;
		    robj *pattern;
		} pubsubPattern;

	client 属性保存着订阅模式的客户端，而 pattern 属性则保存着被订阅的模式。
	每当调用 PSUBSCRIBE 命令订阅一个模式时， 程序就创建一个包含客户端信息和被订阅模式的 pubsubPattern 结构， 并将该结构添加到 redisServer.pubsub_patterns 链表中。
#### 10.7 发送信息到模式
	PUBLISH 除了将 message 发送到所有订阅 channel 的客户端之外， 它还会将 channel 和 pubsub_patterns 中的模式进行对比， 如果 channel 和某个模式匹配的话， 那么也将 message 发送到订阅那个模式的客户端。
#### 10.8 退订模式
	使用 PUNSUBSCRIBE 命令可以退订指定的模式， 这个命令执行的是订阅模式的反操作： 程序会删除 redisServer.pubsub_patterns 链表中， 所有和被退订模式相关联的 pubsubPattern 结构， 这样客户端就不会再收到和模式相匹配的频道发来的信息。
#### 10.9 订阅与发布系统的基本命令
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| SUBSCRIBE | SUBSCRIBE channel [channel ...] | 订阅给定的一个或多个频道的信息 | 接收到的信息 |
| PSUBSCRIBE| PSUBSCRIBE pattern [pattern ...]| 订阅一个或多个符合给定模式的频道 | 接收到的信息 |
| PUBLISH | PUBLISH channel message | 将信息 message 发送到指定的频道 channel | 接收到信息 message 的订阅者数量 |
| UNSUBSCRIBE | UNSUBSCRIBE [channel [channel ...]] | 指示客户端退订所有给定频道 | 退订结果 |
| PUNSUBSCRIBE | PUNSUBSCRIBE [pattern [pattern ...]] | 指示客户端退订所有给定模式 | 退订结果 |
| PUBSUB | PUBSUB <subcommand> [argument [argument ...]] | PUBSUB 是一个查看订阅与发布系统状态的内省命令， 它由数个不同格式的子命令组成 | |
    PSUBSCRIBE
        每个模式以 * 作为匹配符，比如 it* 匹配所有以 it 开头的频道( it.news 、 it.blog 、 it.tweets 等等)， news.* 匹配所有以 news. 开头的频道( news.it 、 news.global.today 等等)，诸如此类

    UNSUBSCRIBE
        如果没有频道被指定，也即是，一个无参数的 UNSUBSCRIBE 调用被执行，那么客户端使用 SUBSCRIBE 命令订阅的所有频道都会被退订。在这种情况下，命令会返回一个信息，告知客户端所有被退订的频道。

	PUNSUBSCRIBE
        如果没有模式被指定，也即是，一个无参数的 PUNSUBSCRIBE 调用被执行，那么客户端使用 PSUBSCRIBE 命令订阅的所有模式都会被退订。在这种情况下，命令会返回一个信息，告知客户端所有被退订的模式。

    PUBSUB 子命令：
        PUBSUB CHANNELS [pattern]
            列出当前的活跃频道。
            活跃频道指的是那些至少有一个订阅者的频道， 订阅模式的客户端不计算在内。
            如果不给出 pattern 参数，那么列出订阅与发布系统中的所有活跃频道。
            如果给出 pattern 参数，那么只列出和给定模式 pattern 相匹配的那些活跃频道。
        PUBSUB NUMSUB [channel-1 ... channel-N]
            返回给定频道的订阅者数量， 订阅模式的客户端不计算在内。
        PUBSUB NUMPAT
            返回订阅模式的数量。
            注意， 这个命令返回的不是订阅模式的客户端的数量， 而是客户端订阅的所有模式的数量总和
### 11. 数据安全
#### 11.1 数据持久化
    Redis 提供了不同级别的持久化方式：
        RDB持久化方式能够在指定的时间间隔能对你的数据进行快照存储.
        AOF持久化方式记录每次对服务器写的操作,当服务器重启的时候会重新执行这些命令来恢复原始的数据,AOF命令以redis协议追加保存每次写的操作到文件末尾.Redis还能对AOF文件进行后台重写,使得AOF文件的体积不至于过大.
        如果你只希望你的数据在服务器运行的时候存在,你也可以不使用任何持久化方式.
        你也可以同时开启两种持久化方式, 在这种情况下, 当redis重启的时候会优先载入AOF文件来恢复原始的数据,因为在通常情况下AOF文件保存的数据集要比RDB文件保存的数据集要完整
        
    RDB的优点：
        RDB是一个非常紧凑的文件,它保存了某个时间点得数据集,非常适用于数据集的备份,这样即使出了问题你也可以根据需求恢复到不同版本的数据集.
        RDB是一个紧凑的单一文件,很方便传送到另一个远端数据中心或者亚马逊的S3（可能加密），非常适用于灾难恢复.
        RDB在保存RDB文件时父进程唯一需要做的就是fork出一个子进程,接下来的工作全部由子进程来做，父进程不需要再做其他IO操作，所以RDB持久化方式可以最大化redis的性能.

    RDB的优点：
        与AOF相比,在恢复大的数据集的时候，RDB方式会更快一些.
        RDB的缺点：
        如果你希望在redis意外停止工作（例如电源中断）的情况下丢失的数据最少的话，那么RDB不适合你.
        RDB 需要经常fork子进程来保存数据集到硬盘上,当数据集比较大的时候,fork的过程是非常耗时的,可能会导致Redis在一些毫秒级内不能响应客户端的请求.
        
    AOF的优点：
        使用AOF 会让你的Redis更加耐久.
        AOF文件是一个只进行追加的日志文件,所以不需要写入seek,即使由于某些原因(磁盘空间已满，写的过程中宕机等等)未执行完整的写入命令,你也也可使用redis-check-aof工具修复这些问题.
        Redis 可以在 AOF 文件体积变得过大时，自动地在后台对 AOF 进行重写.
        AOF 文件有序地保存了对数据库执行的所有写入操作， 这些写入操作以 Redis 协议的格式保存， 因此 AOF 文件的内容非常容易被人读懂， 对文件进行分析（parse）也很轻松。
        
    AOF的缺点：
        对于相同的数据集来说，AOF 文件的体积通常要大于 RDB 文件的体积。
        根据所使用的 fsync 策略，AOF 的速度可能会慢于 RDB 。
        
    如何选择使用哪种持久化方式：
        一般来说， 如果想达到足以媲美 PostgreSQL 的数据安全性， 你应该同时使用两种持久化功能。
        如果你非常关心你的数据， 但仍然可以承受数分钟以内的数据丢失， 那么你可以只使用 RDB 持久化。
        有很多用户都只使用 AOF 持久化， 但我们并不推荐这种方式： 因为定时生成 RDB 快照（snapshot）非常便于进行数据库备份， 并且 RDB 恢复数据集的速度也要比 AOF 恢复的速度要快。
        
    更多RDB细节：
        在默认情况下， Redis 将数据库快照保存在名字为 dump.rdb的二进制文件中。
        这种持久化方式被称为快照 snapshotting.
        
    工作方式：
        当 Redis 需要保存 dump.rdb 文件时， 服务器执行以下操作:
        Redis 调用forks. 同时拥有父进程和子进程。
        子进程将数据集写入到一个临时 RDB 文件中。
        当子进程完成对新 RDB 文件的写入时，Redis 用新 RDB 文件替换原来的 RDB 文件，并删除旧的 RDB 文件。
        
    更多AOF（Append-Only File）细节：
        快照功能并不是非常耐久（dura ble）： 如果 Redis 因为某些原因而造成故障停机， 那么服务器将丢失最近写入、且仍未保存到快照中的那些数据。 从 1.1 版本开始， Redis 增加了一种完全耐久的持久化方式： AOF 持久化。
        你可以在配置文件中打开AOF方式:
            appendonly yes
                从现在开始， 每当 Redis 执行一个改变数据集的命令时（比如 SET）， 这个命令就会被追加到 AOF 文件的末尾。
        
    AOF工作原理：
        Redis 执行 fork() ，现在同时拥有父进程和子进程
        子进程开始将新 AOF 文件的内容写入到临时文件
        对于所有新执行的写入命令，父进程一边将它们累积到一个内存缓存中，一边将这些改动追加到现有 AOF 文件的末尾,这样样即使在重写的中途发生停机，现有的 AOF 文件也还是安全的
        当子进程完成重写工作时，它给父进程发送一个信号，父进程在接收到信号之后，将内存缓存中的所有数据追加到新 AOF 文件的末尾

    日志重写：
        AOF 文件的体积会变得越来越大
        重建（rebuild）
        BGREWRITEAOF 命令
        自动触发 AOF 重写

    AOF 文件损坏：
        为现有的 AOF 文件创建一个备份
        使用redis-check-aof修复
            $ redis-check-aof –fix
                （可选）使用 diff -u 对比修复后的 AOF 文件和原始 AOF 文件的备份，查看两个文件之间的不同之处。
                重启 Redis 服务器，等待服务器载入修复后的 AOF 文件，并进行数据恢复。

    怎样从RDB方式切换为AOF方式：
        为最新的 dump.rdb 文件创建一个备份
        将备份放到一个安全的地方
        执行以下两条命令
            redis-cli config set appendonly yes
            redis-cli config set save “”
            确保写命令会被正确地追加到 AOF 文件的末尾

    AOF和RDB之间的相互作用：
        BGSAVE 与 BGREWRITEAOF 不可同时执行
        
#### 11.2 数据持久化相关配置以及命令
    RDB的配置：
        在配置文件中已经预设三个条件
            save 900 1 		# 15分钟内至少有一个键被更改
            save 300 10 	# 5分钟内至少有10个键被更改
            save 60 10000	# 1分钟内至少有10000个键被更改
        默认的rdb文件路径是当前目录,文件名是:dump.rdb,可以在配置文件中修改路径和文件名,分别是dir和dbfilename
            dir ./ 	# rdb文件存储路径
            dbfilename dump.rdb # rdb文件名
    
    RDB文件的压缩：
        RDB文件是通过压缩的,可以通过配置rdbcompression参数来禁用压缩,Redis默认是开启压缩的
    
    RDB相关命令：
        如果没有触发自动快照,需要对Redis执行手动快照操作,SAVE和BGSAVE都是执行手动快照,
        但是两者有区别:可以通过SAVE和BGSAVE命令来手动快照,两个命令的区别是前者是由主进程进行快照,会阻塞其他请求,后者是通过fork子进程进行快照
    
    AOF相关配置：
        AOF文件的位置和RDB的位置相同,都是通过dir参数设置,默认的文件名是appendonly.aof,可以通过appendfilename参数修改。
        重写策略的参数设置
            auto-aof-rewrite-percentage 100
                当前的AOF文件大小超过上一次重写的AOF文件大小的百分之多少时会再次进行重写,如果之前没有重写过,则以启动时的AOF大小为依据。
            auto-aof-rewrite-min-size 64mb
                限制了允许重写的最小AOF文件
    
    AOF相关配置：
        文件同步策略
            文件写入默认情况下会先写入到系统的缓存中,系统每30秒同步一次,才是真正的写入到磁盘,如果在这30秒服务器宕机那数据也会丢失的
            appendfsync always 每次都同步(最安全但是最慢)
            appendfsync everysec 每秒同步(默认的同步策略)
            appendfsync no 不主动同步,由操作系统来决定(最快但是不安全)
    
    优化AOF文件：
        可以使用BGREWRITEAOF命令来重写AOF文件。目的是去除数据的中间执行过程,保存最终数据命令即可。
    
    
    Redis 数据备份
    
        数据备份：
            确保你的数据由完整的备份. 磁盘故障， 节点失效， 诸如此类的问题都可能让你的数据消失不见， 不进行备份是非常危险的。
            无论何时， 复制 RDB 文件都是绝对安全的。
    
        备份步骤：
            创建一个定期任务（cron job）， 每小时将一个 RDB 文件备份到一个文件夹， 并且每天将一个 RDB 文件备份到另一个文件夹。
            确保快照的备份都带有相应的日期和时间信息， 每次执行定期任务脚本时， 使用 find 命令来删除过期的快照： 比如说， 你可以保留最近 48 小时内的每小时快照， 还可以保留最近一两个月的每日快照。
            至少每天一次， 将 RDB 备份到你的数据中心之外， 或者至少是备份到你运行 Redis 服务器的物理机器之外。
    
    
    Redis 容灾备份
    
        容灾备份：
            对数据进行备份， 并将这些备份传送到多个不同的外部数据中心。
            容灾备份可以在 Redis 运行并产生快照的主数据中心发生严重的问题时， 仍然让数据处于安全状态。
    
        容灾备份方法：
            Amazon S3。
            传送快照可以使用 SCP 来完成（SSH 的组件）。
            在文件传送完毕之后， 检查所传送备份文件的体积和原始快照文件的体积是否相同。
### 12. 高级应用
#### 12.1 HyperLogLog的使用
##### 12.1.1 定义
    Redis 在 2.8.9 版本添加了 HyperLogLog 结构。
    Redis HyperLogLog 是用来做基数统计的算法，HyperLogLog 的优点是，在输入元素的数量或者体积非常非常大时，计算基数所需的空间总是固定 的、并且是很小的。
    在 Redis 里面，每个 HyperLogLog 键只需要花费 12 KB 内存，就可以计算接近 2^64 个不同元素的基 数。这和计算基数时，元素越多耗费内存就越多的集合形成鲜明对比。
    但是，因为 HyperLogLog 只会根据输入元素来计算基数，而不会储存输入元素本身，所以 HyperLogLog 不能像集合那样，返回输入的各个元素。
##### 12.1.2 基数
    比如数据集 {1, 3, 5, 7, 5, 7, 8}， 那么这个数据集的基数集为 {1, 3, 5 ,7, 8}, 基数(不重复元素)为5。 基数估计就是在误差可接受的范围内，快速计算基数。
##### 12.1.3 命令
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| PFADD | PFADD key element [element ...] | 将任意数量的元素添加到指定的 HyperLogLog 里面 | 整数回复： 如果 HyperLogLog 的内部储存被修改了， 那么返回 1 ， 否则返回 0 | 
| PFCOUNT | PFCOUNT key [key ...] | 当 PFCOUNT 命令作用于单个键时， 返回储存在给定键的 HyperLogLog 的近似基数， 如果键不存在， 那么返回 0 | 整数回复： 给定 HyperLogLog 包含的唯一元素的近似数量 |
| PFMERGE | PFMERGE destkey sourcekey [sourcekey ...] | 将多个 HyperLogLog 合并（merge）为一个 HyperLogLog ， 合并后的 HyperLogLog 的基数接近于所有输入 HyperLogLog 的可见集合（observed set）的并集 | 字符串回复：返回 OK |
    PFADD
        作为这个命令的副作用， HyperLogLog 内部可能会被更新， 以便反映一个不同的唯一元素估计数量（也即是集合的基数）。

	PFCOUNT
        当 PFCOUNT 命令作用于多个键时， 返回所有给定 HyperLogLog 的并集的近似基数， 这个近似基数是通过将所有给定 HyperLogLog 合并至一个临时 HyperLogLog 来计算得出的
#### 12.2 GEO的使用
##### 12.2.1 定义
	Redis 的 GEO 特性在 Redis 3.2 版本发布， 这个功能可以将用户给定的地理位置信息储存起来， 并对这些信息进行操作。
	GEO常用于LBS(Location Based Service)，基于位置的服务。
##### 12.2.2 命令
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| GEOADD | GEOADD key longitude latitude member [longitude latitude member ...] | 将给定的空间元素（纬度、经度、名字）添加到指定的键里面 | 新添加到键里面的空间元素数量， 不包括那些已经存在但是被更新的元素 |
| GEOPOS | GEOPOS key member [member ...] | 从键里面返回所有给定位置元素的位置（经度和纬度） | GEOPOS 命令返回一个数组， 数组中的每个项都由两个元素组成： 第一个元素为给定位置元素的经度， 而第二个元素则为给定位置元素的纬度 |
| GEODIST| GEODIST key member1 member2 [unit] | 返回两个给定位置之间的距离 | 计算出的距离会以双精度浮点数的形式被返回。 如果给定的位置元素不存在， 那么命令返回空值 |
| GEORADIUS | GEORADIUS key longitude latitude radius m|km|ft|mi [WITHCOORD] [WITHDIST] [WITHHASH] [ASC|DESC] [COUNT count] | 以给定的经纬度为中心， 返回键包含的位置元素当中， 与中心的距离不超过给定最大距离的所有位置元素 |
| GEORADIUSBYMEMBER | GEORADIUSBYMEMBER key member radius m|km|ft|mi [WITHCOORD] [WITHDIST] [WITHHASH] [ASC|DESC] [COUNT count] | 这个命令和 GEORADIUS 命令一样 不同的是中心点是由给定的位置元素决定的 | 一个数组， 数组中的每个项表示一个范围之内的位置元素 |
| GEOHASH | GEOHASH key member [member ...] | 返回一个或多个位置元素的 Geohash 表示 | 一个数组， 数组的每个项都是一个 geohash 。 命令返回的 geohash 的位置与用户给定的位置元素的位置一一对应 |
    GEOADD
        有效的经度介于 -180 度至 180 度之间。
        有效的纬度介于 -85.05112878 度至 85.05112878 度之间。

	GEODIST
        如果两个位置之间的其中一个不存在， 那么命令返回空值。
        指定单位的参数 unit 必须是以下单位的其中一个：（默认m,km,mi,ft）

	GEORADIUS 选项：
        WITHDIST ： 在返回位置元素的同时， 将位置元素与中心之间的距离也一并返回。
        WITHCOORD ： 将位置元素的经度和维度也一并返回。
        WITHHASH ： 以 52 位有符号整数的形式， 返回位置元素经过原始 geohash 编码的有序集合分值。 这个选项主要用于底层应用或者调试， 实际中的作用并不大。
        ASC ： 根据中心的位置， 按照从近到远的方式返回位置元素
        DESC ： 根据中心的位置， 按照从远到近的方式返回位置元素
#### 12.3 事务处理的使用
##### 12.3.1 定义
	Redis 事务可以一次执行多个命令， 并且带有以下三个重要的保证：
		批量操作在发送 EXEC 命令前被放入队列缓存。
		收到 EXEC 命令后进入事务执行，事务中任意命令执行失败，其余的命令依然被执行。
		在事务执行过程，其他客户端提交的命令请求不会插入到事务执行命令序列中。

	一个事务从开始到执行会经历以下三个阶段：
		开始事务。
		命令入队。
		执行事务。
##### 12.3.2 命令
| 命令 | 语法 | 功能 | 返回值 |
| --- | --- | --- | --- |
| MULTI | MULTI | 标记一个事务块的开始 | 总是返回 OK |
| EXEC | EXEC | 执行所有事务块内的命令 | 事务块内所有命令的返回值，按命令执行的先后顺序排列 当操作被打断时，返回空值 nil |
| DISCARD | DISCARD | 取消事务，放弃执行事务块内的所有命令 | 总是返回 OK |
| WATCH | WATCH key [key ...] | 监视一个(或多个) key ，如果在事务执行之前这个(或这些) key 被其他命令所改动，那么事务将被打断 | 总是返回 OK |
| UNWATCH | UNWATCH | 取消 WATCH 命令对所有 key 的监视 如果在执行 WATCH 命令之后， EXEC 命令或 DISCARD 命令先被执行了的话，那么就不需要再执行 UNWATCH 了 | 总是返回 OK |
#### 12.4 主从复制
	Redis 支持简单且易用的主从复制（master-slave replication）功能， 该功能可以让从服务器(slave server)成为主服务器(master server)的精确复制品。
	以下是关于 Redis 复制功能的几个重要方面：
		Redis 使用异步复制。
		一个主服务器可以有多个从服务器。
		不仅主服务器可以有从服务器， 从服务器也可以有自己的从服务器， 多个从服务器之间可以构成一个图状结构。
		复制功能不会阻塞主服务器。
		复制功能也不会阻塞从服务器。
		复制功能可以单纯地用于数据冗余（data redundancy）， 也可以通过让多个从服务器处理只读命令请求来提升扩展性（scalability）。
		可以通过复制功能来让主服务器免于执行持久化操作。

	相关配置：
		配置一个从服务器非常简单， 只要在配置文件中增加以下的这一行就可以了：
			slaveof 192.168.1.1 6379
		另外一种方法是调用 SLAVEOF 命令， 输入主服务器的 IP 和端口， 然后同步就会开始：
			SLAVEOF 192.168.1.1 10086

	从服务器只读：
		从 Redis 2.6 开始， 从服务器支持只读模式， 并且该模式为从服务器的默认模式。
		只读模式由 redis.conf 文件中的 slave-read-only 选项控制， 也可以通过 CONFIG SET 命令来开启或关闭这个模式。

	从服务器配置：
		如果主服务器通过 requirepass 选项设置了密码， 那么为了让从服务器的同步操作可以顺利进行， 我们也必须为从服务器进行相应的身份验证设置。
		config set masterauth <password> 或者 masterauth <password>

	主服务器其他配置：
		从 Redis 2.8 开始， 为了保证数据的安全性， 可以通过配置， 让主服务器只在有至少 N 个当前已连接从服务器的情况下， 才执行写命令。
		用户可以通过配置， 指定网络延迟的最大值 min-slaves-max-lag ， 以及执行写操作所需的至少从服务器数量 min-slaves-to-write 。






