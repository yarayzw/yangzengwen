<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {

        $this->display();
    }

    public function login(){
        $user = M('user');

        $row = $user->where("username = {$_POST['user_name']} and password = {$_POST['user_pass']}")->find();
        if($row){
            session('user',$row);
            $this->redirect('Homepage/index');
        }else{
            die("账号密码错误");
        }

    }

}