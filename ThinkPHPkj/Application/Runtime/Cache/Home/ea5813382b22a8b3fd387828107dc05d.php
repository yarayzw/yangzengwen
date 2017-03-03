<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <title>幸运大转盘</title>
        <meta name="keywords" content="大转盘抽奖" />
        <link rel="stylesheet" type="text/css" href="/my/ThinkPHPkj/ThinkPHPkj/Public/Home/css/xinyun.css" />
        <style type="text/css">
            .demo{ position:relative;width:650px;}
            #disk{ width:550px; height:550px; background:url("/my/ThinkPHPkj/ThinkPHPkj/Public/Home/images/disk.jpg") no-repeat; }
            #start{ width:163px; height:320px; position:absolute; top:64px; left:144px; }
            #start img{ cursor:pointer }
        </style>
    </head>
    <body>
        <div class="">
            <div class="demo">
                <div id="disk"></div>
                <div id="start"><img src="/my/ThinkPHPkj/ThinkPHPkj/Public/Home/images/start.png" id="startbtn" alt="转盘开启" onclick="lottery()"
/></div>
            </div>  
        </div>
        <script type="text/javascript" src="/my/ThinkPHPkj/ThinkPHPkj/Public/Home/js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="/my/ThinkPHPkj/ThinkPHPkj/Public/Home/js/jQueryRotate.2.2.js"></script>
        <script type="text/javascript" src="/my/ThinkPHPkj/ThinkPHPkj/Public/Home/js/jquery.easing.min.js"></script>
        <script type="text/javascript">
            function lottery() {
                $.ajax({ 
                    type: 'POST', 
                    url:  "/my/ThinkPHPkj/ThinkPHPkj/index.php/Home/Homepage/getDial",
                    dataType: 'json', 
                    cache: false, 
                    error: function() { 
                        alert('Sorry，出错了！'); 
                        return false; 
                    }, 
                    success: function(json) { 
                        $("#startbtn").unbind('click').css("cursor", "default"); 
                        var angle = json.angle; //指针角度  
                        var prize = json.prize; //中奖奖项标题  
                        $("#startbtn").rotate({ 
                            duration: 2500,//转动时间 ms
                            angle: 0, //从0度开始 
                            animateTo: 3600 + angle,//转动角度
                            easing: $.easing.easeOutSine, //easing扩展动画效果 
                            callback: function() { 
                                var resulte = confirm('恭喜您中得' + prize + '\n想要继续吗？');
                                if (resulte) {  //若是点击确定，继续抽奖
                                    lottery(); 
                                } 
                            } 
                        }); 
                    } 
                }); 
            }
        </script>
    </body>
</html>