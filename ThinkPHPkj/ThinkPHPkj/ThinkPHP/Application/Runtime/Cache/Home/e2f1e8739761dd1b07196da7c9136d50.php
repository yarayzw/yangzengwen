<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>人人网 - 注册</title>
    <script src="/thinkphp/Public/Home/js/jquery-1.11.3.js"></script>
    <script src="/thinkphp/Public/Home/js/jquery.min.js"></script>
    <script  src="/thinkphp/Public/Home/js/jquery.validate.js"></script>
    <script src="/thinkphp/Public/Home/js/area.js" type="text/javascript"></script>
    <link href="/thinkphp/Public/Home/image/favicon-rr.ico" rel="shortcut icon" type="image/x-icon">
    <link href="/thinkphp/Public/Home/images/renren_logo_apple.png" rel="apple-touch-icon">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/base.css">
    <link href="/thinkphp/Public/Home/css/reg.css" rel="stylesheet" rev="stylesheet" media="all">
</head>
<style>
    .error{
        color:red;
    }
</style>

<body>
<div id="header">
    <div id="nav">
        <div class="logo"></div>
        <div class="font">
            <span class="right">已有帐号，<a href="/thinkphp/index.php/Home/Index/index">登录</a> </span>
        </div>
    </div>
</div>
<div class="main_wrap clearfix" id="main">
    <div class="main_con">
        <ul class="left-timeline">
            <li id="join-timeline" class="show">
                <span class="item-icon"></span>
                <div class="item-infos">
                    <h3 class="info-title">加入啪啪网</h3>
                </div>
            </li>

        </ul>




        <div class="ft-wrapper clearfix" style="height:600px;">

        </div>

</div>
</div>
<div class="main_left" style="position: relative;top:-645px;left:35%;background:#FFFFFF;width:520px;">
    <div style="width:520px;height:60px;text-align:center;line-height:60px;font-size:24px;color:#333;border-left:1px #ccc solid;"><b>注册新帐号 加入我们</b></div>
    <div style="width:260px;height:45px;font-size:20px;line-height:45px;text-align:center;border-top:1px #ccc solid;border-right:1px #ccc solid;border-left:1px #ccc solid;">手机快速注册</div>
    <div style="width:520px;height:400px;background:#FFFFFF;border-top:1px #ccc solid;">

        <div id='dv' style="width:520px;height:380px;">
            <div id="tagmesge" style="color:#ee0000;width:150px;height:20px;margin-left:120px;font-size:14px;display:none;">请完善信息!!</div>
            <div style="width:520px;height:45px;"><div class="titlename">手机号：</div><div class="inputname"><div class="inputtitle"><input  id='tel' type="text" class="inputcontent" /></div><div class="spantag"><span id="span00" style="display:none;">请输入有效的手机号</span><span id="span000" style="display:none;">该手机号已被注册</span></div></div></div>


            <div style="width:520px;height:45px;"><div class="titlename">密 &nbsp;&nbsp;码：</div><div class="inputname"><div class="inputtitle"><input  id='pswd' type="password" class="inputcontent"/></div><div class="spantag"><span id="span01" style="display:none;">密码长度6-12位且不能有空格</span></div></div></div>


            <div style="width:520px;height:45px;"><div class="titlename">确认密码：</div><div class="inputname"><div class="inputtitle"><input  id='repwd' type="password" class="inputcontent"/></div><div class="spantag"><span id="span02" style="display:none;">两次密码不一致</span></div></div></div>

            <div style="width:520px;height:150px;"><div class="titlename">验证码：</div><div class="inputname"><input type="text" name="code" value="" id="code" class="codeinput"/>
            <input id="btnSendCode" type="button" value="发送验证码" class="inputbtn" /><span id="span05" style="display:none;">验证码错误</span></div></div>
            <div style="width:300px;height:60px;background: #1c68a4;margin-left:110px;text-align:center;line-height:60px;font-size:20px;"><a href="" style="color:#FFFFFF;" id="acodea"><div>完成注册</div></a></div>

        </div>
        <div id="msg" style="width:500px;height:400px;display:none;">
            <form action="/thinkphp/index.php/Home/Index/writeMessage" method="post" id="form">
                <div style="width:500px;height:50px;margin-left:70px;padding-top:20px;">
                    <div style="width:70px;height:35px;float:left;font-size:14px;text-align:right;line-height:35px;">
                        <span style="color:red;">*</span> 用户名：
                    </div>
                    <div style="width:400px;height:35px;float:left;font-size:12px;">
                        <input type="text" name="username" id="uname" style="width:150px;height:30px;color:#000000;font-size:14px;"><span id="span201" style="display:none;color:red;font-size:12px;">用户名已存在</span>
                    </div>
                </div>
                <div style="width:500px;height:50px;margin-left:70px;">
                    <div style="width:70px;height:35px;float:left;font-size:14px;text-align:right;line-height:35px;">
                        <span style="color:red;">*</span> 邮箱：
                    </div>
                    <div style="width:300px;height:35px;float:left;font-size:12px;">
                        <input type="text" id="email10" name="email"  style="width:150px;height:30px;color:#000000;font-size:14px;"><span id="span202" style="display:none;color:red;font-size:12px;">邮箱已存在</span>
                    </div>
                </div>
                <div style="width:500px;height:50px;margin-left:70px;">
                    <div style="width:70px;height:35px;float:left;font-size:14px;text-align:right;line-height:35px;">
                        <span style="color:red;">*</span> 姓名：
                    </div>
                    <div style="width:300px;height:35px;float:left;font-size:12px;">
                        <input type="text" name="name" id="unname" style="width:150px;height:30px;color:#000000;font-size:14px;">
                    </div>
                </div>
                <div style="width:500px;height:50px;margin-left:70px;">
                    <div style="width:70px;height:35px;float:left;font-size:14px;text-align:right;line-height:35px;">
                        毕业院校：
                    </div>
                    <div style="width:300px;height:35px;float:left;font-size:12px;">
                        <input type="text" name="school"  style="width:150px;height:30px;color:#000000;font-size:14px;">
                    </div>
                </div>
                <div style="width:500px;height:50px;margin-left:70px;">
                    <div style="width:100px;height:35px;float:left;font-size:14px;text-align:right;line-height:35px;">
                        年龄 性别：
                    </div>
                    <div style="width:60px;height:35px;float:left;font-size:12px;">
                        <input type="text" name="age"  style="width:50px;height:30px;color:#000000;font-size:14px;">

                    </div>
                    <div style="width:150px;height:35px;float:left;font-size:16px;line-height:35px;text-align:center;">
                        男：<input type="radio" name="sex" value="1"/>
                        女：<input type="radio" name="sex" value="2"/>
                    </div>

                </div>
                <div style="width:300px;height:30px;margin-left:70px;font-size:18px;text-align:center;line-height:30px;">
                    现居地
                </div>
                <div style="width:450px;height:40px;margin-left:70px;margin-top:15px;">

                    <select id="s_province" name="s_province" style="border:1px #993300 solid; background:#FFFFFF;"></select>  
                    <select id="s_city" name="s_city" style="border:1px #993300 solid; background:#FFFFFF;"></select>  
                    <select id="s_county" name="s_county" style="border:1px #993300 solid; background:#FFFFFF;"></select>
                    <script type="text/javascript">_init_area();</script>


                </div>

                <div style="width:300px;height:45px;text-align:center;">
                    <input type="hidden" value="" name="hidmsg" id="inputhidden"/>
                    <input type="submit" id="messagebtnn" value="保存" style="width:150px;height:40px;background:#268;font-size:16px;">
                </div>
            </form>
        </div>



    </div>


</div>
</body>
</html>

<script>

    /*$('#pswd').blur(function(){
     var pswd=$('#pswd').val();

     var num=pwd.length;
     if(num<6 || num>12){
     $('#span01').css('display','inline');
     $("#btnSendCode").attr("disabled", "true");
     }else{
     $('#span01').css('display','none');
     $("#btnSendCode").removeAttr("disabled");
     }
     });*/

    /*$('#repwd').blur(function(){
     var repwd=$('#repwd').val();
     var pswd=$('#pwd').val();
     if(pswd==repwd){
     $('#span02').css('display','none');

     }else{
     $('#span02').css('display','inline');

     }
     });*/


    var InterValObj; //timer变量，控制时间
    var count = 60; //间隔函数，1秒执行
    var curCount;//当前剩余秒数
    var code = ""; //验证码
    var codeLength = 6;//验证码长度

    $('#tel').blur(function(){
        var tel=$('#tel').val();

        if (tel != '') {
            var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
            if (!myreg.test($('#tel').val())){

                $('#span00').css('display','inline');
                $('#span000').css('display','none');
                $("#btnSendCode").attr("disabled", "true");
            }else{
                $('#span00').css('display','none');

                $("#btnSendCode").removeAttr("disabled");
            }
        }else{
            $('#span00').css('display','inline');
            $('#span000').css('display','none');
        }

    });

    $('#tel').keyup(function(){
        var tel=$('#tel').val();
        var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        if(myreg.test($('#tel').val())){

           $.post("/thinkphp/index.php/Home/Index/registerAction",{tel:tel},function(data){
                if(data==1){
                    $('#span000').css('display','inline');
                    $('#span00').css('display','none');
                    $("#btnSendCode").attr("disabled", "true");
                    $("#pswd").attr("disabled", "true");
                    $('#pswd').val('');
                    return false;
                }else{
                    $('#span000').css('display','none');
                    $("#btnSendCode").removeAttr("disabled");
                    $("#pswd").removeAttr("disabled");
                    $('#span00').css('display','none');
                }
            },'json');
        }
    });

    $('#pswd').keyup(function(){
        var pwd=$('#pswd').val();

        var num=pwd.length;
        if(num<6 || num>12 || pwd.indexOf(' ')>-1){
            $('#span01').css('display','inline');
            $("#btnSendCode").attr("disabled", "true");
            $("#repwd").attr("disabled", "true");
        }else{
            $('#span01').css('display','none');
            $("#btnSendCode").removeAttr("disabled");
            $("#repwd").removeAttr("disabled");
        }
    });
    $('#repwd').keyup(function(){
        var pwd=$('#pswd').val();

        var repwd=$('#repwd').val();
        if(pwd!=repwd || (pwd.indexOf(' ')>-1)){
            $('#span02').css('display','inline');
            $("#btnSendCode").attr("disabled", "true");
        }else{
            $('#span02').css('display','none');
            $("#btnSendCode").removeAttr("disabled");
        }
    });


    $("#btnSendCode").click(function get_mobile(){
        var tel=$('#tel').val();
        var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        if(tel=='' || !myreg.test($('#tel').val())){


            $('#span00').css('display','inline');
            return false;
        }


        var pwd=$('#pswd').val();

        var repwd=$('#repwd').val();
        if(pwd=='' || pwd.length<6 || pwd.length>12){
            $('#span01').css('display','inline');
            return false;
        }
        if(pwd.indexOf(' ')>-1){
            $('#span01').css('display','inline');
            return false;
        }
        if(repwd=='' || (pwd!=repwd)){
            $('#span02').css('display','inline');
            return false;
        }

        curCount = count;
        var code=Math.round(Math.random()*10000);
        $("#btnSendCode").attr("disabled", "true");
        $("#btnSendCode").val("请在" + curCount + "秒内输入验证码");
        InterValObj = window.setInterval(SetRemainTime, 1000);


        function SetRemainTime() {

            if (curCount == 0) {
                window.clearInterval(InterValObj);//停止计时器
                $("#btnSendCode").removeAttr("disabled");//启用按钮
                $("#btnSendCode").val("重新发送验证码");
                code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效
            }

            else {
                curCount--;
                $("#btnSendCode").val("请在" + curCount + "秒内输入验证码");
            }

        }

        $.get("/thinkphp/index.php/Home/Index/registerAction",{mobile:$("#tel").val(),mcode:code},function(data){

        });

        $("#code").blur(function get_code(){
            var repwd=$('#repwd').val();
            $.get("/thinkphp/index.php/Home/Index/registerAction",{code:$("#code").val(),mobile1:$("#tel").val(),mcode1:code,pwd:repwd},function(data){
                if (code==$("#code").val())
                {

                }
                else{
                    $('#span05').css('display','inline');
                }
            });
        });


    });
    $('#acodea').click(function(){
        /*var tel=$('#tel').val();
        var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        if(tel=='' || !myreg.test($('#tel').val())){
            $('#span00').css('display','inline');
            return false;
        }
        if(myreg.test($('#tel').val())){
            $.post("/thinkphp/index.php/Home/Index/registerAction",{tel:tel},function(data){
                if(data==1){
                    $('#span000').css('display','inline');
                    $("#btnSendCode").attr("disabled", "true");
                    return false;
                }else{
                    $('#span000').css('display','none');
                    $("#btnSendCode").removeAttr("disabled");
                    $('#span00').css('display','none');
                }
            },'json');
        }
        var pwd=$('#pswd').val();

        var repwd=$('#repwd').val();
        if(pwd=='' || pwd.length<6 || pwd.length>12){
            $('#span01').css('display','inline');
            return false;
        }
        if(pwd.indexOf(' ')>-1){
            $('#span01').css('display','inline');
            return false;
        }
        if(repwd=='' || (pwd!=repwd)){
            $('#span02').css('display','inline');
            return false;
        }*/
        var tel=$('#tel').val();
        var pwd=$('#pswd').val();
        var repwd=$('#repwd').val();
        var acode=$('#code').val();
        if(tel=='' || pwd=="" ||repwd==''){
            $('#tagmesge').css('display','inline');
            return false;
        }
        if(acode==''){
            $('#span05').css('display','inline');
            return false;
        }
        $('#inputhidden').attr('value',tel);
        $('#dv').css('display','none');
        $('#msg').css('display','block');
       return false;

    });
    $('#code').keyup(function(){
        var acode=$('#code').val();
        if(acode!=''){
            $('#tagmesge').css('display','none');
        }
    });


    $('#messagebtnn').click(function(){
        if($('#form').valid()){
            $('#form').submit();
        }

    });
    $('#uname').keyup(function(){
        var uname=$('#uname').val();
        var merg=/^[a-zA-Z0-9_]{6,12}$/;
        if(merg.test(uname)){
            $.post("/thinkphp/index.php/Home/Index/registerAction",{uname:uname},function(data){

                if(data==3){

                    $('#span201').css('display','inline');
                    $('#email10').attr("disabled", "true");

                }else{
                    $('#span201').css('display','none');
                    $('#email10').removeAttr("disabled");
                }
            },'json');
        }

    });
    $('#email10').keyup(function(){
        var email=$('#email10').val();
        var merg=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        if(merg.test(email)){
            $.post("/thinkphp/index.php/Home/Index/registerAction",{email:email},function(data){

                if(data==5){

                    $('#span202').css('display','inline');
                    $('#unname').attr("disabled", "true");

                }else{
                    $('#span202').css('display','none');
                    $('#unname').removeAttr("disabled");
                }
            },'json');
        }

    });
    $('#form').validate(
            {
                rules:{
                    username:{
                        required:true,
                        isname:true
                    },
                    email:{
                        required:true,
                        isemail:true
                    },
                    name:{
                        required:true,
                        isusername:true
                    }
                },
                messages:{
                    username:{
                        required:'用户名不能为空',

                    },
                    email:{
                        required:'必填',
                    },
                    name:{
                        required:'必填'
                    }
                }
            });

    jQuery.validator.addMethod("isname", function (value, element) {
        var name = /^[a-zA-Z0-9_]{6,12}$/;
        return this.optional(element) || (name.test(value));
    }, '仅可用6-12位字母数字');
    jQuery.validator.addMethod("isemail", function (value, element) {
        var email = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        return this.optional(element) || (email.test(value));
    }, '请输入正确的格式');
    jQuery.validator.addMethod("isusername", function (value, element) {
        var username = /^[\u4e00-\u9fa5]{2,4}$/;
        return this.optional(element) || (username.test(value));
    }, '请输入真实姓名');











</script>