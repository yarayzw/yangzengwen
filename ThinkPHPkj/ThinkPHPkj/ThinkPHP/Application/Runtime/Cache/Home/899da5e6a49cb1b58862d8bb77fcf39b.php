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
                        <a href="/thinkphp/index.php/Home/Home/friendalbum">相册</a>
                    </li>
                    <li class="fd-nav-item">
                        <a href="/thinkphp/index.php/Home/Home/friendmood">状态</a>
                    </li>
                    <li class="fd-nav-item">
                        <a href="#">日志</a></li>

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

                                <div style="width:860px;height:500px;background:#ffffff;margin-top:30px;">

                                    <table>
                                        <tr align="center">
                                            <td width="180px" height="50px">时间</td><td width="80px">标题</td><td width="540px">内容</td>
                                        </tr>

                                        <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr align="center" height="80px">
                                                <td><?php echo ($vo["addtime"]); ?></td>
                                                <td><?php echo ($vo["title"]); ?></td>
                                                <td><?php echo (stripslashes(htmlspecialchars_decode($vo["content"]))); ?></td>

                                            </tr><?php endforeach; endif; ?>

                                    </table>
                                    <div class="pagelist"><?php echo ($page); ?></div>


                                </div>



                            </div>

                        </div>
                        <form action="/thinkphp/index.php/Home/Home/deledaily" id="f0" method="post" style="display:none;">
                            <input type="text" value="" name="msgid" id="delselect">
                            <input type="submit">
                        </form>



                    </div>


                </div>




                <div class="ft-wrapper clearfix" style="position: relative; top: 0px; width: 860px;">

                    <p>
                        <strong>玩转人人</strong>
                        <a href="http://page.renren.com/register/regGuide/" target="_blank">公共主页</a>
                        <a href="http://public.renren.com/" target="_blank">公众平台</a>
                        <a href="http://support.renren.com/helpcenter" target="_blank">客服帮助</a>
                        <a href="http://www.renren.com/siteinfo/privacy" target="_blank">隐私</a>
                    </p>

                    <p>
                        <strong>商务合作</strong>
                        <a href="http://page.renren.com/marketing/index" target="_blank">品牌营销</a>
                        <a href="http://bolt.jebe.renren.com/introduce.htm" class="l-2" target="_blank">中小企业<br>自助广告</a>
                        <a href="http://dev.renren.com/" target="_blank">开放平台</a>
                    </p>

                    <p>
                        <strong>公司信息</strong>
                        <a href="http://www.renren-inc.com/zh/product/renren.html" target="_blank">关于我们</a>
                        <a href="http://page.renren.com/gongyi" target="_blank">人人公益</a>
                        <a href="http://www.renren-inc.com/zh/hr/" target="_blank">招聘</a>
                        <a href="http://www.renren.com/898030450/profile#nogo" id="lawInfo">法律声明</a>
                    </p>

                    <p>
                        <strong>友情链接</strong>
                        <a href="http://fenqi.renren.com/" target="_blank">人人分期</a>
                        <a href="https://licai.renren.com/" target="_blank">人人理财</a>
                        <a href="http://www.woxiu.com/" target="_blank">我秀</a>
                        <a href="http://www.nic.ren/" target="_blank">.ren注册局</a>
                    </p>

                    <p>
                        <strong>人人移动客户端下载</strong>
                        <a href="http://mobile.renren.com/showClient?v=platform_rr&psf=42064"
                           target="_blank">iPhone/Android</a>
                        <a href="http://mobile.renren.com/showClient?v=platform_hd&psf=42067" target="_blank">iPad客户端</a>
                        <a href="http://mobile.renren.com/" target="_blank">其他人人产品</a>
                    </p>

                    <!--<p class="copyright-info">-->
                    <!-- 临时添加公司信息用 -->
                    <p class="copyright-info" style="margi-left: -20px">
                        <span>公司全称：北京千橡网景科技发展有限公司</span>
                        <span>公司电话：010-84481818</span>
                        <span><a href="mailto:admin@renren.com">公司邮箱：admin@renren.com</a></span>
                        <span>公司地址：北京市朝阳区酒仙桥中路18号<br>国投创意信息产业园北楼5层</span>
                        <span>违法和不良信息举报电话：027-87676735</span>
                    <span><img id="wenhuajingying_icon" style="height: 28px;float: left; margin-left: 60px;"
                               src="Public/images/wenhuajingying.png"><a
                            href="http://sq.ccm.gov.cn/ccnt/sczr/service/business/emark/toDetail/DFB957BAEB8B417882539C9B9F9547E6"
                            target="_blank">京网文[2013]0136-030号</a></span>
                        <span><a href="http://www.miibeian.gov.cn/" target="_blank">京ICP证090254号</a></span>
                        <span>人人网©2016</span>
                    </p>

                </div>
            </div>
        </div>
    </div>



</body>
</html>