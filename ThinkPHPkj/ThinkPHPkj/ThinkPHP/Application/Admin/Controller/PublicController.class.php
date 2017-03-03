<?php
/**
 * Created by PhpStorm.
 * User: psmingyu
 * Date: 2016/6/14
 * Time: 19:49
 */
namespace Admin\Controller;

use Think\Controller;
class PublicController extends Controller{
    public function __construct()
    {
        parent::__construct();
        header("Content-type:text/html;charset=utf-8");
    }

    public function _empty($name)
    {
        echo "$name 方法不存在";
    }
}