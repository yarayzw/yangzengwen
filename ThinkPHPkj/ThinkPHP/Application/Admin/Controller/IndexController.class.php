<?php
namespace Admin\Controller;
use Common\Controller\PermissionController;
use Think\Controller;

class IndexController extends PermissionController {


    public function index(){
        /*$error=isset($_GET['error']);
        $this->assign('error',$error);*/

        if(I('get.error')){
            $error=I('get.error');
            $this->assign('error',$error);
            $this->display();
        }else{
            $this->display();
        }

    }
    public function LoginAction(){
        $code=I('post.code');
        $username=I('post.username');
        $password=I('post.pwd');

        if(!check_verify($code)){
            $this->redirect('index',array('error'=>1));
        }
        $m=M('Buser');

        $userData=$m->where("username='$username'")->find();
        if(!$userData){
            $this->redirect('index',array('error'=>2));
        }
        if($userData['password']!=$password){
            $this->redirect('index',array('error'=>3));
        }
        if($userData['state']==2){
            $this->redirect('index',array('error'=>4));
        }
        session('name',$userData['name']);
        session('id',$userData['id']);
        session('state',$userData['state']);

        $this->redirect('home');

    }
    public function code(){
        $Verify = new \Think\Verify();
        $Verify->fontSize = 12;
        $Verify->length   = 4;
        $Verify->useImgBg = false;
        $Verify->useCurve = false;
        $Verify->useNoise = false;
        $Verify->entry();
    }
    public function home(){
        $this->display();
    }
    public function top(){
        $this->display();
    }
    public function left(){
        $name= session('name');
        $id['id']=session('id');
        $m=M('Buser');
        $result=$m->where($id)->find();
        $rolemsg=$m->table('think_role')->where('roleid='.$result['roleid'])->find();
        $role_name=$rolemsg['rolename'];
        $role_auth_ids=$rolemsg['roleauthids'];
        if($role_auth_ids){
            $map['authid']=array('in',$role_auth_ids);
        }
        $map['authlevel']='0';
        $authp=$m->table('think_auth')->where($map)->select();
        if($role_auth_ids){
            $map['authid']=array('in',$role_auth_ids);
        }
        $map['authlevel']='1';
        $auths=$m->table('think_auth')->where($map)->select();
        $this->assign('auths',$auths);
        $this->assign('authp',$authp);
        $this->assign('name',$name);
        $this->assign('role_state',$role_name);
        $this->display();

    }
    public function swich(){
        $this->display();
    }
    public function bottom(){
        $this->display();
    }
    public function homepage(){
        $this->display();
    }
    Public function logout(){
        session(null);
        $this->redirect('Index/index');
    }

}