<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/8/27
 * Time: 18:44
 */
   namespace Admin\Controller;
   use Think\Controller;
   //use Think\Controller\RestController;
   use Org\Util\Rbac;


   class CommonController extends Controller{
       protected function _initialize(){
           //$this->access();
          $this->checkLogin();
      }

       public function checkLogin(){

           if(!session('?userId')){     //不存在session
               //判断客户端携带的cookie
               if(!D('User')->cookieCheck()){
                   $this->error("请登录",U("Login/index"));
               }

           }

           if( C("USER_AUTH_ON") && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE'))) ) {
               //AccessDecision($appName=APP_NAME)方法,检测当前项目模块操作,
               //是否存在于$_SESSION['_ACCESS_LIST']数组中
               //$_SESSION['_ACCESS_LIST']['当前操作']['当前模块']['当前操作']是否存在。
               //如果存在表示有权限，返回true；否则返回flase。
               if (!RBAC::AccessDecision(MODULE_NAME)) {
                   //检查认证识别号
                  $this->error("内有权限",U("Login/index") );
               }
           }
       }



       public function access()
       {
           //import('@.ORG.Util.Cookie');
           // 用户权限检查
           //USER_AUTH_ON 是否开启认证
           //NOT_AUTH_MODULE 是否在非认证模块
           if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))) { //NOT_AUTH_MODULE 默认无需认证模块

               //AccessDecision($appName=APP_NAME)方法,检测当前项目模块操作,
               //是否存在于$_SESSION['_ACCESS_LIST']数组中
               //$_SESSION['_ACCESS_LIST']['当前操作']['当前模块']['当前操作']是否存在。
               //如果存在表示有权限，返回true；否则返回flase。
               if (!RBAC::AccessDecision(MODULE_NAME)) {
                   //检查认证识别号
                   if ( session('?'+C("USER_AUTH_KEY")) ) { // 用户认证SESSION标记
                       //跳转到认证网关
                       $this->error( "请登录",U( C("USER_AUTH_GATEWAY") ) );
                   }
               }
           }
       }
   }