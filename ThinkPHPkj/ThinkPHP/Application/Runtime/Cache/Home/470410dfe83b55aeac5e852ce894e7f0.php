<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="/thinkphp/Public/Home/js/jquery-1.11.3.js"></script>
    <script src="/thinkphp/Public/Home/js/layer.js"></script>
    <title>Title</title>
    <style>
        ul{list-style:none;}
        body a{text-decoration:none; color:#333}
    </style>
</head>
<body>
<div style="width:450px;height:200px;">
    <ul>
        <?php if(is_array($arr)): foreach($arr as $key=>$vo): ?><li style="float:left;width:100px;height:50px;border:1px #227DC5 solid;margin-left:20px;margin-top:10px;">
                <a myselfid="<?php echo ($vo["id"]); ?>" onclick="addfriend(this)" href="javascript:void(0)">
                    <img width="50px" height="50px" src="/thinkphp/Public/Uploads/<?php echo ($vo["headphoto"]); ?>">
                    <span style="position:relative;top:-30px;"><?php echo ($vo["name"]); ?></span>
                    <span style="position:relative;left:50px;top:-25px;font-size:12px; "><img src="/thinkphp/Public/Uploads/addfriend.jpg"><span style="position:relative;top:-5px;color:#8F8F8F;">好友</span></span>
                </a>
            </li><?php endforeach; endif; ?>
    </ul>
</div>
</body>
</html>
<script>
    function addfriend(ob){
        var id=$(ob).attr('myselfid');
        layer.msg('已添加好友');
        $.post('/thinkphp/index.php/Home/Home/addfriend',{id:id});
    }
</script>