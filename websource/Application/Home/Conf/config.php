<?php
if(file_exists(dirname(__FILE__).'/db_config.php')) {
	$db_config = require 'db_config.php';
}
else
	$db_config = array();

$config = array(
		"USER_AUTH_ON" => false,                    //是否开启权限验证(必配)
		"USER_AUTH_TYPE" => 2,                     //验证方式（1、登录验证；2、实时验证）

		"USER_AUTH_KEY" => 'uid',                  //用户认证识别号(必配)
		"ADMIN_AUTH_KEY" => 'superadmin',          //超级管理员识别号(必配)
		"USER_AUTH_MODEL" => 'user',               //验证用户表模型 ly_user
		'USER_AUTH_GATEWAY'  =>  '/Home/Auth/login',  //用户认证失败，跳转URL

		'AUTH_PWD_ENCODER'=>'md5',                 //默认密码加密方式

		"RBAC_SUPERADMIN" => 'admin',              //超级管理员名称


		"NOT_AUTH_MODULE" => 'Index,Auth,Api',       //无需认证的控制器
		"NOT_AUTH_ACTION" => 'login',              //无需认证的方法

		'REQUIRE_AUTH_MODULE' =>  '',              //默认需要认证的模块
		'REQUIRE_AUTH_ACTION' =>  '',              //默认需要认证的动作

		'GUEST_AUTH_ON'   =>  false,               //是否开启游客授权访问
		'GUEST_AUTH_ID'   =>  0,                   //游客标记

		"RBAC_ROLE_TABLE" =>  $db_config['DB_PREFIX'].'role',            //角色表名称(必配)
		"RBAC_USER_TABLE" => $db_config['DB_PREFIX'].'role_user',       //用户角色中间表名称(必配)
		"RBAC_ACCESS_TABLE" => $db_config['DB_PREFIX'].'role_node',        //权限表名称(必配)
		"RBAC_NODE_TABLE" => $db_config['DB_PREFIX'].'node',            //节点表名称(必配)
		'DEFAULT_MODULE' => 'Home',
		'DEFAULT_CONTROLLER'    =>  'Auth', // 默认控制器名称
		'DEFAULT_ACTION' => 'login',
		
		'LAYOUT_ON'=>true,
		'LAYOUT_NAME'=>'layout',
		
		'URL_HTML_SUFFIX'=>'.html',
		
		'TMPL_ACTION_ERROR' => 'Common:dispatch_jump',
		'TMPL_ACTION_SUCCESS' => 'Common:dispatch_jump',

        'TMPL_ACTION_ERROR_AJAX' => 'Common:dispatch_jump_ajax',
        'TMPL_ACTION_SUCCESS_AJAX' => 'Common:dispatch_jump_ajax',
		
		'TMPL_PARSE_STRING'=>array(
				'__UPLOAD__'=>__ROOT__.'/Upload/',
		),
		'DB_PARAMS'    =>    array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),
);

if(is_array($db_config))
	$config = array_merge($db_config,$config);

return $config;