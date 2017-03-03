<?php
/**
 * Created by PhpStorm.
 * User: psmingyu
 * Date: 2016/6/29
 * Time: 21:29
 */
namespace Admin\Controller;
use Common\Controller\PermissionController;
use Think\Controller;

class MessageController extends PermissionController{
    public function daily(){
        $m=M('Daily');
        if(IS_POST){
            $arr['id']=I('post.userInformation');
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
    public function message(){
        $m=M('Message');
        if(IS_POST){
            $arr['id']=I('post.userInformation');
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
    public function mood(){
        $m=M('Mood');
        if(IS_POST){
            $arr['id']=I('post.userInformation');
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
    public function photo(){
        $m=M('Photo');
        if(IS_POST){
            $arr['id']=I('post.userInformation');
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

}