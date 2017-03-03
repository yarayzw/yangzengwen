function NameSpace(path, cb) {
    var o = {}, d;
    d = path.split(".");
    o = window[d[0]] = window[d[0]] || {};
    for (var k = 0; k < d.slice(1).length; k++) {
        o = o[d[k + 1]] = o[d[k + 1]] || {};
    }

    if (cb) {
        cb.call(o);
        if (o.ready && typeof o.ready === "function") {
            o.ready.call();
        }
    }
}

//搜索
function common_search(Name){
    var $grid = $('#' + Name + '_table');
    var $form = $('#' + Name + '_search');
    if($form.form('validate')) {
        $grid.datagrid('load',$form.toJson());
    }
}

//只显示年和月份
function showOnlyMonthAndYear(idName){
    $(idName).datebox({
        onShowPanel: function () {//显示日趋选择对象后再触发弹出月份层的事件，初始化时没有生成月份层
            span.trigger('click'); //触发click事件弹出月份层
            if (!tds) setTimeout(function () {//延时触发获取月份对象，因为上面的事件触发和对象生成有时间间隔
                tds = p.find('div.calendar-menu-month-inner td');
                tds.click(function (e) {
                    e.stopPropagation(); //禁止冒泡执行easyui给月份绑定的事件
                    var year = /\d{4}/.exec(span.html())[0]//得到年份
                    , month = parseInt($(this).attr('abbr'), 10); //月份，这里不需要+1
                    $(idName).datebox('hidePanel')//隐藏日期对象
                    .datebox('setValue', year + '-' + month); //设置日期的值
                });
            }, 0)
        },
        parser: function (s) {
            if (!s) return new Date();
            var arr = s.split('-');
            return new Date(parseInt(arr[0], 10), parseInt(arr[1], 10) - 1, 1);
        },
        formatter: function (d) { 
            return d.getFullYear() + '-' + (d.getMonth()+1);
        }
    });
    
    var p = $(idName).datebox('panel'), //日期选择对象
        tds = false, //日期选择对象中月份
        span = p.find('span.calendar-text'); //显示月份层的触发控件
}   

//datagrid刷新
function datagrid_reload(idname){
    var $grid = $('#' + idname);
    $grid.datagrid('reload');
}

//通用弹窗
function common_dialog(url,title,obj){
    if(!document.getElementById('common_open_dialog_div')){
        $('body').append('<div id="common_open_dialog_div"></div>');
    }

    //是否最大化窗口
    var maximizable = $(obj).data('maximizable');
    if(typeof maximizable == 'undefined'){
        maximizable = true;
    }
    //设置默认宽高
    var width = $(obj).data('width');
    var height = $(obj).data('height');

    if(typeof width == 'undefined'){
        width = 800;
    }

    if(typeof height == 'undefined'){
        height = 500;
    }
    var dialogDiv = $('#common_open_dialog_div');
    var viewDialog;
    viewDialog = dialogDiv.dialog({
        title: title,
        href:  _ROOT_ + url,
        method:'post',
        queryParams:{'action':'display'},
        width: width,
        bodyStyle: {overflow: 'hidden'},
        maximized:maximizable,
        height: height,
        modal:true,
        maximizable:true,
        onClose:function(){
            dialogDiv.dialog('destroy');
        },
        onBeforeClose: function() {},
    });
}


//excel导入
function common_excel(url,title){
    if(!document.getElementById('common_excel_import_dialog_div')){
        $('body').append('<div id="common_excel_import_dialog_div"></div>');
    }
    var dialogDiv = $('#common_excel_import_dialog_div');
    var viewDialog;
    viewDialog = dialogDiv.dialog({
        title: 'Excel导入' + title,
        href:  _ROOT_ + url,
        method:'post',
        queryParams:{'action':'display'},
        width: 800,
        bodyStyle: {overflow: 'hidden'},
        maximized:true,
        height: 500,
        modal:true,
        maximizable:true,
        onClose:function(){
            dialogDiv.dialog('destroy');
        },
        onBeforeClose: function() {},
    });
}

//保存excel导入 dataTable:存放数据table
function common_import_save(dataTable,url,parentTable){
    var dialogDiv = $('#common_excel_import_dialog_div');
    var import_table = $('#' + dataTable);
    var $grid = $('#' + parentTable);
    var data = import_table.datagrid('getRows');
    if(data.length == 0){
        $.messager.alert('操作提示','没有数据，请先导入或手动添加。','warning')
        return false;
    }

     //获取正在编辑的行号
    var editingIndex = import_table.datagrid('getEditingRowIndexs');
    if(jQuery.isEmptyObject(editingIndex) === false){
        $.messager.alert('操作提示','请先保存正在编辑的行!','warning');
        return false;
    }

    $.ajax({
        url:_ROOT_ + url,
        method:'POST',
        dataType:'JSON',
        data:{data:data,action:'save'},
        success:function(data){
            $.messager.alert('操作提示',data.msg);
            $.messager.progress('close');
            if(data.code !== 200){
                return false;
            }
            dialogDiv.dialog('close');
            reloadLayoutCenter(data.href);
        },
        beforeSend:function(){
            $.messager.progress();
        },
        error:function(){
            $.messager.alert('操作提示','通讯失败');
            $.messager.progress('close');
        },
    });
}

//显示修改框
function common_update(obj){
    if(!document.getElementById('common_update_dialog_div')){
        $('body').append('<div id="common_update_dialog_div"></div>');
    }
    var show_dialog = $('#common_update_dialog_div');
    var url = $(obj).data('url');
    var id = $(obj).data('id');
    var title = $(obj).data('title');
    var formName = $(obj).data('form');
    var height = $(obj).data('height');
    var tabName = $(obj).data('table');
    show_dialog.dialog({
        title:title,
        href:_ROOT_ + url,
        method:'post',
        queryParams:{'action':'display','id':id},
        width:500,
        height:height,
        bodyStyle: {overflow: 'hidden'},
        modal:true,
        onClose:function(){
            show_dialog.dialog('destroy');
        },
        onBeforeClose: function(){
        },
        buttons: [{
            iconCls:'icon-save',
            text: '保存',
            handler: function(){
                common_save(url,formName,tabName);
            },
        },
        {
            iconCls:'icon-cancel',
            text: '取消',
            handler: function(){
                show_dialog.dialog('close');
            }
        }]

   });
}


//保存修改
function common_save(url,formName,tabName){
    var $show_dialog = $('#common_update_dialog_div');
    var $bt_form = $('#' + formName);
    var $grid = $('#' + tabName);
    if ($bt_form.form('validate')) {
        $.ajax({
            method: "POST",
            url: _ROOT_ + url,
            data: $bt_form.toJson(),
            dataType: 'json',
            success: function(data){
                if (data.code == 200) {
                    $.messager.alert("提示", data.msg);
                    $grid.datagrid('reload');
                    $grid.datagrid('clearSelections');
                    $show_dialog.dialog('close');
                } else {
                    $.messager.alert("提示", data.msg);
                }
            },
            error:function(){
                $.messager.alert("提示", '通讯失败!');
            }
            
        });
    }
}

//删除
function common_deleteOne(obj){
    var id = $(obj).data('id');
    var url = $(obj).data('url');
    var title = $(obj).data('title');
    var index = $(obj).data('index');
    var $grid = $('#' + $(obj).data('table'));
    $.messager.confirm('删除提示', title, function(r) {
        if (r) {
            $.ajax({
                url:_ROOT_ + url,
                data:{id:id},
                method:"POST",
                dataType:"json",
                success:function(data){
                    if(data.code == 200) {
                        $grid.datagrid('reload');
                        $grid.datagrid('clearSelections');
                        $.messager.show({
                            title:'操作提示',
                            msg:'成功删除一条记录',
                        });
                    } else {
                        $.messager.alert("提示", data.msg);
                    }
                },
                error:function(){
                    $.messager.alert("提示",'通讯失败！');
                }
            });
    
        }
    });
}




//格式化unix时间戳 2016-05-31
function formatDate(timestamp){
    if(timestamp == 0){
        return '';
    }
    var date = new Date(timestamp * 1000);
    var year = date.getFullYear();   
    var month = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1);
    var day = (date.getDate() < 10 ? '0' + date.getDate() : date.getDate());   
    return year + '-' + month + '-' + day;
}
//datagrid 编辑一行
function editrow(target){
    $grid = $($(target).data('grid'));
    $grid.datagrid('beginEdit', getRowIndex(target));
    reparse();
}

//datagrid 保存一行
function saverow(target){
    $grid = $($(target).data('grid'));
    $grid.datagrid('endEdit', getRowIndex(target));
    reparse();
}
//datagrid 取消编辑
function cancelrow(target){
    $grid = $($(target).data('grid'));
    //是否验证
    var check = $(target).data('check');
    if(typeof check == 'undefined'){
        check = true;
    }
    var index = getRowIndex(target);
    if(check){
        if($grid.datagrid('validateRow',index)){
            $grid.datagrid('cancelEdit', index);
        }
    }else{
        $grid.datagrid('cancelEdit', index);
    }
    reparse();
}
//datagrid 删除一行
function deleterow(target){
    $grid = $($(target).data('grid'));
    $.messager.confirm('删除确认','确定删除?',function(r){
        if (r){
            if($grid.datagrid('deleteRow', getRowIndex(target))){
                $.messager.show({
                    title:'操作提示',
                    msg:'成功删除一行',
                });
            }
        }
    });
}

//重新解析
function reparse(){
    $.parser.parse($('.linkbutton_new').parent());
}

//datagrid 获取行号
function getRowIndex(target){
    var tr = $(target).closest('tr.datagrid-row');
    return parseInt(tr.attr('datagrid-row-index'));
}

//重新加载中间窗口
function reloadLayoutCenter(href){
    $('#bt_index_layout_center').panel({
        href:href
    });
}

$(function() {
    //菜单树处理
    var get_menu_url = $('#bt_index_menu_tree').data('url');
    $('#bt_index_menu_tree').tree({
        // data: _MENUDATA_,
        url:get_menu_url,
        lines: true,
        onSelect: function(node) {
            //链接不为空且是子分类时ajax请求数据
            if (node.attributes.href != '' && node.attributes.href != null && node.attributes.issort == 1) {
                $('#bt_index_layout_center').panel({
                    title:node.text,
                    href:_ROOT_ + node.attributes.href,
                    fit:true,
                });
            }
        }
    });
    

    //主题切换
    $('.theme').click(function() {
        var themeName = $(this).attr('name');
        $('#yd_easyui_themes').attr('href', _THEME_PATH_ + '/' + themeName + '/easyui.css');
    });

    //个人设置
    $('#bt_user_setting').click(function(){
        var url = $(this).data('url');
        var height = $(this).data('height');
        $('#bt_user_setting_win').dialog({
            title:'个人信息设置',
            width:680,
            height:height,
            modal:true,
            href:url,//ajax请求内容
            onLoad:function(){},
            buttons:[{
                iconCls:'icon-save',
                text:'保存',
                handler:function(){
                    $('#user_setting_form').form('submit',{
                        url:$(this).attr('action'),
                        onSubmit:function(params){
                            return $(this).form('validate');
                        },
                        success:function(data){
                            var result = $.parseJSON(data);
                            if(result.code == 200){
                                $.messager.alert('修改状态',result.msg,'info');
                                $('#bt_user_setting_win').dialog('close');
                            }else{
                                $.messager.alert('修改状态',result.msg,'info');
                            }
                        },
                    });
                }
            },{
                iconCls:'icon-cancel',
                text:'取消',
                handler:function(){
                    $('#bt_user_setting_win').dialog('close');
                }

            }]
        });
    });


    //检测用户名是否存在
    $('.checkUserExist').validatebox({
        required:true,
        validType:'remote[check_username_url,"check_username"]',
        missingMessage:'用户名不能为空',
        invalidMessage:'用户名已存在'
    });

});


(function($){
    /**
     * datagrid扩展
     */
    $.extend($.fn.datagrid.defaults.editors, {
        password: {
            init: function(container, options){
                return $('<input type="password" class="datagrid-editable-input" />').appendTo(container);
            },
            destroy: function(target){
                $(target).remove();
            },
            getValue: function(target){
                return $(target).val();
            },
            setValue: function(target, value){
                $(target).val(value);
            },
            resize: function(target, width){
                $(target)._outerWidth(width);
            }
        }
    });

    /*
    *  datagrid 获取正在编辑状态的行号，使用如下：
    *  $('#id').datagrid('getEditingRowIndexs'); //获取当前datagrid中在编辑状态的行编号列表
    */
   $.extend($.fn.datagrid.methods, {
        getEditingRowIndexs: function(jq, newposition) {
            var indexs = [];
            jq.each(function() {
                var rows = $.data(jq[0], "datagrid").panel.find('.datagrid-row-editing');
                rows.each(function(i, row) {
                    var index = row.sectionRowIndex;
                    if (indexs.indexOf(index) == -1) {
                        indexs.push(index);
                    }
                });
            });
            return indexs;
        }
    });

    //收集form数据
    $.fn.toJson = function() {
        var arrayValue = $(this).serializeArray();
        var json = {};
        $.each(arrayValue, function() {
            var item = this;
            if (json[item["name"]]) {
                json[item["name"]] += "," + item["value"];
            } else {
                json[item["name"]] = item["value"];
            }
        });
        return json;
    };


})(jQuery);

