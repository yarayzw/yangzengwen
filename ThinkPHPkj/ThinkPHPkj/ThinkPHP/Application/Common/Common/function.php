<?php
/**
 * Created by coder meng.
 * User: coder meng
 * Date: 2016/6/14 10:37
 */
header("Content-type:text/html;charset=utf-8");
// 检测输入的验证码是否正确，$code为用户输入的验证码字符串
function check_verify($code, $id = '')
{
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}