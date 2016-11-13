<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/10/18
 * Time: 14:39
 */

namespace Home\Controller;
use Think\Controller;

class ArticleController extends Controller{
    function index(){

    }


    function getArticle(){
        $id = I("get.id",0,'int');
        $Mode = M();

        $data = $Mode
            ->table("blog_article AS A")
            ->join("LEFT JOIN blog_tag AS T ON A.id = T.article_id")
            ->join("LEFT JOIN blog_category AS C ON A.category_id = C.id")
            ->field('A.id, C.name AS category, GROUP_CONCAT(T.name) AS tags,  A.title, A.content, C.name, A.view_count AS viewCount, A.last_modify_time AS time, A.cover, A.summary ')
            ->where("A.id=%d AND A.visible = 1",$id)
            ->group('A.id')
            ->find();
        //转义返回
        $data && $data['content'] = htmlspecialchars_decode( $data['content'] );
        die( json_encode( $data ) );

    }

    function categoryArticle(){
        $categoryId = I("get.cid",0, "int");
        $pageNumber = I("get.pNumber",1,"int");

        //子语句
        $subSql = M("category")
            ->field("id")
            ->where("pid = %d OR id = %d", $categoryId ,$categoryId)
            ->buildSql();

        $data = M()
            ->table("blog_Article A")
            ->join("LEFT JOIN blog_tag T ON A.id = T.article_id")
            ->field("A.id, A.title,A.last_modify_time ,  CONCAT('/index.php',A.cover ) AS cover   , A.summary, GROUP_CONCAT(T.name) AS tags")
            ->where("category_id IN ".$subSql)
            ->group("A.id")
            ->limit( $pageNumber,5 )
            ->select();

       // dump($data);

        die( json_encode($data ) );

    }
}