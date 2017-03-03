<?php
/**
 * Created by coder shank.
 * User: coder shank
 * Date: 2016/6/22 19:33
 */
namespace Common\Controller;
use Admin\Controller\EmptyController;
use Admin\Controller\INdexController;

class  PermissionController extends EmptyController {

    public function __construct(){
    parent::__construct();
        $now_ac=CONTROLLER_NAME.'/'.ACTION_NAME;
        $userid=session('id');
        if($userid){
            $m=M('Buser');
            $res=$m->join("think_role ON think_role.roleid=think_buser.roleid and think_buser.id=$userid")->find();
            $allow_ac=array('Index/index','Index/code','Index/logout','Index/home','Index/homepage','Index/left','Index/top','Index/bottom','Index/swich');
            if(!in_array($now_ac,$allow_ac) && !$res['roleauthac']=='' && strpos($res['roleauthac'],$now_ac)===false){
                $this->error('无权限访问',U('Index/index'));
            }
        }
        $allow_a=array('Index/index','Index/code','Index/loginAction','Index/logout');
        if(session('id')=='' && !in_array($now_ac,$allow_a)){
            $this->error('无权限访问',U('Index/index'));
        }

    }
}
