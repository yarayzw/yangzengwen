<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {

        $this->display();
    }

    public function login(){

        $user = M('manager');
        $row = $user->where("mg_name = '{$_POST['user_name']}' and mg_pwd = {$_POST['user_pass']}")->find();
        if($row){
            session("mg_username",$row["mg_name"]);
            session("mg_id",$row["mg_id"]);
            $this->redirect('Finance/dial');
        }else{
            die("账号密码错误");
        }

    }

}