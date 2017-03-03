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
        <td width="99%" align="left" valign="top">您的位置：角色信息</td>
    </tr>
    <tr>
        <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
                <tr>
                    <td width="90%" align="left" valign="middle">
                        <form method="post" action="/thinkphp/index.php/Admin/Authority/auth">
                            <span>管理员：</span>
                            <input type="text" name="information" value="" class="text-word">
                            <input name="" type="submit" value="查询" class="text-but"><span>按角色名称查询</span>
                        </form>
                    </td>

                    <td width="10%" align="center" valign="middle" style="text-align:right; width:150px;"><a href="#" onclick="addrole()" onFocus="this.blur()" class="add">新增职位</a></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
                <tr>
                    <th align="center" valign="middle" class="borderright">编号</th>
                    <th align="center" valign="middle" class="borderright">角色名称</th>
                    <th align="center" valign="middle" class="borderright">权限编号</th>
                    <th align="center" valign="middle" class="borderright">权限控制</th>
                    <th align="center" valign="middle" class="borderright">操作</th>
                </tr>
                <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align='center' valign='middle' class='borderright'><?php echo ($row["roleid"]); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row["rolename"]); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row["roleauthids"]); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row["roleauthac"]); ?></td>
                        <td align='center' valign='middle' class='borderright'>
                            <?php if($row['roleauthids'] > 0): ?><span class="gray"></span>
                            <a href="/thinkphp/index.php/Admin/Authority/autheditor/roleid/<?php echo ($row["roleid"]); ?>/roleauthids/<?php echo ($row["roleauthids"]); ?>/rolename/<?php echo ($row["rolename"]); ?>">编辑权限</a><?php endif; ?>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
        </td>
    </tr>

</table>
<div id="dv" style="display:none;width:200px;height:150px;text-align:center;line-height:60px;font-size:16px;">
<form action="/thinkphp/index.php/Admin/Authority/addrole" method="post">
    角色名称:<input type="text" name="rolename" style="width:120px;"><br>
    <input type="submit">
</form>
</div>
</body>
<script>
    function addrole(){
        layer.open({
            type: 1,
            title:'添加角色',
            skin: 'layui-layer-rim',            //加上边框
            area: ['300px', '200px'],
            content: $('#dv')
        })
    }
</script>
</html>