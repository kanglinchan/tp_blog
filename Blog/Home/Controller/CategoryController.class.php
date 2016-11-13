<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/10/18
 * Time: 16:33
 */

namespace Home\Controller;
use Think\Controller;

class CategoryController extends Controller{
    public function getCategory(){
         $pid = I("get.pid", 0, "int");
         $result = D("Category")->getCategoryList( $pid );
        die( json_encode( $result ) );
    }

}