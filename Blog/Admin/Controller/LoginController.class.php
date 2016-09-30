<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/8/27
 * Time: 19:16
 */

namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller{
    public function index(){
        if(IS_POST){
            if( !$this->check_verify(I('post.code')) ){
                $this->error("验证码错误请重新登录",U("index"));
            }
            //是否记住密码
            if(I('post.remember','0') == 'on'){
                $remember = true;
            }else{
                $remember = false;
            }
            $account = I('post.account','0');
            $password = I("post.password",'0');
            
            if( D('User')->check($account, $password, $remember) ){
                $this->success("成功登录",U('Index/index'),0);
                return;
            }
        }
        layout(false);
        $this->display();
    }


    public function createVerify(){
        $config =    array(
            'fontSize'    =>    18,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }


    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    public function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }


    public function logout(){
        session("userId",null);
        session("userName",null);
        cookie(null,'blog_');
        session('[destroy]');
        $this->success('成功推出','index');
    }

}