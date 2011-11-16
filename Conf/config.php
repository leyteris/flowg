<?php
return array(
	'APP_DEBUG'=> false, // 开启调试模式
	'URL_MODEL'=> 2,
	'URL_HTML_SUFFIX'=> '.shtml',
	'DB_TYPE'=> 'mysql', // 数据库类型
	'DB_HOST'=> 'localhost', // 数据库服务器地址
	'DB_NAME'=>'tflowg', // 数据库名称
	'DB_USER'=>'root', // 数据库用户名
	'DB_PWD'=>'ilikedoom3', // 数据库密码
	'DB_PORT'=>'3306', // 数据库端口
	'DB_PREFIX'=>'fl_', // 数据表前缀

	'TMPL_CACHE_ON'=>true,
	'HASH_CODE_KEY'=>'HashCode',
	'USER_AUTH_KEY'=>'UserID',
	'URL_CASE_INSENSITIVE'=>true,
	'ERROR_PAGE'=>'/404.html',

	'ATTACHDIR'=>APP_PATH.'/images/avatar',
	'ATTACHSIZE'=>2097192, 
	'ATTACHEXT'=>'jpg,gif,png',
	
);
?>