<?php
return array(
	//'配置项'=>'配置值'
'DB_TYPE'  => 'mysql',// 数据库类型 
 'DB_HOST'  => 'localhost',// 数据库服务器地址 
 'DB_NAME'  => 'studentmange',// 数据库名称 
 'DB_USER'  => 'root',// 数据库用户名 
 'DB_PWD'  => 'ak8A5jxx',// 数据库密码 
 'DB_PREFIX'  => 'sm_',// 数据表前缀 
 'DB_CHARSET' => 'utf8',// 网站编码 
 'DB_PORT'  => '3306',// 数据库端口 

   'SHOW_PAGE_TRACE'=>true,
   // 'TMPL_FILE_DEPR'=>'_',
   'MODULE_ALLOW_LIST'=>array('Student','Teacher'),//允许访问的模块
		'DEFAULT_MODULE'        => 'Student', // 默认模块名称	
    //   'TMPL_L_DELIM' => '{<',   // 模板引擎普通标签开始标记
    // 'TMPL_R_DELIM'  => '>}',   // 模板引擎普通标签结束标记
		'URL_HTML_SUFFIX'=>'shtml|xml',//设置伪静态后缀
		'UTL_DENY_SUFFIX'=>'html',

      TMPL_PARSE_STRING=>array(
        '__BOOT__'=>__ROOT__.'/Public/bootstrap',
        '__PUB__'=>__ROOT__.'/Public',
       '__JQUERY__'=>__ROOT__.'/Public/jquery'
)



      );