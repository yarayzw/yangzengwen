<?php
/**
 * Created by PhpStorm.
 * User: psmingyu
 * Date: 2016/6/13
 * Time: 22:45
 */
namespace Home\Model;
use Think\Model;
class FormModel extends Model {

    // 定义自动验证
    protected $_validate    =   array(
        array('title','require','标题必须'),
    );
    // 定义自动完成
    protected $_auto    =   array(
        array('create_time','time',3,'function'),
    );
}
