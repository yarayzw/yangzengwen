<?php /* Smarty version Smarty-3.1.6, created on 2017-03-01 16:23:31
         compiled from "./Application/Home/View\Index\index.html" */ ?>
<?php /*%%SmartyHeaderCode:1368458b684bd382469-10948255%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8378b70862d866fede2c1372bd9cfe4821690da8' => 
    array (
      0 => './Application/Home/View\\Index\\index.html',
      1 => 1488356606,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1368458b684bd382469-10948255',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_58b684bd3c4af',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b684bd3c4af')) {function content_58b684bd3c4af($_smarty_tpl) {?><form action="<?php echo @__MODULE__;?>
/Index/login" method="post">
    账号: <input type="text" name="user_name">
    密码：<input type="password" name="user_pass">
    <input type="submit">
</form><?php }} ?>