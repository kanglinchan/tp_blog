<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/10/18
 * Time: 18:07
 */

namespace Home\Controller;
use Think\Controller;

class SearchController extends Controller{
    public function getArticle(){


       $keyWord = I("get.keyWord","");
        $pageNumber =  I("get.pageNumber",1, "int");

        $host = 'http://'.$_SERVER['HTTP_HOST'].'/Public';

        $where[ "title" ] = array('like', "%".$keyWord."%" );
        $where['content'] = array('like', "%".$keyWord."%" );
        $where['_logic'] ="OR";
        $complex['_complex' ] = $where;
        $complex['visible'] = array("eq",1);
        $Model = M();
        $data = $Model
            ->table("blog_article A")
            ->join("LEFT JOIN blog_tag T ON A.id = T.article_id")
            ->field("A.id, A.title, CONCAT( '$host' , A.cover) AS cover, A.summary, A.last_modify_time, GROUP_CONCAT(T.name) AS tags")
            ->group("A.id")
            ->where($complex)
            ->page($pageNumber, 5)
            ->select();

//        dump( $Model->getLastSql() );
//        dump($data);
        die( json_encode($data) );
    }
}