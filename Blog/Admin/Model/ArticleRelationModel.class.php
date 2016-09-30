<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/9/11
 * Time: 18:48
 */

    namespace Admin\Model;
    use Think\Model;
    use Think\Model\RelationModel;

    class ArticleRelationModel extends RelationModel{

        protected $tableName = "article";

        protected $_validate = array(
            array('title','require','文章标题必须填！'),
            array('content','require','文章内容不能空！'),
            array('cover','require','封面不能空！'),
            array('category_id','require','分类不能为空！'),
            array('summary','require','描述不能为空！')
        );


        protected $_link    = array(
            "tag"   =>  array(
                "mapping_type"      =>self::HAS_MANY,
                "foreign_key"       =>"article_id",
            ),
            "attribute"     =>  array(
                "mapping_type"          =>self::MANY_TO_MANY,
                "foreign_key"           =>"article_id",
                'relation_foreign_key'  =>"attribute_id",
                'relation_table'        => 'blog_article_attribute'
            )
        );
    }