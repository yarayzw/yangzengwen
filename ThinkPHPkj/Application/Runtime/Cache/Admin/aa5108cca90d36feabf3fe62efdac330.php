<?php if (!defined('THINK_PATH')) exit();?>
<div id="userList_toolbar" style="padding:5px;">
    <div style="margin-bottom:5px;">
        <a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-reload" plain="true" id='reload'
           onclick="sup_list();" style="float: left">刷新</a>
        <a href="javascript:void(0);" class="easyui-linkbutton" style="visibility:hidden"></a>
    </div>
    <div>
        <form id='userList_search'>
            <div style="padding:0 0 0 7px;color:#333;">
                <input type='hidden' name='action' value='ajax'/>

                会员名称:<input type="text" class="easyui-textbox" id="user_name" name="user_name" style="width:110px">
                电话:<input type="text" class="easyui-textbox" id="user_tel" name="user_tel" style="width:110px">
                <a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-search"
                   onclick="userList_search();">查询</a>
                <a href="javascript:void(0);" class="easyui-linkbutton" data-options="iconCls:'icon-back'"
                   onclick="userList_cleanSearch('');">取消</a>
            </div>
        </form>
    </div>
</div>
<div data-options="" style="height: 100%;">
    <table id="user_list" ></table>
</div>
<script>

    var $user_list = $('#user_list');

    $user_list.datagrid({
        fit: true,
        border:false,
        url:  '/my/ThinkPHPkj/index.php/Admin/Finance/userListAjax',
        idField: 'user_id',
        sortName : 'user_id',
        sortOrder : 'desc',
        queryParams: { 'action': 'ajax' },
        pageSize: 20,
        pageList : [ 20, 50, 100,200 ],
        // singleSelect:true,
        pagination: true,//分页控件
        rownumbers: true,//行号
        fitColumns: false,
        singleSelect:true,
        checkOnSelect : true,
        selectOnCheck : true,
        columns: [[
            { field: 'number', checkbox: true },
            { field: 'user_id', title: '编号', align: 'center', width: 40, sortable: true },
            { field: 'user_name', title: '会员名称', width: 180 },
            { field: 'user_email', title: '会员邮箱', width: 120 },
            { field: 'user_sex', title: '性别', width: 80, sortable: true ,formatter: function (value, row){
                if(value==1){
                    return "男";
                }else {
                    return "女";
                }
            }},
            { field: 'user_tel', title: '电话', width: 200 },

        ]],
        onRowContextMenu : function(e, rowIndex, rowData) {
            e.preventDefault();
            $(this).datagrid('unselectAll');
            $(this).datagrid('selectRow', rowIndex);
            $('#menu_order').menu('show', {
                left : e.pageX,
                top : e.pageY
            });
        },
        toolbar: '#userList_toolbar',
        onClickRow : function(value, row){
            var row = $user_list.datagrid('getSelected');
        },
    });

    /**
     * 查询
     * */

    function userList_search() {
        var search_form = $('#userList_search');
        if (search_form.form('validate')) {
            $user_list.datagrid('load', search_form.toJson());
        }
    }
    /**
     * 取消
     * */
    function userList_cleanSearch(){
        $user_list.datagrid('load', {});
        $user_list.datagrid('clearChecked');
        $user_list.datagrid('clearSelections');
        $('#userList_search input').val('');
    }

</script>