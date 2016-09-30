<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/9/4
 * Time: 0:38
 */

namespace Admin\Controller;
use Think\Controller;

class AlbumController extends CommonController{
    public function index(){

        $data = array();
        if( session( C("ADMIN_AUTH_KEY")) ){
            $data = M("Album")->select();
        }else{
            $data = M("Album")->where("u_id='%d'",session("userId") )->select();
        }

        $this->data = $data;

        $this->display();
    }


    public function addAlbum(){

        if(IS_POST){

            $data['width']          = I("post.width",200,'int');
            $data['height']         = I("post.height",200,'int');
            $data['x']              = I("post.x", 0, "int");
            $data['y']              = I("post.y", 0, "int");
            $data["cropWidth"]      = I("post.cropWidth",200, 'int');
            $data['cropHeight']     = I("post.cropHeight",200, 'int');
            $data['imageFile']      = I("post.imageFile",'');
            $data['title']          = I("post.title");
            $data['status']         = I("post.status",0,'int');
            $data['u_id']           = session(C("USER_AUTH_KEY"));



            $result = D("album")->addAlbum($data);
            if($result['flag']){
                $this->success($result['msg'], U("Album/index"));
            }else{
                $this->error($result['msg'], U("Album/index"));
            }

            return;
        }
        layout(false);
        $this->display();
    }


    public function uploadCover(){
        if( IS_POST ){
            $_FILES['file']['name'];
            $result = D("Album")->uploadTemp();
            die( json_encode($result) );
        }
    }

    public function editAlbum(){
        if( IS_GET ){

            $id = I("get.id", 0, "int");
            if( $id === 0){
                $this->error( "arguments error" );
            }

            $data = M("Album")->where("id='%s'",$id)->find();

            $this->data = $data;
            layout(false);
            $this->display();
        }

        if( IS_POST ){

            $data['id']             = I('get.id',0,'int');
            if( $data['id'] == 0 ){
                $this->success("参数错误",U("Album/index"));
            }

            $data['width']          = I("post.width",200,'int');
            $data['height']         = I("post.height",200,'int');
            $data['x']              = I("post.x", 0, "int");
            $data['y']              = I("post.y", 0, "int");
            $data["cropWidth"]      = I("post.cropWidth",200, 'int');
            $data['cropHeight']     = I("post.cropHeight",200, 'int');
            $data['title']          = I("post.title");
            $data['status']         = I("post.status",0,'int');
            $data['u_id']           = session(C("USER_AUTH_KEY"));


            if( !empty(I("post.imageFile",'')) ){
                $data['imageFile'] = I("post.imageFile",'');
            }


            $result = D("album")->updateAlbum($data);
            if($result['flag']){
                $this->success($result['msg'], U("Album/index"));
            }else{
                $this->error($result['msg'], U("Album/index"));
            }

            return;
        }
    }


    public function pictureList(){

        if( IS_GET){
            $aid = I("get.aid",0 ,"int");
            if($aid == 0){
                $this->error("参数错误");
            }
            $this->aid = $aid;

            $data = M("picture")->where("a_id='%s'",$aid)->field("id,picture,thumb")->select();
            $data['aid'] = $aid;
            $this->data = $data;
        }
        


        $this->display();
    }


    public  function addPicture(){

        $aid = I("get.aid",0 ,"int");
        if($aid == 0){
            $this->error("参数错误");
        }
        if(IS_POST){
            var_dump(I('get.'));
           var_dump( I("post.") );
            $result  = D("Album")->uploadPicture( $aid );
            die( json_encode($result) );
        }
        if( IS_GET){

            $this->aid = $aid;
        }
        layout(false);
        $this->display();
    }


    public function removeAlbum(){
        $aid = I("get.aid",0,"int");
        if($aid == 0){
            $this->error("参数错误");
        }

        $Album = M("Album");
        $data = $Album->where("id='%d'",$aid)->field("u_id")->find();
        if($data['u_id'] != session( C("USER_AUTH_KEY") ) &&  !session( C("ADMIN_AUTH_KEY") ) ){
            $this->error("没有权限删除相册");
        }

        $picture =  M("picture")->where("a_id='%s'",$aid)->field("id")->find();


        if( $picture===false ){
            $this->error("内部错误");
        }
        if( !empty($picture) ){
            $this->error("该相册还有照片不能删除");
        }

        $result = $Album->where("id='%s'",$aid)->delete();
        if( $result === false ){
            $this->error("删除出错");
        }else{
            $this->success("成功删除");
        }
    }


    public function removePicture(){
        if( IS_GET ){
            $id = I("get.id", 0, "int");
            if( $id === 0 ){
                $this->error("参数错误");
            }

            $Picture = M("picture");
            $subQuery = $Picture->where("id='%s'",$id)->field("a_id")->buildSql();
            $data = M("album")->where( "id in".$subQuery )->field("u_id")->find();

            if( $data['u_id'] != C("USER_AUTH_KEY") && !session( C("ADMIN_AUTH_KEY") ) ){
                $this->errer("权限不够");
            }

            $pictureData = $Picture->where("id='%s'",$id)->field('thumb, picture')->find();


            $result =  $Picture->where("id='%s'", $id)->delete();
            if( $result === false){
                $this->error("上传错误");
            }else{
                unlink("./Public".$pictureData['thumb']);
                unlink("./Public".$pictureData['picture']);
                $this->success("删除成功");
            }

        }




    }
}