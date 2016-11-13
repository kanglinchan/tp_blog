<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/10/19
 * Time: 16:54
 */

    namespace Home\Controller;
    use Think\Controller;

    class HomeController extends Controller{
        public function index(){

            $pageNumber = I("get.pageNumber",1, 'int');
            $path = $_SERVER['host']."Public";

            $Model = M();
            $data = $Model
                ->table("blog_article A")
                ->join("LEFT JOIN blog_tag T ON A.id = T.article_id")
                ->field("A.id, CONCAT( '$path', A.cover) AS cover, A.title, A.last_modify_time, A.summary, GROUP_CONCAT(T.name) AS tags")
                ->group("A.id")
                ->order('A.create_time DESC')
                ->page( $pageNumber, 5)
                ->select();

            die( json_encode($data) );
        }
    }