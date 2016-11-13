<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/10/18
 * Time: 16:45
 */

namespace Home\Model;
use Think\Model;

class CategoryModel extends Model{

    public function getCategoryList($pid){
        $Category =  M("Category")->field('pid,id,name')->select();
        $CategoryList = $this->getList( $Category, $pid );

        //print_r( $CategoryList );
        return $CategoryList;
    }

    protected function getList( $list, $pid = 0 ){
        $result = null;
        foreach ( $list as $key => $value ){
            if( $value['pid'] == $pid ){
                $children = $this->getList( $list,$value['id'] );
                !empty($children) && ( $value['child'] = $children);
                unset($value['pid']);
                $result[] = $value;

            }
        }
        return $result;
    }

}