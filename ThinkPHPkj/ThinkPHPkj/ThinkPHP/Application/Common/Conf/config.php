<?php
return array(
    //'配置项'=>'配置值'
    //'URL_PATHINFO_DEPR'=>'=',
    //PDO连接方式
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_USER'   => 'a0713170732', // 用户名
    'DB_PWD'    => '7941abcd', // 密码
    'DB_PREFIX' => 'think_', // 数据库表前缀
    'DB_DSN'    => 'mysql:host=localhost;dbname=a0713170732;charset=UTF-8',
    //页面trace
    'SHOW_PAGE_TRACE'=>true,
    'DB_LIKE_FIELDS'=>'name|content',
    //默认错误跳转对应的模板文件
    //'TMPL_ACTION_ERROR' => 'Common@Public/error',
    //默认成功跳转对应的模板文件
    'TMPL_ACTION_SUCCESS' => 'Common@Public/success',


);