<?php if (!defined('THINK_PATH')) exit();?>
<!Doctype html>
<html class="nx-main760">
<head>
    <title>人人网 </title>
    <meta charset="utf-8"/>
    <script src="/thinkphp/Public/Home/js/jquery-1.11.3.js"></script>
    <script src="/thinkphp/Public/Home/js/layer.js"></script>
    <script src="/thinkphp/Public/Home/js/area.js" ></script>
    <script type="text/javascript" charset="utf-8" src="/thinkphp/Public/umeditor/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/thinkphp/Public/umeditor/umeditor.min.js"></script>
    <script type="text/javascript" src="/thinkphp/Public/umeditor/lang/zh-cn/zh-cn.js"></script>
    <script src="/thinkphp/Public/Home/js/jquery.uploadify.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/base.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/home.css" />
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/register-guide-v7.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/uploadify.css">
    <link href="/thinkphp/Public/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
</head>
<body>


<div id="nxHeader" class="hd-wraper ">
    <div class="hd-fixed-wraper clearfix">
        <div class="hd-main">
            <h1 class="hd-logo">
                <a href="#" >啪啪网</a>
            </h1>
            <div class="hd-nav clearfix">
                <div class="hd-search">
                    <form method="post" action="/thinkphp/index.php/Home/Home/searchall" onsubmit="return check()">
                        <input name='search' type="text" id="hd-search" class="hd-search-input" placeholder="搜索好友，公共主页，状态" />
                        <input style="border: 0" type="submit" class="hd-search-btn" value=" "/>
                    </form>
                </div>
                <dl class="hd-account clearfix">
                    <dt>
                        <a href="">
                            <img class="hd-avatar" width="30" height="30" src="/thinkphp/Public/Uploads/<?php echo ($headphoto); ?>" />
                        </a>
                    </dt>
                    <dd>
                        <a class="hd-name" href="##"><?php echo ($name); ?></a>
                        <a class="hd-name" href="##"><?php echo ($level); ?>级</a>
                    </dd>
                </dl>

                <div class="hd-account-action" style='border:1px #ccc solid;'>
                    <a href="/thinkphp/index.php/Home/Home/logout" style="color:#ffffff">退出</a>

                </div>
                <div class="hd-account-action" style='border:1px #ccc solid;'>
                    <a href="/thinkphp/index.php/Home/Home/recharge" style="color:#ffffff">会员充值</a>

                </div>
                <div class="hd-account-action" style='border:1px #ccc solid;'>
                    <a href="javascript:void(0)">
                        <?php if($sign == 1): ?><span id="span963" onclick="explevel(this)" uid="<?php echo ($id); ?>" style="color:#ffffff;display:inline;">签到</span>
                            <span id="span964"  style="color:#ffffff; display:none;">已签到</span><?php endif; ?>
                        <?php if($sign == 2): ?><span style="color:#ffffff;">已签到</span><?php endif; ?>
                    </a>
                </div>

                <div class="hd-account-action hd-account-action-vip" >

                        <?php if($status == 2): ?><img src="/thinkphp/Public/Home/images/vip.png"><?php endif; ?>

                </div>

                <div style="width:70px;height:50px;position:relative;top:-45px;left:950px;">
                    <a href="javascript:void(0);"><img onclick="openmsg()" src='/thinkphp/Public/Home/images/messagetag.jpg'></a>
                </div>
                <div id="closemsg" style="display:none;width:35px;height:35px;position:relative;top:40px;left:815px;">
                    <a href="javascript:void(0)"><img onclick="closemsg()" src="/thinkphp/Public/Uploads/close.png"></a>
                </div>
                <div id="msglist" style="display:none;width:150px;height:600px;overflow-y:auto;overflow-x:hidden;background:#ffffff;position:relative;top:-45px;left:850px;">
                    <div style="width:150px;height:50px;border-bottom:1px #ccc solid;">
                        <div style="width:100px;height:35px;margin-top:15px;font-size:16px;text-align:center;line-height:35px;float:left;">
                            好友列表
                        </div>
                        <div style="width:50px;height:35px;margin-top:15px;float:left;">
                            <?php if($msgstatus != 1): ?><a href="javascript:void(0)"><img onclick="scanmsg(this)" alt="ed" title="没未读信息" src="/thinkphp/Public/Uploads/messaged.png"></a><?php endif; ?>
                            <?php if($msgstatus == 1): ?><a href="javascript:void(0)"><img onclick="scanmsg(this)" alt="op" title="有未读信息" src="/thinkphp/Public/Uploads/message.png"></a><?php endif; ?>
                        </div>
                        <div style="width:120px;height:520px;float:left;margin-left:15px;margin-top:15px;">
                            <ul>
                            <?php if(is_array($brr)): foreach($brr as $key=>$vo): ?><li style="margin-top:5px;"><div onclick="sendmsg(this)" senderid="<?php echo ($id); ?>" sendername="<?php echo ($name); ?>" alt="<?php echo ($vo["id"]); ?>" name="<?php echo ($vo["name"]); ?>" style="height:60px;line-height:58px;" onmouseover="mousehere(this)" onmouseout="mouseleve(this)" ><a href="javascript:void(0)"><img width="50" height="50" src="/thinkphp/Public/Uploads/<?php echo ($vo["headphoto"]); ?>">&nbsp;&nbsp;<?php echo ($vo["name"]); ?></a></div></li><?php endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>



<div id="sendmsg11" style="display:none;text-align:center;">
    <div style="width:400px;height:20px;"></div>

        发送给：<input id="getname" style="width:150px;height:30px;font-size:16px;" type="text" value="">
        <textarea id="contmsg" style="margin:15px; width: 301px; height: 99px;"></textarea>

</div>


<div id="scanmsg" style="background:#ffffff;color:#227DC5;display:none;height:450px;">
    <table>
        <td width="80" height="30" align="center">状态</td>
        <td width="120" align="center">发送人</td>
        <td width="550" align="center">内容</td>
        <td width="250" align="center">时间</td>
        <td width="80" align="center">操作</td>
    <?php if(is_array($crr)): foreach($crr as $key=>$vo): ?><tr>
        <?php if($vo["status"] == 1): ?><td height="30" align="center">未读</td>
            <td height="30" align="center"><?php echo ($vo["sendername"]); ?></td>
            <td height="30" width="550"><?php echo ($vo["content"]); ?></td>
            <td height="30" align="center"><?php echo ($vo["addtime"]); ?></td><?php endif; ?>
            <?php if($vo["status"] != 1): ?><td height="30" align="center">已读</td>
                <td height="30" align="center"><?php echo ($vo["sendername"]); ?></td>
                <td height="30" width="550"><?php echo ($vo["content"]); ?></td>
                <td height="30" align="center"><?php echo ($vo["addtime"]); ?></td><?php endif; ?>
            <td align="center"><a recipientid="<?php echo ($vo["senderid"]); ?>" recipientname="<?php echo ($vo["sendername"]); ?>" senderid="<?php echo ($id); ?>" sendername="<?php echo ($name); ?>" onclick="replymsg(this)" href="javascript:void(0)">回复</a></td>
        </tr><?php endforeach; endif; ?>
    </table>
</div>

<div class="nx-wraper clearfix">
    <div class="nx-sidebar">
        <div id="nxSlidebar" class="slide-fixed-wraper clearfix">
            <div class="app-nav-wrap">
                <div class="app-nav-cont">
                    <ul class="app-nav-list">
                        <li class="app-nav-item app-nav-item-cur app-feed" ><a class="app-link" href="#"><img class="app-icon" width="32" height="32" src="/thinkphp/Public/Home/images/a.gif"/><span >首页</span></a></li>
                        <li class="app-nav-item app-homepage" ><a class="app-link" href="/thinkphp/index.php/Home/Home/personpage"><img class="app-icon" width="32" height="32" src="/thinkphp/Public/Home/images/a.gif"/><span >主页</span></a></li>
                        <li class="app-nav-item app-album"><a class="app-link" href="/thinkphp/index.php/Home/Home/photo"><img class="app-icon" width="32" height="32" src="/thinkphp/Public/Home/images/a.gif"/><span >相册</span></a></li>
                        <li style="height:500px;width:40px;"></li>
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
                        <a href="/thinkphp/index.php/Home/Home/personpage">我的主页</a></li>
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

    <div class="bd-content clearfix">
        <div class="bd-publisher"></div>
        <div class="nx-right ">

            <div id="huatiBox" class="side-item"></div>
            <div class="side-item" id="mergeModule">

                <div class="side-item-body clearfix" style='width:250px;height:440px;'  id="merge-side-item-body">
                    <div style="width:250px;height:35px;">
                        <div style="width:240px;height:28px;text-align:center;line-height:28px;border:1px #ccc solid;float:left;"><a href="javascript:void(0)">谁看过我</a></div>
                    </div>
                    <div style="width:240px;height:410px;overflow:auto;">
                        <ul>
                            <?php if(is_array($visitid)): foreach($visitid as $key=>$vo): ?><li style="margin-left:10px;margin-top:10px;">
                                    <img width="50px" height="50px" src="/thinkphp/Public/Uploads/<?php echo ($vo["headphoto"]); ?>">
                                    &nbsp;<?php echo ($vo["name"]); ?>
                                    &nbsp;&nbsp;<?php echo ($vo["addtime"]); ?>
                                </li><?php endforeach; endif; ?>
                        </ul>
                    </div>

                </div>
            </div>
            <div id="feed-list-right">
                <div style="width:240px;height:340px;">
                    <img width="240" height="340" src="/thinkphp/Public/Uploads/<?php echo ($homepicpath1); ?>">
                </div>
                <div style="width:240px;height:340px;margin-top:15px;">
                    <img width="240" height="340" src="/thinkphp/Public/Uploads/<?php echo ($homepicpath2); ?>">
                </div>
            </div>
        </div>
        <div class="nx-content">
            <div class="advert-box" style="float:none;"><div class="side-item-advert"></div></div>
            <!--guide 引导 begin-->
            <div id='dailytag'>
                <div id='dttop'>
                    <div id='innerdttop'>
                        你现在想说点什么....
                    </div>
                </div>
                <div id="f" style="display:none;">
                    <div style="width:500px;height:10px;"></div>
                    <div style="width:500px;height:40px;color:#e7b402;text-align:center;line-height:40px;font-size:18px;border:1px #ccc solid;">
                        <b>上传照片</b>
                    </div>
                    <div id='lay01' style="width:500px;height:300px;text-align:center;line-height:150px;border:1px #ccc solid;display:block;">
                        <form action="/thinkphp/index.php/Home/Home/upload" id="photoform" method="post" >
                        <div style='width:500px;height:35px;position: relative;top:-50px;left:-70px;'>
                                <span style="color:red;">请选择上传到的相册</span>

                                <select name="uploadalbum" style="width:120px;height:30px;margin-left:30px; ">
                                    <?php if(is_array($album)): foreach($album as $key=>$vvo): ?><option value="<?php echo ($vvo["id"]); ?>"><?php echo ($vvo["name"]); ?></option><?php endforeach; endif; ?>
                                    <input type="hidden" name="uid" id="photouid" value="<?php echo ($id); ?>">
                                    <input type="hidden" name="key" value="1">
                                </select>
                        </div>
                        <div style="border:1px solid #ccc;width:480px;height:250px;margin-top:10px;margin-left:7px;">
                            <div id="queue" onclick="sendphotomsg()"></div>
                            <input id="file_upload" name="file_upload" type="file" multiple="true">
                            <div id="img123" style="border:1px solid #805;text-align:left;">
                            </div>
                        </div>
                            <input type="submit" style="width:80px;height:30px;background:#ffffff;">
                        </form>
                    </div>
                </div>

                <form action="/thinkphp/index.php/Home/Home/writemood" id="f1" method="post" enctype="multipart/form-data" style="display: none">
                    <div style='width:398px;height:40px;color:#e97e09;font-size:16px;text-align:center;line-height:40px;border:1px #ccc solid;'>
                        说说现在的心情
                    </div><input type="hidden" name="uid" value="<?php echo ($id); ?>">
                    <input type="hidden" name="name" value="<?php echo ($name); ?>">
                    <input type="hidden" name="headphoto" value="<?php echo ($headphoto); ?>">
                    <br><input type="file" name="picpath" style="margin-left:20px;">插入图片
                    <br><br><textarea name="content" style='width:398px;height:85px;'></textarea>
                    <br/><br/><div style='width:398px;text-align:center;'><input type='submit' value='确定' style="width:80px;height:30px;background:#ffffff;"></div>
                </form>
                <div id='dtbottom'>
                    <div style="width:500px;height:5px;"><img src='/thinkphp/Public/Home/images/lineline.jpg'></div>
                    <a href="javascript:void(0);"><div id='dt01' class='dtinner' style="margin-left:1px;">
                        传照片
                    </div></a>
                    <a href="javascript:void(0);"><div id='dt02' class='dtinner'>
                        写心情
                    </div></a>
                    <a href="javascript:void(0);"><div id='dt03' class='dtinner'>
                        写日志
                    </div></a>
                </div>
            </div>

            <div class="guide-find-friends" id="guide-user-frd">
                <div style="width:500px;height:80px;background:#227DC5;color:#ffffff;text-align:center;">
                    <div style="width:450px;height:10px;"></div>
                       性别：<select id="searchsex" name="sex">
                            <option value="1">男生</option>
                            <option value="2">女生</option>
                        </select>
                    年龄：<select id="searchage" name="age">
                            <option value="17-21">18-20</option>
                            <option value="20-26">21-25</option>
                            <option value="25-31">25-30</option>
                            <option value="30">30以上</option>
                        </select>
                    毕业学校：<input id="searchschool" type="text" name="school"><br><br>
                    现居地：<select id="s_province" name="s_province"></select> 
                    <select id="s_city" name="s_city" ></select>  
                    <select id="s_county" name="s_county"></select>
                    <script type="text/javascript">_init_area();</script>
                    <a id="search000" onclick="searchfriend()" href="javascript:void(0)" style="color:#ffffff;font-size:16px;">搜索</a>

                </div>
                <div style="width:500px;height:230px;">
                    <iframe id="iframe" src="/thinkphp/index.php/Home/Home/relative" width="500px" height="230px" frameborder="0">

                    </iframe>
                </div>

            </div>

            <div id="newsmsgdv" style='width:500px;height:690px;background:#ffffff;'>
                <div style='width:500px;height:40px;'>
                    <?php if($status == 2): ?><div id="newsdv" style='width:100px;height:30px;border:1px #ccc solid;text-align:center;line-height:30px;font-size:16px;float:right;'>
                            <a id="closenews" href="javascript:viod(0)">只看好友</a>
                        </div><?php endif; ?>
                </div>
                <div style="width:480px;height:30px;">
                    <div style="width:100px;height:30px;text-align:right;line-height:30px;float:left;">
                        所有分类：
                    </div>
                    <div style="float:left;width:350px;height:25px;font-size:12px;line-height:25px;border:1px #ccc solid;">
                        <ul>
                            <?php if(is_array($arr081)): foreach($arr081 as $key=>$vo080): ?><li style="float:left;margin-left:10px;"><a onclick="delenews0(this)" newscid="<?php echo ($vo080["1"]); ?>" newscatename="<?php echo ($vo080["0"]); ?>" href="javascript:void(0)"><?php echo ($vo080["0"]); ?> X</a></li><?php endforeach; endif; ?>
                        </ul>
                    </div>
                </div>
                <div style="width:100px;margin-left:25px;margin-top:10px;float:left;height:90px;">
                    <div style="width:100px;height:30px;font-size:14px;line-height:30px;text-align:right;">新闻：</div>
                    <div style="width:100px;height:30px;font-size:14px;line-height:30px;text-align:right;">广告：</div>
                    <div style="width:100px;height:30px;font-size:14px;line-height:30px;text-align:right;">游戏：</div>
                </div>
                <div style="width:340px;margin-left:10px;margin-top:10px;float:left;height:90px;">
                    <div style="width:340px;height:30px;font-size:12px;line-height:30px;">
                        <ul>
                            <?php if(is_array($arr0)): foreach($arr0 as $key=>$v10): ?><li style="float:left;"><a onclick="searchmsg(this)" cid="<?php echo ($v10["cate_id"]); ?>" catename="<?php echo ($v10["categoryname"]); ?>" href="javascript:void(0)"><?php echo ($v10["categoryname"]); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li><?php endforeach; endif; ?>
                        </ul>
                    </div>
                    <div style="width:340px;height:30px;font-size:12px;line-height:30px;">
                        <ul>
                            <?php if(is_array($arr1)): foreach($arr1 as $key=>$v11): ?><li style="float:left;"><a onclick="searchmsg(this)" cid="<?php echo ($v11["cate_id"]); ?>" catename="<?php echo ($v11["categoryname"]); ?>" href="javascript:void(0)"><?php echo ($v11["categoryname"]); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li><?php endforeach; endif; ?>
                        </ul>
                    </div>
                    <div style="width:340px;height:30px;font-size:12px;line-height:30px;">
                        <ul>
                            <?php if(is_array($arr2)): foreach($arr2 as $key=>$v12): ?><li style="float:left;"><a onclick="searchmsg(this)" cid="<?php echo ($v12["cate_id"]); ?>" catename="<?php echo ($v12["categoryname"]); ?>" href="javascript:void(0)"><?php echo ($v12["categoryname"]); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li><?php endforeach; endif; ?>
                        </ul>
                    </div>

                    <div style="width:480px;height:500px;position:relative;left:-125px;overflow:auto;border:1px #ccc solid;">
                        <table >
                            <?php if(is_array($newsdata)): foreach($newsdata as $key=>$vo101): ?><tr>
                                    <td height="30px" align="center" colspan="2"><?php echo ($vo101["title"]); ?></td><td width="80px"><?php echo ($vo101["addtime"]); ?></td>
                                </tr>
                                <tr>
                                    <td height="120px" width="150px"><img width="150px" height="120px" src="/thinkphp/Public/Uploads/<?php echo ($vo101["picpath"]); ?>"></td><td colspan="2" width="250px"><?php echo ($vo101["content"]); ?></td>
                                </tr>
                                <tr><td height="20px" width="200px" colspan="3"></td></tr><?php endforeach; endif; ?>
                        </table>

                        <table>
                            <?php if(is_array($arr11)): foreach($arr11 as $key=>$vo102): ?><tr>
                                    <td height="30px" align="center" colspan="2"><?php echo ($vo102["title"]); ?></td><td width="80px"><?php echo ($vo102["addtime"]); ?></td>
                                </tr>
                                <tr>
                                    <td height="120px" width="150px"><img width="150px" height="120px" src="/thinkphp/Public/Uploads/<?php echo ($vo102["picpath"]); ?>"></td><td colspan="2" width="250px"><?php echo ($vo102["content"]); ?></td>
                                </tr>
                                <tr><td height="20px" width="200px" colspan="3"></td></tr><?php endforeach; endif; ?>
                        </table>
                    </div>
                </div>
            </div>

            <!--好友心情-->
            <div style='width:500px;height:650px;background:#ffffff;overflow:auto;margin-top:15px;'>
                <div style="width:450px;height:10px;"></div>
                <table width="470" style="margin-left:10px;">
                    <?php if(is_array($fmod)): foreach($fmod as $key=>$v205): ?><tr>
                            <td width="200px" height="50px" align="left"><img width="30px" height="30px" src="/thinkphp/Public/Uploads/<?php echo ($v205["headphoto"]); ?>">&nbsp;&nbsp;<?php echo ($v205["name"]); ?></td>
                            <td width="250px" align="right"><?php echo ($v205["addtime"]); ?></td>
                        </tr>
                        <tr>
                            <td width="250px"><?php echo ($v205["content"]); ?></td>
                        </tr>
                        <tr>
                            <td align="left">
                                <?php if($v205["picpath"] == 1): endif; ?>
                                <?php if($v205["picpath"] != 1): ?><img width="100px" height="100px" src="/thinkphp/Public/Uploads/<?php echo ($v205["picpath"]); ?>"><?php endif; ?>

                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <?php if(is_array($res_comment)): $i = 0; $__LIST__ = $res_comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$res_vo): $mod = ($i % 2 );++$i; if($res_vo["moodid"] == $v205["id"] ): ?><!--<pre>

                                             <?php echo (var_dump($res_vo)); ?>
                                        </pre>-->


                                        <a href="javascript:void(0)" ><?php echo ($res_vo["name"]); ?></a><span>:<?php echo ($res_vo["content"]); ?></span><br/><?php endif; endforeach; endif; else: echo "" ;endif; ?>

                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <form action="/thinkphp/index.php/Home/Home/addComment" method="post" >
                                <td >
                                    <input type="hidden" name="uid" value="<?php echo ($id); ?>"/>
                                    <input type="hidden" name="moodid" value="<?php echo ($v205["id"]); ?>"/>
                                    <textarea name="content" id="<?php echo ($v205["id"]); ?>" style="width: 400px;height: 20px;" onclick="change(this)" onblur="rechange(this)"></textarea>
                                </td>
                                <td>
                                    <input  style=" padding: 2px 2px 0px 2px;font-size: 12px;background-color: #ece9d8;border-width: 1px; width: 40px; height: 30px;" type="submit" value="发表" onsubmit="return check(this)" onclick="clickcheck()"/>
                                </td>
                            </form>
                        </tr><?php endforeach; endif; ?>
                </table>
            </div>

            <script>
                function change(ob){
                    var obid=$(ob).attr('id');
                    $(ob).css('height','80px');
                }

                function rechange(ob){
                    var text = $(ob).val();
                    if(text==''){
                        var obid=$(ob).attr('id');
                        $(ob).css('height','20px');
                    }
                }
                function check(ob){
                    var text = $(ob).val();
                    if(text==''){
                        return false;
                    }

                }



            </script>

            <form id="f101" action="/thinkphp/index.php/Home/Home/homepage" method="post" style="display:none;">
                <input type="text" id="cid" name="cate_id" value="">
                <input type="text" id="catename001" name="catename" value="">

                <input type="submit">
            </form>
            <input type="text" id="memery" style="display:none;" value="<?php echo (session('meme')); ?>">
            <input type="text" id="memname" style="display:none;" value="<?php echo (session('memename')); ?>">


            <form id="f102" action="/thinkphp/index.php/Home/Home/homepage" method="post" style="display:none;">
                <input type="text" id="delenewscate" name="delenewscate_id" value="">
                <input type="text" id="cid0" name="cate_id" value="">
                <input type="text" id="catename002" name="catename" value="">
                <input type="submit">
            </form>

            <form id="f99" action="/thinkphp/index.php/Home/Home/scanfriend" method="post" style="display:none;">
                <input type="hidden" id="friendid" name="friendid" value="">
                <input type="hidden" id="myselfid" name="myselfid" value="<?php echo ($id); ?>">
                <input type="submit">
            </form>


            <form action="/thinkphp/index.php/Home/Home/writedaily" id="f98" style='display:none;' method="post">
                <input type="hidden" name="uid" value="<?php echo ($id); ?>">
                <br><span style='margin-left:20px;font-size:16px;'>标题：</span><input type="text" name="title">
                <br><br>
                <script type="text/plain" id="myEditor" name="contdaily" style="width:500px;height:240px;">

	            </script>
                <button style="margin-top:15px;margin-left:220px;width:80px;height:30px;background:#ffffff;">发表</button>
            </form>





            <div class="ft-wrapper clearfix">

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
    $('#dt01').bind({
        mouseover:function(){$(this).css("background-color","#e7b402");},
        mouseout:function(){$(this).css("background-color","#FFFFFF");}
    });
    $('#dt02').bind({
        mouseover:function(){$(this).css("background-color","#e97e09");},
        mouseout:function(){$(this).css("background-color","#FFFFFF");}
    });
    $('#dt03').bind({
        mouseover:function(){$(this).css("background-color","#1aaf5e");},
        mouseout:function(){$(this).css("background-color","#FFFFFF");}
    });
    $('#layone').bind({
        mouseover:function(){$(this).css("background-color","#e7b402");},
        mouseout:function(){$(this).css("background-color","#FFFFFF");},
        click:function(){$('#lay01').css('display','block'),$('#lay02').css('display','none');}
    });
    $('#laymuch').bind({
        mouseover:function(){$(this).css("background-color","#e7b402");},
        mouseout:function(){$(this).css("background-color","#FFFFFF");},
        click:function(){$('#lay01').css('display','none'),$('#lay02').css('display','block');}
    });
    $('#dt01').on('click', function(){
        layer.open({
            type: 1,
            title: false,
            skin: 'false', //加上边框
            area: ['519px', '500px'], //宽高
            content:$('#f')
        });

//自定页

    });
    $('#dt02').on('click', function(){
        layer.open({
            type: 1,
            title: false,
            skin: 'layui-layer-rim', //加上边框
            area: ['402px', '250px'], //宽高
            content:$('#f1')
        });

//自定页

    });
    $('#dt03').on('click', function(){
        layer.open({
            type: 1,
            title: '写日志',
            skin: 'layui-layer-rim', //加上边框
            area: ['505px', '480px'], //宽高
            content:$('#f98')
        });

//自定页

    });
    $('#innerdttop').on('click', function(){
        layer.open({
            type: 1,
            title: false,
            skin: 'layui-layer-rim', //加上边框
            area: ['402px', '250px'], //宽高
            content:$('#f1')
        });

//自定页

    });

   function openmsg(){
       $('#closemsg').css('display','block');
       $('#msglist').css('display','block');

   }
    $('#closemsg').click(function(){
        $('#closemsg').css('display','none');
        $('#msglist').css('display','none');
    });

   function mousehere(ob){
       $(ob).css('background','#FCEAA3');
   }
    function mouseleve(ob){
        $(ob).css('background','#ffffff');
    }
    function sendmsg(ob){
        var senderid=$(ob).attr('senderid');
        var sendername=$(ob).attr('sendername');
        var recipientid=$(ob).attr('alt');
        var getname=$(ob).attr('name');
        $('#getrecipientid').attr('value',recipientid);
        $('#getname').attr('value',getname);
        $('#getname').attr('disabled',true);
        layer.confirm('您想要干嘛?', {
            title: false,
            btn: ['发信息','看看Ta'] //按钮
        }, function(){
            layer.open({
                type: 1,
                title: '发信息',
                btn: ['发送'],
                yes: function(index){
                    var cont=$('#contmsg').val();
                    layer.close(index);
                    layer.msg('发送成功', {icon: 1});
                    $.post('/thinkphp/index.php/Home/Home/sendmsg',{senderid:senderid,sendername:sendername,recipientid:recipientid,content:cont});
                },
                shadeClose: true,
                area: ['400px', '300px'],
                skin: 'yourclass',
                content: $('#sendmsg11')
            });


        }, function(){
            $('#friendid').attr('value',recipientid);
            $('#f99').submit();
        });


    }
    function scanmsg(ob){
        var  status=$(ob).attr('alt');
        $.post('/thinkphp/index.php/Home/Home/readmsg',{msgstatus:status,id:<?php echo ($id); ?>});
        layer.open({
            type: 1,
            title: false,
            closeBtn: 0,
            shadeClose: true,
            area: ['700px', '450px'],
            skin: 'yourclass',
            content: $('#scanmsg')
        });
    }
    function replymsg(ob){
        var recipientname=$(ob).attr('recipientname');
        var recipientid=$(ob).attr('recipientid');
        var senderid=$(ob).attr('senderid');
        var sendername=$(ob).attr('sendername');
        $('#getname').attr('value',recipientname);
        $('#getname').attr('disabled',true);
        layer.open({
            type: 1,
            title: '发信息',
            btn: ['发送'],
            yes: function(index){
                var cont=$('#contmsg').val();
                layer.close(index);
                layer.msg('发送成功', {icon: 1});
                $.post('/thinkphp/index.php/Home/Home/sendmsg',{senderid:senderid,sendername:sendername,recipientid:recipientid,content:cont});
            },
            shadeClose: true,
            area: ['400px', '300px'],
            skin: 'yourclass',
            content: $('#sendmsg11')
        });
    }
    function searchmsg(ob){
       var cid=$(ob).attr('cid');
       var catename=$(ob).attr('catename');
        var cidcatename=catename+'*'+cid;
        var memname=$('#memname').attr('value');
        var strname=cidcatename+'@'+memname;
        $('#memname').attr('value',strname);
        var memename=$('#memname').attr('value');
        var mem=$('#memery').attr('value');
        var str=cid+'@'+mem;
        $('#memery').attr('value',str);
        var meme=$('#memery').attr('value');
        $.post('/thinkphp/index.php/Home/Home/sendsession',{meme:meme,memename:memename});
        $('#catename001').attr('value',memename);
        $('#cid').attr('value',meme);
        $('#f101').submit();

    }
    function check(){
        var a = $('#hd-search').val();
        if(a==''){
            return false;
        }
    }
    function delenews0(ob){
        var newscatename=$(ob).attr('newscatename');
        var memename=$('#memname').attr('value');
        var meme=$('#memery').attr('value');
        var newscid=$(ob).attr('newscid');
        $('#catename002').attr('value',memename);
        $('#cid0').attr('value',meme);
        $('#delenewscate').attr('value',newscid);
        $.post('/thinkphp/index.php/Home/Home/sendsession',{newscid:newscid,newscatename:newscatename});
        $('#f102').submit();
    }
    $('#closenews').bind({
        mouseover:function(){$('#newsdv').css("background-color","#e97e09");},
        mouseout:function(){$('#newsdv').css("background-color","#FFFFFF");}
    });
    $('#closenews').click(function(){
        $('#newsmsgdv').css('display','none');
    });
    $('#search000').mouseover(function(){
        var sex=$('#searchsex').val();
        var age=$('#searchage').val();
        var school=$('#searchschool').val();
        var province=$('#s_province').val();
        $.post('/thinkphp/index.php/Home/Home/sessionfriend',{sex:sex,age:age,school:school,province:province});
    });
    function searchfriend(){
        $("#iframe").attr("src",'/thinkphp/index.php/Home/Home/searchfriend').ready();
    }
    var um = UM.getEditor('myEditor');
    function explevel(ob){
        var id=$(ob).attr('uid');
        $.post('/thinkphp/index.php/Home/Home/explevel',{id:id});
        $('#span963').css('display','none');
        $('#span964').css('display','inline');
    }
    <?php $timestamp = time() ?>
    $('#file_upload').uploadify({
        'formData'     : {
            'timestamp' : '<?php echo $timestamp ?>',
            'token'     : '<?php echo md5('unique_salt' . $timestamp) ?>'
        },
        'swf'      : '/thinkphp/Public/Home/uploadify.swf',
        'uploader' : '/thinkphp/index.php/Home/Home/uploadify',
        'auto':'true',
        'buttonCursor':'hand',
        'buttonText':'图片上传',
        'onUploadSuccess':function(file,data,response){
            var path="<img width='50' height='50' src='/thinkphp/Public/Uploads/img/"+data;
            var uid="<input type='hidden' name='photopath[]' value='"+data;
            $("#img123").append(path);
            $("#photoform").append(uid);
        }

    });



</script>