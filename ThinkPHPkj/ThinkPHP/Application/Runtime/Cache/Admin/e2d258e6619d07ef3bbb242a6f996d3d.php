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
        <td width="99%" align="left" valign="top">您的位置：广告发布</td>
    </tr>
    <tr>
        <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
                <tr>
                    <td width="90%" align="left" valign="middle">

                    </td>


                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
                <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                    <td align='center' valign='middle' class='borderright'>修改时间</td>
                    <td align='center' valign='middle' class='borderright'>
                       <?php echo ($row["addtime"]); ?>
                    </td>
                    <td align="center" valign="middle" class="borderbottom">

                    </td>
                </tr>
                    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align='center' valign='middle' class='borderright'>登录轮播1</td>
                        <td align='center' valign='middle' class='borderright'>
                            <img width="50" height="50" src="/thinkphp/Public/Uploads/<?php echo ($row["prepicpath1"]); ?>">
                        </td>
                        <td align="center" valign="middle" class="borderbottom">
                            <span class="gray"></span><a onclick="modify1(this)" picpath="prepicpath1" href="javascript:void(0)">修改</a>
                        </td>
                    </tr>
                    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align='center' valign='middle' class='borderright'>登录轮播2</td>
                        <td align='center' valign='middle' class='borderright'>
                            <img width="50" height="50" src="/thinkphp/Public/Uploads/<?php echo ($row["prepicpath2"]); ?>">
                        </td>
                        <td align="center" valign="middle" class="borderbottom">
                            <span class="gray"></span><a onclick="modify2(this)" picpath="prepicpath2" href="javascript:void(0)">修改</a><span class="gray"></span>
                        </td>
                    </tr>
                    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align='center' valign='middle' class='borderright'>登录轮播3</td>
                        <td align='center' valign='middle' class='borderright'>
                            <img width="50" height="50" src="/thinkphp/Public/Uploads/<?php echo ($row["prepicpath3"]); ?>">
                        </td>
                        <td align="center" valign="middle" class="borderbottom">
                            <span class="gray"></span><a onclick="modify3(this)" picpath="prepicpath3" href="javascript:void(0)">修改</a><span class="gray"></span>
                        </td>
                    </tr>
                    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align='center' valign='middle' class='borderright'>登录轮播4</td>
                        <td align='center' valign='middle' class='borderright'>
                            <img width="50" height="50" src="/thinkphp/Public/Uploads/<?php echo ($row["prepicpath4"]); ?>">
                        </td>
                        <td align="center" valign="middle" class="borderbottom">
                            <span class="gray"></span><a onclick="modify4(this)" picpath="prepicpath4" href="javascript:void(0)">修改</a><span class="gray"></span>
                        </td>
                    </tr>
                    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align='center' valign='middle' class='borderright'>首页上</td>
                        <td align='center' valign='middle' class='borderright'>
                            <img width="50" height="50" src="/thinkphp/Public/Uploads/<?php echo ($row["homepicpath1"]); ?>">
                        </td>
                        <td align="center" valign="middle" class="borderbottom">
                            <span class="gray"></span><a onclick="modify5(this)" picpath="homepicpath1" href="javascript:void(0)">修改</a><span class="gray"></span>
                        </td>
                    </tr>
                    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align='center' valign='middle' class='borderright'>首页下</td>
                        <td align='center' valign='middle' class='borderright'>
                            <img width="50" height="50" src="/thinkphp/Public/Uploads/<?php echo ($row["homepicpath2"]); ?>">
                        </td>
                        <td align="center" valign="middle" class="borderbottom">
                            <span class="gray"></span><a onclick="modify6(this)" picpath="homepicpath2" href="javascript:void(0)">修改</a><span class="gray"></span>
                        </td>
                    </tr>
            </table>
        </td>
    </tr>

</table>
<div id="dv" style="display:none;width:198px;height:148px;text-align:center;">

<form action="/thinkphp/index.php/Admin/Type/modifypic" method="post" enctype="multipart/form-data" style="margin-left:60px;margin-top:50px;">
    <input type="hidden" id="hidpicpath" name="picpath" value="">
    <input type="file" name="photo"><br><br>
    <input type="submit">
</form>
</div>
</body>
<script>
    function modify1(ob){
        var picpath=$(ob).attr('picpath');
        $('#hidpicpath').attr('value',picpath);
        layer.open({
            type: 1,
            title:false,
            skin: 'layui-layer-rim',            //加上边框
            area: ['300px', '250px'],
            content: $('#dv')
        });
    }
    function modify2(ob){
        var picpath=$(ob).attr('picpath');
        $('#hidpicpath').attr('value',picpath);
        layer.open({
            type: 1,
            title:false,
            skin: 'layui-layer-rim',            //加上边框
            area: ['300px', '250px'],
            content: $('#dv')
        });
    }
    function modify3(ob){
        var picpath=$(ob).attr('picpath');
        $('#hidpicpath').attr('value',picpath);
        layer.open({
            type: 1,
            title:false,
            skin: 'layui-layer-rim',            //加上边框
            area: ['300px', '250px'],
            content: $('#dv')
        });
    }
    function modify4(ob){
        var picpath=$(ob).attr('picpath');
        $('#hidpicpath').attr('value',picpath);
        layer.open({
            type: 1,
            title:false,
            skin: 'layui-layer-rim',            //加上边框
            area: ['300px', '250px'],
            content: $('#dv')
        });
    }
    function modify5(ob){
        var picpath=$(ob).attr('picpath');
        $('#hidpicpath').attr('value',picpath);
        layer.open({
            type: 1,
            title:false,
            skin: 'layui-layer-rim',            //加上边框
            area: ['300px', '250px'],
            content: $('#dv')
        });
    }
    function modify6(ob){
        var picpath=$(ob).attr('picpath');
        $('#hidpicpath').attr('value',picpath);
        layer.open({
            type: 1,
            title:false,
            skin: 'layui-layer-rim',            //加上边框
            area: ['300px', '250px'],
            content: $('#dv')
        });
    }

</script>
</html>