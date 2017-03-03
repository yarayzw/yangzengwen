<?php
/**
 * Created by PhpStorm.
 * User: psmingyu
 * Date: 2016/6/14
 * Time: 19:49
 */
namespace Home\Controller;
use Think\Controller;
class EmptyController extends PublicController
{
    public function index(){
        echo  CONTROLLER_NAME."控制器不存在";

    }

}