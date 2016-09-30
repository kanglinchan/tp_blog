<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/9/3
 * Time: 21:59
 */

namespace Admin\Controller;
use Think\Controller;


class AttributeController extends CommonController{

    public function index(){

        $result = M("Attribute")->select();
        $this->attribute = $result;
        $this->display();
    }


    public function addAttribute(){
        $data['name']       = I("post.name");
        $data['value']      = I("post.value");

        $Attribute = D("Attribute");
        if( !$Attribute->create($data) ){
            $this->error( $Attribute->getError() );
        }

        $result =  $Attribute->add( $data );
        if($result){
            $this->success("添加属性成功",U("Attribute/index"));
        }else{
            $this->error("添加属性失败",U("Attribute/index"));
        }
    }


    public function removeAttribute(){
        $id = I("get.id",0,"int");
        if($id == 0){
            $this->error("参数错误");
        }
        $result = M("Attribute")->where("id='%s'",$id)->delete();
        if($result){
            $this->success("删除成功", U("Attribute/index"));
        }else{
            $this->error("删除失败",U("Attribute/index"));
        }
    }


    public function editAttribute(){
        if(IS_GET){
            $id = I("get.id",0,"int");
            if($id == 0){
                $this->error("参数错误");
            }
            $attribute = M("Attribute")->where("id='%s'",$id)->find();
            $this->attribute = $attribute;
        }

        if(IS_POST){
            $id = I("get.id",0,"int");
            if($id == 0){
                $this->error("参数错误");
            }
            $data['name']   = I("post.name",'');
            $data['value']  = I("post.value",'');

            $Attribute = D("Attribute");
            if( !$Attribute->create($data)){
                $this->error( $Attribute->getError() );
            }
            $result = $Attribute->where("id='%s'",$id)->save($data);
            if($result){
                $this->success("更新成功", U("Attribute/index"));
            }else{
                $this->error("更新失败",U("Attribute/index"));
            }
            return;
        }


        layout(false);
        $this->display();
    }
}