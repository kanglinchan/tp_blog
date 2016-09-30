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
    

<div class="attributeList">

    <ol class="breadcrumb">
        <li><a href="/index.php/Admin"><?php echo (MODULE_NAME); ?></a></li>
        <li><a href="/index.php/Admin/Attribute"><?php echo (CONTROLLER_NAME); ?></a></li>
        <li class="active"><?php echo (ACTION_NAME); ?></li>
    </ol>


    <div class="addButton">
        <button id="addNodeHandler" type="button" class="btn btn-primary" data-toggle="modal" data-target="#Attribute-modal">
            <span class="glyphicon glyphicon-plus"></span> 增加属性
        </button>

        <!-- 模态框（Modal） -->
        <div class="modal fade" id="Attribute-modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form method="post" action="/index.php/Admin/Attribute/addAttribute">
                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">
                                &times;
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                               添加属性
                            </h4>
                        </div>
                        <div class="modal-body" >
                            <div class="form-group">
                                <label for="name">
                                    属性名称
                                </label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Attribute Name">
                            </div>
                            <div class="form-group">
                                <label for="value">
                                    属性值
                                </label>
                                <input type="text" class="form-control" name="value" id="value" placeholder="Attribute value">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">关闭
                            </button>
                            <button type="submit"  class="btn btn-primary">
                                提交更改
                            </button>
                        </div>
                    </form>

                </div><!-- /.modal-content -->
            </div><!-- /.modal -->
        </div>
    </div><!--addNodeButton-->


    <table class="table table-hover">
        <thead>
        <tr>
            <th width="100">ID</th>
            <th width="200">属性名称</th>
            <th width="200">属性值</th>
            <th width="200">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($attribute)): foreach($attribute as $key=>$item): ?><tr>
                <td> <?php echo ($item["id"]); ?></td>
                <td> <?php echo ($item["name"]); ?></td>
                <td> <?php echo ($item["value"]); ?></td>
                <td>
                    <a href="/index.php/Admin/Attribute/removeAttribute/id/<?php echo ($item["id"]); ?>" >删除</a>&nbsp;
                    <a data-toggle="modal" data-target="#Attribute-modal" href="/index.php/Admin/Attribute/editAttribute/id/<?php echo ($item["id"]); ?>" >编辑</a>&nbsp;
                </td>
            </tr><?php endforeach; endif; ?>
        </tbody>

    </table>








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