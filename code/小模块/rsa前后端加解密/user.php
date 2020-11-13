<?php
require 'config.php';

$username = isset($_POST['username'])?$_POST['username']:'';
$pwd = isset($_POST['pwd'])?$_POST['pwd']:'';

$username = RSA_openssl($username,'decode');
$pwd = RSA_openssl($pwd,'decode');

if($username=='admin' && $pwd=='321'){
    echo json_encode(array('err'=>1,'msg'=>'登录成功'));
}else{
    echo json_encode(array('err'=>-1,'msg'=>'用户名或者密码错误'));
}


/**
 * RSA数据加密解密
 * @param type $data
 * @param type $type encode加密 decode解密
 */
function RSA_openssl($data, $type = 'encode') {
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