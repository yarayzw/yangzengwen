<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>啪啪网后台管理</title>
    <link href="/thinkphp/Public/Admin/css/alogin.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="/thinkphp/index.php/Admin/Index/loginAction" method="post">
    <div class="Main">
        <ul>
            <li class="top"></li>
            <li class="top2"></li>
            <li class="topA"></li>
            <li class="topB"><span><img src="/thinkphp/Public/Admin/images/login/logo.gif"/></span><span style='font-size:26px;'>啪啪后台管理</span></li>
            <li class="topC"></li>
            <li class="topD">
                <ul class="login">
                    <li><span class="left login-text">用户名：</span> <span style="">
                        <input type="text" class="txt" name="username"/>

                    </span></li>
                    <li><span class="left login-text">密码：</span> <span style="">
                       <input  type="password" class="txt" name="pwd" />
                    </span></li>
                    <li><span class="left login-text">验证码：</span> <span style="">
                    <input  type="text" class="txtCode" name="code" />
                        <img src="/thinkphp/index.php/Admin/Index/code"  onclick="this.src=this.src+'?m='+Math.random()">
                    </span></li>


                </ul>
            </li>
            <li class="topE"></li>
            <li class="middle_A"></li>
            <li class="middle_B"></li>
            <li class="middle_C"><span class="btn"><input name="" type="image" src="/thinkphp/Public/Admin/images/login/btnlogin.gif" /></span></li>
            <li class="middle_D"></li>
            <li class="bottom_A"></li>
            <li class="bottom_B">网站后台管理系统&nbsp;&nbsp;www.php.com</li>
        </ul>
    </div>
</form>
         <span class='size'><?php switch($error): case "1": ?>验证码错误<?php break;?>
            <?php case "2": ?>用户名错误<?php break;?>
            <?php case "3": ?>密码错误<?php break;?>
            <?php case "4": ?>帐号受限<?php break; endswitch;?> </span>


</body>
</html>