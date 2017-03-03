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
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/profile-all-min.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/publisher-all-min.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/profile.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/index-all-min.css" media="all">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/style.css">
    <style>
        .pagelist{ text-align:center; background:#f1f1f1; padding:7px 0;}
        .pagelist a{ margin:0 5px; border:#6185a2 solid 1px; display:inline-block; padding:2px 6px 1px; line-height:16px; background:#fff; color:#6185a2;}
        .pagelist span{ margin:0 5px; border:#6185a2 solid 1px; display:inline-block; padding:2px 6px 1px; line-height:16px; color:#6185a2; color:#fff; background:#6185a2;}

    </style>
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
                                    <img class="hd-avatar" width="30" height="30" src="/thinkphp/Public/Uploads/<?php echo (session('asdfg')); ?>">

                                </a>
                            </dt>
                            <dd>
                                <a class="hd-name"><?php echo (session('name')); ?></a>

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
                                        class="app-link" href="/thinkphp/index.php/Home/Home/personpage"><img class="app-icon" width="32"
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
                                <a href="/thinkphp/index.php/Home/Home/homepage">我的主页</a></li>
                            <li class="fd-nav-item">
                                <a href="/thinkphp/index.php/Home/Home/photo">相册</a>
                            </li>
                            <li class="fd-nav-item">
                                <a href="/thinkphp/index.php/Home/Home/mood">状态</a>
                            </li>
                            <li class="fd-nav-item">
                                <a href="#">日志</a></li>
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

                                <div style="padding:10px;border:1px solid #000;-moz-box-shadow:3px 3px 4px #000;-webkit-box-shadow:3px 3px 4px #000;box-shadow:3px 3px 4px #000;background:#fff;filter:progid:DXImageTransform.Microsoft.Shadow(Strength=4,Direction=135,Color='#000000');">

                                    <table width="500" height="300">
                                        <tr align="center">
                                            <td>好友</td>
                                            <?php if($res == null): ?><td>无匹配好友</td>
                                                <?php else: ?>
                                                <?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td><?php echo ($vo["name"]); ?></td><?php endforeach; endif; else: echo "" ;endif; endif; ?>

                                        </tr>
                                        <tr align="center" >
                                            <td >标题</td>
                                            <td >内容</td>
                                        </tr>
                                        <tr align="center">
                                        <?php if($resnews == null): ?><td colspan="2">无匹配新闻</td>
                                            <?php else: ?>
                                            <?php if(is_array($resnews)): foreach($resnews as $key=>$v): ?><td><?php echo ($v["title"]); ?></td>
                                                    <td><?php echo ($v["content"]); ?></td><?php endforeach; endif; endif; ?>
                                        </tr>


                                    </table>




                                </div>

                            </div>




                        </div>


                    </div>




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