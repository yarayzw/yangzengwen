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
</head>
<body>

        <div id="nxHeader" class="hd-wraper ">
            <div class="hd-fixed-wraper clearfix">
                <div class="hd-main">
                    <h1 class="hd-logo">
                        <a href="#" >人人网</a>
                    </h1>
                    <div class="hd-nav clearfix">
                        <div class="hd-search">
                            <input type="text" id="hd-search" class="hd-search-input" placeholder="搜索好友，公共主页，状态" />
                            <a href="javascript:;" class="hd-search-btn"></a>
                        </div>
                        <dl class="hd-account clearfix">
                            <dt>
                                <a href="">
                                    <img class="hd-avatar" width="30" height="30" src="/thinkphp/Public/Uploads/<?php echo ($headphoto); ?>" />
                                </a>
                            </dt>
                            <dd>
                                <a class="hd-name" href="#"><?php echo ($name); ?></a>
                                <a class="hd-name" href="#"><?php echo ($level); ?>级</a>
                            </dd>
                        </dl>

                        <div class="hd-account-action hd-account-action-vip" >
                            <?php if($status == 2): ?><img src='/thinkphp/Public/Home/images/vip.png'><?php endif; ?>
                        </div>


                    </div>

                </div>

            </div>

        </div>




<div class="nx-wraper clearfix">
    <div class="nx-sidebar">
        <div id="nxSlidebar" class="slide-fixed-wraper clearfix">
            <div class="app-nav-wrap">
                <div class="app-nav-cont">
                    <ul class="app-nav-list">
                        <li class="app-nav-item app-nav-item-cur app-feed"><a class="app-link" href="/thinkphp/index.php/Home/Home/homepage"><img class="app-icon" width="32" height="32" src="/thinkphp/Public/Home/images/a.gif"/><span >首页</span></a></li>
                        <li class="app-nav-item app-homepage" ><a class="app-link" href="/thinkphp/index.php/Home/Home/personpage"><img class="app-icon" width="32" height="32" src="/thinkphp/Public/Home/images/a.gif"/><span >主页</span></a></li>
                        <li class="app-nav-item app-album" ><a class="app-link" href="/thinkphp/index.php/Home/Home/photo"><img class="app-icon" width="32" height="32" src="/thinkphp/Public/Home/images/a.gif"/><span >相册</span></a></li>


                    </ul>
                </div>
                </ul>
            </div>

        </div>
    </div>
</div>


<div class="bd-container ">
    <div class="frame-nav-wrap">
        <div id="frameFixedNav" class="frame-nav-fixed-wraper">
            <div class="frame-nav-inner">
                <ul class="fd-nav-list clearfix">
                    <li class="fd-nav-item fd-nav-cur-item">
                        <span class="fd-nav-icon fd-sub-nav"></span>
                        <a href="#">Ta的主页</a></li>
                    <li class="fd-nav-item">
                        <a href="/thinkphp/index.php/Home/Home/friendalbum">相册</a>
                    </li>
                    <li class="fd-nav-item">
                        <a href="/thinkphp/index.php/Home/Home/friendmood">状态</a>
                    </li>
                    <li class="fd-nav-item">
                        <a href="/thinkphp/index.php/Home/Home/frienddaily">日志</a></li>

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

                                </ul>


                            </div>

                        </div>
                        <div style="width:860px;background:#ffffff;margin-top:30px;">
                            <script type="text/javascript">
                                $(function(){
                                    $("#asas").eq(0).animate({
                                        height:'600px'
                                    },3000);
                                });
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