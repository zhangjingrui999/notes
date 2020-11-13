<?php

namespace app\index\model;


use \think\Model;
use \think\Db;
use \think\facade\Env;
use Exception;

class Login extends Model{

    protected function dingxiang($token)
    {
        return dingxiang($token);
    }

    public function login($data)
    {
        if(!$this->dingxiang($data['token'])) {
            rejson(400,'数据错误，请重试');

        }

        $user_tel = RSA_openssl($data['user_tel'], 'decode');
        $password = RSA_openssl($data['password'], 'decode');
        $user = db('shop_user')->where(['user_tel'=>$user_tel,'is_logout'=>'0'])->find();
        if (empty($user)) {
            rejson(400, '手机号或密码错误请重试','0');
        }

        if(!$user['enable'])
        {
            rejson(400,'此账号未启用','0');
        }

        if(!password_verify(md5($password),$user['password'])){
            rejson(400, '手机号或密码错误请重试','2');
        }

        $user_info = [
            'last_login_time' => date('Y-m-d H:i:s',time()),
            'last_login_ip'   => request()->ip()
        ];

        Db::startTrans();
        try {
            db('shop_user_info')->where('user_id',$user['id'])->update($user_info);
            Db::commit();
            session('login_id',$user['id']);
            session('login_name',$user['username']);
            rejson(0,'登录成功',1,session_id());
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            rejson(400,'系统错误，登录失败，请重试',2);
        }
    }

    public function invite()
    {
        $chars = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
        $num   = array(0,1,2,3,4,5,6,7,8,9);
        shuffle($chars);                            //打乱数组顺序
        shuffle($num);
        $str = '';
        for($i=0; $i<2; $i++){
            $str .= $chars[mt_rand(0,count($chars)-1)];    //随机取出一位
        }
        for($i=0; $i<4; $i++){
            $str .= $num[mt_rand(0,count($num)-1)];    //随机取出一位
        }
        $invite = db('shop_user')->where('invite_code',$str)->field('id')->find();
        if($invite)
        {
            return $this->invite();
        }
        return $str;
    }

    public function register($data)
    {
        if(!$this->dingxiang($data['token'])) {
            rejson(400,'数据错误，请重试');

        }
        $this->sms_code($data);
        if(RSA_openssl($data['password1'], 'decode') != RSA_openssl($data['password2'], 'decode'))
        {
            rejson('400','密码不一致，请核对后再试',0);
        }

        $invite_code = $data['invite_code'] ?? 'yn0000';

        $user_p = Db::name('shop_user')->where('invite_code',$invite_code)->field('id,user_pid')->find();
        if (empty($user_p)) {
            rejson(400, '数据错误,请核对后重试', 0);
        }

        $tel = Db::name('shop_user')->where('user_tel',$data['user_tel'])->value('user_tel');
        if(!empty($tel))
        {
            rejson(400,'该手机号已注册',0);
        }
        $password = RSA_openssl($data['password1'], 'decode');
        $invite = $this->invite();
        $user = [
            'username' => $invite,
            'user_tel' => $data['user_tel'],
            'password' => password_hash(md5($password), PASSWORD_DEFAULT),
            'invite_code' => $invite,
            'user_pid' => $user_p['id'],
            'user_pids'=> $user_p['user_pid'],
            'user_qrcode'=>'',
            'is_active'=> '0',
            'is_enable'=> '1',
            'is_logout'=> '0',
            'create_time'=>date('Y-m-d H:i:s',time()),
            'create_ip'=>request()->ip()
        ];
        qrcode("http://shop.xiang-ge-che.com/index/login.html?invite_code=".$invite,$invite.'png',Env::get('root_path') .'public/static/invite/');
        Db::startTrans();
        try {
            $id = Db::name('shop_user')->insertGetId($user);
            $user_info = [
                'user_id'    => $id,
                'last_login_time' => date('Y-m-d H:i:s',time()),
                'last_login_ip' => request()->ip(),
            ];
            Db::name('shop_user_info')->insert($user_info);
            Db::name('shop_user_assets')->insert([
                'user_id' => $id
            ]);
            $user_ps = Db::name('shop_user_relation')->where('user_id',$user_p['id'])->column('user_pid');
            $user_relation = [];
            if(!empty($user_ps))
            {
                foreach($user_ps as $value)
                {
                    $user_relation[] = [
                        'user_id' => $id,
                        'user_pid'=> $value
                    ];
                }
            }
            $user_relation[] = [
                'user_id' => $id,
                'user_pid'=> $user_p['id']
            ];
            Db::name('shop_user_relation')->insertAll($user_relation);
            Db::commit();
            session('login_id',$id);
            session('login_name',$data['username']);

            rejson(0,'注册成功，已自动登录',1,session_id());
        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
//            rejson(400,'系统错误，注册失败，请重试',0);
            rejson(400,$e->getMessage(),0);
        }
    }

    public function reset_password($data)
    {
        if(!$this->dingxiang($data['token'])) {
            rejson(400,'数据错误，请重试');

        }
        if($data['new_password1'] != $data['new_password2'])
        {
            rejson(400,'俩次新密码不一致',0);
        }

        Db::startTrans();
        try {
            db('shop_user')->where('user_tel',$data['user_tel'])->update(['password',password_hash(md5($data['new_password1']), PASSWORD_DEFAULT)]);
            // 提交事务
            Db::commit();
            rejson(0,'密码重置成功',1);
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            rejson(400,'系统错误，密码重置失败，请重试',0);
        }
    }

    public function sms($data)
    {
        $code = get_random(3);
        $content = "【壹诺商城】"."您于".date('Y-m-d',time())."申请了手机号码注册，校验码是".$code;
        $sms = senddemo(['tel'=>$data['user_tel'],'code'=>$code,'date_time'=>date('Y-m-d',time())],$content);

        if($sms){
            Db::startTrans();
            try {
                $time = time();
                $date = [
                    'tel'  => $data['user_tel'],
                    'code' => $code,
                    'scene'=> $data['scene'],
                    'send_time' => date('Y-m-d H:i:s',$time),
                    'failure_time'=>date('Y-m-d H:i:s',$time+180),
                    'content'=> $content,
                    'is_use' => 0
                ];
                db('shop_sms_code')->insert($date);
                // 提交事务
                Db::commit();
                rejson(0,'发送成功，请尽快验证',1,$code);
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                rejson(400,'系统错误，请重试',0);
            }
        }else{
            rejson(400,'发送失败，请59秒后重试',0);
        }
    }

    public function sms_code($data)
    {
        $sms = db('shop_sms_code')->where(['tel'=>$data['user_tel'],'scene'=>$data['scene']])->order('send_time desc')->find();

        if(empty($sms) | $sms['is_use'] == 1)
        {
            rejson(400,'无效的验证码',0);
        }

//        Db::startTrans();
//        try {
            db('shop_sms_code')->where('id',$sms['id'])->update(['is_use'=>1]);

        if(strtotime($sms['failure_time']) < time() )
        {
            rejson(400,'验证码已超时',0);
        }
//            // 提交事务
//            Db::commit();
//        } catch (\Exception $e) {
//            // 回滚事务
//            Db::rollback();
//        }
        if($data['code'] != $sms['code'])
        {
            rejson(400,'验证码错误',0);
        }
//        rejson(0,'验证成功',1,$data['tel']);
    }
}


