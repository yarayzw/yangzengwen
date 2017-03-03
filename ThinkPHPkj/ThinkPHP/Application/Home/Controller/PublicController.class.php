<?php
/**
 * Created by PhpStorm.
 * User: psmingyu
 * Date: 2016/6/14
 * Time: 19:49
 */
namespace Home\Controller;

use Think\Controller;
class PublicController extends Controller{
    public function __construct()
    {
        parent::__construct();
        header("Content-type:text/html;charset=utf-8");
        $now_ac=CONTROLLER_NAME.'/'.ACTION_NAME;
        $allow_a=array('Index/index','Index/code','Index/LoginAction','Index/register','Index/registerAction','Index/writeMessage','Index/getpassword','Index/reseting');
        if(session('id')==''&& !in_array($now_ac,$allow_a)){
            $this->error('无权限访问',U('Index/index'));
        }


    }

    public function _empty($name)
    {
        echo "$name 方法不存在";
    }
}