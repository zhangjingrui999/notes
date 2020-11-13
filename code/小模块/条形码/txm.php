<?php
$code = $_GET['code'];
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
    $increment  = 10;
    // 创建方形（×95是因为整个条码共95个单元，+60和+30是给条码图片周围留空白边框）    
    $img=ImageCreate($width*95+60,$height+30);// 目前这个方形是透明的    
    // “1”的颜色（黑）与“0”的颜色（白）    
    $fg=ImageColorAllocate($img,0,0,0);
    $bg=ImageColorAllocate($img,255,255,255);
    // 以“0”的颜色（白色），填充整个方形    
    ImageFilledRectangle($img,0,0,$width*95+60,$height+30,$bg);
    // 循环编码后的每一个单元，输出条码图形    
    for ($x=0;$x<strlen($barcode); $x++) {
    // ($x<4) 为起始符，($x>=92)为中止符，($x>=45 && $x<50)为中间分隔符    
    // 这3个需要将高度增加    
        if (($x<4)||($x >=45&&$x<50)||($x>= 92)) {
            $increment=10;
        } else {
            $increment=0;
        }
    // 当编码值为“1”时，输出黑色；当编码值为“0”时，输出白色    
        if ($barcode[$x]=='1') {
            $color=$fg;
        } else {
            $color=$bg;
        }
        ImageFilledRectangle($img,($x*$width)+30,5,($x+1)*$width+29,$height+ $increment,$color);
    }
    ImageString($img,5,20,$height+5,$code[0],$fg);
    for ($x=0;$x<6;$x++) {
    // 左侧识别码    
        ImageString($img,5,$width*(8+$x*6)+30,$height+5,$code[$x+1],$fg);
        // 右侧识别码    
        ImageString($img,5,$width*(53+$x*6)+30,$height+5,$code[$x+7],$fg);
    }
    header("Content-Type: image/jpeg");
//    Header("Content-type: application/octet-stream");
//    Header("Content-Transfer-Encoding: binary");
//    Header("Accept-Ranges: bytes");
//    Header("Content-Length: ".$img);
//    Header("Content-Disposition: attachment; filename=741.png");


    ImageJPEG($img,"22.png", 999);
//    downloadFile('123.png','456.png');
}

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
?>