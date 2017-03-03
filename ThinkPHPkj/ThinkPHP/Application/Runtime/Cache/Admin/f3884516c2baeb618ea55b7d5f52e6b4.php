<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>主要内容区main</title>
    <script type="text/javascript" src="/thinkphp/Public/Admin/js/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="/thinkphp/Public/Admin/js/layer/layer.js"></script>
    <link href="/thinkphp/Public/Admin/css/css.css" type="text/css" rel="stylesheet"/>
    <link href="/thinkphp/Public/Admin/css/main.css" type="text/css" rel="stylesheet"/>
    <link href="/thinkphp/Public/Admin/css/mainselect.css" type="text/css" rel="stylesheet"/>
    <link href="/thinkphp/Public/Admin/css/page.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
    <tr>
        <td width="99%" align="left" valign="top">您的位置：权限信息</td>
    </tr>

    <tr>
        <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
                <tr>
                    <th align="center" valign="middle" class="borderright">编号</th>
                    <th align="center" valign="middle" class="borderright">权限名称</th>
                    <th align="center" valign="middle" class="borderright">父编号</th>
                    <th align="center" valign="middle" class="borderright">控制器</th>
                    <th align="center" valign="middle" class="borderright">方法</th>
                    <th align="center" valign="middle" class="borderright">路径</th>
                    <th align="center" valign="middle" class="borderright">权限等级</th>
                </tr>
                <?php if(is_array($authp)): foreach($authp as $key=>$vo): ?><tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align='center' valign='middle' class='borderright'><?php echo ($vo["authid"]); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($vo["authname"]); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($vo["authpid"]); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($vo["authc"]); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($vo["autha"]); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($vo["authpath"]); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($vo["authlevel"]); ?></td>
                    </tr>
                    <?php if(is_array($auths)): foreach($auths as $key=>$voo): if($voo['authpid'] == $vo['authid']): ?><tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                            <td align='center' valign='middle' class='borderright'><?php echo ($voo["authid"]); ?></td>
                            <td align='center' valign='middle' class='borderright'><?php echo ($voo["authname"]); ?></td>
                            <td align='center' valign='middle' class='borderright'><?php echo ($voo["authpid"]); ?></td>
                            <td align='center' valign='middle' class='borderright'><?php echo ($voo["authc"]); ?></td>
                            <td align='center' valign='middle' class='borderright'><?php echo ($voo["autha"]); ?></td>
                            <td align='center' valign='middle' class='borderright'><?php echo ($voo["authpath"]); ?></td>
                            <td align='center' valign='middle' class='borderright'><?php echo ($voo["authlevel"]); ?></td>
                        </tr><?php endif; endforeach; endif; endforeach; endif; ?>
            </table>
        </td>
    </tr>
</table>

</body>

</html>