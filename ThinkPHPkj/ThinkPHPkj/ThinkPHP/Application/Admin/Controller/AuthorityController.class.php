<?php
/**
 * Created by PhpStorm.
 * User: psmingyu
 * Date: 2016/6/30
 * Time: 0:37
 */
namespace Admin\Controller;
use Common\Controller\PermissionController;
use Think\Controller;

class AuthorityController extends PermissionController {
    public function auth(){
        $role=M('Role');
        if(I('information')){
            $rolename=I('information');
            $arr['rolename']=array('like',"%$rolename%");
            $result=$role->where($arr)->select();
        }else{
            $result=$role->select();
        }

        $this->assign('result',$result);
        $this->display();
    }
    public function autheditor(){
        $roleid=I('get.roleid');
        $roleauthids=I('get.roleauthids');
        $rolename=I('get.rolename');
        $roleauthids=explode(',',$roleauthids);
        $roleauthids=array_filter($roleauthids);
        $auth=M('Auth');
        $authp=$auth->where(array('authlevel'=>0))->select();
        $auths=$auth->where(array('authlevel'=>1))->select();
        $this->assign('roleid',$roleid);
        $this->assign('rolename',$rolename);
        $this->assign('roleauthids',$roleauthids);
        $this->assign('authp',$authp);
        $this->assign('auths',$auths);
        $this->display();
    }
    public function authaction(){
        $roleid['roleid']=I('post.roleid');
        $authname=I('post.authname');
        $roleauthids=implode(',',$authname);
        $auth=M('Auth')->select($roleauthids);
        $roleauthac='';
        foreach($auth as $v)
        {
            if(!empty($v['authc']) && !empty($v['autha']))
            {
                $roleauthac.= $v['authc'].'/'.$v['autha'].',';
            }

        }
        $roleauthac=rtrim($roleauthac,',');
        $date['roleauthac']=$roleauthac;
        $date['roleauthids']=implode(',',$authname).',';
        $m=M('Role');
        $res=$m->where($roleid)->save($date);
        if($res){
            $this->redirect('auth','修改成功');
        }else{
            $this->error('修改失败');
        }
    }
    public function addrole(){
        $data['rolename']=I('post.rolename');
        $m=M('Role');
        $res=$m->add($data);
        if($res){
            $this->redirect('autheditor',array('roleid'=>$res,'rolename'=>$data['rolename']));
        }else{
            $this->error('添加失败');
        }
    }
    public function authority(){
        $m=M('Auth');
        $authp=$m->where(array('authlevel'=>0))->select();
        $auths=$m->where(array('authlevel'=>1))->select();
        foreach($auths as $k=>$v){
            $auths[$k]['authname']='-------'.$v['authname'];
        }
       $this->assign('authp',$authp);
       $this->assign('auths',$auths);
       $this->display();
    }
}