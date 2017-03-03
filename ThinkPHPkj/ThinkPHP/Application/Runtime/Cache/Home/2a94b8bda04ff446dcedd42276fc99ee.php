<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html><html class="nx-main980" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" type="image/x-icon" href="/thinkphp/Public/Home/images/favicon-rr.ico" />
    <link rel="apple-touch-icon" href="/thinkphp/Public/Home/images/apple_icon_.png" />
    <meta charset="utf-8"/>
    <link rel="shortcut icon" type="image/x-icon" href="/thinkphp/Public/Home/images/favicon-rr.ico" />
    <link rel="apple-touch-icon" href="/thinkphp/Public/Home/images/apple_icon_.png" />
    <script src="/thinkphp/Public/Home/js/jquery-1.11.3.js"></script>
    <script src="/thinkphp/Public/Home/js/layer.js"></script>
    <script  src="/thinkphp/Public/Home/js/jquery.validate.js"></script>
    <link href="/thinkphp/Public/Home/css/login.css" rel="stylesheet" type="text/css" media="all" />
    <title>啪啪网</title>
    <style>
        .error{
            color:red;
            font-size:12px;
        }
    </style>

</head>

<style>
    .ad_cycle
    {
        position:relative;
    }
    .number
    {
        position:absolute;
        top:330px;
        left:400px;
    }
    .number ul
    {
        list-style-type:none;
    }
    .number li
    {
        float:left;
        width:20px;
        height:20px;
        font-size:16px;
        margin:5px;
        text-align:center;
        line-height:20px;
        border:#666 1px solid;
    }
    .nonce
    {
        background-color:#528fc6;
        color:#FFF;
    }
    .initial
    {
        background-color:#FFF;
        color:#000;
    }
</style>



<body id="syshome" class="login">
<div id="header">
    <div id="navBar" class="site-nav rr">
        <div class="navigation-wrapper">
            <div class="navigation navigation-new clearfix">
                <div id="logo2">
                    <h1>
                        <a href="#">
                            <img width="179" height="43" src="/thinkphp/Public/Home/images/logopa.png" />
                        </a>
                    </h1>
                </div>
                <div class="nav-body clearfix">
                    <div class="nav-other">
                        <div class="menu">
                            <a href="##" class="st-btn">学生团体申请入口</a>
                        </div>
                        <div class="menu">
                            <a id="reg_link" title="注册" stats="homenav_reg" href="##">注册</a>
                        </div>
                        <div class="menu">
                            <a title="给我们提建议" stats="homenav_suggest" href="##">反馈意见</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="opi" class="page-wrapper clearfix">
    <div class="full-page-holder">
        <div class="full-page"><div class="login-page clearfix login-wrap">
            <div class="side-column login-box">
                <div class="login-panel ">
                    <div class="radiusimg">
                        <div class="shadow"></div>
                        <div class="pic"><img src="" id="personhead"/></div>

                    </div>
                    <span id="errorMessage" class="errors_div" style="display:none;"></span>

                    <form method="post"  class="login-form" action="/thinkphp/index.php/Home/Index/LoginAction">
                        <dl class="top clearfix">
                            <dd>
                                <input type="text"  class="input-text" id="email" name="username" placeholder="请输入用户名或手机号" />
                            </dd>
                        </dl>
                        <dl class="pwd clearfix">
                            <dd>
                                <input type="password" id="password" name="password"  class="input-text" placeholder="请输入密码" />


                            </dd>
                        </dl>
                        <div class="caps-lock-tips" id="capsLockMessage" style="display:none"></div>
                        <div style="width:100px; height:15px;"></div>
                        <dl id="code" class="code clearfix" style="display:inline">

                            <dd>
                                <input id="icode" type="text" name="icode" class="input-text" tabindex="3" autocomplete="off" placeholder="请输入验证码"/>

                                <img src="/thinkphp/index.php/Home/Index/code"  onclick="this.src=this.src+'?m='+Math.random()">

                            </dd>

                        </dl>

                        <dl class="savepassword clearfix">

                            <dd>
                                <span class="getpassword" id="getpassword"><a href="javascript:void(0)" id="forgetpsw" >忘记密码？</a></span>
                            </dd>
                        </dl>


                        <dl class="bottom">

                            <input type="submit" id="login" class="input-submit login-btn" stats="loginPage_login_button" value="登录" tabindex="5"/>
                        </dl>
                    </form>
                    <div class="regnow">
                        <a href="/thinkphp/index.php/Home/Index/register"><img src="/thinkphp/Public/Home/images/aregister.jpg"></a>

                    </div>
                    <div class="login_corp" >
                        <div class="login-word">其它帐号登录：</div>
                        <a  title="移动" class="login-item yidong" href="#" id="login_cnmobile" stats="loginPage_baidu_link"></a>
                        <a title="天翼" class="login-item tianyi" id="login_tianyi" href="#" stats="loginPage_tianyi_link"></a>
                        <a title="360" class="login-item lo360" id="login_360" href="#" stats="loginPage_360_link"></a>
                        <a title="百度" class="login-item baidu" href="#" id="login_baidu" stats="loginPage_baidu_link"></a>
                    </div>
                </div>
            </div>


            <div class="main-column">
                <div id="mainRecommend" class="main-recommend">
                    <div style="width:100px;height:20px;"></div>
                    <div id="ad100000000061">


                        <div class="ad_cycle">
                            <div class="number" id="jscycle">
                                <ul>
                                    <li class="nonce" target_src="/thinkphp/Public/Uploads/<?php echo ($prepicpath1); ?>" alt="1">1</li>
                                    <li class="initial" target_src="/thinkphp/Public/Uploads/<?php echo ($prepicpath2); ?>" alt="2">2</li>
                                    <li class="initial" target_src="/thinkphp/Public/Uploads/<?php echo ($prepicpath3); ?>" alt="3">3</li>
                                    <li class="initial" target_src="/thinkphp/Public/Uploads/<?php echo ($prepicpath4); ?>" alt="4">4</li>
                                </ul>
                            </div>
                            <a href="#"><img src="/thinkphp/Public/Uploads/<?php echo ($prepicpath1); ?>" id="jsimg"/></a>
                        </div>
                    </div>

                    <div class="login-recommend clearfix">
                        <div class="intro">
                            <div class="item">
                                <a class="qrcode content" href="#" target="_blank"></a>
                            </div>
                            <div class="item">
                                <a class="phone content" href="#" target="_blank"></a>
                            </div>
                            <div class="item">
                                <a class="pad content" href="#" target="_blank"></a>
                            </div>
                            <div class="item">
                                <a class="other content" href="#" target="_blank"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<div id="forgetdv" style="display:none;width:450px;height:200px;margin-left:50px;margin-top:20px;text-align:center;line-height:30px;font-size:16px;">
    <span style="color:red;font-size:18px;">请填写你的手机号</span><br>
    <form action="/thinkphp/index.php/Home/Index/getpassword" id="form" method="post" style="text-align:left;">
        <span style="color:red;">*</span>手机号：<input type="text" name="phone" id="phone" value="" style="width:180px;"><span id="span0" style="color:red;font-size:12px;"></span><br>
        <span style="color:red;">*</span>新密码：<input type="password" name="password" style="width:180px;"><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="sub" type="submit">
    </form>

</div>



</body>
</html>
<script>

    if(<?php echo ($error); ?>==1){
        $('#errorMessage').css('display','inline').html('验证码错误');
    }
    if(<?php echo ($error); ?>==2){
        $('#errorMessage').css('display','inline').html('用户名错误');
    }
    if(<?php echo ($error); ?>==3){
        $('#errorMessage').css('display','inline').html('用户名密码不匹配');
    }
    if(<?php echo ($error); ?>==4){
        $('#errorMessage').css('display','inline').html('此帐号禁止登录');
    }
    if(<?php echo ($error); ?>==5){
        $('#errorMessage').css('display','inline').html('密码重置成功请登录');
    }
    if(<?php echo ($error); ?>==6){
        $('#errorMessage').css('display','inline').html('邮件已过期');
    }



</script>

<script>

    var jsns=document.getElementById("jscycle").getElementsByTagName("li");
    var jsimg=document.getElementById("jsimg");
    setInterval("cycle()",1500);
    function cycle()
    {
        for(var i=0;i<jsns.length;i++)
        {
            if(jsns[i].className=="nonce")
            {
                if(i+1>=jsns.length)
                {
                    var nextli=jsns[0];
                }
                else
                {
                    var nextli=jsns[i+1];
                }
            }
        }
        slide(nextli);
    }
    function slide(nextli)
    {
        jsimg.src=nextli.attributes['target_src'].nodeValue;
        for(var i=0;i<jsns.length;i++)
        {
            jsns[i].className="initial";
        }
        nextli.className="nonce";
    }

</script>

<script>
    $('#forgetpsw').click(function(){
        layer.open({
            type: 1,
            title: '忘记密码',
            closeBtn: 0,
            shadeClose: true,
            area: ['500px', '300px'],
            skin: '',
            content:$('#forgetdv')
        });
    });
    $('#form').validate({
        rules:{
            phone:{
                required:true,
                isphone:true
            },
            password:{
                required:true,
                ispsw:true
            }
        },
        messages:{
            phone:{
                required:'必填',
            },
            password:{
                required:'6到12为不能含空格',
            }
        }
    });
    jQuery.validator.addMethod("isphone", function (value, element) {
        var name = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        return this.optional(element) || (name.test(value));
    }, '请输入有效的手机号');
    jQuery.validator.addMethod("ispsw", function (value, element) {
        var name = /^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{6,12}$/;
        return this.optional(element) || (name.test(value));
    }, '6到12为不能含空格');




</script>