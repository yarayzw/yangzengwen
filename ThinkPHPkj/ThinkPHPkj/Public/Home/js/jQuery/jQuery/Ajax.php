<?php
header("content-type:text/html;charset=utf-8");
/*mysql_connect("localhost","root",'root');
mysql_select_db("think");
mysql_query("set names utf8");
$res = mysql_query("select * from p2_lucky");
$luckycount = mysql_num_rows($res);
while ($rout=mysql_fetch_assoc($res)) {
    $prize_arr [] = $rout;
};

for($i =0;$i <7;$i ++){
    $prize_arr[$i]['min'] = explode(',', $prize_arr[$i]['min']);
    $prize_arr[$i]['max'] = explode(',', $prize_arr[$i]['max']);
};*/
//var_dump(233);die();
//$row =array(
//    'yi'=> 5,
//    'er'=> 10,
//    'san'=> 10,
//    'si'=> 15,
//    'wu'=> 25,
//    'liu'=> 35,
//);
//$row['yi'] = $row['yi']/100*3600;
//$row['er'] = $row['er']/100*3600;
//$row['san'] = $row['san']/100*3600;
//$row['si'] = $row['si']/100*3600;
//$row['wu'] = $row['wu']/100*3600;
//$row['liu'] = $row['liu']/100*3600;
//echo "<pre>";
//var_dump($row);die();
 $prize_arr = array( 
    '0' => array('id' => 1, 'min' => 1, 'max' => 51.43, 'prize' => '未中奖', 'v' => 1),
    '1' => array('id' => 2, 'min' => 51.43, 'max' => 102.86, 'prize' => '提高白条额度', 'v' => 1),
    '2' => array('id' => 3, 'min' => 102.86, 'max' => 154.29, 'prize' => '免分期服务费', 'v' => 1),
    '3' => array('id' => 4, 'min' => 154.29, 'max' => 205.72, 'prize' => '免单5元', 'v' => 1),
    '4' => array('id' => 5, 'min' => 205.72, 'max' => 257.15, 'prize' => '免单10元', 'v' => 50),
     '5' => array('id' => 6, 'min' => 257.15, 'max' => 308.58, 'prize' => '免单50元', 'v' => 45),
     '6' => array('id' => 7, 'min' => 308.58, 'max' => 360, 'prize' => '免单4999元', 'v' => 1),
     //min数组表示每个个奖项对应的最小角度 max表示最大角度
    //prize表示奖项内容，v表示中奖几率(若数组中七个奖项的v的总和为100，如果v的值为1，则代表中奖几率为1%，依此类推) 
 );

//中奖概率方法我们之前在jQuery砸金蛋_PHP砸金蛋讲过，代码如下
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
//函数getRand()会根据数组中设置的几率计算出符合条件的id，我们可以接着调用getRand()。
foreach ($prize_arr as $v) { 
    $arr[$v['id']] = $v['v']; 
}
//echo "<pre>";
//var_dump($arr);die();
$prize_id = getRand($arr); //根据概率获取奖项id  
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
//$data['angle']=20;
//$data['prize']="特等奖";
echo json_encode($data);
?>
