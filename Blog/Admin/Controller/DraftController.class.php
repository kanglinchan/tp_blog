<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/9/12
 * Time: 16:25
 */

namespace Admin\Controller;
use Think\Controller\RestController;

Class DraftController extends CommonController {
    protected $allowMethod    = array('get','post','put'); // REST允许的请求类型列表
    protected $allowType      = array('html','xml','json'); // REST允许请求的资源类型列表

    /*Public function read_get_html(){
        // 输出id为1的Info的html页面
    }
    Public function read_get_xml(){
        // 输出id为1的Info的XML数据
    }
    Public function read_xml(){
        // 输出id为1的Info的XML数据
    }
    Public function read_json(){
        // 输出id为1的Info的json数据
    }*/

    public function saveDraft(){
        echo $this->_method;
        var_dump( $this->_type  );
    }
}