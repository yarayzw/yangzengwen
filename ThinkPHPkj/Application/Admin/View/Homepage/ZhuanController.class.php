<?php
/**
 * Created by PhpStorm.
 * User: psmingyu
 * Date: 2016/6/14
 * Time: 19:49
 */
namespace Home\Controller;
use Think\Controller;
class ZhuanController extends EmptyController
{
    public function index(){
        $this->display();

    }

    public function zhuanquan(){
        $prize_arr = array(
            '0' => array('id' => 1, 'min' => 1, 'max' => 29, 'prize' => '一等奖', 'v' => 1),
            '1' => array('id' => 2, 'min' => 302, 'max' => 328, 'prize' => '二等奖', 'v' => 2),
            '2' => array('id' => 3, 'min' => 242, 'max' => 268, 'prize' => '三等奖', 'v' => 30),
            '3' => array('id' => 4, 'min' => 182, 'max' => 208, 'prize' => '四等奖', 'v' => 7),
            '4' => array('id' => 5, 'min' => 122, 'max' => 148, 'prize' => '五等奖', 'v' => 10),
            '5' => array('id' => 6, 'min' => array(32, 92, 62), 'max' => array(58, 118, 88), 'prize' => '六等奖', 'v' => 45),
            '6' => array('id' => 7, 'min' => array(152, 212, 272, 332),
                'max' => array(178, 238, 298, 358), 'prize' => '七等奖', 'v' => 5)
            //min数组表示每个个奖项对应的最小角度 max表示最大角度
            //prize表示奖项内容，v表示中奖几率(若数组中七个奖项的v的总和为100，如果v的值为1，则代表中奖几率为1%，依此类推)
        );
        //函数getRand()会根据数组中设置的几率计算出符合条件的id，我们可以接着调用getRand()。
        foreach ($prize_arr as $v) {
            $arr[$v['id']] = $v['v'];
        }
//        echo "<pre>";
//        var_dump($arr);die();
        $prize_id = $this->getRand($arr); //根据概率获取奖项id
        $res = $prize_arr[$prize_id - 1]; //中奖项
        $min = $res['min'];
        $max = $res['max'];
        $luckya = count($min);

        if ($luckya>1) { //七等奖
            $i = mt_rand(0, $luckya-1);
            $data['angle'] = mt_rand($min[$i], $max[$i]);
        } else {
            $data['angle'] = mt_rand($min, $max); //随机生成一个角度
        }

        $data['prize'] = $res['prize'];
        $data['angle']=20;
        $data['prize']="特等奖";
        echo json_encode($data);
    }

    function getRand($proArr) {
        $data = '';
        $proSum = array_sum($proArr); //概率数组的总概率精度
        foreach ($proArr as $k => $v) { //概率数组循环
            $randNum = mt_rand(1, $proSum);
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