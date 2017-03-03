<?php
//会员控制器
namespace Admin\Controller;
use Think\Controller;
class FinanceController extends Controller
{


    public function __construct()
    {
        parent::__construct();

    }
    /**
     *
     * 转盘抽奖功能后台管理
     *
     * */

    /**
     * 调用页面
     * */
    public function dial(){
        $this->display();
    }

    /**
     * 奖品列表AJAX获取
     * */
    public function dialListAjax(){
        $financeM = new \Admin\Model\FinanceModel();
        $row = $financeM->dialListAjax($_POST);
        $data['total'] = count($row);
        $data['rows'] = $row;
        echo json_encode($data);
    }

    /**
     * 获取指定获奖人列表
     * */
    public function assignPrizeListAjax(){
        $financeM = new \Admin\Model\FinanceModel();
        $row = $financeM->assignPrizeListAjax($_POST);
        $data['total'] = count($row);
        $data['rows'] = $row;
        echo json_encode($data);
    }

    /**
     * 添加指定人页面
     * */
    public function addAssign(){
        $this->display();
    }

    public function userList(){
        $this->display();
    }

    /**
     * 渲染保存页面
     * */
    public function saveAssign(){
        $financeM = new \Admin\Model\FinanceModel();
        $row = $financeM->getAssignInfo();
        $this->assign("user",$row['user']);
        $this->assign("prize",$row['prize']);
        $this->display();
    }

    /**
     * 确认添加指定人获奖
     * */
    public function saveAssignSure(){
//        var_dump($_POST);die();
        $financeM = new \Admin\Model\FinanceModel();
        if(S('assign_user')&&S('assign_prize')){
            $row['user'] = S('assign_user');
            $row['prize'] = S('assign_prize');
            if($_POST['dial_id']==$row['prize']['id']&&$_POST['user_id']==$row['user']['user_id']){
                $row = $financeM->saveAssignSure($row['user'],$row['prize']);
                if($row ===false){
                    $data['code'] = 400;
                    $data['message'] = '添加失败！';
                    echo json_encode($data);
                    die();
                }else{
                    $data['code'] = 200;
                    $data['message'] = '添加成功！';
                    echo json_encode($data);
                    die();
                }
            }
        }
        //如果缓存读取数据流程未结束进入读库操作
        $row=$financeM->getAssignInfo($_POST['user_id'],$_POST['dial_id']);
        $row = $financeM->saveAssignSure($row['user'],$row['prize']);
        if($row ===false){
            $data['code'] = 400;
            $data['message'] = '添加失败！';
            echo json_encode($data);
            die();
        }else{
            $data['code'] = 200;
            $data['message'] = '添加成功！';
            echo json_encode($data);
            die();
        }
    }

    /**
     * 删除指定获奖
     * */
    public function deleteUserSure(){
        $id = trim($_POST['id']);
        $financeM = new \Admin\Model\FinanceModel();
        $row = $financeM->deleteUserSure($id);
        if($row ===false){
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
     * 编辑奖品页面
     * */
    public function updateDial(){
        $id = trim($_GET['id']);
        $dial = M('dial');
        $row = $dial->where("id = $id")->find();
        $this->assign('dial',$row);
        $this->display();
    }

    /**
     * 判断提交信息
     * */
    public function verify(){
        if(empty($_POST['prize_name'])||empty($_POST['probability'])){
            $data['code'] = 400;
            $data['message'] = '请完善数据！';
            echo json_encode($data);
            die();
        }

        $temp = explode ( '.', $_POST['probability'] );
        if (sizeof ( $temp ) > 1) {
            $decimal = end ( $temp );
            $count = strlen ( $decimal );
        }
        if($count>2){
            $data['code'] = 400;
            $data['message'] = '获奖概率最多两位小数！';
            echo json_encode($data);
            die();
        }
        if($_POST['probability']<=0){
            $data['code'] = 400;
            $data['message'] = '获奖概率需大于零！';
            echo json_encode($data);
            die();
        }
        $data['code'] = 200;
        echo json_encode($data);
        die();
    }

    /**
     * 确认修改
     * */
    public function updateDialSure(){
        $data['prize_name'] = trim($_POST['prize_name']);
        $data['probability'] = trim($_POST['probability']);
        $id = trim($_POST['id']);
        $dial = M('dial');
        $row =$dial->where("id = $id")->save($data);
        if($row ===false){
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
     *调用获奖信息页
     * */
    public function prizeInfo(){
        $this->display();
    }

    /**
     * 获奖信息AJAX
     * */
    public function prizeInfoAjax(){
        $financeM = new \Admin\Model\FinanceModel();
        $row = $financeM->prizeInfoAjax();
        $data['total'] = count($row);
        $data['rows'] = $row;
        echo json_encode($data);
    }






    /**
     *会员列表AJAX
     * */
    public function userListAjax(){
        $financeM = new \Admin\Model\FinanceModel();
        $row = $financeM->userList($_POST);
        $data['total'] = count($row);
        $data['rows'] = $row;
        echo json_encode($data);
    }






}

?>