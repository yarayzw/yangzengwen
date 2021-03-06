<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>

<link id='yd_easyui_themes' href="/my/ThinkPHPkj/Public/Admin/js/jquery-easyui-1.4.4/themes/default/easyui.css" rel="stylesheet" type="text/css" />
<link href="/my/ThinkPHPkj/Public/Admin/js/jquery-easyui-1.4.4/themes/icon.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/my/ThinkPHPkj/Public/Admin/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="/my/ThinkPHPkj/Public/Admin/js/jquery-easyui-1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="/my/ThinkPHPkj/Public/Admin/js/jquery-easyui-1.4.4/jquery.easyui.min.js"></script>
<!--<{*中文语言包*}>-->
<script type="text/javascript" src="/my/ThinkPHPkj/Public/Admin/js/jquery-easyui-1.4.4/locale/easyui-lang-zh_CN.js"></script>
<!--<{*验证扩展*}>-->
<script type="text/javascript" src="/my/ThinkPHPkj/Public/Admin/js/validateextend.js"></script>
<!--<{*html5上传插件*}>-->
<script type="text/javascript" src="/my/ThinkPHPkj/Public/Admin/js/jquery.Huploadify.js"></script>
<!--<{*关联浏览扩展*}>-->
<script type="text/javascript" src="/my/ThinkPHPkj/Public/Admin/js/datagrid-detailview.js"></script>
<!--<{*单元格编辑扩展*}>-->
<script type="text/javascript" src="/my/ThinkPHPkj/Public/Admin/js/datagrid-cellediting.js"></script>
<script type="text/javascript" src="/my/ThinkPHPkj/Public/Admin/js/syUtil.js"></script>
<script type="text/javascript" src="/my/ThinkPHPkj/Public/Admin/js/index.js"></script>
<script type="text/javascript" src="/my/ThinkPHPkj/Public/Admin/js/jquery-form.js"></script>
<!--<{*不蒜子访问统计*}>-->
<script async src="//dn-lbstatics.qbox.me/busuanzi/2.3/busuanzi.pure.mini.js"></script>


<body>
<div id='list_div'></div>
<div style="height: 850px;margin-right:  2%;">
    <table id="bt_user"></table>
</div>
</body>
</html>
<script>
    var $grid = $('#bt_user');
    $grid.datagrid({
        fit: true,
        url: '/my/ThinkPHPkj/index.php/Admin/Finance/prizeInfoAjax',
        idField: 'mg_id',
        sortName : 'mg_id',
        fite:true,
        striped:true,
        nowrap : false,
        sortOrder : 'desc',
        pageSize: 20,
        // singleSelect:true,
        queryParams:{ 'action':'ajax' },
        pagination: true,//分页控件
        rownumbers: true,//行号
        columns: [[
            { field: 'number', checkbox: true  },
            { field: 'id', title: '编号', align: 'center', width: 80,sortable : true },
            { field: 'dial_id', title: '奖品ID', width: 80 ,sortable : true },
            { field: 'dial_name', title: '奖品名称 ', width: 120},
            { field: 'user_id', title: '获奖人ID', width: 80 ,sortable : true },
            { field: 'user_name', title: '获奖人名称', width: 80,sortable : true },
            { field: 'creat_time', title: '获奖时间', width: 150,sortable : true ,formatter: function(value,row){
                if(value){
                    var value_time = parseInt(value);
                    var time = new Date(value_time * 1000);
                    var ymdhis = "";
                    ymdhis += time.getUTCFullYear() + "-";
                    ymdhis += (time.getUTCMonth()+1) + "-";
                    ymdhis += time.getUTCDate();

                    ymdhis += " " + time.getUTCHours() + ":";
                    ymdhis += time.getUTCMinutes() + ":";
                    ymdhis += time.getUTCSeconds();

                    return ymdhis;
                }
            }},
            { field: 'is_grant', title: '是否发放', width: 80,sortable : true ,formatter: function(value,row){
                if(value ==1){
                    return "未发放";
                }else {
                    return "已发放";
                }
            }},

        ]],

        toolbar: '#yd_toolbar',
        onLoadSuccess: function () {

        }
    });
</script>