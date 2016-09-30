<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/8/29
 * Time: 15:59
 */

    namespace Admin\Model;
    use Think\Model;


    class NodeModel extends Model{
        //验证
        protected $_validate = array(
           // array('name','','帐号名称已经存在！',0,'unique',3), // 在新增的时候验证name字段是否唯一
            array('title','require','中文名称必须填写！'),
            array('pid','number','pid参数错误'),
            array('sort','number','sort参数错误'),
            array('level',array(1,2,3),'值的范围不正确！',0,'in'), // 当值不为空的时候判断是否在一个范围内
        );


        //返回节点列表数据
        public function getNodeList(){
            $data = M('Node')->field(array('id','pid','title'))->order('sort desc')->select();
            return $this->tree($data);
        }








        public function tree($data, $pid = 0){
            $result = array();
            foreach ($data as $item){
                if($item['pid'] == $pid){
                    $item['child'] = $this->tree($data, $item['id']);
                    $result[] = $item;
                }
            }
            return $result;
        }


        public function remove($id){
            //判断是否有节点指向当节点
            $result = M('node')->where("pid=$id")->find();
            if(empty($result)){
                $delResult = M("node")->where("id=$id")->delete();
                if($delResult == false){
                    return array('flag'=>"false",'msg'=>'删除失败');
                }else{
                    return array('flag'=>"true",'msg'=>'成功删除');
                }
            }else{
                return array('flag'=>'false', "msg"=>"还有子节点不能删除");
            }

        }
    }














