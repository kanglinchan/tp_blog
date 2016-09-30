<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/8/27
 * Time: 23:17
 */

namespace Admin\Model;
use Think\Model;


class UserModel extends Model{

    protected $_validate    =   array(
        array('username','','帐号名称已经存在！',0,'unique',1),
        array('email','','电子邮箱已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
        array('repassword','password','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
    );


    public function check($account, $password, $flag=false){
        $user = D("user");
        if(!$user->create()){
            echo '验证错误';
            return false;
        }
        $result = $user->where("username='$account' OR email='$account' ")->field("salt,status,password,id,username")->find();
        if($result['password'] == md5($password)){
            //session('userId',$result['id']);
            session('username',$result['username']);
            session(C("USER_AUTH_KEY"), $result["id"]);

            if($flag){
                cookie('token', $result['id'].md5($result['password'].$result['salt']), array('expire'=>7*24*3600,'prefix'=>'blog_'));
            }
            if($result['username'] == C('ADMIN_AUTH_KEY')) {
                session(C('ADMIN_AUTH_KEY'), true);
            }
            return true;
        }else{
            return false;
        }
    }


    public function cookieCheck(){
        $token =  substr( cookie('blog_token'),-32 );
        $id = intval( substr(cookie('blog_token'),0,-32) );
        if( empty($token) ){
            return false;
        }
        $result = M('user')->where( array('id' => $id) )->field("salt,password,id,username")->find();
        if( md5($result['password'].$result['salt']) == $token ){
           // session('userId',$result['id']);
            session(C("USER_AUTH_KEY"), $result["id"]);
            if($result['username'] == C('ADMIN_AUTH_KEY')) {
                session(C('ADMIN_AUTH_KEY'), true);
            }
            session('username',$result['username']);
            return true;
        }else{
            return false;
        }
    }


    public function insertUser( $data,$userRole ){
        $db = new Model();
        $db->startTrans();
        $result = $this->add($data);

        if(!$result){
            return array('flag'=>false, "msg"=>"用户数据写入失败");
        }

        for ($i =0; $i < count($userRole) ;$i++ ){
            if( preg_match('/[\d]*/',$userRole[$i]) ){
                $userRole[$i] = array( "role_id"=>$userRole[$i], "user_id"=>$result );
            }else{
                $db->rollback();
                return array('flag'=>false, "msg"=>"角色id错误");
            }
        }

        $flag = M('role_user')->addAll($userRole);

        if($flag === false || $result === false){
            $db->rollback();
            return array('flag'=>false, "msg"=>"角色添加失败");
        }else{
            $db->commit();
            return array('flag'=>true, "msg"=>"角色添加成功");
        }

    }


    public function updateUser($id, $data,$userRole ){
        $db = new Model();
        $db->startTrans();
        $result = M("user")->where("id = '%s'",$id)->save($data);

        if($result === false){
            $db->rollback();
            var_dump($data);
            die();
            return array('flag'=>false, "msg"=>"用户数据更新失败");
        }

        $flag = M("role_user")->where("user_id='%s'",$id)->delete();

        $flag2 = M('role_user')->addAll($userRole);

        if($flag === false || $result === false || $flag2 === false){
            $db->rollback();
            return array('flag'=>false, "msg"=>"用户更新失败");
        }else{
            $db->commit();
            return array('flag'=>true, "msg"=>"用户更新成功");
        }
    }



    /*
     * remove user
     * @param int $id
     *
     * */
    public function removeUser($id){
        $db = new Model();
        $db->startTrans();

        $userFlag = M("user")->where("id='%s'",$id)->delete();
        $roleFlag = M("role_user")->where("user_id='%s'",$id)->delete();

        if($userFlag === false || $roleFlag === false){
            $this->rollback();
            return array("flag"=>false, 'msg'=>'用户删除失败');

        }else{
            $db->commit();
            return array("flag"=>true, 'msg'=>"用户删除成功");
        }

    }




}