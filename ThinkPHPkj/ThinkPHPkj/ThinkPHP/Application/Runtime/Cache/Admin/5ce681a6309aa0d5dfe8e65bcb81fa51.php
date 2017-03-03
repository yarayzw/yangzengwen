<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
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
    <style>
        *{
            margin-left: 5px;
            margin-top: 3px;
        }
    </style>
    <!--添加类别-->
    <div id="addNewcategorid" style="display: none;" align="center">
        <table align="center" style="text-align: center">
            <form action="/thinkphp/index.php/Admin/Type/addNewcategory" method="post" onsubmit="return checknewSubmit()">
                <tr>
                    <td>请选择类别</td>
                    <td><select class="text-word" name="addcatagory" id="addcatagory" style="position: relative; width:100px;height: 25px;" >
                    <option value="0">--请选择--</option>
                    <?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cate_id"]); ?>" ><?php echo ($vo["categoryname"]); ?> </option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><span id="saddcatagory" style="color: red"></span></td>
                </tr>
                <tr>
                    <td>请输入新类别名称</td>
                    <td><input type="text" name="newcate" id="newcate"/></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><span id="snewcate" style="color: red"></span></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="提交" />&nbsp;&nbsp;&nbsp;
                        <input type="reset" value="重置" />
                    </td>
                </tr>
            </form>
        </table>
    </div>



    <!--添加讯息-->
    <div id="addNewsid" style="display: none;" align="center">
        <table  align="center" style="text-align: center">
            <form action="/thinkphp/index.php/Admin/Type/addNews" method="post" enctype="multipart/form-data" onsubmit="return checkSubmit()">
                <tr>
                    <td align="right">讯息类别：</td>
                    <td><select class="text-word" name="catagory" id="catagory" style="position: relative; width:100px;height: 25px;" >
                        <option value="0">--请选择--</option>
                        <?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["pid"] == 0)): ?><option value="<?php echo ($vo["cate_id"]); ?>" disabled><?php echo ($vo["categoryname"]); ?> </option>
                                <?php else: ?>
                                <option value="<?php echo ($vo["cate_id"]); ?>" ><?php echo ($vo["categoryname"]); ?> </option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </select></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><span id="scatagory" style="color: red"></span></td>
                </tr>
                <tr>
                    <td align="right">标题：</td>
                    <td><input type="text" name="title" id="title" placeholder="请输入标题"/></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><span id="stitle" style="color: red"></span></td>
                </tr>
                <tr>
                    <td align="right">图片：</td>
                    <td><input type="file" name="photo"></td>
                </tr>
                <tr>
                    <td align="right">内容：</td>
                    <td>
                        <textarea style="margin:3px 0px 0px 5px;height:135px;width:176px;" name="content" id="content" placeholder="请输入内容"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><span id="scontent" style="color: red"></span></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="subnews" value="发布"/>&nbsp;&nbsp;&nbsp;
                        <input type="reset" name="renew" value="重置"/>
                    </td>
                </tr>
            </form>
        </table>
    </div>


</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
    <tr>
        <td width="99%" align="left" valign="top">您的位置：资讯管理</td>
    </tr>
    <tr>
        <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
                <tr>
                    <td width="76%" align="left" valign="middle">
                        <form method="post" action="/thinkphp/index.php/Admin/Type/selectNewcategory" width="1400px">
                            <span>管理员：</span>
                            <select class="text-word" name="catagory" style="position: relative; width:120px;height: 35px">
                                <option value="">--请选择--</option>
                                <?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["pid"] == 0)): ?><option value="<?php echo ($vo["cate_id"]); ?>" disabled><?php echo ($vo["categoryname"]); ?> </option>
                                    <?php else: ?>
                                    <option value="<?php echo ($vo["cate_id"]); ?>" ><?php echo ($vo["categoryname"]); ?> </option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            <input name="" type="submit" value="查询" class="text-but">
                        </form>
                    </td>
                    <td width="12%" align="center" valign="middle" style="text-align:right; width:200px;"><a href="#" id="addNews" onFocus="this.blur()" class="add">发布信息</a></td>

                    <td width="12%" align="center" valign="middle" style="text-align:right; width:200px;"><a href="#" id="addNewcategory" onFocus="this.blur()" class="add">添加分类</a></td>


                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
                <tr>
                    <th align="center" valign="middle" class="borderright">编号</th>
                    <th align="center" valign="middle" class="borderright">发布者</th>
                    <th align="center" valign="middle" class="borderright">类别</th>
                    <th align="center" valign="middle" class="borderright">标题</th>
                    <th align="center" valign="middle" class="borderright">图片</th>
                    <th align="center" valign="middle" class="borderright">内容</th>
                    <th align="center" valign="middle" class="borderright">创建时间</th>
                </tr>
                <?php if(is_array($ren)): $i = 0; $__LIST__ = $ren;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['news_id']); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['name']); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['categoryname']); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['title']); ?></td>
                        <td align='center' valign='middle' class='borderright'>
                            <?php if($row["picpath"] == 1): ?>无<?php endif; ?>
                            <?php if($row["picpath"] != 1): ?><img width="30" height="30" src="/thinkphp/Public/Uploads/<?php echo ($row["picpath"]); ?>"><?php endif; ?>
                        </td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['content']); ?></td>
                        <td align='center' valign='middle' class='borderright'><?php echo ($row['news_addtime']); ?></td>
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
    //判断选择框是否为空
    $('#catagory').blur(function(){
       var cata =$('#catagory').val();
        if(cata==0){
            $('#scatagory').html("请选择发布类别");
        }else{
            $('#scatagory').html("");
        }
    });
    //判断标题框是否为空
    $('#title').blur(function(){
        var tit =$('#title').val();
        if(tit==''){
            $('#stitle').html("请填写标题");
        }
    });
    $('#title').focus(function(){
        $('#stitle').html("");
    });

    //判断内容框是否为空
    $('#content').blur(function(){
        var con =$('#content').val();
        if(con==''){
            $('#scontent').html("请填写内容");
        }
    });
    $('#content').focus(function(){
        $('#scontent').html("");
    });

    //提交判断
    function checkSubmit(){

        //防止直接提交
        var cata =$('#catagory').val();
        if(cata==0){
            $('#scatagory').html("请选择发布类别");
        }
        var tit =$('#title').val();
        if(tit==''){
            $('#stitle').html("请填写标题");
        }
        var con =$('#content').val();
        if(con==''){
            $('#scontent').html("请填写内容");
        }

        //只要有错误提示就不能提交
        var errorLength= new Array($('#scatagory').text().length,
                $('#stitle').text().length,
                $('#scontent').text().length
        );
        var count=0;
        for(var i=0;i<errorLength.length;i++){
            count=count+errorLength[i];
        }
        if(count>0){
            return false;
        }
    }
    //弹出框加载
    $("#addNews").click(function () {

        layer.open({
            type: 1,
            skin: 'layui-layer-rim',            //加上边框
            area: ['500px', '380px'],
            content: $('#addNewsid')
        })
    });


    //添加分类
    $("#addNewcategory").click(function () {

        layer.open({
            type: 1,
            skin: 'layui-layer-rim',            //加上边框
            area: ['500px', '380px'],
            content: $('#addNewcategorid')
        })
    });


    $("#addcatagory").blur(function(){
        var text_addcatagory = $('#addcatagory').val();
        if(text_addcatagory==0){
            $('#saddcatagory').html('请选择所属类别');
        }else{
            $('#saddcatagory').html('');
        }
    });
    $('#newcate').blur(function(){
        var text_cate=$('#newcate').val();
        if(text_cate==''){
            $('#snewcate').html('新类别不允许为空');
        }
    });
    $('#newcate').focus(function(){
        $('#snewcate').html('');
    });

    function checknewSubmit(){
        var text_addcatagory = $('#addcatagory').val();
        if(text_addcatagory==0) {
            $('#saddcatagory').html('请选择所属类别');
        }
        var text_cate=$('#newcate').val();
        if(text_cate==''){
            $('#snewcate').html('新类别不允许为空');
        }
        var errLength=$('#saddcatagory').text().length+$('#snewcate').text().length;
        if(errLength!=0){
            return false;
        }
    }


</script>
</html>