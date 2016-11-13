<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/10/18
 * Time: 19:31
 */

namespace Home\Controller;
use Think\Controller;

class EmptyController extends Controller{

    public function _empty(){
        echo "00";
    }

    public function search(){
        die("");
    }

}