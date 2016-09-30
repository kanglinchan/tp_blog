<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/9/2
 * Time: 19:05
 */

    namespace Admin\Model;
    use Think\Model;

    class CategoryModel extends Model{
        protected $_validate    =   array(
            array('name','require','分类名称必须填写！'),
            array('pid','require','父级分类不能为空'),
        );


        /*
         * 分类列表
         * */
        public function getCategoryList(){
            $listData =  M("Category")->order("sort desc")->select();
             return $this->tree($listData);
        }


        protected  function tree( $data, $pid =0, $deep=0  ){
            static $result = array();
            foreach ($data as $item ){
                if($item['pid'] == $pid){
                    $item["deep"] = $deep;
                    $item["html"] = str_repeat('——',$deep);
                    $result[] = $item;
                    $this->tree( $data, $item['id'],$deep+1 );
                }
            }
            return $result;
        }

       /* public function delCategory($id){
            $result = M("Category")->where("pid = '%s'",$id)->find();

        }*/
    }