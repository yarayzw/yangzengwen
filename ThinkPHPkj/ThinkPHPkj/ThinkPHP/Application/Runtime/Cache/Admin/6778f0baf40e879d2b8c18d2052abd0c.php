<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧导航menu</title>
<link href="/thinkphp/Public/Admin/css/css.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/thinkphp/Public/Admin/js/sdmenu.js"></script>
<script type="text/javascript">
	// <![CDATA[
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
	// ]]>
</script>
<style type=text/css>
html{ SCROLLBAR-FACE-COLOR: #538ec6; SCROLLBAR-HIGHLIGHT-COLOR: #dce5f0; SCROLLBAR-SHADOW-COLOR: #2c6daa; SCROLLBAR-3DLIGHT-COLOR: #dce5f0; SCROLLBAR-ARROW-COLOR: #2c6daa;  SCROLLBAR-TRACK-COLOR: #dce5f0;  SCROLLBAR-DARKSHADOW-COLOR: #dce5f0; overflow-x:hidden;}
body{overflow-x:hidden; background:url(/thinkphp/Public/Admin/images/main/leftbg.jpg) left top repeat-y #f2f0f5; width:194px;}
    .general_manager{
        display: none;
    }
</style>
</head>
<body onselectstart="return false;" ondragstart="return false;" oncontextmenu="return false;">
<div id="left-top">
	<div><img src="/thinkphp/Public/Admin/images/main/member.gif" width="44" height="44" /></div>
    <span>用户：<?php echo ($name); ?><br>角色：<?php echo ($role_state); ?></span>
</div>
    <div  id="my_menu" class="sdmenu">
        <?php if(is_array($authp)): foreach($authp as $key=>$vo): ?><div>
                <span><?php echo ($vo["authname"]); ?></span>
                <?php if(is_array($auths)): foreach($auths as $key=>$voo): if($voo['authpid'] == $vo['authid']): ?><a href="/thinkphp/index.php/Admin/<?php echo ($voo["authc"]); ?>/<?php echo ($voo["autha"]); ?>" target="mainFrame" onFocus="this.blur()"><?php echo ($voo["authname"]); ?></a><?php endif; endforeach; endif; ?>
            </div><?php endforeach; endif; ?>




    </div>
</body>
</html>