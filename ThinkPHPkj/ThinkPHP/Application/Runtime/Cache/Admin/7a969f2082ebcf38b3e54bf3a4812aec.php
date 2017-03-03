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
        <td width="99%" align="left" valign="top">您的位置：心情信息</td>
    </tr>
    <tr>
        <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
                <tr>
                    <td width="90%" align="left" valign="middle">
                        <form method="post" action="/thinkphp/index.php/Admin/Message/mood">
                            <span>管理员：</span>
                            <input type="text" name="userInformation" value="" class="text-word">
                            <input name="" type="submit" value="查询" class="text-but"><span>按编号查询</span>
                        </form>
                    </td>


                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
                <tr>
                    <th align="center" valign="middle" class="borderright">编号</th>
                    <th align="center" valign="middle" class="borderright">用户编号</th>
                    <th align="center" valign="middle" class="borderright">内容</th>
                    <th align="center" valign="middle" class="borderright">图片</th>
                    <th align="center" valign="middle" class="borderright">创建时间</th>
                </tr>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['id']); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['uid']); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['content']); ?></td>
                        <td align='center' valign='middle' class='borderright'>
                            <?php if($row["picpath"] == 1): ?>无<?php endif; ?>
                            <?php if($row["picpath"] != 1): ?><img width="50" height="50" src="/thinkphp/Public/Uploads/<?php echo ($row["picpath"]); ?>"><?php endif; ?>
                        </td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['addtime']); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
        </td>
    </tr>
    <tr>
        <td class="Pagination"><?php echo ($page); ?></td>

    </tr>
</table>

</body>
<script>

</script>
</html>