<?php
/**
 * Created by coder shank.
 * User: coder shank
 * Date: 2016/6/20 17:20
 */

namespace Admin\Controller;
use Common\Controller\PermissionController;
use Think\Controller;

class TypeController extends PermissionController{

    public function selectNewcategory(){
        $News=M('News');
        $Newcategory=M('Newcategory');
        $sql="select * from think_newcategory order by concat(path,cate_id)";
        $res=$Newcategory->query($sql);
        $resnormal=$Newcategory->select();
        for($i=0;$i<count($res);$i++){
            $num=substr_count($res[$i]['path'],',');
            $str= str_repeat('&nbsp;&nbsp;&nbsp;',$num-1);
            $res[$i]['categoryname']=$str.$res[$i]['categoryname'];
        }
        $this->assign('resnormal',$resnormal);
        $this->assign('res',$res);
        if($_POST['catagory']){
            $catagory=array('cid'=>$_POST['catagory']);
            $count=$News->where($catagory)->count();
       }else{
            $count=$News->count();
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
        $ren=$News->join('think_buser ON think_news.uid = think_buser.id')->join('think_newcategory ON think_news.cid = think_newcategory.cate_id')->where($catagory)->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('page',$show);
        $this->assign('ren',$ren);
        $this->display();
    }
    public function addNews(){
        $where['uid']=I('session.id');
        $where['cid']=I('post.catagory');
        $where['title']=I('post.title');
        $where['content']=I('post.content');
        $where['news_addtime']=date("Y-m-d H:i:s");
        $upload=new \Think\Upload();
        $upload->maxSize=3145728 ;
        $upload->exts=array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath='./Public/Uploads/';
        $upload->saveName = time().'_'.mt_rand();
        $info   =   $upload->uploadOne($_FILES['photo']);
        $where['picpath']=$info['savepath'].$info['savename'];
        $News=M('News');
        $res=$News->add($where);
        if($res){
            $this->success('发布成功');
        }else{
            $this->error('发布失败');
        }
    }
    public function addNewcategory(){
        $id=I('post.addcatagory');
        $newcate=I('post.newcate');
        $Newcategory=M('Newcategory');
        if($id>=0){
            $res=$Newcategory->find($id);
            $array=array(
                'categoryname'=>$newcate,
                'pid'=>$id,
                'path'=>$res['path'].$res['cate_id'].','
            );
        }
        $res=$Newcategory->add($array);
        if($res){
            $this->success('发布成功');
        }else{
            $this->error('发布失败');
        }
    }
    public function advert(){
        $m=M('Advert');
        $result=$m->find();
        $this->assign('row',$result);
        $this->display();
    }
    public function modifypic(){
        $path=I('picpath');
        $upload=new \Think\Upload();
        $upload->maxSize=3145728 ;
        $upload->exts=array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath='./Public/Uploads/';
        $upload->saveName = time().'_'.mt_rand();
        $info   =   $upload->uploadOne($_FILES['photo']);
        $picpath=$info['savepath'].$info['savename'];
        $arr[$path]=$picpath;
        $arr['addtime']=date('Y-m-d H:i:s');
        $m=M('Advert');
        $res=$m->where('id=1')->save($arr);
        if($res){
            $this->success('发布成功');
        }else{
            $this->error('发布失败');
        }
    }

}