<?php if (!defined('THINK_PATH')) exit();?><div class='content_div'>
    <center>
        <form id="updateDial" method="post" enctype="multipart/form-data">
            <table class="content_tab" cellpadding="5" cellspacing="0" border='0' style="margin-top: 20px;">
                <tbody>
                <tr>
                    <td>
                        奖品名称：
                    </td>
                    <td><input name='prize_name' class="easyui-textbox" required="required"
                               value="<?php echo ($dial['prize_name']); ?>"/>
                    </td>
                    </td>
                </tr>
                <tr>
                    <td>
                        获奖概率：
                    </td>
                    <td><input class="easyui-textbox"  required="required"
                               name="probability" value="<?php echo ($dial['probability']); ?>"/>%
                    </td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <input type="hidden" value="<?php echo ($dial['id']); ?>" name="id">
                </tr>
                </tbody>
            </table>

        </form>
    </center>
</div>