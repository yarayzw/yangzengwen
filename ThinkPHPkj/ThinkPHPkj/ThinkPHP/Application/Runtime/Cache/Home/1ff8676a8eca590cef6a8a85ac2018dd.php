<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="nx-main860">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>人人网</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="/thinkphp/Public/Home/js/jquery-1.11.3.js"></script>
    <script src="/thinkphp/Public/Home/js/layer.js"></script>
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/base.css">
    <link href="./Public/css/global2-all-min.css" rel="stylesheet">
    <script  src="/thinkphp/Public/Home/js/jquery.validate.js"></script>
    <script src="/thinkphp/Public/Home/js/area.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/profile-all-min.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/publisher-all-min.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/profile.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/index-all-min.css" media="all">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/style.css">
</head>
<body>
<div id="nxContainer" class="nx-container vip-skin-profile nx-webpager-fold nx-normalViewport">
    <div class="nx-main">
        <div id="zidou_template" style="display:none"></div>
        <div id="hometpl_style" data-notshow="" style="display:none">
            <br>
            <style></style>
        </div>
        <div id="nxHeader" class="hd-wraper ">
            <div class="hd-fixed-wraper clearfix" style="width: 1484px;">
                <div class="hd-main">
                    <h1 class="hd-logo">
                        <a href="#">人人网</a>
                    </h1>
                    <div class="hd-nav clearfix">
                        <div class="hd-search">
                            <input type="text" id="hd-search" class="hd-search-input" placeholder="搜索好友，公共主页，状态">
                            <a href="javascript:;" class="hd-search-btn"></a>
                        </div>
                        <dl class="hd-account clearfix">
                            <dt>
                                <a href="#">
                                    <img class="hd-avatar" width="30" height="30" src="/thinkphp/Public/Uploads/<?php echo ($headphoto); ?>">

                                </a>
                            </dt>
                            <dd>
                                <a class="hd-name"><?php echo ($name); ?></a>
                                <a class="hd-name" href="##"><?php echo (session('level')); ?>级</a>
                            </dd>

                        </dl>
                        <div>
                            <?php if($status == 2): ?><img src="/thinkphp/Public/Home/images/vip.png"><?php endif; ?>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="nx-wraper clearfix">
            <div class="nx-sidebar">
                <div id="nxSlidebar" class="slide-fixed-wraper clearfix ui-scrollbar" style="height: 885px;">
                    <div class="app-nav-wrap">
                        <div class="app-nav-cont">
                            <ul class="app-nav-list">
                                <li class="app-nav-item app-feed" data-tip="首页"><a class="app-link"
                                                                                   href="/thinkphp/index.php/Home/Home/homepage"><img
                                        class="app-icon" width="32" height="32" src="/thinkphp/Public/Home/images/a.gif"><span
                                        class="app-title">首页</span></a></li>

                                <li class="app-nav-item app-nav-item-cur app-homepage" data-tip="个人主页"><a
                                        class="app-link" href="#l"><img class="app-icon" width="32"
                                                                                           height="32"
                                                                                           src="/thinkphp/Public/Home/images/a.gif"><span
                                        class="app-title">个人主页</span></a></li>
                                <li class="app-nav-item app-album" data-tip="我的相册"><a class="app-link"
                                                                                      href="/thinkphp/index.php/Home/Home/photo"><img
                                        class="app-icon" width="32" height="32" src="/thinkphp/Public/Home/images/a.gif"><span
                                        class="app-title">我的相册</span></a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="app-nav-cont recent-app-cont">

                    </div>
                    <div class="ui-scrollbar-bar ui-scrollbar-bar-y" style="top: 0px; height: 0px;"></div>
                </div>
            </div>
        </div>
        <div class="bd-container ">
            <div class="frame-nav-wrap">
                <div id="frameFixedNav" class="frame-nav-fixed-wraper" style="width: 1324px;">
                    <div class="frame-nav-inner">
                        <ul class="fd-nav-list clearfix">
                            <li class="fd-nav-item fd-nav-cur-item">
                                <span class="fd-nav-icon fd-sub-nav"></span>
                                <a href="#">我的主页</a></li>
                            <li class="fd-nav-item">
                                <a href="/thinkphp/index.php/Home/Home/photo">相册</a>
                            </li>
                            <li class="fd-nav-item">
                                <a href="/thinkphp/index.php/Home/Home/mood">状态</a>
                            </li>
                            <li class="fd-nav-item">
                                <a href="/thinkphp/index.php/Home/Home/daily">日志</a></li>
                            <li class="fd-nav-item">
                                <a href="/thinkphp/index.php/Home/Home/msgbox">收件箱</a></li>

                        </ul>
                    </div>
                </div>
            </div>


            <div class="bd-main">
                <div class="bd-content clearfix">
                    <div id="profile_wrapper">
                        <div class="top-attach clearfix" id="top-attach"></div>
                        <div id="timeline_wrapper">
                            <div id="cover">
                                <div class="avatar">
                                    <div class="figure_con">
                                        <figure id="uploadPic">
                                            <img width="200px" height="180px" src="/thinkphp/Public/Uploads/<?php echo ($headphoto); ?>">


                                        </figure>
                                    </div>

                                    <img src="/thinkphp/Public/Home/images/men_main.gif" id="largepic" style="display:none;"></div>
                                <div class="cover-bg"><h1 class="avatar_title no_auth"><?php echo ($name); ?></h1>


                                </div>

                            </div>

                        </div>
                        <div></div>
                        <div id="operate_area" class="clearfix">
                            <div class="tl-information">
                                <ul>
                                    <li class="school"><span>就读于<?php echo ($school); ?></span></li>
                                    <li class="birthday">
                                        <span><?php echo ($sex); ?></span> <span>，年方<?php echo ($age); ?></span></li>
                                    <li class="address">现居 <?php echo ($city); ?></li>
                                    <li><a class="information" onclick="information(this)" uid="<?php echo ($id); ?>" href="javascript:viod(0)" >完善信息</a></li>
                                </ul>

                                <a class="editinfo" onclick="uploadhp(this)" uid="<?php echo ($id); ?>" href="javascript:viod(0)">上传头像</a>
                            </div>

                        </div>

                        <!--完善信息-->
                        <form action="/thinkphp/Home/Index/personpage" method="post" id="f00" style="display:none;">
                            <div style="width:500px;height:50px;margin-left:70px;padding-top:20px;">
                                <div style="width:70px;height:35px;float:left;font-size:14px;text-align:right;line-height:35px;">
                                    <span style="color:red;">*</span> 用户名：
                                </div>
                                <div style="width:400px;height:35px;float:left;font-size:12px;">

                                    <input value="<?php echo ($username); ?>" type="text" <?php if($username != null): ?>disabled="disabled"<?php endif; ?> name="username" id="uname" style="width:150px;height:30px;color:#000000;font-size:14px;">


                                </div>

                            </div>
                            <div style="width:500px;height:50px;margin-left:70px;">
                                <div style="width:70px;height:35px;float:left;font-size:14px;text-align:right;line-height:35px;">
                                    <span style="color:red;">*</span> 邮箱：
                                </div>
                                <div style="width:300px;height:35px;float:left;font-size:12px;">
                                    <input value="<?php echo ($email); ?>" type="text" <?php if($email != null): ?>disabled="disabled"<?php endif; ?> id="email10" name="email"  style="width:150px;height:30px;color:#000000;font-size:14px;"><span id="span202" style="display:none;color:red;font-size:12px;" >邮箱已存在</span>
                                </div>

                            </div>
                            <div style="width:500px;height:50px;margin-left:70px;">
                                <div style="width:70px;height:35px;float:left;font-size:14px;text-align:right;line-height:35px;">
                                    <span style="color:red;">*</span> 姓名：
                                </div>
                                <div style="width:300px;height:35px;float:left;font-size:12px;">
                                    <input type="text" name="name" id="unname" style="width:150px;height:30px;color:#000000;font-size:14px;" value="<?php echo ($name); ?>">

                                </div>

                            </div>

                            <div style="width:500px;height:50px;margin-left:70px;">
                                <div style="width:70px;height:35px;float:left;font-size:14px;text-align:right;line-height:35px;">
                                    毕业院校：
                                </div>
                                <div style="width:300px;height:35px;float:left;font-size:12px;">
                                    <input type="text" name="school"  style="width:150px;height:30px;color:#000000;font-size:14px;" value="<?php echo ($school); ?>">

                                </div>

                            </div>
                            <div style="width:500px;height:50px;margin-left:70px;">
                                <div style="width:100px;height:35px;float:left;font-size:14px;text-align:right;line-height:35px;">
                                    年龄 性别：
                                </div>
                                <div style="width:60px;height:35px;float:left;font-size:12px;">
                                    <input type="text" name="age"  style="width:50px;height:30px;color:#000000;font-size:14px;" value="<?php echo ($age); ?>">

                                </div>
                                <div style="width:150px;height:35px;float:left;font-size:16px;line-height:35px;text-align:center;">
                                    男：<input type="radio" name="sex" value="1"  <?php if($ssex == 1): ?>checked<?php endif; ?> />
                                    女：<input type="radio" name="sex" value="2" <?php if($ssex == 2): ?>checked<?php endif; ?> />
                                </div>

                            </div>
                            <div style="width:300px;height:30px;margin-left:70px;font-size:18px;line-height:30px;">
                                现居地:<?php echo ($city); ?>
                            </div>
                            <hr/>
                            <div style="width:300px;height:30px;margin-left:70px;font-size:18px;line-height:30px;">
                                修改地址：
                            </div>
                            <div style="width:450px;height:40px;margin-left:70px;margin-top:15px;">

                                <select id="s_province" name="s_province" style="border:1px #993300 solid; background:#FFFFFF;"  >
                                    <option value="河南省" checked="checked"></option>
                                </select>  
                                <select id="s_city" name="s_city" style="border:1px #993300 solid; background:#FFFFFF;" >
                                    <option value="<?php echo ($sanji[1]); ?>"></option>
                                </select>  
                                <select id="s_county" name="s_county" style="border:1px #993300 solid; background:#FFFFFF;" >
                                    <option value="<?php echo ($sanji[2]); ?>"></option>
                                </select>
                                <script type="text/javascript">_init_area();</script>
                            </div>

                            <div style="width:300px;height:45px;text-align:center;">
                                <input type="hidden" value="" name="hidmsg" id="inputhidden"/>
                                <input type="submit" id="messagebtnn" value="保存" style="width:150px;height:40px;background:#268;font-size:16px;">
                            </div>
                        </form>
                        <div style="width:860px;background:#ffffff;margin-top:30px;">
                            <script type="text/javascript">
                                $(function(){
                                    $("#asas").eq(0).animate({
                                        height:'600px'
                                    },3000);
                                });





                                $('#f00').validate(
                                        {
                                            rules:{
                                                username:{
                                                    unique:true,
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
                                                    required:'用户名不能为空'

                                                },
                                                email:{
                                                    required:'必填'
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

                            <div id="asd">
                                <div id='asas' class="timeline" style="overflow: auto;">
                                    <div class="timeline-date" >
                                        <ul>
                                            <h2 class="second" style="position: relative;">
                                                <span>2016年</span>
                                            </h2>
                                            <?php if(is_array($arr)): foreach($arr as $key=>$vo): ?><li>
                                                <h3><?php echo ($vo["date"]); ?><span><?php echo ($vo["year"]); ?></span></h3>
                                                <dl class="right">
                                                    <?php if(isset($vo["title"])): ?><span>日志：<?php echo ($vo["title"]); ?></span><?php endif; ?>
                                                    <?php if(isset($vo["content"])): ?><span>心情：<?php echo ($vo["content"]); ?></span><?php endif; ?>
                                                </dl>
                                            </li><?php endforeach; endif; ?>
                                        </ul>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>


                </div>

                    <form action="/thinkphp/index.php/Home/Home/headphoto" method="post" id="f0" enctype="multipart/form-data" style="display:none;">
                        <div style="width:280px;height:100px;text-align:center;">
                        <input type="hidden" name="uid" id="uid" value=""><br>
                        <input type="file" name="headphoto">
                        <br><br><input type="submit" value='确定' style="width:80px;height:30px;background:#ffffff;">
                        </div>
                    </form>


              <div class="ft-wrapper clearfix" style="position: relative; top: 0px; width: 860px;">

                  <p>
                      <strong>玩转啪啪</strong>
                      <a href="#" target="_blank">公共主页</a>
                      <a href="#" target="_blank">公众平台</a>
                      <a href="#" target="_blank">客服帮助</a>
                      <a href="#" target="_blank">隐私</a>
                  </p>

                  <p>
                      <strong>商务合作</strong>
                      <a href="#" target="_blank">品牌营销</a>
                      <a href="#" class="l-2" target="_blank">中小企业<br />自助广告</a>
                      <a href="#" target="_blank">开放平台</a>
                  </p>

                  <p>
                      <strong>公司信息</strong>
                      <a href="#" target="_blank">关于我们</a>
                      <a href="#" target="_blank">啪啪公益</a>
                      <a href="#" target="_blank">招聘</a>
                      <a href="#" id="lawInfo">法律声明</a>
                  </p>

                  <p>
                      <strong>友情链接</strong>
                      <a href="#" target="_blank">啪啪分期</a>
                      <a href="#" target="_blank">啪啪理财</a>
                      <a href="#" target="_blank">我秀</a>
                      <a href="#" target="_blank">注册局</a>
                  </p>

                  <p>
                      <strong>啪啪移动客户端下载</strong>
                      <a href="#" target="_blank">iPhone/Android</a>
                      <a href="#" target="_blank">iPad客户端</a>
                      <a href="#" target="_blank">其他产品</a>
                  </p>


                  <p class="copyright-info" style="margi-left: -20px">
                      <span>公司全称：郑州景科技发展有限公司</span>
                      <span>公司电话：0371-88888888</span>
                      <span><a href="#">公司邮箱：admin@papa.com</a></span>
                      <span>公司地址：郑州市高新区<br>河南商务产业园</span>
                      <span>违法和不良信息举报电话：027-87676735</span>
                      <span></span>
                      <span><a href="#" target="_blank">京ICP证090254号</a></span>
                      <span>人人网&copy;2016</span>
                  </p>
            </div>
            </div>
        </div>
    </div>



</body>
</html>

<script>
    $(function(){
        $("#timeline").eq(0).animate({
            height:'600px'
        },3000);
    });
    function uploadhp(ob){
        var uid=$(ob).attr('uid');
        $('#uid').attr('value',uid);
        layer.open({
            type: 1,
            title: '上传头像',
            closeBtn: 0,
            shadeClose: true,
            area: ['300px', '150px'],
            skin: 'yourclass',
            content: $('#f0')
        });
    }

    function information(ob){
        var uid=$(ob).attr('uid');
        $('#uid').attr('value',uid);
        layer.open({
            type: 1,
            title: '完善信息',
            closeBtn: 0,
            shadeClose: true,
            area: ['570px', '520px'],
            skin: 'yourclass',
            content: $('#f00')
        });
    }


</script>