<?php
namespace Admin\Model;

use Think\Model;
class FinanceModel extends Model {

    public function __construct(){
        parent::__construct();
    }

    /**
     * 转盘功能model
     * */
    public function dialListAjax($data){
        $tableQ = C('DB_PREFIX');
        $where = "";
        if(!empty($data['prize_name'])){
            $where = " and prize_name like '%".trim($data['prize_name'])."%'";
        }
        if (!empty($date['sort'])){
            $where .= " order by {$date['sort']} {$date['order']}";
        }

        $sql = "select *
                from {$tableQ}dial
                WHERE 1=1 $where";
        $Model = new \Think\Model();
        $row = $Model->query($sql);
        if($row===false){
            die('数据库查询错误!');
        }else{
            return $row;
        }

    }

    /**
     * 获取指定奖品指定人列表
     * */
    public function assignPrizeListAjax($data){
        $tableQ = C('DB_PREFIX');
        $where = "";
        if(!empty($data['dial_id'])){
            $where = " and dial_id = ".trim($data['dial_id']);
        }
        if (!empty($date['sort'])){
            $where .= " order by {$date['sort']} {$date['order']}";
        }
        $sql = "select *
                from {$tableQ}assign_prize
                WHERE 1=1 and is_del =1 and prize_num > 0 $where";
        $Model = new \Think\Model();
        $row = $Model->query($sql);
        if($row===false){
            die('数据库查询错误!');
        }else{
            return $row;
        }
    }

    /**
     * 获奖信息AJAX
     * */
    public function prizeInfoAjax(){
        $tableQ = C('DB_PREFIX');
        $where = "";
        $sql = "select *
                from {$tableQ}prizeinfo
                WHERE 1=1 and is_del =1  $where";
        $Model = new \Think\Model();
        $row = $Model->query($sql);
        if($row===false){
            die('数据库查询错误!');
        }else{
            return $row;
        }
    }

    /**
     * 获取添加指定人信息
     * */
    public function getAssignInfo($userId,$dialTd){
        $user_id = trim($_GET['act']);
        $prize_id = trim($_GET['dial_id']);
        if(!empty($userId)){
            $user_id = $userId;
        }
        if(!empty($dialTd)){
            $prize_id = $dialTd;
        }

        $user = M('user');
        $row['user'] = $user->where("user_id = $user_id")->find();
        $prize = M('dial');
        $row['prize'] = $prize->where("id = $prize_id")->find();
        S('assign_user',$row['user']);
        S('assign_prize',$row['prize']);
        if($row['user']===false || $row['prize']===false){
            die('数据库查询错误!');
        }else{
            return $row;
        }
    }

    /**
     * 确认添加指定人获奖
     * */
    public function saveAssignSure($user,$prize){
        $assign = M('assign_prize');
        //如果添加的信息与数据库中有类似的则累加。
        $row = $assign->where(" dial_id = {$prize['id'] } and user_id = {$user['user_id']} and interval_time = {$_POST['interval_time']}")->find();
        if($row){
            $num = $row['prize_num']+$_POST['prize_num'];
            $data['prize_num'] = $num ;
            $row = $assign->where("id = {$row['id']}")->save($data);
            return $row;
        }
        //不存在类似的信息，创建新数据。
        $data['dial_id'] = $prize['id'];
        $data['dial_name'] = $prize['prize_name'];
        $data['user_id'] = $user['user_id'];
        $data['user_name'] = $user['username'];
        $data['admin_id'] = $_SESSION['mg_id'];
        $data['admin_name'] = $_SESSION['mg_username'];
        $data['creat_time'] = time();
        $data['interval_time'] = trim($_POST['interval_time']);
        $data['prize_num'] = trim($_POST['prize_num']);
        $info = $assign->add($data);
        return $info;
    }

    /**
     * 删除指定获奖
     * */
    public function deleteUserSure($id){
        $assign = M('assign_prize');
        $data['is_del']=2;
        $row = $assign->where("id = {$id}")->save($data);
        return $row;
    }













    /**
     *会员列表
     * */
    public function userList($date){
//        var_dump($date);die();
        $tableQ = C('DB_PREFIX');
        $where = "";
        if(!empty($date['user_isdel'])){
            $where .=" and is_del =".$date['user_isdel'];
        }else{
            $where .=" and is_del = 1 ";
        }
        if(!empty($date['user_name'])){
            $where .=" and username like '%".trim($date['user_name'])."%'";
        }
        if(!empty($date['user_tel'])){
            $where .=" and user_tel like '%".trim($date['user_tel'])."%'";
        }
        if (!empty($date['sort'])){
            $where .= " order by {$date['sort']} {$date['order']}";
        }
        $sql = "select username as user_name, user_email, user_sex, user_tel,user_id,is_del
                from {$tableQ}user
                WHERE 1=1 $where";
//        var_dump($sql);die();
        $Model = new \Think\Model();
        $row = $Model->query($sql);
        if($row===false){
            die('数据库查询错误!');
        }else{
            return $row;
        }

    }

    /**
     * 会员充值列表
     * */
    public function financeInformation($date){
        $tableQ = C('DB_PREFIX');
        $where = "";
        if(!empty($date['moneyThan']) && !empty($date['money'])){
            if ($date['moneyThan'] == 1) {
                $where .= " and t.recharge_limit > ".trim($date['money']);
            } else if ($date['moneyThan'] == 2) {
                $where .= " and t.recharge_limit < ".trim($date['money']);
            } else if ($date['moneyThan'] == 3) {
                $where .= " and t.recharge_limit = ".trim($date['money']);
            } else {
                $data['code'] = 400;
                $data['message'] = '数据错误！';
                echo json_encode($data);
                die();
            }
        }
        if(!empty($date['monet_state'])){
            $where .=" and t.state =".trim($date['monet_state']);
        }
        $where.=" and t.user_id =".trim($date['monet_hidden']);
        if (!empty($_POST['sort'])) $where .= " order by {$_POST['sort']} {$_POST['order']}";

        $sql = "select *
                from {$tableQ}recharge t
                WHERE t.is_del = 1 $where";
//        var_dump($sql);
        $Model = new \Think\Model();
        $row = $Model->query($sql);
        if($row===false){
            die('数据库查询错误!');
        }else{
            return $row;
        }
    }

    /**
     * 会员消费列表
     * */
    public function financeConsume($date){
        $tableQ = C('DB_PREFIX');
        $where = "";
        if(!empty($date['moneyThan']) && !empty($date['money'])){
            if ($date['moneyThan'] == 1) {
                $where .= " and t.consume_money > ".trim($date['money']);
            } else if ($date['moneyThan'] == 2) {
                $where .= " and t.consume_money < ".trim($date['money']);
            } else if ($date['moneyThan'] == 3) {
                $where .= " and t.consume_money = ".trim($date['money']);
            } else {
                $data['code'] = 400;
                $data['message'] = '数据错误！';
                echo json_encode($data);
                die();
            }
        }
        if(!empty($date['monet_state'])){
            $where .=" and t.consume_type =".trim($date['monet_state']);
        }
        $where.=" and t.user_id =".trim($date['monet_hidden']);
        if (!empty($_POST['sort'])) $where .= " order by {$_POST['sort']} {$_POST['order']}";

        $sql = "select *
                from {$tableQ}consume t
                WHERE t.is_del = 1 $where";
//        var_dump($date);
        $Model = new \Think\Model();
        $row = $Model->query($sql);
        if($row===false){
            die('数据库查询错误!');
        }else{
            return $row;
        }
    }

    /**
     * 导出充值记录
     * */
    public function financeExportExcelM($date){
        $tableQ = C('DB_PREFIX');
        $where = "";
        include_once '../public/Admin/PHPExcel.php';
        Vendor('PHPExcel');
        $objPHPExcel =new \PHPExcel();
        $objPHPExcel->getProperties()->setCreator("ctos")
            ->setLastModifiedBy("ctos")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        // set width
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyle('K')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
//        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(35);
//        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
//        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
        // 设置行高度
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);
        $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        // 字体和样式
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A2:K2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A2:K2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A2:K2')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        // 设置水平居中
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//        $objPHPExcel->getActiveSheet()->getStyle('K')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//        $objPHPExcel->getActiveSheet()->getStyle('L')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//        $objPHPExcel->getActiveSheet()->getStyle('M')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//        $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);
//        $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setShrinkToFit(true);
        //  合并
        $objPHPExcel->getActiveSheet()->mergeCells('A1:K1');

        // 表头
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', iconv('utf-8', 'utf-8', '会员充值列表'))
            ->setCellValue('A2', iconv('utf-8', 'utf-8', '编号'))
            ->setCellValue('B2', iconv('utf-8', 'utf-8', '会员编号'))
            ->setCellValue('C2', iconv('utf-8', 'utf-8', '会员名称'))
            ->setCellValue('D2', iconv('utf-8', 'utf-8', '电话'))
            ->setCellValue('E2', iconv('utf-8', 'utf-8', 'QQ'))
            ->setCellValue('F2', iconv('utf-8', 'utf-8', '邮箱'))
            ->setCellValue('G2', iconv('utf-8', 'utf-8', '性别'))
            ->setCellValue('H2', iconv('utf-8', 'utf-8', '是否启用'))
            ->setCellValue('I2', iconv('utf-8', 'utf-8', '充值时间'))
            ->setCellValue('J2', iconv('utf-8', 'utf-8', '充值金额'))
            ->setCellValue('K2', iconv('utf-8', 'utf-8', '状态'));

        if(!empty($date['user_name'])){
            $where .=" and t.username like '%".trim($date['user_name'])."%'";
        }
        if(!empty($date['user_tel'])){
            $where .=" and t.user_tel like '%".trim($date['user_tel'])."%'";
        }
        if(!empty($date['user_isdel'])){
            $where .=" and t.is_del = ".trim($date['user_isdel']);
        }

        $Model = new \Think\Model();
        $sql = "select t.user_id, t.username as user_name, t.user_email, t.user_qq, t.user_tel, t.user_sex, t.is_del,
                from_unixtime(t1.creat_time,'%Y-%m-%d %H:%i:%s') as creat_time, t1.recharge_limit, t1.state
                from {$tableQ}user t
                LEFT JOIN {$tableQ}recharge t1 ON t.user_id = t1.user_id
                WHERE 1=1 $where";
        $row = $Model->query($sql);
        $money = 0;
        for($i = 0; $i<count($row);$i++){
            $objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 3), $i+1);
            $objPHPExcel->getActiveSheet(0)->setCellValue('B' . ($i + 3), $row[$i]['user_id']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), $row[$i]['user_name']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 3), $row[$i]['user_tel']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 3), $row[$i]['user_qq']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('F' . ($i + 3), $row[$i]['user_email']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('G' . ($i + 3), $user_sex = $row[$i]['user_sex'] == 1 ? "男" : "女" );
            $objPHPExcel->getActiveSheet(0)->setCellValue('H' . ($i + 3), $is_del = $row[$i]['is_del'] == 1 ? "启用" : "停用" );
            $objPHPExcel->getActiveSheet(0)->setCellValue('I' . ($i + 3), $row[$i]['creat_time']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('J' . ($i + 3), $row[$i]['recharge_limit']);
            $money = $money+$row[$i]['recharge_limit'];
            if($row[$i]['state']==1){
                $state = "交易成功";
            }else if($row[$i]['state']==2){
                $state = "退款";
            }else{
                $state = "关闭交易";
            }
            $objPHPExcel->getActiveSheet(0)->setCellValue('K' . ($i + 3), $state);
        }
        $objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 3), "总计");
        $objPHPExcel->getActiveSheet(0)->setCellValue('J' . ($i + 3), $money);
        $objPHPExcel->getActiveSheet()->getStyle('A' . (2) . ':K' . ($i + 3))->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . (2) . ':K' . ($i + 3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        $filename = "客户充值统计";
        $objPHPExcel->getActiveSheet()->setTitle(iconv('utf-8', 'utf-8', $filename));
        $objPHPExcel->setActiveSheetIndex(0);
        $timestamp = date('Y-m-d-H-i-s', time());
        $ex = '200';
        if ($ex == '2007') { //导出excel2007文档
            ob_end_clean();
            header('content-Type:application/vnd.ms-excel;charset=utf-8');
            header('Content-Disposition: attachment;filename="' . $filename . $timestamp . '.xls"');
            header('Cache-Control: max-age=0; charset=UTF-8');
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
            exit;
        } else {  //导出excel2003文档
            ob_end_clean();
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $filename . $timestamp . '.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }

    }


}
?>