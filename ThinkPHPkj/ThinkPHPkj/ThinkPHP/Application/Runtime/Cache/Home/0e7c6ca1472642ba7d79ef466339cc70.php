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

    <style>
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

        }
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
                    <?php if($status == 2): ?><img src='/thinkphp/Public/Home/images/vip.png'><?php endif; ?>
                </div>

                <div style="width:150px;height:200px;background:#805;position:relative;top:10px;left:850px;display:none;">

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
                        <li class="app-nav-item app-homepage" ><a class="app-link" href="#"><img class="app-icon" width="32" height="32" src="/thinkphp/Public/Home/images/a.gif"/><span >主页</span></a></li>
                        <li class="app-nav-item app-album" ><a class="app-link" href="/thinkphp/index.php/Home/Home/photo"><img class="app-icon" width="32" height="32" src="/thinkphp/Public/Home/images/a.gif"/><span >相册</span></a></li>
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
                    <li class="fd-nav-item fd-nav-item-list fd-nav-cur-item">
                        <a class="fd-nav-filter" data-feed-type="0" href="#"></a>

                    </li>
                    <li class="fd-nav-item"></li>
                    <li class="fd-nav-item" style="font-size:16px;line-height:40px;">查看相册</li>
                    <li class="fd-nav-item"></li>
                    <li class="fd-nav-item feed-sort"></li>


                </ul>
            </div>
        </div>
    </div>

    <div class="bd-content clearfix">
        <div class="bd-publisher"></div>

        <div style="width:750px;height:500px;border:1px #ccc solid;overflow:auto;background:#ffffff;">
            <div id='dv01' style="width:120px;height:30px;font-size:16px;line-height:30px;text-align:center;margin-left:30px;margin-top:10px;margin-bottom:10px;border:1px #ccc solid;">
                <?php if($content == 1): ?>非特效相册<?php endif; ?>
                <?php if($content == 2): ?><a id="te2" href="javascript:void(0)">点击特效浏览</a><?php endif; ?>
                <?php if($content == 3): ?><a  onclick="tex3()" href="javascript:void(0)">点击特效浏览</a><?php endif; ?>
                <?php if($content == 4): ?><a id="te4" onclick="tex4()" href="javascript:void(0)">点击特效浏览</a><?php endif; ?>
            </div>
            <div style="border-bottom:1px #ccc solid;"></div>
            <ul>
                <?php if(is_array($photopath)): foreach($photopath as $key=>$vo): ?><li style="float:left;width:150px;margin-left:15px;margin-top:15px;"><img width="150" height="150" onclick="scanphoto(this)" alt="<?php echo ($vo["path"]); ?>" src="/thinkphp/Public/Uploads/img/<?php echo ($vo["path"]); ?>">

                    </li><?php endforeach; endif; ?>
            </ul>
        </div>



        <div id="tex2" style="width:800px;text-align:center;height:1000px;display:none;">

            <audio id="audioplayer" preload="auto" controls style="width:500px;position:relative;top:200px;">
                <source src="/thinkphp/Public/Uploads/banhusha.mp3" loop="true" autostart="true" type="audio/mp3">

            </audio>

            <div class="ad_cycle">
                <div class="number" id="jscycle">
                    <ul>
                        <li class="nonce" target_src="/thinkphp/Public/Uploads/006.png" ></li>
                        <?php if(is_array($photopath)): foreach($photopath as $key=>$vo): ?><li class="initial" target_src="/thinkphp/Public/Uploads/img/<?php echo ($vo["path"]); ?>" ></li><?php endforeach; endif; ?>
                        <
                    </ul>
                </div>
                <a href="#"><img src="img/1.jpg" id="jsimg"/></a>
            </div>

        </div>

        <div id='tex3' style="width:800px;text-align:center;height:900px;display:none; ">

            <ul>
                <?php if(is_array($photopath)): foreach($photopath as $key=>$vo): ?><li><img src="/thinkphp/Public/Uploads/img/<?php echo ($vo["path"]); ?>"></li><?php endforeach; endif; ?>
            </ul>







        </div>








        <div class="nx-content">
            <div class="advert-box" style="float:none;"><div class="side-item-advert"></div></div>
        </div>
        <div class="ft-wrapper clearfix" >
        </div>
    </div>


</body>
</html>
<script>
    $('#dv01').bind({
        mouseover:function(){$(this).css("background-color","#ccc");},
        mouseout:function(){$(this).css("background-color","#F8F8F8");}
    });
    function scanphoto(ob){
        var path=$(ob).attr('alt');
        path='/thinkphp/Public/Uploads/img/'+path;
        layer.open({
            type: 1,
            title: false,
            closeBtn: 0,
            area: ['1000px','1000px'],
            skin: 'layui-layer-nobg',
            shadeClose: true,
            content: "<div style='text-align:center;line-height:1000px;'><img src="+path+"></div>"
        });
    }

    $('#te2').click(function(){
        layer.open({
            type: 1,
            title: false,
            closeBtn: 0,
            area: ['1000px','1000px'],
            skin: 'layui-layer-nobg',
            shadeClose: true,
            content: $('#tex2')
        })
    });

    var jsns=document.getElementById("jscycle").getElementsByTagName("li");
    var jsimg=document.getElementById("jsimg");
    setInterval("cycle()",2000);
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

    var audioTag = document.createElement('audio');
    if (!(!!(audioTag.canPlayType) && ("no" != audioTag.canPlayType("audio/mpeg")) && ("" != audioTag.canPlayType("audio/mpeg")))) {
        AudioPlayer.embed("audioplayer_1", {soundFile: "your.mp3", transparentpagebg: "yes"});
        $( '#audioplayer').hide();
    }else {
        $( '#audioplayer' ).audioPlayer();
    }


    function tex3(){
        layer.open({
            type: 1,
            title: false,
            closeBtn: 0,
            area: ['800px','900px'],
            skin: 'layui-layer-nobg',
            shadeClose: true,
            content: $('#tex3')
        })
    }





</script>