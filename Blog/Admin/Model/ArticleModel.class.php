<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/9/11
 * Time: 0:07
 */

    namespace Admin\Model;
    use Think\Model;

    class ArticleModel extends Model{
        


        public function getCategory(){
           $data =  M("category")->field("id, pid, name")->order("sort desc")->select();
           if( $data === false ){
               return array("flag"=>false, "msg"=>"内部错误");
           }else{
               return array( "flag"=>true, "msg"=> $this->getList( $data ) );
           }
        }


        protected function getList($list, $pid = 0, $deep=0){
            static $result = array();
            foreach ($list as $v){
                if( $v['pid'] == $pid){
                    $v['deep'] = $deep;
                    $result[] = $v;
                    $this->getList($list, $v['id'], $deep+1);
                }
            }
            return $result;
        }

        protected function tree( $list, $pid =0, $deep=0){
            $result = array();
            foreach ( $list as $v){
                if( $v['pid'] == $pid ){
                    $v['deep'] = $deep;
                    $v['child'] = $this->tree($list, $v['id'], $deep+1);
                    $result[] = $v;
                }
            }
            return $result;
        }


        public function getArticle( $id ){
            $article = M("Article")
                ->where("id='%d'",$id)
                ->field("id, title, cover, content, category_id, allow_comment, summary, visible")
                ->find();

            $tag = M("tag")
                ->where("article_id = '%s'",$id)
                ->field("name")
                ->select();

            $category = M("category")
                ->field("id, name, pid")
                ->order("sort desc")
                ->select();

            $ArticleAttribute = M("Article_attribute")
                ->where("article_id='%d'", $id)
                ->field("attribute_id")
                ->select();


            $allAttribute = M("Attribute")
                ->field("id, name")
                ->select();

            foreach ( $tag as $k => $v ){
                $tag[$k] = $v['name'];
            }

            $article['tag'] = implode("|", $tag);

            $article['content'] = htmlspecialchars_decode( $article['content'] );

            foreach ( $category as $k=> $v){
                if( $v['id'] == $article['category_id'] ){
                    $category[$k]['checked'] = true;
                }else{
                    $category[$k]['checked'] = false;
                }
            }

            foreach ( $ArticleAttribute as $k=> $v ){
                $ArticleAttribute[$k] = $v['attribute_id'];
            }

            foreach ($allAttribute as $k=> $v){
                if( in_array($v['id'], $ArticleAttribute )  ){
                    $allAttribute[$k]['selected'] = true;
                }else{
                    $allAttribute[$k]['selected'] = false;
                }
            }

            //var_dump( $category );
            $article['attribute'] = $allAttribute;
            $article['category'] = $this->getList( $category );
           // print_r($article);
           // die();
            return $article;
        }



        public function updateArticle($id, $data){

            $db = new model();
            $db->startTrans();

            $Article = D("ArticleRelation");
            if(  !$Article->create()){
                return array( "flag"=>true, "msg"=>$Article->getError() );
            }

            /*var_dump($data);
            die();*/

             $articleFlag = M("Article")
                ->where("id='%d'",$id)
                //->field("title, summary, content, cover, category_id, last_modify_time, allow_comment, visible")
                ->setField($data);

            $attribute = array();
            foreach ( $data['attribute'] as $k => $v ){
                $attribute[] = array( "article_id"=>$id, "attribute_id"=> intval($v) );
            }

            $removeAttribute = M("Article_attribute")->where("article_id='%d'", $id)->delete();
            $addAttribute = M("Article_attribute")->addAll($attribute);

            if( substr($data['tag'],0) == "|" ){
                $data['tag'] = substr($data['tag'],1);
            }
            if(  substr($data['tag'],-1) == "|" ){
                $data['tag'] = substr($data['tag'],-1);
            }

            $data['tag']   = explode("|", $data['tag']);
            $tag = array();
            foreach( $data['tag'] as $k =>$v ){
                if( empty($v) ){
                    unset( $data['tag'][$k] );
                }else{
                    $tag[$k] = array("article_id"=>$id, "name"=>$v);
                }
            }

            var_dump( $tag );

            $removeTag = M("tag")->where("article_id ='%d'",$id)->delete();
            $addTag = M("tag")->addAll($tag);


            if( $articleFlag ===false || $removeAttribute ===false || $addAttribute===false || $removeTag===false  ){
                $db->rollback();

                var_dump($articleFlag);
                var_dump($removeAttribute);
                var_dump($addAttribute);
                var_dump($removeTag);
                var_dump($addTag);


                die();
                return array("flag"=> false, "msg"=>"更新数据失败");
            }else{
                $db->commit();
                return array("flag"=> true, "msg"=>"更新成功");
            }

        }


        //删除文章
        public function delArticle($id){

            $db = new model();
            $db->startTrans();
            $articleData = M('Article')->field("cover")->where("id='%d'",$id)->find();
            $delTagFlag = M("tag")->where("article_id='%d'",$id)->delete();
            $delAttrFlag = M("Article_attribute")->where("article_id='%d'",$id)->delete();
            $delArtFlag = M("Article")->where("id='%d'",$id)->delete();

            if($articleData===false ||$delTagFlag===false || $delAttrFlag===false || $delArtFlag===false ){
                $db->rollback();
                return array("flag"=>false, "msg"=>"删除失败");
            }else{
                unlink( './Public'.$articleData['cover'] );
                $db->commit();
                return array("flag"=>true, "msg"=>"删除成功");
            }
        }


        //删除草稿
        public function delDraft($id){

            $draftData = M("Draft")->where("id='%d'",$id)->field('content')->find();

            $draftData = json_decode( htmlspecialchars_decode($draftData['content']) );
            $draftData = $draftData->cover;
            $flag = M("Draft")->where("id='%d'",$id)->delete();
            if( $flag === false){
                return array("flag"=>false, "msg"=>"删除失败");
            }else{
                unlink('./Public'.$draftData);
                return array("flag"=>true, "msg"=>"删除成功");
            }

            /*var_dump( $draftData );

            die();*/

        }
    }