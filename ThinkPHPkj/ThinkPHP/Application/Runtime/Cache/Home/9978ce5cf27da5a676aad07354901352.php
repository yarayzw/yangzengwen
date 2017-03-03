<?php if (!defined('THINK_PATH')) exit();?>
<!Doctype html>
<html class="nx-main760">
<head>
    <title>人人网 </title>
    <meta charset="utf-8"/>
    <script src="/thinkphp/Public/Home/js/jquery-1.11.3.js"></script>
    <script src="/thinkphp/Public/Home/js/layer.js"></script>
    <script src="/thinkphp/Public/Home/js/jquery.uploadify.js" type="text/javascript"></script>
    <link rel="shortcut icon" type="image/x-icon" href="/thinkphp/Public/Home/images/favicon-rr.ico" />
    <link rel="apple-touch-icon" href="/thinkphp/Public/Home/images/apple_icon_.png" />
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/base.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/home.css" />
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/register-guide-v7.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/Home/css/uploadify.css">
</head>
<body>


<div id="nxHeader" class="hd-wraper ">
    <div class="hd-fixed-wraper clearfix">
        <div class="hd-main">
            <h1 class="hd-logo">
                <a href="#" >人人网</a>
            </h1>
            <div class="hd-nav clearfix">
                <div class="hd-search">
                    <input type="text" id="hd-search" class="hd-search-input" placeholder="搜索好友，公共主页，状态" />
                    <a href="javascript:;" class="hd-search-btn"></a>
                </div>
                <dl class="hd-account clearfix">
                    <dt>
                        <a href="">
                            <img class="hd-avatar" width="30" height="30" src="/thinkphp/Public/Uploads/<?php echo (session('headphoto')); ?>" />
                        </a>
                    </dt>
                    <dd>
                        <a class="hd-name" href="##"><?php echo ($name); ?></a>
                        <a class="hd-name" href="##"><?php echo (session('level')); ?>级</a>
                    </dd>
                </dl>

                <div class="hd-account-action hd-account-action-vip" >
                    <?php if($_SESSION['status']== 2): ?><img src='/thinkphp/Public/Home/images/vip.png'><?php endif; ?>
                </div>


            </div>

        </div>

    </div>

</div>
<div class="nx-wraper clearfix">
    <div class="nx-sidebar">
        <div id="nxSlidebar" class="slide-fixed-wraper clearfix">
            <div class="app-nav-wrap">
                <div class="app-nav-cont">
                    <ul class="app-nav-list">
                        <li class="app-nav-item app-nav-item-cur app-feed"><a class="app-link" href="/thinkphp/index.php/Home/Home/homepage"><img class="app-icon" width="32" height="32" src="/thinkphp/Public/Home/images/a.gif"/><span >首页</span></a></li>
                        <li class="app-nav-item app-homepage" ><a class="app-link" href="/thinkphp/index.php/Home/Home/personpage"><img class="app-icon" width="32" height="32" src="/thinkphp/Public/Home/images/a.gif"/><span >主页</span></a></li>
                        <li class="app-nav-item app-album" ><a class="app-link" href="#"><img class="app-icon" width="32" height="32" src="/thinkphp/Public/Home/images/a.gif"/><span >相册</span></a></li>
                    </ul>
                </div>
                </ul>
            </div>

        </div>
    </div>
</div>


<div class="bd-container ">
    <div class="frame-nav-wrap">
        <div id="frameFixedNav" class="frame-nav-fixed-wraper">
            <div class="frame-nav-inner">
                <ul class="fd-nav-list clearfix">
                    <li class="fd-nav-item fd-nav-cur-item">
                        <span class="fd-nav-icon fd-sub-nav"></span>
                        <a href="/thinkphp/index.php/Home/Home/personpage">我的主页</a></li>
                    <li class="fd-nav-item">
                        <a href="/thinkphp/index.php/Home/Home/photo">相册</a>
                    </li>
                    <li class="fd-nav-item">
                        <a href="/thinkphp/index.php/Home/Home/mood">状态</a>
                    </li>
                    <li class="fd-nav-item">
                        <a href="/thinkphp/index.php/Home/Home/daily">日志</a></li>
                    <li class="fd-nav-item">
                        <a href="/thinkphp/index.php/Home/Home/msgbox">收件箱</a></li>

                </ul>
            </div>
        </div>
    </div>

    <div class="bd-content clearfix">
        <div class="bd-publisher"></div>

       <div id="f" style="display:none;">
            <div style="width:500px;height:10px;"></div>
            <div style="width:500px;height:40px;color:#e7b402;text-align:center;line-height:40px;font-size:18px;border:1px #ccc solid;">
                <b>上传照片</b>
            </div>
           <div id='lay01' style="width:500px;height:300px;text-align:center;line-height:150px;border:1px #ccc solid;display:block;">
               <form action="/thinkphp/index.php/Home/Home/upload" id="photoform" method="post" >
                   <div style='width:500px;height:35px;position: relative;top:-50px;left:-70px;'>
                       <span style="color:red;">请选择上传到的相册</span>
                   <select name="uploadalbum" style="width:120px;height:30px;margin-left:30px; ">
                       <?php if(is_array($arr)): foreach($arr as $key=>$vvo): ?><option value="<?php echo ($vvo["id"]); ?>"><?php echo ($vvo["name"]); ?></option><?php endforeach; endif; ?>
                       <input type="hidden" name="uid" id="photouid" value="<?php echo ($id); ?>">
                       <input type="hidden" name="key" value="2">
                   </select>

            </div>
                   <div style="border:1px solid #ccc;width:480px;height:250px;margin-top:10px;margin-left:7px;">
                       <div id="queue" onclick="sendphotomsg()"></div>
                       <input id="file_upload" name="file_upload" type="file" multiple="true">
                       <div id="img123" style="border:1px solid #805;text-align:left;">
                       </div>
                   </div>
                   <input type="submit" style="width:80px;height:30px;background:#ffffff;">
               </form>
           </div>

        </div>
        <form action="/thinkphp/index.php/Home/Home/createalbum" id="f1" method="post" style="display: none">
            <div style='width:178px;height:30px;font-size:16px;text-align:center;line-height:30px;'>
                请输入相册名
            </div>
            <input type="hidden" name="hid1" value="特效1">
            <input type="hidden" name="hid2" value="特效2">
            <input type="hidden" name="hid3" value="特效3">
            &nbsp;&nbsp;&nbsp;<input type='text' name="createalbum"><br><br>
            <input type="hidden" name="uid" value="<?php echo ($id); ?>">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value='确定' style="width:80px;height:30px;background:#ffffff;">
        </form>

        <div class="nx-content">
            <div class="advert-box" style="float:none;"><div class="side-item-advert"></div></div>

            <div style="width:800px;height:500px;background:#ffffff;">
                <div style='width:800px;height:65px;text-align:center;background:#F8F8F8;'>
                    <a href='javascript:void(0)'><div style='width:100px;height:65px;float:left;text-align:center;line-height:65px;'>我的相册</div></a>
                    <a href='javascript:void(0)'><div id='photo02' style='width:100px;height:35px;float:right;text-align:center;line-height:35px;border:1px #ccc solid;margin-top:20px;'>上传照片</div></a>
                    <a href='javascript:void(0)'><div id='photo01' style='width:100px;height:35px;float:right;text-align:center;line-height:35px;border:1px #ccc solid;margin-top:20px;'>新建相册</div></a>
                </div>
                <div style="width:700px;height:350px;margin-left:50px;overflow:auto;margin-top:15px;">
                 <ul id="album">
                    <?php if(is_array($arr)): foreach($arr as $key=>$vo): ?><li style="float:left;width:140px;height:170px;text-align:center;margin-left:25px;">
                            <a href="javascript:void(0)"><div onclick="getmessages(this)" alt="<?php echo ($vo["id"]); ?>" cate="<?php echo ($vo["content"]); ?>">
                            <?php if($vo["homepage"] == 1): ?><img src="/thinkphp/Public/Uploads/002.jpg"><?php endif; ?>
                            <?php if($vo["homepage"] != 1): ?><img src="/thinkphp/Public/Uploads/img/<?php echo ($vo["homepage"]); ?>" width="140" height="150"><?php endif; ?></div>
                            <?php if($vo["status"] == 1): ?><a id="<?php echo ($vo["id"]); ?>" onclick="getidand(this)"  href="javascript:viod(0)"><img src="/thinkphp/Public/Uploads/004.jpg"></a><?php echo ($vo["name"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="/thinkphp/Public/Uploads/001.jpg"><a href="javascript:void(0)"><img onclick="delealbum(this)" alt="<?php echo ($vo["id"]); ?>" cont="<?php echo ($vo["content"]); ?>" src="/thinkphp/Public/Uploads/dele.png"></a><?php endif; ?>
                            <?php if($vo["status"] == 2): ?><a id="<?php echo ($vo["id"]); ?>" onclick="getidand(this)" href="javascript:viod(0)"><img src="/thinkphp/Public/Uploads/004.jpg"></a><?php echo ($vo["name"]); ?><a href="javascript:void(0)"><img onclick="delealbum(this)" alt="<?php echo ($vo["id"]); ?>" cont="<?php echo ($vo["content"]); ?>" src="/thinkphp/Public/Uploads/dele.png"></a><?php endif; ?>
                            </a>
                        </li><?php endforeach; endif; ?>
                </div>
            </div>
            <form action="/thinkphp/index.php/Home/Home/search" method="post" id="f5" style="display:none;">
                <input type="hidden" id="searchphoto1" name="albumid" value="">
                <input type="hidden" id="content01" name="album" value="">
                <input type="submit">
            </form>

            <form action="/thinkphp/index.php/Home/Home/modify" id="f2" method="post" style="display: none">

                <select name="modify" style="width:120px;height:30px;margin-left:30px;margin-top:20px;">
                    <option value="3">修改权限</option>
                    <option value="1">仅自己可见</option>
                    <option value="2">公开相册</option>
                </select>

                <input type="hidden" id="modifyhid" name="id" value="">
                <input type="submit" style="width:80px;height:30px;margin-left:30px;margin-top:20px;background:#ffffff;">
            </form>

            <form action="/thinkphp/index.php/Home/Home/delalb" id="f7" method="post" style="display: none">

                <input type="hidden" id="albid" name="albid" value="">
                <input type="hidden" id="albcont" name="albcont" value="">
                <input type="submit">
            </form>
            <div class="ft-wrapper clearfix" >

                <p>
                    <strong>玩转啪啪</strong>
                    <a href="#" target="_blank">公共主页</a>
                    <a href="#" target="_blank">公众平台</a>
                    <a href="#" target="_blank">客服帮助</a>
                    <a href="#" target="_blank">隐私</a>
                </p>

                <p>
                    <strong>商务合作</strong>
                    <a href="#" target="_blank">品牌营销</a>
                    <a href="#" class="l-2" target="_blank">中小企业<br />自助广告</a>
                    <a href="#" target="_blank">开放平台</a>
                </p>

                <p>
                    <strong>公司信息</strong>
                    <a href="#" target="_blank">关于我们</a>
                    <a href="#" target="_blank">啪啪公益</a>
                    <a href="#" target="_blank">招聘</a>
                    <a href="#" id="lawInfo">法律声明</a>
                </p>

                <p>
                    <strong>友情链接</strong>
                    <a href="#" target="_blank">啪啪分期</a>
                    <a href="#" target="_blank">啪啪理财</a>
                    <a href="#" target="_blank">我秀</a>
                    <a href="#" target="_blank">注册局</a>
                </p>

                <p>
                    <strong>啪啪移动客户端下载</strong>
                    <a href="#" target="_blank">iPhone/Android</a>
                    <a href="#" target="_blank">iPad客户端</a>
                    <a href="#" target="_blank">其他产品</a>
                </p>


                <p class="copyright-info" style="margi-left: -20px">
                    <span>公司全称：郑州景科技发展有限公司</span>
                    <span>公司电话：0371-88888888</span>
                    <span><a href="#">公司邮箱：admin@papa.com</a></span>
                    <span>公司地址：郑州市高新区<br>河南商务产业园</span>
                    <span>违法和不良信息举报电话：027-87676735</span>
                    <span></span>
                    <span><a href="#" target="_blank">京ICP证090254号</a></span>
                    <span>人人网&copy;2016</span>
                </p>

            </div>

        </div>


</body>
</html>
<script>

    $('#photo01').bind({
        mouseover:function(){$(this).css("background-color","#ccc");},
        mouseout:function(){$(this).css("background-color","#F8F8F8");}
    });
    $('#photo02').bind({
        mouseover:function(){$(this).css("background-color","#ccc");},
        mouseout:function(){$(this).css("background-color","#F8F8F8");}
    });
    $('#layone').bind({
        mouseover:function(){$(this).css("background-color","#e7b402");},
        mouseout:function(){$(this).css("background-color","#FFFFFF");},
        click:function(){$('#lay01').css('display','block'),$('#lay02').css('display','none');}
    });

    $('#laymuch').bind({
        mouseover:function(){$(this).css("background-color","#e7b402");},
        mouseout:function(){$(this).css("background-color","#FFFFFF");},
        click:function(){$('#lay01').css('display','none'),$('#lay02').css('display','block');}
    });


    $('#photo02').on('click', function(){
        layer.open({
            type: 1,
            title: false,
            skin: 'false', //加上边框
            area: ['519px', '500px'], //宽高
            content:$('#f')
        });

//自定页

    });
    $('#photo01').on('click', function(){
        layer.open({
            type: 1,
            title: false,
            skin: 'layui-layer-rim', //加上边框
            area: ['180px', '150px'], //宽高
            content:$('#f1')
        });

//自定页

    });
    function getidand(ob){
        var id=$(ob).attr('id');
        $('#modifyhid').attr('value',id);
        layer.open({
            type: 1,
            title: false,
            skin: 'layui-layer-rim', //加上边框
            area: ['180px', '150px'], //宽高
            content:$('#f2')
        });

//自定页
    }

    function getmessages(ob){
        var id=$(ob).attr('alt');
        var content=$(ob).attr('cate');
        $('#content01').attr('value',content);
        $('#searchphoto1').attr('value',id);
        $('#f5').submit();
    }

    function delealbum(ob){
        var id=$(ob).attr('alt');
        var cont=$(ob).attr('cont');
        $('#albid').attr('value',id);
        $('#albcont').attr('value',cont);

        layer.msg('确定删除相册(特效相册不能删除)？', {
            time: 0 //不自动关闭
            ,btn: ['确定', '取消']
            ,yes: function(index){
                $('#f7').submit();
            }
        });
    }
    <?php $timestamp = time() ?>
            $('#file_upload').uploadify({
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp ?>',
                    'token'     : '<?php echo md5('unique_salt' . $timestamp) ?>'
                },
                'swf'      : '/thinkphp/Public/Home/uploadify.swf',
                'uploader' : '/thinkphp/index.php/Home/Home/uploadify',
                'auto':'true',
                'buttonCursor':'hand',
                'buttonText':'图片上传',
                'onUploadSuccess':function(file,data,response){
                    var path="<img width='50' height='50' src='/thinkphp/Public/Uploads/img/"+data;
                    var uid="<input type='hidden' name='photopath[]' value='"+data;
                    $("#img123").append(path);
                    $("#photoform").append(uid);
                }

            });

</script>