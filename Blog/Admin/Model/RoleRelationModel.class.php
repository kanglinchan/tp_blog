<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/8/30
 * Time: 17:58
 */

namespace Admin\Model;
use Think\Model;
use Think\Model\RelationModel;


class RoleRelationModel extends RelationModel{

    //define table
    protected $tableName = "role";

    protected $_validate = array(
        array('level',array(1,2,3),'值的范围不正确！',0,'in'),
        array('node_id','require','权限节点必须勾选！'),
        array('node_id','require','level参数错误！'),
        array('role_id','number','角色id参数不是数字！'),
        array('node_id','number','权限id参数不是数字！'),
        array('remark','require','角色描述必须填写！'),

    );

    protected $_link        =  array(
        "access"        => array(
            "mapping_type"          =>  self::HAS_MANY,
            'foreign_key'           => 'role_id',
            'mapping_fields'        => 'node_id',
            //"as_fields"             =>  'node_id',
        ),
        /*"user"          =>array(
            "napping_type"          =>  self::MANY_TO_MANY,
            'relation_table'        =>  'blog_role_user',
            "foreign_key"           =>  "role_id",
            "relation_foreign_key"  =>  "user_id",
            'mapping_fields'        => 'username'

        ),*/
    );


        public function getCurrentRole( $id ){
            $allAccessNode = M("Node")->select();
            $currentRole = D("RoleRelation")->where("id='%s'",$id)->Relation(true)->find();

            foreach($currentRole['access'] as $k => $v){ //列出角色拥有的节点设置成一维的数组['1','2']
                $currentRole['access'][$k] = $v['node_id']; //合并数组
            }

            foreach ( $allAccessNode as $k => $v ){ //判断当前节点是否已经设置
                if( in_array($v['id'], $currentRole['access']) ){ //如果节点中在 $currentRole['access']出现则登记为checked
                    $allAccessNode[$k]['checked'] = 'checked';
                }else{
                    $allAccessNode[$k]['checked'] = '';
                }
            }
            $currentRole['access'] = $this->createTreeList($allAccessNode);
            unset($allAccessNode);
            return $currentRole;
        }


    protected function createTreeList($list, $pid = 0){
        $result = array();
        foreach ($list as $item){
            if( $item['pid'] == $pid ){
                $item['child'] = $this->createTreeList($list, $item['id']);
                $result[] = $item;
            }
        }
        return $result;
    }


    /*
     * 编辑节点
     * @params int $id roleID
     * @params array $roleData role data
     * @params array $roleData access data
     * @return array array('flag'=>'boolean', 'msg'=>"message")
     * */
    public function updateRole($id, $roleData ,$accessData){
        $db = new Model();
        $db->startTrans(); //开启

        $role = M('role');
        if(!$role->create($roleData)){
            return array('flag'=>false, 'msg'=>"角色表数据出错:".$role->getError());
        }
        $roleFlag = $role->where("id=$id")->save($roleData);

        $access = M("access");
        $accessFlag1 = $access->where("role_id=$id")->delete();

        $accessFlag2 = true;

        if( !empty($accessData) ){
            $accessFlag2 = $access->addAll($accessData);
        }
        if( $roleFlag===false || $accessFlag1===false || $accessFlag2===false ){
            $db->rollback();
            return array("flag"=>false, "msg"=>"提交未能成功");
        }else{
            $result =  $db->commit();
            if($result){
                return array("flag"=>true, "msg"=>"提交成功");
            }else{
                return array("flag"=>false, "msg"=>"提交失败");
            }
        }
    }



    /*
     * 删除角色
     * @param int $id 角色id
     * @return boolean
     * */
    public function removeRole($id){
        $mode = new Model();
        //开启事务
        $mode->startTrans();
        //删除关联的角色节点
        $accessFlag = M("access")->where("role_id=$id")->delete();
        //删除自身角色节点
        $roleFlag = M("role")->where("id=$id")->delete();
        if($accessFlag === false || $roleFlag === false  ){
            $mode->rollback();
            return false;
        }else{
            $mode->commit();
            return true;
        }
    }

}