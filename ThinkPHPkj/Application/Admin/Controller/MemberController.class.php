<?php
//会员控制器
namespace Admin\Controller;

use Component\AdminController;
use Component\myPublicController;

class MemberController extends AdminController
{

    public function __construct()
    {
        parent::__construct();

    }

    //会员列表展示
    public function showlist()
    {
        $member = D("Member");
        //分页类1.获得当前记录总数
        $total = $member->count();
        $per = 7;
        //2.实例化分页类对对象
        $page = new \Component\Page($total, $per);
        //3.拼接sql语句
        $sql = "select * from sw_member " . $page->limit;
        $info = $member->query($sql);
        //4.获得页码列表
        $pagelist = $page->fpage();
        //show_bug($info);

        //把数据assign给模板
        $this->assign("info", $info);
        $this->assign("pagelist", $pagelist);
        $this->display();
    }

    //添加会员
    public function add()
    {
        $member = D("Member");
        if (!empty($_POST)) {
            //判断是否有附件上传,如果有则实例化
            if (!empty($_FILES)) {
                //设置图片路径
                $config = array(
                    'rootPath' => './public/', //保存根路径
                    'savePath' => 'upload/', //保存路径
                );
                $upload = new \Think\Upload($config);
//                $upload->saveRule=$serverFileName;
                //调用uploadOne方法上传单个图片
//                var_dump($_FILES['member_big_img']);die();
                $z = $upload->uploadOne($_FILES['member_big_img']);
                if (!$z) {
                    show_bug($upload->getError());
                } else {
                    //拼接路径
                    $bigimg = $z['savepath'] . $z['savename'];
                    $_POST['member_big_img'] = $bigimg;
                }
            }
            $member->create(); //收集post表单数据
            $rst = $member->add();
            if ($rst > 0) {
                $this->success('添加会员成功', U('Member/showlist'));
            } else {
                $this->error('添加会员失败', U('Member/showlist'));
            }
        } else {
            $this->display();
        }
    }

    //修改会员
    public function update($member_id)
    {
        //在update操作方法内部有两个逻辑：展现表单、收集表单
        $member = D("Member");

        if (!empty($_POST)) {
            $member->create();
            $rst = $member->save();

            if ($rst > 0) {
                echo "<script> alert('修改会员成功') </script>";
            } else {
                echo "false";
            }

        } else {
            $info = $member->find($member_id);
            $this->assign("info", $info);
            $this->display();
        }

    }

    //删除会员
    public function delete($member_id)
    {
        $member = D("Member");
        $rs = $member->delete($member_id);
        if ($rs) {
            $this->success('删除会员成功', U('Member/showlist'));
        } else {
            $this->error('删除会员失败', U('Member/showlist'));
        }

    }

    public function getMoney()
    {
        return "1000";
    }

    /**
     * 管理员列表接口
     * */
    public function ceshi()
    {
        $this->display();
    }

    /**
     * 管理员列表
     * */
    public function userList()
    {
        $Model = new \Think\Model();
        $tableQ = C('DB_PREFIX');
        $userName = I('post.userName');
        $Q_s_time = I('post.Q_s_time');
        $Q_e_time = I('post.Q_e_time');
//          echo "<pre>";
//          var_dump($_POST);die;
        $where = "";
        if (!empty($userName)) {
            $where .= " and t.mg_name like '%$userName%'";
        }
        if (!empty($Q_s_time)) {
            $where .= " and t.mg_time <" . trim(strtotime($Q_s_time));
        }
        if (!empty($Q_e_time)) {
            $where .= " and t.mg_time >" . trim(strtotime($Q_e_time));
        }
        if (!empty($_POST['sort'])) $where .= " order by {$_POST['sort']} {$_POST['order']}";
        $sql = "select t.mg_id,t.mg_name,from_unixtime(t.mg_time,'%Y-%m-%d %H:%i:%s') as user_time,t.mg_role_id,t1.role_name
                  ,t.mg_phone
                  from {$tableQ}manager t
                  LEFT JOIN {$tableQ}role t1 ON t.mg_role_id = t1.role_id
                  WHERE (1=1) and t.mg_stute = 1 $where";
        $row = $Model->query($sql);
        $data['total'] = count($row);
        $data['rows'] = $row;
        echo json_encode($data);
    }

    /**
     * 添加管理员
     * */
    public function addAdministrator()
    {
        $option = $this->getOption();
        $this->assign('option', $option);
        $this->display();
    }

    /**
     * 确认添加
     * */
    public function addAdministratorSure()
    {
        $Model = new \Think\Model();
        $action = $_GET['action'];
        $name = trim(I('post.administrator_name'));
        $password = trim(I('post.administrator_password'));
        $position = I('post.administrator_position');
        $tel = I('post.administrator_tel');
        $time = time();
        if ($action == 'format_true') {
            $sql = "insert into sw_manager (mg_name,mg_pwd,mg_time,mg_role_id,mg_phone) VALUE ('$name','$password',$time,$position,$tel)";
            $row = $Model->query($sql);
            if ($row) {
                $data['code'] = 400;
                $data['message'] = '添加失败';
            } else {
                $data['code'] = 200;
                $data['message'] = '添加成功';
            }
            echo json_encode($data);
        } else if ($action == 'format_false') {
            if ($tel) {
                if (!preg_match("/^1[34578]{1}\d{9}$/", $tel)) {
                    $data['code'] = 400;
                    $data['message'] = '请填写正确手机号！';
                    echo json_encode($data);
                    die();
                }
            } else {
                $data['code'] = 400;
                $data['message'] = '请填写手机号！';
                echo json_encode($data);
                die();
            }
            $sql_name = "select mg_name from sw_manager WHERE mg_name = '$name'";
            $row = $Model->query($sql_name);
            if ($row) {
                $data['code'] = 400;
                $data['message'] = '该账户已存在！';
                echo json_encode($data);
                die();
            } else {
                $data['code'] = 200;
                echo json_encode($data);
            }

        } else if ($action == 'update_true') {
            $id = I('get.id');
            $sql_update = "update sw_manager set mg_phone='$tel',mg_pwd='$password' WHERE mg_id = $id";

            $row = $Model->execute($sql_update);
            $data['code'] = 200;
            $data['message'] = '修改成功！';
            echo json_encode($data);
        }
    }

    /**
     * 获得角色分类
     * */
    public function getOption()
    {
        $fenlei = M("role");
        $info = $fenlei->select();
        $option = "";
        foreach ($info as $v) {
            $option .= "<option value='{$v['role_id']}'>{$v['role_name']}</option>";
        }
        return $option;
    }

    /**
     * 修改管理员接口
     * */
    public function updateAdministrator()
    {
        $mg_id = I('get.id');
        $user = M('manager');
        $row = $user->where("mg_id = $mg_id")->find();
        $this->assign('row', $row);
        $this->display();
    }

    /**
     * 删除管理员
     * */
    public function deleteAdministratorSure()
    {
        $data['mg_stute'] = 2;
        $mg_id = I('post.id');
        $user = M('manager');
        $row = $user->where("mg_id = $mg_id")->save($data);
        if ($row) {
            $data['code'] = 200;
            $data['message'] = '删除成功！';
            echo json_encode($data);
        } else {
            $data['code'] = 400;
            $data['message'] = '删除失败！';
            echo json_encode($data);
        }
    }

    /**
     * 批量删除管理员
     * */
    public function deleteAllAdministratorSure()
    {

        $id_all = I('post.act');
        $id_str = implode(',', $id_all);
        $Model = new \Think\Model();
        $sql = "update sw_manager set mg_stute = 2 WHERE mg_id IN ({$id_str})";
//            var_dump($sql);die();
        $row = $Model->execute($sql);
        $data['code'] = 200;
        $data['message'] = '删除成功！';
        echo json_encode($data);
    }


    /**
     * 会员列表测试
     * */
    public function userceshi()
    {
        $this->display();
    }

    /**
     * 会员列表信息AJAX
     * */
    public function memberList()
    {
        $action = I('post.action');
        $userName = I('post.userName');
        $Q_s_time = I('post.Q_s_time');
        $Q_e_time = I('post.Q_e_time');
        $userOrder = I('post.userOrder');
        $userThan = I('post.userThan');
        $userThanNumber = I('post.userThanNumber');
        $member_isdel = I('post.member_isdel');
        $Model = new \Think\Model();
        $tableQ = C('DB_PREFIX');
        $where = "";
        if (!empty($userName)) {
            $where .= " and t.member_name like '%$userName%'";
        }
        if (!empty($Q_s_time)) {
            $where .= " and t.member_create_time <" . trim(strtotime($Q_s_time));
        }
        if (!empty($Q_e_time)) {
            $where .= " and t.member_create_time >" . trim(strtotime($Q_e_time));
        }
        if (!empty($userOrder)) {
            $where .= " and t.member_order = $userOrder";
        }
        if (!empty($userThan) && !empty($userThanNumber)) {
            if ($userThan == 1) {
                $where .= " and t.member_age > $userThanNumber";
            } else if ($userThan == 2) {
                $where .= " and t.member_age < $userThanNumber";
            } else if ($userThan == 3) {
                $where .= " and t.member_age = $userThanNumber";
            } else {
                $data['code'] = 400;
                $data['message'] = '数据错误！';
                echo json_encode($data);
                die();
            }
        }
        if(!empty($member_isdel)){
            $where .= " and t.member_isdel = $member_isdel";
        }else{
            $where .= " and t.member_isdel = 1";
        }
        if (!empty($_POST['sort'])) $where .= " order by {$_POST['sort']} {$_POST['order']}";
        $sql_member = "select t.member_id, t.member_name, t.member_age, t.member_introduce, from_unixtime(t.member_create_time,'%Y-%m-%d %H:%i:%s')
                            as create_time, from_unixtime(t.member_last_time,'%Y-%m-%d %H:%i:%s') as last_time, t.member_order, t.member_big_img, t.member_isdel
                            from {$tableQ}member t
                            WHERE 1=1   $where";
//        var_dump($sql_member);die();
        $row = $Model->query($sql_member);
        $data['total'] = count($row);
        $data['rows'] = $row;
        echo json_encode($data);
    }

    /**
     * 调用编辑会员信息页面
     * */
    public function updateMember()
    {
        $id = I('get.id');
        $userM = new \Model\MemberModel();
        $user = $userM->getMemberMessage($id);
        $this->assign('user', $user);
        $this->display();
    }

    /**
     * 调用会员编辑页面
     * */
    public function updateUser(){
        $id = I('get.id');
        $userM = new \Model\MemberModel();
        $user = $userM->getUserMessage($id);
        $this->assign('user', $user);
        $this->display();
    }

    /**
     * 确认会员信息编辑
     * */
    public function updateUserSure(){
        $user_id = I('post.user_id');
        $user_tel = I('post.user_tel');
        $user_email = I('post.user_email');
        if(!empty($user_tel)){
            $data['user_tel'] = $user_tel;
        }
        if(!empty($user_email)){
            $data['user_email'] = $user_email;
        }
        $userM = new \Model\MemberModel();
        $row = $userM->updateUesrMessage($user_id,$data);
        if($row===false){
            $data['code'] = 400;
            $data['message'] = '修改失败！';
            echo json_encode($data);
            die();
        }else{
            $data['code'] = 200;
            $data['message'] = '修改成功！';
            echo json_encode($data);
            die();
        }
    }

    /**
     * 确认会员信息编辑
     * */
    public function updateMemberSure()
    {
        $member_name = I('post.member_name');
        $member_age = I('post.member_age');
        $member_memo = I('post.member_memo');
        $file = $_FILES['member_pic'];
        if (!empty($file)) {
            //设置图片路径
            $config = array(
                'rootPath' => './public/', //保存根路径
                'savePath' => 'upload/', //保存路径
            );
            $upload = new \Think\Upload($config);
            //调用uploadOne方法上传单个图片
//                 $houzui=substr(strrchr($file['name'], '.'), 1);
//                 $_FILES['member_pic']['name']=date('Y-m-d')."-".$member_name.rand(1000,9999).'.'.$houzui;
            //不知道TP自带的上传方法为什么不能重命名文件，下次要引用第三方插件了
            $info = $upload->uploadOne($_FILES['member_pic']);
            if (!$info) {
                show_bug($upload->getError());
                die();
            } else {
                //拼接路径
                $data['member_big_img'] = $info['savepath'] . $info['savename'];
            }
        }

        if(!empty($member_name)){
            $data['member_name'] = $member_name;
        }
        if(!empty($member_age)){
            $data['member_age'] = $member_age;
        }
        if(!empty($member_memo)){
            $data['member_introduce'] = $member_memo;
        }
        $id = I('post.member_id');
        $userM = new \Model\MemberModel();

        $row = $userM->updateMemberMessage($id,$data);

//              $member -> create(); //收集post表单数据
//              $rst = $member->add();
        if($row===false){
            $data['code'] = 400;
            $data['message'] = '修改失败！';
            echo json_encode($data);
            die();
        }else{
            $data['code'] = 200;
            $data['message'] = '修改成功！';
            echo json_encode($data);
            die();
        }

    }

    /**
     * 删除/恢复会员信息
     * */
    public function deleteMemberSure(){
        $id = I('post.id');
        $state = I('post.state');
        $userM = new \Model\MemberModel();
        $row = $userM->deleteMemberOne($id,$state);
        if($row===false){
            $data['code'] = 400;
            $data['message'] = '删除失败！';
            if($state==1){
                $data['message'] = '恢复失败！';
            }
            echo json_encode($data);
            die();
        }else{
            $data['code'] = 200;
            $data['message'] = '删除成功！';
            if($state==1){
                $data['message'] = '恢复成功！';
            }
            echo json_encode($data);
            die();
        }

    }

    /**
     * 删除/恢复会员
     * */
    public function deleteUserSure(){
//        var_dump($_POST);die();
        $id = I('post.id');
        $state = I('post.state');
        $userM = new \Model\MemberModel();
        $row = $userM->deleteUserOne($id,$state);
        if($row===false){
            $data['code'] = 400;
            $data['message'] = '删除失败！';
            echo json_encode($data);
            die();
        }else{
            $data['code'] = 200;
            $data['message'] = '删除成功！';
            echo json_encode($data);
            die();
        }
    }


    /**
     * 批量删除
     * */
    public function deleteAllMemberSure(){
        $id_all = I('post.act');
        $id_str = implode(',', $id_all);
        $userM = new \Model\MemberModel();
        $date['member_isdel'] = 2;
        $row = $userM->deleteMemberAll($id_str,$date);
        if($row===false){
            $data['code'] = 400;
            $data['message'] = '删除失败！';
            echo json_encode($data);
            die();
        }else{
            $data['code'] = 200;
            $data['message'] = '删除成功！';
            echo json_encode($data);
            die();
        }
    }

    /**
     * 会员消费充值列表
     * */
    public function userMessage(){
        $this->display();
    }

    /**
     * 验证表单信息
     * */
    public function verify(){
        $tel = I('post.user_tel');
        if (!preg_match("/^1[34578]{1}\d{9}$/", $tel)) {
            $data['code'] = 400;
            $data['message'] = '请填写正确手机号！';
            echo json_encode($data);
            die();
        }else{
            $data['code'] = 200;
            echo json_encode($data);
            die();
        }
    }



}
?>