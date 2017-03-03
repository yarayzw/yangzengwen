<?php /* Smarty version Smarty-3.1.6, created on 2017-03-01 16:35:54
         compiled from "./Application/Home/View\Homepage\index.html" */ ?>
<?php /*%%SmartyHeaderCode:471158b6864e0bb0c6-35209127%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aec561c2d6a9eb914ff68d0aa27e947333a363a3' => 
    array (
      0 => './Application/Home/View\\Homepage\\index.html',
      1 => 1488357354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '471158b6864e0bb0c6-35209127',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_58b6864e13bf6',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b6864e13bf6')) {function content_58b6864e13bf6($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <title>幸运大转盘</title>
        <meta name="keywords" content="大转盘抽奖" />
        <link rel="stylesheet" type="text/css" href="<?php echo @CSS_URL;?>
xinyun.css" />
        <style type="text/css">
            .demo{ position:relative;width:650px;}
            #disk{ width:550px; height:550px; background:url("<?php echo @IMAGES_URL;?>
/disk.jpg") no-repeat; }
            #start{ width:163px; height:320px; position:absolute; top:64px; left:144px; }
            #start img{ cursor:pointer }
        </style>
    </head>
    <body>
        <div class="">
            <div class="demo">
                <div id="disk"></div>
                <div id="start"><img src="./images/start.png" id="startbtn" alt="转盘开启" onclick="lottery()"
/></div>
            </div>  
        </div>
        <script type="text/javascript" src="./js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="./js/jQueryRotate.2.2.js"></script>
        <script type="text/javascript" src="./js/jquery.easing.min.js"></script>
        <script type="text/javascript">
            function lottery() {
                $.ajax({ 
                    type: 'POST', 
                    url:  "<?php echo @__MODULE__;?>
/Homepage/getDial",
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

<?php }} ?>