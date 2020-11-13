<html>
    <head>
            <title>用户登陆</title>
    </head>
    <body>
       
    </body>
</html>




<script src='./jsencrypt.min.js'></script>
<script src='jquery-2.1.4.min.js'></script>
<script>
    
    $("#sub").click(function(){
        var username = RSA_openssl($("#user_name").val());
        var pwd = RSA_openssl($("#password").val());
        $.post('user.php',{username:username,pwd:pwd},function(data){
            if(data.err==1){
                alert(data.msg);
            }else{
                alert(data.msg);
            }
        },'json');
        return false;
    });
    
    
    function RSA_openssl(str){
         var encrypt = new JSEncrypt();
        encrypt.setPublicKey('MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDWC8CNLIAyKpI9cooqUrXAOd3YSmW014qdSlfEm1+Y355jK/1bsf/WwB6hvZ/9mmj6+Ij4pwAoOl7C2oiuQHj9XE3p7kuPA8ZHz63eoL1DTFXaTyFBTPyeap6srkpfaQYZ8WCrCxfjakxa632yMYT5OzdgiJyw4LSFpERHUEcV5wIDAQAB');//公钥
        var encrypted = encrypt.encrypt(str);
        return encrypted;
    }
     
      
</script>

