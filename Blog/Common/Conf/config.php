<?php
return array(
	//'配置项'=>'配置值'

	//开启trace
	'SHOW_PAGE_TRACE' 		=>true,

	//网站根目录
	//"__ROOT__"				=> $_SERVER['HTTP_ORIGIN'],

	// 加载扩展配置文件
	'LOAD_EXT_CONFIG' => 'customConfig',

	// 系统默认的变量过滤机制
	'DEFAULT_FILTER'        => 'htmlspecialchars',

	//开启布局
	'LAYOUT_ON' 			=> true,
	'LAYOUT_NAME'			=>'layout',

	// 关闭多模块访问
	'MULTI_MODULE'          =>  true,
	'DEFAULT_MODULE'        =>  'Admin',


	//数据库配置信息
	'DB_TYPE'   			=> 'mysql', // 数据库类型
	'DB_HOST'   			=> '127.0.0.1', // 服务器地址
	'DB_NAME'   			=> 'blog', // 数据库名
	'DB_USER'   			=> 'root', // 用户名
	'DB_PWD'    			=> '', // 密码
	'DB_PORT'   			=> 3306, // 端口
	'DB_PREFIX' 			=> 'blog_', // 数据库表前缀


	//Rbac 权限配置
	'USER_AUTH_ON'              =>  true,
	'USER_AUTH_TYPE'            =>  2,              // 默认认证类型 1 登录认证 2 实时认证
	'USER_AUTH_KEY'             =>  'userId',       // 用户认证SESSION标记 为真时不认证
	'ADMIN_AUTH_KEY'            =>  'Admin',
	'USER_AUTH_MODEL'           =>  'User',         // 默认验证数据表模型，如果用户表名称不是User的话自己改
	'USER_AUTH_GATEWAY'         =>  '/Login/index',// 默认认证网关
	'NOT_AUTH_MODULE'           =>  'Login',       // 默认无需认证模块
	'DB_LIKE_FIELDS'            =>  'title|remark',
	'RBAC_ROLE_TABLE'           =>  'blog_role',
	'RBAC_USER_TABLE'           =>  'blog_role_user',
	'RBAC_ACCESS_TABLE'         =>  'blog_access',
	'RBAC_NODE_TABLE'           =>  'blog_node',
);