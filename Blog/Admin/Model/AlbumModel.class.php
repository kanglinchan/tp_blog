<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/9/5
 * Time: 21:44
 */

namespace Admin\Model;
use Think\Model;


class AlbumModel extends Model{


    protected $_validate        =array(
        array('title','require','名称必须填写！'), //默认情况下用正则进行验证
        array('status','require','状态参数错误！'), //默认情况下用正则进行验证
        array('imageFile','require','封面不能为空！',0,"regex","self::MODEL_INSERT"), //默认情况下用正则进行验证
    );

    public function uploadTemp(){
        $file['temp'] = './Public/uploads/temp/';
        file_exists($file['temp']) or mkdir($file['temp'], 0777, true);

        $config = array(
            'maxSize'    =>    3145728 ,
            "rootPath"   =>   $file['temp'],
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub'    =>    false,
            "saveRule"   =>     array('uniqid',''),
        );

        $Upload = new \Think\Upload( $config );
        $rst = $Upload->upload();
        if( $rst === false ){
            return array("flag"=>false, "msg"=>$Upload->getError());
        }else{
            return array("flag"=>true, "msg"=>$file['temp'].$rst['file']['savename']);
        }
    }


    protected  $rootPath = "./Public";

    public function addCover( $resource, $width , $height, $cropWidth, $cropHeight, $x, $y  ){

        $filePath = "/uploads/cover/". date('Y-m').'/'. date('d').'/';
        $fileName = array_pop( explode("/",$resource) );
        file_exists( $this->rootPath.$filePath ) OR mkdir($this->rootPath.$filePath,0777,true);
        $image = new \Think\Image();
        $image->open( $resource );
        $image->thumb($width , $height,\Think\Image::IMAGE_THUMB_FIXED);
        $image->crop($cropWidth, $cropHeight, $x,$y )->save( $this->rootPath.$filePath.$fileName );
        unlink( $resource);
        return $filePath.$fileName;
    }




    public function addAlbum($data){

        $Album = D("Album");
        if( !$Album->create($data) ){
            isset($data['imageFile']) && unlink( $data['imageFile'] );
            return array("flag"=>false, "msg"=> $Album->getError());
        }

        var_dump( $data['imageFile'] );

        $resource = $this->addCover( $data['imageFile'], $data['width'], $data['height'], $data['cropWidth'], $data['cropHeight'], $data['y'], $data['y'] );
        $data['cover'] = $resource;

        $result = $Album->add($data);
        if( !$result ){
            unlink( $this->rootPath. $resource );
            return array("flag"=>false, "msg"=>"写入数据失败");
        }else{
            return array('flag'=> true, 'msg'=> "成功添加封面");
        }
    }


    public function updateAlbum( $data ){

        $Album = D("Album");
        if( !$Album->create($data) ){
            isset($data['imageFile']) && unlink( $data['imageFile'] );
            return array("flag"=>false, "msg"=> $Album->getError());
        }

        if( isset($data['imageFile']) ){
            $resource = $this->addCover( $data['imageFile'], $data['width'], $data['height'], $data['cropWidth'], $data['cropHeight'], $data['y'], $data['y'] );
            $data['cover'] = $resource;
        }



        $result = M("Album")->where("id='%d'", $data['id'] )->save($data);

        if( !$result ){
            if( isset($data['cover']) ){
                unlink( $this->rootPath.$data['cover']);
            }
            return array("flag"=>false, "msg"=>"更新数据失败");
        }else{
            return array('flag'=> true, 'msg'=> "更新封面成功");
        }

    }


    public function  uploadPicture($aid){

        //判断用户是否拥有该相册
        $uid = M("Album")->where("id='%d'",$aid)->field("u_id")->find();
        if( $uid['u_id'] != session( C("USER_AUTH_KEY") ) ){
            return array("flag"=>true, "msg"=>"错误操作");
        }

        //设置上传路径
        $rootDir = './Public';
        $path =  '/uploads/picture/'.date("Y-m").'/'.date('d').'/';
        file_exists($rootDir.$path) or mkdir($rootDir.$path, 0777, true);
        //配置图片参数
        $config = array(
            'maxSize'    =>    3145728 ,
            "rootPath"   =>     $rootDir,
            "savePath"   =>     $path,
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub'    =>    false,
            "saveRule"   =>     array('uniqid',''),
        );
        $Upload = new \Think\Upload( $config );
        $info = $Upload->upload();
        if( $info === false){
            return array("flag"=>false, "msg"=>$Upload->getError());
        }

        //缩略图
        $image = new \Think\Image();
        $image->open( $rootDir.$path.$info['file']["savename"] );
        $thumbName = "thumb-".$info['file']["savename"];
        $image->thumb(200, 200)->save($rootDir.$path.$thumbName);

        //写入数据库
        $data['a_id'] = $aid;
        $data['picture'] = $path.$info['file']["savename"];
        $data['thumb']      = $path.$thumbName;
        $pictureResult = M("picture")->add($data);
        if($pictureResult === false){
            unlink( $rootDir.$path.$info['file']["savename"] );
            return array("flag"=>false, "msg"=>"写入是失败");
        }else{
            return array("flag"=>true, "msg"=>"保存成功");
        }



    }

}