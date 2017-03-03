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
        <td width="99%" align="left" valign="top">您的位置：用户管理</td>
    </tr>
    <tr>
        <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
                <tr>
                    <td width="90%" align="left" valign="middle">
                        <form method="post" action="/thinkphp/index.php/Admin/User/preuser">
                            <span>管理员：</span>
                            <input type="text" name="userInformation" value="" class="text-word">
                            <input name="" type="submit" value="查询" class="text-but"><span>按姓名查询</span>
                        </form>
                    </td>
                    <td width="10%" align="center" valign="middle" style="text-align:right; width:150px;"><a href="#" id="addUser" onFocus="this.blur()" class="add">新增管理员</a></td>

                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
                <tr>
                    <th align="center" valign="middle" class="borderright">帐号</th>
                    <th align="center" valign="middle" class="borderright">密码</th>
                    <th align="center" valign="middle" class="borderright">联系方式</th>
                    <th align="center" valign="middle" class="borderright">邮箱</th>
                    <th align="center" valign="middle" class="borderright">姓名</th>
                    <th align="center" valign="middle" class="borderright">性别</th>
                    <th align="center" valign="middle" class="borderright">年龄</th>
                    <th align="center" valign="middle" class="borderright">状态</th>
                    <th align="center" valign="middle" class="borderright">创建时间</th>
                    <th align="center" valign="middle">操作</th>
                </tr>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['username']); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['password']); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['tel']); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['email']); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['name']); ?></td>
                        <td align='center' valign='middle' class='borderright'>
                            <?php if($row['sex'] == 1): ?>男生<?php endif; ?>
                            <?php if($row['sex'] == 2): ?>女生<?php endif; ?>
                        </td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['age']); ?></td>
                        <td align='center' valign='middle' class='borderright'>
                            <?php if($row['status'] == 1): ?>普通会员<?php endif; ?>
                            <?php if($row['status'] == 2): ?>vip<?php endif; ?>
                            <?php if($row['status'] == 3): ?>禁止<?php endif; ?>
                        </td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['addtime']); ?></td>
                        <td align="center" valign="middle" class="borderbottom">
                            <span class="gray"></span><a href="javascript:void(0)" onclick="modifymsg(this)" uid="<?php echo ($row["id"]); ?>">修改</a><span class="gray"></span>
                            <a href="javascript:void(0)" city="<?php echo ($row["city"]); ?>" school="<?php echo ($row["school"]); ?>" headphoto="<?php echo ($row["headphoto"]); ?>" level="<?php echo ($row["level"]); ?>" onclick="msgdetail(this)">详情</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
        </td>
    </tr>
    <tr>
        <td class="Pagination"><?php echo ($page); ?></td>

    </tr>
</table>
<div id="dv1" style="display:none;width:198px;height:178px;text-align:center;line-height:178px;">
<form action="/thinkphp/index.php/Admin/User/mdfstatus" method="post" id="f0">
    <select name="status" width="80px" height="30px">
        <option value="3">禁止</option>
        <option value="1">解封</option>
    </select>
    <input type="hidden" id="hidmodify" name="uid" value="">
    &nbsp;&nbsp;&nbsp;<input type="submit">
</form>
</div>
<div id="dv2" style="display:none;width:398px;height:298px;text-align:center;font-size:16px;">
    <img id="headphoto" width="130px"  height="150px" src=""><br>
    <table style="margin-left:50px;">
        <tr><td align="right">现居地：</td><td><span id="city"></span></td></tr>
        <tr><td align="right">  学校：</td><td><span id="school"></span></td></tr>
        <tr><td align="right">  等级：</td><td><span id="level"></span></td></tr>
    </table>
</div>
</body>
<script>
    function modifymsg(ob){
        var id=$(ob).attr('uid');
        $('#hidmodify').attr('value',id);
        layer.open({
            type: 1,
            title:false,
            skin: 'layui-layer-rim',            //加上边框
            area: ['200px', '180px'],
            content: $('#dv1')
        });

    }
    function msgdetail(ob){
        var city=$(ob).attr('city');
        var school=$(ob).attr('school');
        var headphoto=$(ob).attr('headphoto');
        var level=$(ob).attr('level');
        headphoto="/thinkphp/Public/Uploads/"+headphoto;
        $('#headphoto').attr('src',headphoto);
        $('#school').html(school);
        $('#city').html(city);
        $('#level').html(level);
        layer.open({
            type: 1,
            title:false,
            skin: 'layui-layer-rim',            //加上边框
            area: ['400px', '300px'],
            content: $('#dv2')
        });
    }
</script>
</html>