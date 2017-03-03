<?php // 本类由系统自动生成，仅供测试用途 namespace Home\Controller; use Think\Controller;
namespace Home\Controller;

use Think\Controller;

class HomepageController extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $this->display();
    }

    /**
     * 获取抽奖信息
     * */
    public function getDial(){
        $dial = M('dial');
        $assign = M('assign_prize');
        $prizeinfo = M('prizeinfo');
        //首先判断该用户是否有指定奖品，如果有，则选中，并且更新数据库
        $user_id = trim($_SESSION['user']['user_id']);
        $row_assign = $assign->where("user_id = $user_id and is_del=1 and prize_num > 0")->select();
        if($row_assign!==false){
            $time = time();
            //遍历所有添加的指定中奖
            for($i=0;$i<count($row_assign);$i++){
                //判断本次中间间隔是否到期，若没有到期则随机抽取
                $interval_time=$row_assign[$i]['update_time']+$row_assign[$i]['interval_time']*3600*24;
                if($interval_time<$time){
                    $k = array_rand($row_assign);
                    $assign_one = $row_assign[$k];
                    $data['prize_num'] = $assign_one['prize_num']-1;
                    $data['update_time'] = time();
                    $row_update_assign = $assign->where("id = {$assign_one['id']}")->save($data);
                    if($row_update_assign===false){
                        die("操作失败");
                    }
                    //添加一条获奖信息
                    $data_add['dial_id']=$assign_one['dial_id'];
                    $data_add['dial_name']=$assign_one['dial_name'];
                    $data_add['user_id']=$user_id;
                    $data_add['user_name']=trim($_SESSION['user']['username']);
                    $data_add['creat_time']=time();
                    $row_add = $prizeinfo->add($data_add);
                    if($row_add===false){
                        die("操作失败");
                    }
                    if($assign_one){
                        $row_dial = $dial->where("id ={$assign_one['dial_id']}")->find();//奖品设置
                        $min = $row_dial['min'];
                        $max = $row_dial['max'];
                        $data['angle'] = mt_rand($min, $max);
                        $data['prize'] = $row_dial['prize_name'];
                        echo json_encode($data);
                        die();
                    }
                }
            }
        }

        //该用户没有被指定奖品，获取数据库设置奖品信息，随机抽取
        $row_dial = $dial->where('is_del =1')->select();//奖品设置
        foreach ($row_dial as $v) {
            $arr[$v['id']] = $v['probability'];
        }
        $prize_id = $this->getRand($arr);
        $res = $row_dial[$prize_id - 1];
        $min = $res['min'];
        $max = $res['max'];
        $data['angle'] = mt_rand($min, $max);
        $data['prize'] = $res['prize_name'];
        echo json_encode($data);
    }

    function getRand($proArr) {
        $data = '';
        $proSum = array_sum($proArr);
        foreach ($proArr as $k => $v) {
            $randNum = mt_rand(0, $proSum);

            if ($randNum <= $v) {
                $data = $k;
                break;
            } else {
                $proSum -= $v;
            }
        }
        unset($proArr);
        return $data;
    }

}
