<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/8/31
 * Time: 0:08
 */

/*//递归成数列表
public function createTreeList($list, $pid =0){
    $result = array();
    foreach ($list as $item){
        if($item['pid'])
    }
}*/

//获取ip
function getIp(){
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif(!empty($_SERVER["REMOTE_ADDR"])){
        $cip = $_SERVER["REMOTE_ADDR"];
    }
    else{
        $cip = "无法获取！";
    }
    return $cip;
}