<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/9/10
 * Time: 14:29
 */
    namespace Admin\Controller;
    use Think\Controller;


    class ArticleController extends CommonController{
        public function index(){


            $current =I("number",0,'int');
            $Article = M("Article");
            $data = M()
                ->table("blog_article AS A")
                ->join("LEFT JOIN blog_user AS U ON A.user_id = U.id")
                ->join("LEFT JOIN blog_category AS C ON A.category_id = C.id")
                ->join("LEFT JOIN blog_comment AS CT ON A.id = CT.article_id")
                ->field('U.username , C.name, A.title, A.id, A.last_modify_time, count(CT.id) AS count')
                ->group("A.id")
                ->page($current, C("PAGE_SIZE"))
                ->select();


            $total = $Article->count();
            $page['total'] = ceil($total / C('PAGE_SIZE'));
            $page['current'] = $current;

           /*var_dump($page);
            var_dump($data);
            die();*/
            $this->page = $page;
            $this->article = $data;
            $this->display();
        }


        public function comment(){

            $aid = I("get.id", 0, 'int');
            $current =I("number",0,'int');

            $articleData = M("article")
                ->field("id, title")
                ->where("id = %d", $aid)
                ->find();

            $commentData = M("comment")
                ->field("id, content, email, author, time, visible")
                ->where("article_id = %d", $aid)
                ->page($current, C('PAGE_SIZE') )
                ->order("id DESC")
                ->select();


            $total = M("comment")->count();
            $page['total'] = ceil($total / C('PAGE_SIZE'));
            $page['current'] = $current;
            $this->page = $page;

            $articleData['comments'] = $commentData;
            $this->article = $articleData;

            $this->display();

        }

        public function commentVisible(){
            $id = I("get.id", 0, 'int');
            $visible = M("comment")->where("id=%d", $id)->field("abs(visible -1) AS visible")->find();
            $data = M("comment")->where("id=%d",$id)->save( $visible );
            $data ? die(json_encode(array("flag"=>true))) : die(json_encode(array("flag"=>false)));
        }



        public function reply(){
            $id = I("post.id", 0, 'int');
            $data['content'] = I("post.content", '');
            $data['time'] = date("Y-m-d H:i:s");
            $data['visible'] = 1;
            $userId = session("userId");
            ($id == 0 || $data['content'] == '' ) AND die(json_encode(array("flag"=>false)));

            $path = M("comment")->where("id=%d",$id)->field("CONCAT(path,',',id) AS path, article_id")->find();
            $author = M("user")->where("id=%d",$userId)->field("username AS author, email")->find();

            $data= array_merge($path, $author,$data);
            $flag = M("comment")->add( $data );
            $data['id'] = $flag;

            $flag ? die(json_encode(array("flag"=>true,"msg"=>$data))) : die(json_encode(array("flag"=>false)));

        }


        public function getCateDate(){
            $categoryData = D("Article")->getCategory();
            $this->ajaxReturn( $categoryData );
        }


        public function addArticle(){

            if(IS_GET){
                $categoryData = D("Article")->getCategory();
                if($categoryData['flag'] == false){
                    $this->error($categoryData['msg']);
                }
                $attributeData = M("Attribute")->field("id, name")->select();
                if($attributeData  === false){
                    $this->error("读取属性失败");
                }
                $this->attribute = $attributeData;
                $this->categorys = $categoryData['msg'];
                $this->display();
            }

            if(IS_POST){

                $data['title']          =I("post.title","");
                $data['summary']        =I("post.summary","");
                $data['content']        =I("post.content","" );
                $data['cover']          =I("post.cover","");
                $data['user_id']        =session( C("USER_AUTH_KEY") );
                $data['category_id']    =I("post.category", 0, "int");
                $data['create_time']   = date("Y-m-d H:i:s");
                $data['attribute']      =   I("post.attribute",'',false);
                $data['last_modify_time']=date("Y-m-d H:i:s");
                $data['allow_comment']  =I("post.allowComment",0 ,'int');
                $data['visible']        =I("post.visible", 0, "int" );
                $tag                    =I("post.tag","");
                $tag                    =explode("|",$tag);

                for( $i=0; $i<count( $tag )-1; $i++ ){
                    $data['tag'][]        = array('name'=>$tag[$i] );
                }


                var_dump(I("post."));
               // die();

                //验证
                if(strlen($data['summary']) > 600){
                    $this->error("描述不能超过200字符");
                }
                if( $data['category_id'] <= 0 ){
                    $this->error("请选择文章分类");
                }

                $Article = D("ArticleRelation");
                if(  !$Article->create()){
                    $this->error( $Article->getError() );
                }

                //把文件移动到picture文件夹
                $moveRst = $this->moveImage( $data['cover'] );
                if( !$moveRst ){
                   $this->error("文件转移错误");
                }else{
                    $data['cover'] = $moveRst;
                }

                $result = $Article->Relation(true)->add($data);

                if( $result === false ){
                    $this->error("保存失败");
                }else{
                    $this->success("保存成功");
                }
            }
        }




        public function updateArticle(){

            if(IS_POST){


                $id = I("get.id",0, "int");

               // var_dump( I("post.") );
                $data['title']          =I("post.title","");
                $data['summary']        =I("post.summary","");
                $data['content']        =I("post.content","");
                $data['cover']          =I("post.cover","");
                $data['category_id']    =I("post.category", 0, "int");
                $data['attribute']      =   I("post.attribute",'',false);
                $data['last_modify_time']=date("Y-m-d H:i:s");
                $data['allow_comment']  =I("post.allowComment",0 ,'int');
                $data['visible']        =I("post.visible", 0, "int" );
                $data['tag']            =I("post.tag","");

                //验证
                if(strlen($data['summary']) > 600){
                    $this->error("描述不能超过200字符");
                }
                if($data['cover'] == ''){
                    $this->error("封面不能为空");
                }
                if( $data['category_id'] <= 0 ){
                    $this->error("请选择文章分类");
                }



               //把文件移动到picture文件夹
                $moveRst = $this->moveImage( $data['cover'] );
                if( !$moveRst ){
                    $this->error("文件转移错误");
                    return;
                }else{
                    $data['cover'] = $moveRst;
                }

                $result = D("Article")->updateArticle($id, $data);
               // $result = D("ArticleRelation")->relation(true)->where("id='%s'",$id)->save($data);

                if( $result['flag'] === false ){
                    $this->error( $result['msg'], U("Article/index"));
                }else{
                    $this->success( $result['msg'], U("Article/index"));
                }
            }
        }



        public function moveImage( $oldImage ){

            $rootDir = './Public';
            $savePath = '/uploads/cover/'. date('Y-m'). "/". date('d')."/";
            file_exists( $rootDir. $savePath ) OR mkdir( $rootDir.$savePath, 0777, true );
            $ImageName = array_pop( explode("/", $oldImage) );
            $result = rename($rootDir.$oldImage, $rootDir.$savePath.$ImageName );
            if( $result ){
                //unlink( $rootDir.$oldImage );
                return $savePath.$ImageName;
            }else{
                return false;
            }
        }


        public function uploaderCover(){
            if(IS_POST){
                $rootDir = "./Public";
                $path = "/uploads/temp/";
                $config = array(
                    'maxSize'    =>    3145728,
                    'rootPath'   =>    $rootDir,
                    'savePath'   =>    $path,
                    'saveName'   =>    array('uniqid',''),
                    'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
                    'autoSub'    =>    false,
                );

                // 实例化上传类
                $upload = new \Think\Upload( $config );

                // 上传文件
                $info   =   $upload->upload();
                if(!$info) {
                    // 上传错误提示错误信息
                    die( json_encode( array( "flag"=>false, "msg"=>$upload->getError() ) ) );
                    //;
                }else{
                    // 上传成功 获取上传文件信息
                     die( json_encode( array( "flag"=>true, "msg"=>$path.$info['file']['savename']) ) );
                }
            }
        }


        //删除图片
        public function removeCover(){
            $id = I("get.id",0 ,"int");
            if($id == 0){
                $this->error("参数错误");
            }

            $Article = M("Article");
            $coverRst = $Article->where("id = '%s'",$id)->field("cover")->find();

            if(!$coverRst){
                $result = json_encode(array("flag"=>false, "msg"=>"删除失败"));
                $this->ajaxReturn( $result );
            }

            $deleteRst =  $Article->where("id='%d'", $id)->save(array("cover"=>''));
            if(!$deleteRst){
                $result = json_encode(array("flag"=>false, "msg"=>"删除失败"));
                $this->ajaxReturn( $result );
            }else{
                //unlink( './Public'.$coverRst['cover'] );
                $result = json_encode(array("flag"=>true, "msg"=>"成功删除"));
                $this->ajaxReturn( $result );
            }
        }



        //保存草稿
        public function saveDraft(){

            if( IS_AJAX ){

                $id = I("get.id",'',"int");

                $params = file_get_contents("php://input");
                $stdObject = json_decode($params);
                $data['title']              = htmlspecialchars ($stdObject->title );
                $data['content']            = htmlspecialchars ($params );
                //var_dump( htmlspecialchars_decode(  $data['content'] ) );
                $data['last_save_time']     = date("Y-m-d H:m:s");


                if( empty($id) ){
                    $DraftResult = M("Draft")->add($data);
                    $result['id'] = $DraftResult;
                }else{
                    $DraftResult = M("Draft")->where("id='%s'",$id)->save($data);
                    $result['id'] = $id;

                }


                if( $DraftResult ){
                    $result['flag'] = true;
                    $result['msg']  = "添加到草稿成功";

                }else{
                    $result['flag'] = false;
                    $result['msg']  = "添加失败";
                }
                die( json_encode($result) );
            }
        }


        //草稿列表
        public function DraftList(){

            $current =I("number",0,'int');

            $Draft = M("Draft");
            $result = $Draft
                ->field("id, title, last_save_time")
                ->page($current,C("PAGE_SIZE"))
                ->select();

            $total = $Draft->count();

            $page['total'] = ceil($total / C('PAGE_SIZE'));
            $page['current'] = $current;

            $this->page = $page;

            $this->drafts = $result;
            $this->display();
        }


        //
        public function editDraft(){
            $id = I("get.id",0,"int");
            if($id  === 0){
                $this->error("参数错误");
            }

            $draftResult = M("Draft")->where("id='%d'", $id)->field("id, content")->find();
            $data['id'] = $draftResult['id'];
            if(empty($draftResult)){
                $this->error("内部错误",U("Article/index"));
            }
            $draftResult = json_decode( htmlspecialchars_decode( $draftResult['content'] ) );

            $draftResult = (array)$draftResult;

            $categoryData = D("Article")->getCategory();
            $allAttribute = M("Attribute")->field("id, name")->select();


            if(!$categoryData['flag']){
                var_dump($categoryData);
                die();
                $this->error("数据读取失败");
            }
            $cateList = $categoryData['msg'];
            foreach ( $cateList as $k => $v ){
                if( $v['id'] == $data['category'] ){
                    $cateList[$k]['checked'] = true;
                }else{
                    $cateList[$k]['checked'] = false;
                }
            }
            $draftResult['category'] = $cateList;


            foreach ($allAttribute as $k => $v){
                if( in_array($v['id'], $draftResult['attribute']) ){
                    $allAttribute[$k]['selected'] = true;
                }else{
                    $allAttribute[$k]['selected'] = false;
                }
            }
            $draftResult['attribute'] = $allAttribute;
            $draftResult["id"] = $id;

            $this->article= $draftResult;
            $this->display();
        }


        public function editArticle(){
            $id = I("get.id", 0, "int");
            if( $id == 0 ){
                $this->error("参数错误！");
            }


            $data = D("Article")->getArticle($id);



            $this->article = $data;
            $this->display();
        }


        //删除文章
        public  function removeArticle(){
            $id = I("get.id",0, 'int');
            if( $id == 0){
                $this->error("删除失败");
            }

            $result = D("Article")->delArticle($id);

            if($result['flag']){
                $this->success($result['msg'],U("Article/index"));
            }else{
                $this->error($result['msg'],U("Article/index"));
            }
        }


        //删除草稿
        public  function removeDraft(){
            $id = I("get.id",0, 'int');
            if( $id == 0){
                $this->error("删除失败");
            }
            $result = D("Article")->delDraft($id);

            if($result['flag']){
                $this->success($result['msg'],U("Article/index"));
            }else{
                $this->error($result['msg'],U("Article/index"));
            }
        }

    }