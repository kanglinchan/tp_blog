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
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>博客后台管理</title>
</head>
<body>
    的对方的付费的
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