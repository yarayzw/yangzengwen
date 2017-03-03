<?php
/**
 * Created by PhpStorm.
 * User: coder shank
 * Date: 2016/6/17 22:39
 */
namespace Admin\Controller;
use Common\Controller\PermissionController;
use Think\Controller;
use Think\Page;
class UserController extends PermissionController{
    public function addUser(){
            $arr['username']=I('post.username');
            $arr['password']=I('post.pwd');
            $arr['name']=I('post.name');
            $arr['sex']=I('post.sex');
            $arr['tel']=I('post.tel');
            $arr['addtime']=date("Y-m-d H:i:s");
            $arr['roleid']=I('post.roleid');
            $Buser=M('Buser');

            $res=$Buser->add($arr);
            if($res){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }
    public function delUser(){
        $Buser=M('Buser');
        $res=$Buser->delete($_GET['id']);
        if($res){
            $this->success();
        }else{
            $this->error();
        }
    }
    public function mdfUser(){
        $data['id']=$_GET['id'];
        $m=M('Buser');
        $res=$m->where($data)->field('state')->find();
        if($res['state']==1){
            $arr['state']=2;
            $m->where($data)->save($arr);
        }
        if($res['state']==2){
            $arr['state']=1;
            $m->where($data)->save($arr);
        }
        if($res){
            $this->success();
        }else{
            $this->error();
        }
    }
    public function inpectUser(){
        $a = I('post.buser');
        $Buser=M('Buser');
        $arr=array('username'=>$a);
        $res=$Buser->where($arr)->select();
        if($res){
            $data=1;
            echo json_encode($data);
        }else{
            $data=2;
            echo json_encode($data);
        }
    }
    public function pageUser(){
        $role=M('role');
        $result=$role->field('roleid,rolename')->select();
        $this->assign('result',$result);
        $states=array(2=>"普通管理员",1=>"超级管理员");
        $sex=array('女','男');
        $Buser=M('Buser');
        if(IS_POST){
            $inpect=I('post.userInformation');
            $arr['name']=array('like',"%$inpect%");
            $count=$Buser->where($arr)->count();
        }else{
            $count=$Buser->count();
        }
        $page=new \Think\Page($count,2);
        $page->setConfig('header','<li class="rows"><b>共%TOTAL_ROW%</b>&nbsp;第<b>%NOW_PAGE%</b>共<b>%TOTAL_PAGE%</b>页</li>');
        $page->setConfig('prev','<<');
        $page->setConfig('next','>>');
        $page->setConfig('last','末页');
        $page->setConfig('first','首页');
        $page->setConfig('theme','%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $show=$page->show();
        $page->lastSuffix=false;
        $list=$Buser->where($arr)->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('page',$show);
        $this->assign('states',$states);
        $this->assign('sex',$sex);
        $this->assign('res',$list);
        $this->display();
    }
    public function preuser(){
        $m=M('User');
        if(IS_POST){
            $inpect=I('post.userInformation');
            $arr['name']=array('like',"%$inpect%");
            $count=$m->where($arr)->count();
        }else{
            $count=$m->count();
        }
        $page=new \Think\Page($count,5);
        $page->setConfig('header','<li class="rows"><b>共%TOTAL_ROW%</b>&nbsp;第<b>%NOW_PAGE%</b>共<b>%TOTAL_PAGE%</b>页</li>');
        $page->setConfig('prev','<<');
        $page->setConfig('next','>>');
        $page->setConfig('last','末页');
        $page->setConfig('first','首页');
        $page->setConfig('theme','%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $show=$page->show();
        $page->lastSuffix=false;
        $list=$m->where($arr)->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->display();
    }
    public function mdfstatus(){
        $id=I('post.uid');
        $data['status']=I('post.status');
        if($data['status']==1){
            $vip=M('Vip');
            $res=$vip->where('uid='.$id)->find();
            if($res){
                $data['status']=2;
            }else{
                $data['status']=1;
            }
        }
        $m=M('User');
        $m->where('id='.$id)->save($data);
        $this->redirect('preuser');
    }
}
