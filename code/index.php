<?php
/*
|------------------------------
|  @对微信昵称 表情符处理
|------------------------------
|	$nickname  包含表情的字符串
*/
/*
function emoji_encode($nickname)
{
    $strEncode = '';
    $length = mb_strlen($nickname, 'utf-8');
    for ($i = 0; $i < $length; $i++) {
        $_tmpStr = mb_substr($nickname, $i, 1, 'utf-8');
        if (strlen($_tmpStr) >= 4) {
            $strEncode .= '[[EMOJI:' . rawurlencode($_tmpStr) . ']]';
        } else {
            $strEncode .= $_tmpStr;
        }
    }
    return $strEncode;
}
/**/


/*
|------------------------------
|  @对emoji表情转反义
|------------------------------
|	$str  包含表情的字符串
*/
/*
function emoji_decode($str)
{
    $strDecode = preg_replace_callback('|\[\[EMOJI:(.*?)\]\]|', function ($matches) {
        return rawurldecode($matches[1]);
    }, $str);

    return $strDecode;
}
/**/

/*
|------------------------------
|  @curl请求
|------------------------------
|	$url      路径
|   $data     值
|   $headers  头参数
*/
/*
function http_request($url,$data = null,$headers=array()){
    $curl = curl_init();
    if( count($headers) >= 1 ){
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($curl, CURLOPT_URL, $url);

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);


    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}


/*
|---------------------------------------
|  @memcached
|---------------------------------------
|  连接  connect('IP','端口')
|  添加  set('key','value');
|  获取  get('key');
|  删除  delete('key');
|  获取全部信息 getStats();
*/
/*
	$mem = new Memcache;
	$mem->connect('127.0.0.1','11211');

	$mem->set('name','user1');
	var_dump($mem->get('name'));
	$mem->set('name','user2');
	var_dump($mem->get('name'));
	$mem->delete('name');
	var_dump($mem->get('name'));
	$arr = $mem->getStats();

	echo '<pre>';
	print_r($arr);
	echo '</pre>';
/**/


/*
|------------------------------
|  @redis
|------------------------------
|	连接  connect('IP','端口');
|	设置  set('key','value');
|   获取  get('key');
*/
/*
	$redis = new Redis();
	$redis->connect('127.0.0.1',6379);
    $redis->set('name','hello world！');
    echo $redis->get('name');
/**/


/*
|------------------------------
|  @PHP队列
|------------------------------
|  PHP队列
*/
/*
	$queue = new SplQueue();
	$queue->enqueue(1);
	$queue->enqueue(2);
	$queue->enqueue(3);
	$queue->enqueue(4);
	$queue->enqueue(5);
	$queue->enqueue(6);

	echo $queue->bottom();
	echo "<br/>";
	$queue->dequeue();        //出队列
	echo $queue->bottom();
	echo "<br/>";
	echo $queue->count();     //队列中元素个数
/**/


/** 邮件发送
 * @param array $setFrom 发件人数组 [邮箱,{昵称}] 可默认
 * @param $addAddress       收件人数组 [[邮箱,{昵称}],{[...]}]
 * @param array $addReplyTo 回复人数组 [邮箱，昵称]  可省略
 * @param string $Subject 邮件标题
 * @param string $Body 邮件内容
 * @param string $AltBody 当HTML显示失败后，展示的内容
 * @param string $addCC 抄送人 可省略
 * @param string $addBCC 密送人 可省略
 * @param array $addAttachment 附件 [['file',{'new_file'}],{[...]}] 可省略
 * @param string $send_true 邮件发送成功语句
 * @param string $send_false邮件发送失败短语
 */
/*
use app\common\PHPMailer;
use app\common\Exception;
function send_email(
    $setFrom = '',
    $addAddress,
    $addReplyTo = array(),
    $Subject = "新邮件",
    $Body = '',
    $AltBody = '',
    $addCC = '',
    $addBCC = '',
    $addAttachment = array(),
    $send_true = '邮件发送成功',
    $send_false = '邮件发送失败')
{
    require '../application/common/Exception.php';
    require '../application/common/PHPMailer.php';
    require '../application/common/SMTP.php';

    $Debug = 0; // 是否开启 debug调试 (1 0)
    $Host = 'smtp.qq.com'; //SMTP 服务器
    $username = '';// SMTP 用户名  即邮箱的用户名
    $password = ''; // SMTP 用户名  即邮箱的用户名
    $Port = '465';              // 服务器端口 25 或者465 具体要看邮箱服务器支持

    if (!isset($setFrom) | empty($setFrom)) {
        $setFrom = ['email' => '', 'name' => ''];
    }
    if (!isset($addAddress) | empty($addAddress)) {
        echo "没有收件人";
        exit;
    }

    $mail = new PHPMailer(true);     // Passing `true` enables exceptions
    try {
        //服务器配置
        $mail->CharSet = "UTF-8";     // 设定邮件编码
        $mail->SMTPDebug = $Debug;    // 调试模式输出
        $mail->isSMTP();              // 使用SMTP
        $mail->Host = $Host;          // SMTP服务器
        $mail->SMTPAuth = true;       // 允许 SMTP 认证
        $mail->Username = $username;  // SMTP 用户名  即邮箱的用户名
        $mail->Password = $password;  // SMTP 用户名  即邮箱的用户名
        $mail->SMTPSecure = 'ssl';    // 允许 TLS 或者ssl协议
        $mail->Port = $Port;          // 服务器端口 25 或者465 具体要看邮箱服务器支持

        if (isset($setFrom['email']) & !empty($setFrom['email'])) // 发件人
        {
            if (isset($setFrom['name']) & !empty($setFrom['name'])) {
                $mail->setFrom($setFrom['email'], $setFrom['name']);
            } else {
                $mail->setFrom($setFrom['email']);
            }
        }
        foreach ($addAddress as $key => $value)                  // 收件人(可多人，循环产生)
        {
            if (isset($value['email']) & !empty($value['email'])) {
                if (isset($value['name']) & !empty($value['name'])) {
                    $mail->addAddress($value['email'], $value['name']);
                } else {
                    $mail->addAddress($value['email']);
                }
            }
        }

        if (isset($addReplyTo) & !empty($addReplyTo)) {
            $mail->addReplyTo($addReplyTo['email'], $addReplyTo['name']); // 回复的时候回复给哪个邮箱 建议和发件人一致
        }

        // 抄送
        if (isset($addCC) & !empty($addCC)) {
            $mail->addCC($addCC);
        }
        // 密送
        if (isset($addBCC) & !empty($addBCC)) {
            $mail->addBCC($addBCC);
        }

        if (isset($addAttachment) & !empty($addAttachment)) {
            foreach ($addAttachment as $key => $value)                  // 收件人(可多人，循环产生)
            {
                if (isset($value['file']) & !empty($value['file'])) {
                    if (isset($value['new_file']) & !empty($value['new_file'])) {
                        $mail->addAttachment($value['file'], $value['new_file']); // 发送附件并且重命名
                    } else {
                        $mail->addAttachment($value['file']);           // 添加附件
                    }
                }
            }
        }

        //Content
        $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
        $mail->Subject = $Subject;
        $mail->Body = $Body;
        $mail->AltBody = $AltBody;

        $mail->send();
        echo $send_true;
    } catch (Exception $e) {
        echo $send_false . "<br/>" . $mail->ErrorInfo;
    }
}
/**/


/** 生成随机数
 * @param string $len 随机数的长度/2 即 3 4
 * @return string     返回随机数     即 6 8
 */
/*
function get_random($len = "")
{
    //range 是将10到99列成一个数组
    $numbers = range(10, 99);
    //shuffle 将数组顺序随即打乱
    shuffle($numbers);
    //取值起始位置随机
    $start = mt_rand(1, 10);
    //取从指定定位置开始的若干数
    $result = array_slice($numbers, $start, $len);
    $random = "";
    for ($i = 0; $i < $len; $i++) {
        $random = $random . $result[$i];
    }
    return $random;
}
/**/


/*
|-----------------------------------------
|  @生成原始的二维码(不生成图片文件)
|-----------------------------------------
|	$url  二维码 跳转路径 及 文本参数
*/
/*
	function scerweima2($url=''){
		require_once './phpqrcode.php';
		$value = $url;                  //二维码内容
		$errorCorrectionLevel = 'L';    //容错级别
		$matrixPointSize = 5;           //生成图片大小
		$QR = QRcode::png($value,false,$errorCorrectionLevel, $matrixPointSize, 2);  //生成二维码图片
	}

	return scerweima2('http://kangbang.net/default');  //调用查看结果
/**/


/*
|-----------------------------------------
|  @生成原始的二维码(生成图片文件)
|-----------------------------------------
|   $url   二维码 跳转路径 及 文本参数
|	$img   二维码图片名字
|   $qrimg 二维码图片带logo名字
*/
/*
	function scerweima3($url='',$img='',$qrimg=''){
		include './phpqrcode.php';
		$value = $url; 				//二维码内容
		$errorCorrectionLevel = 'L';//容错级别
		$matrixPointSize = 6;		//生成图片大小
		QRcode::png($value,$img, $errorCorrectionLevel, $matrixPointSize, 2); //生成二维码图片
 		$logo = $img;//准备好的logo图片
		$QR = $img;		//已经生成的原始二维码图

		if ($logo !== FALSE) {
			$QR = imagecreatefromstring(file_get_contents($QR));
			$logo = imagecreatefromstring(file_get_contents($logo));
			$QR_width = imagesx($QR);		//二维码图片宽度
			$QR_height = imagesy($QR);		//二维码图片高度
			$logo_width = imagesx($logo);	//logo图片宽度
			$logo_height = imagesy($logo);	//logo图片高度
			$logo_qr_width = $QR_width / 5;
			$scale = $logo_width/$logo_qr_width;
			$logo_qr_height = $logo_height/$scale;
			$from_width = ($QR_width - $logo_qr_width) / 2;
			imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,$logo_qr_height, $logo_width, $logo_height); //重新组合图片并调整大小
			imagepng($QR,$qrimg); //输出图片

		}
	}

	scerweima3('http://shop.xiang-ge-che.com/index/login.html?invite_code=of2090','./of2090.png'); //调用查看结果
/**/
/*
function qrcode($url, $qrcode_name, $qrcode_path = '', $logo = '', $qrcode_path_logo = "")
{
    include_once './phpqrcode.php'; // 引用PHP二维码生成类

    if (isset($qrcode_path) & !empty($qrcode_path)) {
        if (!file_exists($qrcode_path)) {
            mkdir($qrcode_path, 0777, true);
        }
    } else {
        $qrcode_path = './';
    }

    if (isset($qrcode_path_logo) & !empty($qrcode_path_logo)) {
        if (!file_exists($qrcode_path_logo)) {
            mkdir($qrcode_path_logo, 0777, true);
        }
    } else {
        $qrcode_path_logo = '';
    }
    if (isset($qrcode_name) & !empty($qrcode_name)) {
        $qrcode = $qrcode_path . $qrcode_name;
        $qrcode_logo = $qrcode_path_logo . $qrcode_name;
    } else {
        $qrcode = "qrcode.png";
        $qrcode_logo = "qrcode.png";
    }

    $value = $url; //二维码内容
    $errorCorrectionLevel = 'L';//容错级别
    $matrixPointSize = 6;//生成图片大小
    //生成二维码图片
    QRcode::png($value, $qrcode, $errorCorrectionLevel, $matrixPointSize, 2);
    if (!$logo) {
        exit;
    }
    $QR = $qrcode;//已经生成的原始二维码图
    if (isset($logo) & !empty($logo)) {
        if ($logo !== FALSE) {
            $QR = imagecreatefromstring(file_get_contents($QR));
            $logo = imagecreatefromstring(file_get_contents($logo));
            $QR_width = imagesx($QR);//二维码图片宽度
            $QR_height = imagesy($QR);//二维码图片高度
            $logo_width = imagesx($logo);//logo图片宽度
            $logo_height = imagesy($logo);//logo图片高度
            $logo_qr_width = $QR_width / 5;
            $scale = $logo_width / $logo_qr_width;
            $logo_qr_height = $logo_height / $scale;
            $from_width = ($QR_width - $logo_qr_width) / 2;
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);//重新组合图片并调整大小
            imagepng($QR, $qrcode_logo);//输出图片
        }
    }
}
qrcode('你是咋滴了','./hd.png');
/**/


/** 二维码
 * @param string $url 二维码将要携带的参数
 * @param string $qrcode_name 二维码的名称 为空为false时 不生成实际文件，不生成二维码(logo)
 * @param string $qrcode_path 二维码存放路径
 * @param string $logo logo路径
 * @param string $qrcode_path_logo 二维码(logo)存放路径
 */
/*
function qrcode($url, $qrcode_name, $qrcode_path = '', $logo = '', $qrcode_path_logo = "")
{
    include_once '../application/common/phpqrcode.php'; // 引用PHP二维码生成类

    if (isset($qrcode_path) & !empty($qrcode_path)) {
        if (!file_exists($qrcode_path)) {
            mkdir($qrcode_path, 0777, true);
        }
    } else {
        $qrcode_path = './';
    }

    if (isset($qrcode_path_logo) & !empty($qrcode_path_logo)) {
        if (!file_exists($qrcode_path_logo)) {
            mkdir($qrcode_path_logo, 0777, true);
        }
    } else {
        $qrcode_path_logo = '';
    }
    if (isset($qrcode_name) & !empty($qrcode_name)) {
        $qrcode = $qrcode_path . $qrcode_name;
        $qrcode_logo = $qrcode_path_logo . $qrcode_name;
    } else {
        $qrcode = false;
        $qrcode_logo = false;
    }

    $value = $url; //二维码内容
    $errorCorrectionLevel = 'L';//容错级别
    $matrixPointSize = 6;//生成图片大小
    //生成二维码图片
    QRcode::png($value, $qrcode, $errorCorrectionLevel, $matrixPointSize, 2);
    $QR = $qrcode;//已经生成的原始二维码图
    if (isset($logo) & !empty($logo)) {
        if ($logo !== FALSE) {
            $QR = imagecreatefromstring(file_get_contents($QR));
            $logo = imagecreatefromstring(file_get_contents($logo));
            $QR_width = imagesx($QR);//二维码图片宽度
            $QR_height = imagesy($QR);//二维码图片高度
            $logo_width = imagesx($logo);//logo图片宽度
            $logo_height = imagesy($logo);//logo图片高度
            $logo_qr_width = $QR_width / 5;
            $scale = $logo_width / $logo_qr_width;
            $logo_qr_height = $logo_height / $scale;
            $from_width = ($QR_width - $logo_qr_width) / 2;
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);//重新组合图片并调整大小
            imagepng($QR, $qrcode_logo);//输出图片
        }
    }
}
/**/


/** 二维码名片
 * @param string $vname     名字
 * @param string $vtel      电话
 * @param string $widthHeight
 * @param string $EC_level
 * @param string $margin
 */
/*
function businessCard($vname = '', $vtel = '', $widthHeight = '150', $EC_level = 'L', $margin = '0')
{
    if ($vname && $vtel) {
        $chl = "BEGIN:VCARD\nVERSION:3.0" .
            "\nFN:$vname" .
            "\nTEl:$vtel" .
            "\nEND:VCARD";

        echo '<img src="http://chart.apis.google.com/chart?chs=' . $widthHeight . 'x' . $widthHeight . '&cht=qr&chld=' . $EC_level . '|' . $margin . '&chl=' . urlencode($chl) . '" alt="QR code" widhtHeight="100px" widhtHeight="100px" />';
    }
}
/**/


/**
 * @param string $code 条形码编号
 * @param string $imgName 条形码名字
 * @return bool  返回图片
 */
/*
function barCode($code="",$imgName='barCode.png')
{
    if($code != "") {
        if (!is_numeric($code)) die('输入的不是数字');
        if (strlen($code) < 12 || strlen($code) > 13) die('条码长度不正确');
        if (strlen($code) == 12) {
            // 计算校验位    
            $lsum = 0;
            $rsum = 0;
            for ($i = 1; $i <= strlen($code); $i++) {
                if ($i % 2) {
                    $lsum += (int)$code[$i - 1];
                } else {
                    $rsum += (int)$code[$i - 1];
                }
            }
            $tsum=$lsum+$rsum* 3;
            $chkdig=10-($tsum % 10);
            if($chkdig== 10)$chkdig= 0;
            $code .=    $chkdig;
        }
        // 定义起始付    
        $start='101';
        // 定义中止符    
        $end='101';
        // 定义中间分隔符    
        $center='01010';
        // 定义左资料码    
        $Guide=array(0 => 'AAAAAA', 'AABABB', 'AABBAB', 'AABBBA', 'ABAABB', 'ABBAAB', 'ABBBAA', 'ABABAB', 'ABABBA', 'ABBABA');
        // 定义左侧码，分为“A”、“B”两种    
        $Lencode=array("A" => array('0001101', '0011001', '0010011', '0111101', '0100011', '0110001', '0101111', '0111011', '0110111', '0001011'), "B" => array('0100111', '0110011', '0011011', '0100001', '0011101', '0111001', '0000101', '0010001', '0001001', '0010111'));
        // 定义右侧码，统一为“C”编码    
        $Rencode=array('1110010', '1100110', '1101100', '1000010', '1011100', '1001110', '1010000', '1000100', '1001000', '1110100');
        // 编码起始符    
        $barcode=$start;
        // 编码左资料位    
        for ($i = 1; $i <= 6; $i++) {
            $barcode .= $Lencode[$Guide[$code[0]][($i - 1)]][$code[$i]];
        }
        // 编码中间分隔符    
        $barcode .= $center;
        // 编码右资料位    
        for ($i = 7; $i < 13; $i++) {
            $barcode .= $Rencode[$code[($i)]];
        }// 编码中止符    
        $barcode .= $end;
        // 定义每个条码单元的宽度和高度，单位是像素    
        $width=2;
        $height=40;
        // 定义起始符、中止符、中间分隔符的高度增量    
        $increment= 10;
        // 创建方形（×95是因为整个条码共95个单元，+60和+30是给条码图片周围留空白边框）    
        $img=ImageCreate($width*95+60,$height+30);// 目前这个方形是透明的    
        // “1”的颜色（黑）与“0”的颜色（白）    
        $fg=ImageColorAllocate($img,0,0,0);
        $bg=ImageColorAllocate($img,255,255,255);
        // 以“0”的颜色（白色），填充整个方形    
        ImageFilledRectangle($img,0,0,$width*95+60,$height+30,$bg);
        // 循环编码后的每一个单元，输出条码图形    
        for ($x = 0; $x < strlen($barcode); $x++) {
            // ($x<4) 为起始符，($x>=92)为中止符，($x>=45 && $x<50)为中间分隔符    
            // 这3个需要将高度增加    
            if (($x < 4) || ($x >= 45 && $x < 50) || ($x >= 92)) {
                $increment=10;
            } else {
                $increment=0;
            }
            // 当编码值为“1”时，输出黑色；当编码值为“0”时，输出白色    
            if ($barcode[$x] == '1') {
                $color=$fg;
            } else {
                $color=$bg;
            }
            ImageFilledRectangle($img,($x*$width)+30,5,($x+1)*$width+29,$height+$increment,$color);
        }
        ImageString($img, 5, 20, $height + 5, $code[0], $fg);
        for ($x = 0; $x < 6; $x++) {
            // 左侧识别码    
            ImageString($img, 5, $width * (8 + $x * 6) + 30, $height + 5, $code[$x + 1], $fg);
            // 右侧识别码    
            ImageString($img, 5, $width * (53 + $x * 6) + 30, $height + 5, $code[$x + 7], $fg);
        }
        header("Content-Type: image/jpeg");
        ImageJPEG($img,$imgName, 100);
    }else{
        return false;
    }
}
/** 条形码对应的前端
 *<form action="cs.php">
 *  输入EAN-13条形码(如果输入12位长度，将自动计算校验位)
 *  <input type="text" name="code"> <input type="submit" value="生成条码图片">
 *</form>
 */
/**/


/** 对文件进行路径完善
 * @param string $http 域名路径 ，为空时默认为 ...
 * @param string $file 文件名
 * @param string $path 文件路径
 * @return string           返回完善后的文件路径
 */
/*
function repath_file($path, $file,$http = 'http://')
{
    return $http . $path . $file;
}
/**/


/*
|----------------------------------------------
|  @遍历文件/压缩包 并获取指定后缀文件
|----------------------------------------------
|   $url     压缩包/文件所在路径
|   $suffix  指定后缀
*/
/*
function only_suffix($url,$new_url,$suffix) {
    if(!is_dir($url)){
        return "目录不存在";
    }

    if(!is_dir($new_url)){
        mkdir($new_url);
    }

    $ml = scandir($url);
    if(count($ml) > 0) {
        for ($i=0;$i<count($ml);$i++) {
            if($ml[$i] === '.' || $ml[$i] === '..'){
                continue;
            }
            if(is_dir($url.'/'.$ml[$i])) {
                only_suffix($url.'/'.$ml[$i],$new_url,$suffix);
            }else if(is_file($url.'/'.$ml[$i])){
                $file_suffix = pathinfo($url.'/'.$ml[$i])['extension'];
                if(in_array($file_suffix,$suffix)) {
                    copy($url.'/'.$ml[$i],$new_url.'/'.$ml[$i]);
                }
            }
        }
    }
}
only_suffix('C:\Users\admin\Desktop\第1章 Mongodb数据库上(云知梦)','C:\Users\admin\Desktop\Mongodb',['txt','pdf']);
/**/


/*
|----------------------------------------------
|  @PHP文件原样输出
|----------------------------------------------
|   对指定PHP文件进行原样输出
|	$file_path   文件路径
|	$type 		 默认为'r'，读取二进制文件时设置为'rb'
|	$length 	 读取长度，为空 为0时读取全部
*/
/*
	function php_fread($file_path='',$type='r',$length=0){
		if(empty($file_path)){
			return "文件名不能为空";
		}

		if(!file_exists($file_path)){
			return "文件不存在";
		}

		if(empty($length)){
			$length = filesize ($file_path);
		}

		$handle = fopen($file_path, $type);//读取二进制文件时，需要将第二个参数设置成'rb'
		$contents = fread($handle, $length);//通过filesize获得文件大小，将整个文件一下子读到一个字符串中
		$contents =str_replace("\r\n","<br />",$contents );
		fclose($handle);
		return    "<pre>".$contents."</pre>";
	}

	echo php_fread('./index.php');
/**/


/*
|----------------------------------------------
|  @PHP文件夹下载(方法一)
|----------------------------------------------
|   对服务器指定路径下的文件夹进行下载
|	同一文件只可压缩一次，后期可直接获取压缩包
|	在指定位置生成压缩文件
|	在浏览器处生成下载文件
*/
/*
	 // * PHP ZipArchive压缩文件夹，实现将目录及子目录中的所有文件压缩为zip文件
	 // * @author 吴先成 wuxiancheng.cn
	 // * @param string $folderPath 要压缩的目录路径
	 // * @param string $zipAs 压缩文件的文件名，可以带路径
	 // * @return bool 成功时返回true，否则返回false

	date_default_timezone_set("PRC");
	function zipFolder($folderPath, $zipAs){
        $folderPath = (string)$folderPath;
        $zipAs = (string)$zipAs;
        if(!class_exists('ZipArchive')){
            return false;
        }
        if(!$files=scanFolder($folderPath, true, true)){
            return false;
        }

        $za = new ZipArchive;
        if(true!==$za->open($zipAs, ZipArchive::OVERWRITE | ZipArchive::CREATE)){
            return false;
        }
        $za->setArchiveComment(base64_decode('LS0tIHd1eGlhbmNoZW5nLmNuIC0tLQ==').PHP_EOL.date('Y-m-d H:i:s'));
        foreach($files as $aPath => $rPath){
            $za->addFile($aPath, $rPath);
        }
        if(!$za->close()){
            return false;
        }
        return true;
	}

	 // * 扫描文件夹，获取文件列表
	 // * @author 吴先成 wuxiancheng.cn
	 // * @param string $path 需要扫描的目录路径
	 // * @param bool   $recursive 是否扫描子目录
	 // * @param bool   $noFolder 结果中只包含文件，不包含任何目录，为false时，文件列表中的目录统一在末尾添加/符号
	 // * @param bool   $returnAbsolutePath 文件列表使用绝对路径，默认将返回相对于指定目录的相对路径
	 // * @param int    $depth 子目录层级，此参数供系统使用，禁止手动指定或修改
	 // * @return array|bool 返回目录的文件列表，如果$returnAbsolutePath为true，返回索引数组，否则返回键名为绝对路径，键值为相对路径的关联数组
	function scanFolder($path='', $recursive=true, $noFolder=true, $returnAbsolutePath=false,$depth=0){
        $path = (string)$path;
        if(!($path=realpath($path))){
                return false;
        }
        $path = str_replace('\\','/',$path);
        if(!($h=opendir($path))){
                return false;
        }
        $files = array();
        static $topPath;
        $topPath = $depth===0||empty($topPath)?$path:$topPath;
        while(false!==($file=readdir($h))){
	        if($file!=='..' && $file!=='.'){
                $fp = $path.'/'.$file;
                if(!is_readable($fp)){
                        continue;
                }
                if(is_dir($fp)){
                    $fp .= '/';
                    if(!$noFolder){
                        $files[$fp] = $returnAbsolutePath?$fp:ltrim(str_replace($topPath,'',$fp),'/');
                    }
                    if(!$recursive){
                        continue;
                    }
                    $function = __FUNCTION__;
                    $subFolderFiles = $function($fp, $recursive, $noFolder, $returnAbsolutePath, $depth+1);
                    if(is_array($subFolderFiles)){
                        $files = array_merge($files, $subFolderFiles);
                    }
                }else{
                        $files[$fp] = $returnAbsolutePath?$fp:ltrim(str_replace($topPath,'',$fp),'/');
                }
	        }
        }
        return $returnAbsolutePath?array_values($files):$files;
	}

    //-----------------------------------------------
    //	实例调用
    //-----------------------------------------------
    //	$file 	 目标操作目录 例：./thinkphp/
    //	$filezip 压缩路径 	  例：./thinkphp.zip
    //	$filedow 浏览器下载
    //	开头判断是否存在压缩包并时间为一天以内

	function filezipdow($file='',$filezip='',$filedow=''){
		if(!file_exists($filezip) | filectime($filezip)+86400 < time()){
			ini_set('max_execution_time',0); // 不限制执行时间
			ini_set('memory_limit',-1); // 不限制内存使用
			if(zipFolder($file,$filezip)){ //PHP压缩文件夹为zip压缩文件
			    echo '成功压缩了文件夹。';
			}else{
			    echo '文件夹没有压缩成功。';
			}
		}

		ob_end_clean();
		header("Content-Type: application/force-download");
		header("Content-Transfer-Encoding: binary");
		header('Content-Type: application/zip');
		header('Content-Disposition: attachment; filename='.basename($filedow));
		header('Content-Length: '.filesize($filedow));
		error_reporting(0);
		@readfile($filedow);
		flush();
		ob_flush();
		exit;
	}
	filezipdow('./tp51/route/','./code.zip','./code.zip');
/**/


/*
|---------------------------------------
|  @PHP单文件下载
|---------------------------------------
|   对服务器指定路径下的某一文件进行下载
|	$filePath  		服务器的文件地址
|	$saveAsFileName 用户指定的下载后的文件名
*/
/*
	function downloadFile($filePath,$saveAsFileName){
	    ob_end_clean();    // 清空缓冲区并关闭输出缓冲
    	$fileHandle=fopen($filePath,"rb");    //r: 以只读方式打开，b: 强制使用二进制模式
    	if($fileHandle===false){
        	echo "Can not find file: $filePath\n";
        	exit;
    	}

	    Header("Content-type: application/octet-stream");
	    Header("Content-Transfer-Encoding: binary");
	    Header("Accept-Ranges: bytes");
	    Header("Content-Length: ".filesize($filePath));
	    Header("Content-Disposition: attachment; filename=\"$saveAsFileName\"");

    	while(!feof($fileHandle)) {
        	echo fread($fileHandle, 32768);    //从文件指针 handle 读取最多 length 个字节
    	}
    	fclose($fileHandle);
	}
	downloadFile("./phpqrcode.php","users.php");
/**/


/** 对数据进行表格返回，通常用于后台
 * @param string $code code码，例如 0，200，400，6002
 * @param string $msg 状态短语
 * @param string $data 表格数据
 * @param string $count 数据总数
 * @param string $token 请求令牌
 */
/*
function table($code = '', $msg = '', $data = '', $count = 0, $token = '')
{
    if (empty($data)) {
        $code = 6002;
        $msg = '暂无数据';
    }

    $data = [
        'code' => $code,
        'msg' => $msg,
        'data' => $data,
        'token' => $token,
    ];

    if (empty($count) & !empty($data['data'])) {
        $data['count'] = count($data['data']);
    } else {
        $data['count'] = $count;
    }

    echo json_encode($data);
    exit;
}
/**/


/*
|----------------------------------------------
|  @json返回
|----------------------------------------------
|   $code   状态码
|   $msg    状态短语
|   $icon   状态图标
|   $data   返回数据
*/
/*
function rejson($code = '', $msg = '', $icon = '', $data = array())
{
    $array = array('code' => $code, 'msg' => $msg);
    if ($icon != '') {
        $array['icon'] = $icon;
    }
    if (isset($data) & !empty($data)) {
        $array['data'] = $data;
    }

    echo json_encode($array);
    exit;
}
/**/


/** 顶象验证
 * @param string $token 顶象令牌
 * @param string $appId 顶象账号ID
 * @param string $appSecret 顶象账号密码
 * @return bool  是否通过验证
 */
/*
use \app\common\CaptchaClient; //引用顶象主类，主类调用CaptchaResponse 辅类
function dingxiang($token, $appId = "8a736233852c943adb5790cadb882dd3", $appSecret = "f556449399b1a9632d91854eebb1ac2d")
{
    if (!isset($token) | empty($token)) {
        return false;
    }
    $client = new CaptchaClient($appId, $appSecret);
    $client->setTimeOut(5);      //设置超时时间，默认2秒
    # $client->setCaptchaUrl("http://cap.dingxiang-inc.com/api/tokenVerify");
    //特殊情况可以额外指定服务器，默认情况下不需要设置
    $response = $client->verifyToken($token);
    $response->serverStatus;
    //确保验证状态是SERVER_SUCCESS，SDK中有容错机制，在网络出现异常的情况会返回通过
    if ($response->result) {
        return true;
    } else {
        return false;
    }
}
/**/


/*
|----------------------------------------------
|  @颜色遍历展示
|----------------------------------------------
|
*/
/*
 $arr = [0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F'];

 for($y=0;$y<count($arr);$y++){
 	echo $arr[$y].$arr[$y].$arr[$y].$arr[$y].$arr[$y].$arr[$y];
 	echo "<div style='display:inline-block;width:100px;height:20px;margin-left:10%;margin-top:30px;background:#".$arr[$y].$arr[$y].$arr[$y].$arr[$y].$arr[$y].$arr[$y]."'></div><br />";
 }

 for($q=0;$q<1;$q++){
 	for($w=0;$w<count($arr);$w++){
 		for($e=0;$e<count($arr);$e++){
 			for($r=0;$r<count($arr);$r++){
 				for($t=0;$t<count($arr);$t++){
 					for($y=0;$y<count($arr);$y++){
 						echo $arr[$q].$arr[$w].$arr[$e].$arr[$r].$arr[$t].$arr[$y];
 						echo "<div style='display:inline-block;width:100px;height:20px;margin-left:10%;margin-top:30px;background:#".$arr[$q].$arr[$w].$arr[$e].$arr[$r].$arr[$t].$arr[$y]."'></div><br />";
 					}
 				}
 			}
 		}
 	}
 }
*/


/** 短信接口 启瑞云
 * @param $data = [
 *                  'phone' => '接收手机号',
 *                  'code'  => '随机数字码'
 *                 ];
 * @param string $apikey 启瑞云账号key
 * @param string $apiSecret 启瑞云账号密码
 */
/*
use \app\common\SendDemo; // 引用 启瑞云短信接口类
function senddemo($data,$content="",$apiKey = '2267080010', $apiSecret = '04b6957457e3b269c419')
{
    if (!isset($data['time']) || $data['time'] == '' || empty($data['time'])) {
        $data['time'] = "3";    // 验证码有效时长
    }
    //接受短信的手机号码
    $phone = $data['tel'];


    //短信内容(【签名】+短信内容)，系统提供的测试签名和内容，如需要发送自己的短信内容请在启瑞云平台申请签名和模板
    // $content   = ''.$data['username'].'您好，本次验证码为'.$data['code'].'，有效期为'.$data['time'].'分钟，请尽快完成验证，以免过期。';
    if(empty($content))
    {
        $content = '【壹诺商城】' ."您于".$data['date_time']."申请了手机号码注册，校验码是".$data['code'];
    }
    $sms = new SendDemo($apiKey, $apiSecret);

    $result = $sms->send($phone, $content);
    return $result;
}
/**/


/**
 * RSA数据加密解密
 * @param type $data
 * @param type $type encode加密 decode解密
 */
/*
include_once "../vendor/Key.php";
function RSA_openssl($data, $type = 'encode')
{
    if (empty($data)) {
        return '加密解密数据不能为空';
    }
    if ($type == 'encode') {
        $return = openssl_pkey_get_public(RSA_public);
        if (!$return) {
            die('公钥不可用');
        }
        openssl_public_encrypt($data, $crypted, $return);
        $crypted = base64_encode($crypted);
        return $crypted;
    }
    if ($type == 'decode') {
        $private_is_use = openssl_pkey_get_private(RSA_private);
        if (!$private_is_use) {
            die('私钥不可用');
        }
        openssl_private_decrypt(base64_decode($data), $decrypted, $private_is_use);
        return $decrypted;
    }
}
/**/