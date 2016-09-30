<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/9/2
 * Time: 18:31
 */

namespace Admin\Controller;
use Think\Controller;


    class CategoryController extends CommonController{
        //分类列表
        public function index(){
            $result =  D("Category")->getCategoryList();
            if(!$result){
                $this->error("数据获取失败");
            }
            $this->category = $result;
            $this->display();
        }

        public function AddCategory(){
            if(IS_POST){
                $data['name']   = I("post.name",'');
                $data['pid']    = I("post.pid",0,"int");
                $data['sort']   = I("post.sort",0,"int");

                $cat = D("Category");
                if(!$cat->create($data)){
                    $this->error($cat->getError());
                }

                $result = $cat->add($data);
                if( $result ){
                    $this->success("添加成功");
                }else{
                    $this->error("添加失败");
                }
                return ;
            }
            layout(false);
            $this->display();
        }


        //编辑分类
        public function editCategory(){
            if(IS_GET){

                $argv   = explode('_', I("get.deepId",''));
                $deep   = intval( $argv[0] );
                $id     = intval($argv[1]);
                if( !isset( $deep ) || !isset( $id )  ){
                    echo "参数错误";
                }

                $data['id'] = $id;

               $name = M("Category")->where("id='%s'",$id)->field('name')->find();
                if( !$name ){
                    $this->error("不能更新,不存在该分类");
                }

                $cate[] = array("id"=> "0", "name"=>"顶级分类");
                $data = array_merge($data,$name);

                //如果是不是一级分类可以更改分类
                if( $deep != 0 ){
                    $result =  M("Category")->where("pid=0")->field('id,name')->select();
                    $cate = array_merge($cate,$result);
                    if(!$result){
                        $this->error("获取数据出错");
                    }
                }

                $data['list'] = $cate;
                $this->data = $data;
                layout(false);
                $this->display();
            }


            if(IS_POST){
                $id             =   I("get.id",0,"int");
                if($id == 0){
                    var_dump($id);
                    $this->error("id错误");
                }
                $data['pid']    =   I("post.pid",0, "int");
                $data['name']   =   I("post.name",'');
                $data['sort']   =   I("post.sort");

                $category = D("Category");
                if(!$category->create($data)){
                    $this->error($category->getError());
                }

                $result = $category->where("id='%d'",$id)->save($data);
                if($result){
                    $this->success("修改分类成功");
                }else{
                    $this->error("修改分类失败");
                }

            }
        }


        public function removeCategory(){
            $id = I("get.id",0, "int");
            if( $id == 0 ){
                $this->error("参数错误");
            }
            $Category = M("Category");

            $result = $Category->where("pid = '%s'",$id)->find();
            if( !empty( $result )){
                $this->error("不能删除还有子节点",U('Category/index'));
            }

            $delResult = $Category->where("id='%s'",$id)->delete();
            if($delResult){
                $this->success("删除成功");
            }else{
                $this->error("删除失败");
            }
        }
    }