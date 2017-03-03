<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>主要内容区main</title>
    <style>
        ul li{list-style: none;}
    </style>

</head>
<body>
<!--main_top-->


       您的位置：修改<span style="color:red;"><?php echo ($rolename); ?></span>的权限


    <form method="post" action="/thinkphp/index.php/Admin/Authority/authaction">
        <ul>
            <?php if(is_array($authp)): foreach($authp as $key=>$fo): ?><li>
                <input type="checkbox" name="authname[]" <?php if(in_array($fo['authid'],$roleauthids)): ?>checked='checked'<?php endif; ?> value="<?php echo ($fo["authid"]); ?>"><?php echo ($fo["authname"]); ?>
            </li>
                <?php if(is_array($auths)): foreach($auths as $key=>$foo): ?><ul>

                    <?php if($foo['authpid'] == $fo['authid']): ?><li><input type="checkbox" name="authname[]" <?php if(in_array($foo['authid'],$roleauthids)): ?>checked='checked'<?php endif; ?> value="<?php echo ($foo["authid"]); ?>"><?php echo ($foo["authname"]); ?></li><?php endif; ?>

                </ul><?php endforeach; endif; endforeach; endif; ?>
        </ul>
        <input type="hidden" value="<?php echo ($roleid); ?>" name="roleid"/>
        <input type="submit" value="修改">
        </form>



</body>
<script>

</script>
</html>