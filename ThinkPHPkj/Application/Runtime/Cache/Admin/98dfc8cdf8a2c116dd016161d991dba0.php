<?php if (!defined('THINK_PATH')) exit();?><div class='content_div'>
    <center>
        <form id="save_assign" method="post" enctype="multipart/form-data">
            <table class="content_tab" cellpadding="5" cellspacing="0" border='0' style="margin-top: 20px;">
                <tbody>
                <tr>
                    <td>
                        指定奖品名称：
                    </td>
                    <td><input name='assign_prize' class="easyui-textbox"
                               value="<?php echo ($prize['prize_name']); ?>" disabled="disabled"/>
                    </td>
                    </td>
                </tr>
                <tr>
                    <td>
                        指定人名称：
                    </td>
                    <td><input class="easyui-textbox"
                               name="assign_user" value="<?php echo ($user['username']); ?>" disabled="disabled"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        获奖时间间隔：
                    </td>
                    <td><input class="easyui-textbox" required="required"
                               name="interval_time" value="" /> 天
                    </td>
                </tr>
                <tr>
                    <td>
                        获奖次数：
                    </td>
                    <td><input class="easyui-textbox" required="required"
                               name="prize_num" value="" />
                    </td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <input type="hidden" value="<?php echo ($user['user_id']); ?>" name="user_id">
                    <input type="hidden" value="<?php echo ($prize['id']); ?>" name="dial_id">
                </tr>
                </tbody>
            </table>

        </form>
    </center>
</div>