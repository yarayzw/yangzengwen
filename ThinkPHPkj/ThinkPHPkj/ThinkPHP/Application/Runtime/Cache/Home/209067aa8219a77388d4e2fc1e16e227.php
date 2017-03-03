<?php if (!defined('THINK_PATH')) exit();?>
<!Doctype html>
<html class="nx-main760">
<head>
    <title>人人网 </title>
    <meta charset="utf-8"/>
    <script src="/thinkphp/Public/Home/js/jquery-1.11.3.js"></script>
    <script src="/thinkphp/Public/Home/js/layer.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="/thinkphp/Public/Home/images/favicon-rr.ico" />
    <link rel="apple-touch-icon" href="/thinkphp/Public/Home/images/apple_icon_.png" />
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/base.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/home.css" />
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/register-guide-v7.css">
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
                            <img class="hd-avatar" width="30" height="30" src="/thinkphp/Public/Uploads/<?php echo (session('friendhphoto')); ?>" />
                        </a>
                    </dt>
                    <dd>
                        <a class="hd-name" href="#"><?php echo (session('friendname')); ?></a>
                        <a class="hd-name" href="#"><?php echo (session('friendlevel')); ?>级</a>
                    </dd>
                </dl>

                <div class="hd-account-action hd-account-action-vip" >
                    <?php if($_SESSION['friendstatus']== 2): ?><img src='/thinkphp/Public/Home/images/vip.png'><?php endif; ?>
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
                        <a href="/thinkphp/index.php/Home/Home/scanfriend">Ta的主页</a></li>
                    <li class="fd-nav-item">
                        <a href="#">相册</a>
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

    <div class="bd-content clearfix">
        <div class="bd-publisher"></div>




        <div class="nx-content">
            <div class="advert-box" style="float:none;"><div class="side-item-advert"></div></div>

            <div style="width:800px;height:500px;background:#ffffff;">
                <div style='width:800px;height:65px;text-align:center;background:#F8F8F8;'>
                    <a href='javascript:void(0)'><div style='width:100px;height:65px;float:left;text-align:center;line-height:65px;'>我的相册</div></a>

                </div>
                <div style="width:700px;height:350px;margin-left:50px;overflow:auto;margin-top:15px;">
                    <ul id="album">
                        <?php if(is_array($arr)): foreach($arr as $key=>$vo): ?><li style="float:left;width:140px;height:170px;text-align:center;margin-left:25px;">
                                <a href="javascript:void(0)"><div onclick="getmessages(this)" alt="<?php echo ($vo["id"]); ?>" cate="<?php echo ($vo["content"]); ?>">
                                    <?php if($vo["homepage"] == 1): ?><img src="/thinkphp/Public/Uploads/002.jpg"><?php endif; ?>
                                    <?php if($vo["homepage"] != 1): ?><img src="/thinkphp/Public/Uploads/img/<?php echo ($vo["homepage"]); ?>" width="140" height="150"><?php endif; ?></div>


                                    <?php echo ($vo["name"]); ?>

                                </a>
                            </li><?php endforeach; endif; ?>
                </div>
            </div>

            <form action="/thinkphp/index.php/Home/Home/friendsearch" method="post" id="f5" style="display:none;">
                <input type="hidden" id="searchphoto1" name="albumid" value="">
                <input type="hidden" id="content01" name="album" value="">
                <input type="submit">
            </form>


            <div class="ft-wrapper clearfix" >

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


</body>
</html>
<script>
    function getmessages(ob){
        var id=$(ob).attr('alt');
        var content=$(ob).attr('cate');
        $('#content01').attr('value',content);
        $('#searchphoto1').attr('value',id);
        $('#f5').submit();
    }
</script>