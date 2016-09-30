<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/Public/css/style.css">
</head>
<body>

<div id="header">
    <div class="container">
        <button id="navBtn" class="btn">
            <span class="glyphicon glyphicon-menu-hamburger"></span>
        </button>
        <a class="brand" href=""><img src="/Public/img/logo.png" alt=""></a>
        <ul class="pull-right">
            <li class="hidden-xs" ><a href=""><span class="glyphicon glyphicon-user"></span>你好, <?php echo (session('username')); ?></a></li>
            <li > <a href="/index.php/Admin/Login/logout"><span class="glyphicon glyphicon-log-out"></span>退出</a></li>
        </ul>
    </div>
</div>


<div id="navList" >
    <ul >
        <li><a href="javascript:;">前端首页</a></li>
        <li>
            <a href="javascript:;" class="hasChild">
                RBAC 用户权限管理
                <span class="glyphicon glyphicon-triangle-right pull-right"></span>
            </a>
            <ul >
                <li><a href="/index.php/Admin/Rbac/index">用户列表</a></li>
                <li><a href="/index.php/Admin/Rbac/roleList">角色管理</a></li>
                <li><a href="/index.php/Admin/Rbac/nodeList">权限管理</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="hasChild">
                分类菜单
                <span class="glyphicon glyphicon-triangle-right pull-right" ></span>
            </a>
            <ul>
                <li><a href="/index.php/Admin/Category/index">菜单列表</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="hasChild">
                文章管理
                <span class="glyphicon glyphicon-triangle-right pull-right" ></span>
            </a>
            <ul>
                <li><a href="/index.php/Admin/Article/index">文章列表</a></li>
                <li><a href="/index.php/Admin/Article/addArticle">添加文章</a></li>
                <li><a href="/index.php/Admin/Article/DraftList">草稿列表</a></li>
            </ul>
        </li>

        <li>
            <a href="JavaScript:;" class="hasChild">
                文章属性
                <span class="glyphicon glyphicon-triangle-right pull-right" ></span>
            </a>
            <ul>
                <li><a href="/index.php/Admin/Attribute/index">属性管理</a></li>
            </ul>
        </li>

        <li>
            <a href="JavaScript:;" class="hasChild">
                图片关联
                <span class="glyphicon glyphicon-triangle-right pull-right" ></span>
            </a>
            <ul>
                <li><a href="/index.php/Admin/Album/index">相册管理</a></li>
                <li><a href="/index.php/Admin/Album/addAlbum">添加相册</a></li>
                <li><a href="/index.php/Admin/Pictrue/index">图片管理</a></li>
            </ul>
        </li>

    </ul>
</div>

<div id="main">
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>articleList</title>
    <link rel="stylesheet" href="/Public/lib/webupload/webuploader.css">
</head>
<body>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>articleList</title>
    <link rel="stylesheet" href="/Public/lib/webupload/webuploader.css">
</head>
<body>



<div class="articleList">

    <ol class="breadcrumb">
        <li><a href="/index.php/Admin"><?php echo (MODULE_NAME); ?></a></li>
        <li><a href="/index.php/Admin/Article"><?php echo (CONTROLLER_NAME); ?></a></li>
        <li class="active"><?php echo (ACTION_NAME); ?></li>
    </ol>

    <form action="/index.php/Admin/Article/updateArticle/id/<?php echo ($article["id"]); ?>" method="post">
        <div class="col-sm-9 col-xs-12 left-side">

            <div class="form-group">
                <label for="title">
                    文章标题
                </label>
                <input type="text" class="form-control" name="title" id="title" value="<?php echo ($article["title"]); ?>">
            </div>

            <div class="form-group">
                <label for="summary">
                    文章概述
                </label>
                <textarea class="form-control" name="summary"  id="summary" ><?php echo ($article["summary"]); ?></textarea>
            </div>

            <div class="form-group">
                <label>
                    文章内容
                </label>
                <!-- 加载编辑器的容器 -->
                <script id="container" style="width:100%" name="content" type="text/plain"><?php echo ($article["content"]); ?></script>
            </div>
        </div>

        <div class="col-sm-3 col-xs-12 right-side">

            <div class="form-group">
                <label for="cover">封面图片</label>
                <input type="hidden" id="cover" name="cover" >
                <div class="cover-box" >
                    <!--<div class="filePicker">上传封面</div>-->
                    <!--  <img src="/Public/<?php echo ($article["cover"]); ?>" alt=""> -->
                </div>
            </div>

            <div class="form-group category-select">
                <label>所属分类</label>
                <div class="box">
                    <?php if(is_array($article["category"])): foreach($article["category"] as $key=>$cate): if($cate['deep'] == 0): ?><div class="checkbox parent">
                                <?php echo ($cate["name"]); ?>
                            </div>
                            <?php else: ?>
                            <div class="checkbox child">
                                <label>
                                    <?php if( $cate['checked'] == true): ?><input type="checkbox" name="category" checked="checked" class="category" value="<?php echo ($cate["id"]); ?>"><?php echo ($cate["name"]); ?>
                                        <?php else: ?>
                                        <input type="checkbox" name="category"  class="category" value="<?php echo ($cate["id"]); ?>"><?php echo ($cate["name"]); endif; ?>

                                </label>
                            </div><?php endif; endforeach; endif; ?>
                </div>
            </div>


            <div class="form-group">
                <label for="tag">文章属性</label>
                <select multiple="multiple" class="form-control" name="attribute[]">
                    <?php if(is_array($article['attribute'])): foreach($article['attribute'] as $key=>$item): if($item['selected'] == true): ?><option selected='selected' value="<?php echo ($item["id"]); ?>"><?php echo ($item["name"]); ?></option>
                            <?php else: ?>
                                <option  value="<?php echo ($item["id"]); ?>"><?php echo ($item["name"]); ?></option><?php endif; endforeach; endif; ?>
                </select>
            </div>




            <div class="form-group">
                <label for="tag">标签</label>
                <input type="text" class="form-control" name="tag" id="tag" value="<?php echo ($article["tag"]); ?>">
            </div>

            <div class="checkbox">
                <label>
                    <?php if($article["visible"] == 1): ?><input type="checkbox" value="1" checked="checked"  name="visible">
                        <?php else: ?>
                        <input type="checkbox" value="1"  name="visible"><?php endif; ?>
                    是否显示
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <?php if($article["allow_comment"] == 1): ?><input type="checkbox" value="1" checked="checked"  name="allowComment">
                        <?php else: ?>
                        <input type="checkbox" value="1"  name="allowComment"><?php endif; ?>
                    是否评论
                </label>
            </div>

        </div>

        <div class="col-xs-12 col-sm-9">
            <div class="pull-right">
                <button data-id="" id="draft" class="btn-default btn ">保存草稿</button>
                <button type="submit" class="btn btn-primary ">保存更改</button>
            </div>


        </div>

    </form>

    <script src="/Public/js/jquery.1.9.1.min.js" type="text/javascript"></script>
    <script type="text/javaScript" src="/Public/lib/webupload/webuploader.js"></script>


    <!-- 配置文件 -->
    <script type="text/javascript" src="/Public/lib/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/Public/lib/ueditor/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container',{
            initialFrameHeight:"320"
        });
    </script>

</div>
<script type="text/javascript">
    jQuery(document).ready(function($){

        //图片设置
        var imageSrc = "<?php echo ($article["cover"]); ?>";
        $filePicker = $('<div class="filePicker">上传封面</div>');
        if(imageSrc == ""){
            $(".cover-box").append( $filePicker );
             uploadImage();
        }else{

            var Img = new Image();
            Img.src = "/Public/"+imageSrc;
            $delete = $("<div>fdffd</div>");
            $coverPic = $(
                    '<div class="cover-picture">'+
                        '<div class="delete-picture">'+
                            '<span class="glyphicon glyphicon-trash"></apan>'+
                        '</div>'+
                    '</div>'
                );
            Img.onload = function(){
                $("#cover").val(imageSrc );

                $(".cover-box").append($coverPic);
                $coverPic.css({
                    "backgroundImage":"url("+Img.src+")",
                })
                .hover(function(){
                    $(".delete-picture",this).css("display","block");
                },function () {
                    $(".delete-picture",this).css("display","none");
                });

                $(".delete-picture").on("click",function(){
                   $.ajax({
                       url: '/index.php/Admin/Article/removeCover/id/<?php echo ($article["id"]); ?>',
                       type: 'get'
                   })
                   .done(function(data) {
                       console.dir(data);
                       $("cover").val();
                       $coverPic.replaceWith($filePicker);
                       uploadImage();
                   })
                   .fail(function(data) {
                       console.log("error");
                   })
                   
                })
            }

        }


        //唯一分类选择
        $inpusts = $(".child input");
        $inpusts.on("change",function(){
            $inpusts.prop('checked', '');
            $(this).prop('checked', 'checked');
        })


        //保存草稿
        $saveDraft = $("#draft");
        $saveDraft.on("click",function(event){
            event.preventDefault();
            var data = $("form").serializeArray();
            var json = {};
            for( var i in data){ //整理json数据
                json[ data[i]['name'] ] = data[i]['value'];
            };

            var params = JSON.stringify(json);

            var id =  $saveDraft.attr("data-id");
            var saveDraftUrl = '/index.php/Admin/Article/saveDraft/id/'+id;
            console.log( saveDraftUrl );
            console.debug();
            $.ajax({
                url: saveDraftUrl,
                type: 'POTS',
                dataType: 'text',
                data: params,
            })
            .done(function( data ) {
                data = $.parseJSON(data);
                alert(data.msg);
                alert(data.id);
                console.dir(this);
                $saveDraft.attr("data-id", data.id);
            })
            .fail(function() {
                console.log("error");
            })

        })


        function uploadImage(){

            $coverBox = $(".cover-box");
            $cover    = $('#cover');
            var thumbnailWidth  = $coverBox.width();
            var thumbnailHeight = $coverBox.height();

            var uploader = WebUploader.create({
                auto: true,
                swf: '/Public'+'lib/webupload/Uploader.swf',

                // 文件接收服务端。
                server: '/index.php/Admin/Article/uploaderCover',

                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: '.filePicker',

                // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                resize: false,
                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                }
            });

            uploader.on( 'fileQueued', function( file ) { //文件上传加入时触发
                $img = $("<img>")
                $(".filePicker").replaceWith($img);

                uploader.makeThumb( file, function( error, src ){ //回调函数error
                    if ( error ) {
                        $img.replaceWith('<span>不能预览</span>');
                        return;
                    };
                    $img.attr( 'src', src );
                }, thumbnailWidth, thumbnailHeight );
            });

            uploader.on("uploadError", function(file, reason){
                $coverBox.replaceWith( '<div class="upload-error">上传出错</div>' );
            });

            uploader.on("uploadSuccess", function( file, response ){
                console.dir( response );
                if( response.flag ){
                    $cover.val(response.msg);
                }else{
                    $coverBox.replaceWith( '<div class="upload-error">'+response.msg+'</div>' );
                }
            });

        }


    })
</script>

</body>
</html>

</body>
</html>
</div>




<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/Public/js/jquery.1.9.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/Public/js/bootstrap.min.js"></script>
<script src="/Public/js/admin.js"></script>
<script>
    jQuery(document).ready(function($) {
        $("#navBtn").navToggle("#navList"); //导航栏部分
        $(".hasChild").arrowToggle();

        //模态弹窗缓存处理
        $("#user-modal, #node-modal, #role-modal,#remove-user,#Category-modal,#modal,#picture-modal").on("hidden.bs.modal", function() {
            $(this).removeData("bs.modal");
        });



        /*pictureList 页面*/
        $("#picture-modal").on("show.bs.modal",function (e) {
            $(this).removeData("bs.modal");
            //alert("fgg");
            $src = $(e.relatedTarget).attr("data-link");
            $('#pictureList-picture').attr("src",$src);
            //console.dir( $src );
            //$("#picture").attr();
        });

        $(".pictureList .thumb-box").hover(function() {
            $link = $(this).attr("data-delLink");
            $delPicture = $('<div class="delPicture" ><a href="'+$link+'" >删除</a></div>');
            $(this).append($delPicture);
            $aW = $("a:first",this).width() + 8;
            $delPicture.css({
               
               width: $aW+'px',
            });
        }, function() {
           $('.delPicture',this).remove();
        });

    });
</script>

</body>
</html>