<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/8/28
 * Time: 21:26
 */

namespace Admin\Model;
use Think\Model\RelationModel;


class UserRelationModel extends RelationModel{

    protected $tableName =  "user";     //定义tabel name

/*    protected $_validate    =   array(
        array('username','require','验证码必须！'), //默认情况下用正则进行验证
        array('status',array(0,1),'值的范围不正确！',0,'in'), // 当值不为空的时候判断是否在一个范围内
        array('name','','帐号名称已经存在！',0,'unique',1),
        array('email','','电子邮箱已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
        array('repassword','password','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
    );*/


    protected $_link = array(
        'Role' => array(
          'mapping_type'            =>  self::MANY_TO_MANY,
          'relation_table'          =>  'blog_role_user',    //此处应显式定义中间表名称，且不能使用C函数读取表前缀
          'mapping_name'            =>  'Role',              //要关联的模型类名
          'foreign_key'             =>  'user_id',           //关联的外键名称
          'relation_foreign_key'    =>  'role_id',            //关联表的外键名称
            "mapping_fields"        =>  'remark,id',
        ),
    );



    /*
     * 获取用户数据
     * @param int $id user id
     * @return array
     * */
    public function getUserData($id){
        $userData = $this->where("id=%s",$id)->Relation(true)->find();
        $roles = M('role')->select();
        foreach ($userData['Role'] as $v ){
            $userRoleData[] = $v['id'];
        }
        foreach ($roles as $k => $v){
            if( in_array($v['id'], $userRoleData) ){
                $roles[$k]['checked'] = 'checked';
            }else{
                $roles[$k]['checked'] = null;
            }
        }
        $userData['Role'] = $roles;
        return $userData;

    }
}