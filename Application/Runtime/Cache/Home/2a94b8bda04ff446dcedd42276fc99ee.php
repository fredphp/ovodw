<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($title); ?></title>
    <meta name="viewport" content="device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <base href="/Public/static/home/">
    <link rel="stylesheet" href="css/layui.css">
    <style>
        @media only screen and (max-width:600px ){
            .Notice {
                color: green;
                width: 10rem;
                margin: 25px auto; 
            }
            body {
            color: #ffffff;
            background: url("images/tu.jpg") 0 0 no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
            #header {
            border-radius: 36px;
            text-align: center;
            margin: 0 3%;
            background-color: #222;
            opacity: 0.9
        }
        #footer {
            border-radius: 30px;
            text-align: center;
            background-color: #222;
            /*opacity: 0.9*/
        }
        .header-t{
            padding: 10px 0;
        }
        .header-f ul {
            text-align: center;
            border-bottom: 1px solid #333
        }

        button {
            display: inline-block;
        }

        button:nth-of-type(2) {
            background-color: tomato;
        }
        #footer>div{
            padding: 10px 0;
            text-align: center;
        }
        .list-group-item{
            margin: 30px 0;
        }
        .copyphone , .copycode{
            position: relative;
        }
        .copyphone button{
            width: 45%;
            position: absolute;
            top: 0;
            right: 0;
        }
        .copycode button{
            width: 45%;
            position: absolute;
            top: 0;
            right: 0;
        }

        }
        @media (min-width: 600px) and (max-width: 1000000px){
            body {
            color: #ffffff;
            background: url("images/tu.jpg") 0 0 no-repeat;
            background-attachment: fixed
        }

        #header {
            border-radius: 36px;
            text-align: center;
            margin: 0 20%;
            background-color: #222;
            opacity: 0.9
        }
        #footer {
            border-radius: 30px;
            text-align: center;
            background-color: #222;
            /*opacity: 0.9*/
        }
        .header-t{
            padding: 10px 0;
        }
        .header-f ul {
            text-align: center;
            border-bottom: 1px solid #333
        }

        button {
            display: inline-block;
        }

        button:nth-of-type(2) {
            background-color: tomato;
        }

        .Notice {
            width: 400px;
            margin: 25px auto; 
        }
        #footer>div{
            padding: 10px 0;
            text-align: center;
        }
        .list-group-item{
            margin: 30px 0;
        }
        .copyphone , .copycode{
            position: relative;
        }
        .copyphone button{
            width: 30%;
            position: absolute;
            top: 0;
            right: 0;
        }
        .copycode button{
            width: 30%;
            position: absolute;
            top: 0;
            right: 0;
        }

        }
        #region{
            display: none;
            border-left: 1px solid #ed420c;
            padding: 0 1px;
        }
        .layui-select-dropdown {
            background-color: #9e9e9e;
        }
        .layui-select-title {
            background-color: #fff0;
        }
        .layui-unselect {
            background-color: #fff0;
            border-color: #666 !important;
            color: #fff;
        }
        .layui-form-select dl {
            background-color: #9E9E9E;
            color: #fff;
        }
        .layui-buy-url {
            margin-top: 5px;
        }
        .layui-buy-title {
            padding: 5px;
            border-top: 1px solid #ccc;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div id="header">
        <div class="header-t">
            <strong><?php echo ($name); ?>-手机在线验证平台</strong>
        </div>
        <div class="header-f">
            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this">在线验证</li>
                    <li>使用说明</li>
                    <?php if($extra["indextopenon"] == 'on'): ?><li data-tag="addtitle"><?php echo ($extra["indexttitle"]); ?></li><?php endif; ?>
                    
                </ul>
                <div class="Notice">
                    公告：<span><?php echo ($notice["text"]); ?></span>
                </div>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <div class="layui-form layui-form-pane">
                            <div class="list-group">
                                <div id="getphone">
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"
                                            style="border-top-left-radius: 30px;border-bottom-left-radius: 30px; background-color:#222; color:white;border:1px solid #666;">项目</label>
                                        <div class="layui-input-block">
                                            <select name="project" lay-verify="required" id="project" style="border-top-right-radius: 30px;border-bottom-right-radius: 30px; background-color:#222; color:white;border:1px solid #666;">
                                                <!-- <option value="">-选择-</option> -->
                                                <?php if(is_array($project)): foreach($project as $key=>$vo): if($vo["status"] == 1): ?><option value="<?php echo ($vo["proid"]); ?>" selected><?php echo ($vo["name"]); ?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo ($vo["proid"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if($config["id"] == 2): ?><div class="layui-form-item">
                                            <label class="layui-form-label"
                                                style="border-top-left-radius: 30px;border-bottom-left-radius: 30px; background-color:#222; color:white;border:1px solid #666;">国家</label>
                                            <div class="layui-input-block">
                                                <select name="country" lay-verify="required" id="country" style="border-top-right-radius: 30px;border-bottom-right-radius: 30px; background-color:#222; color:white;border:1px solid #666;">
                                                    <!-- <option value="">-选择-</option> -->
                                                    <?php if(is_array($country)): foreach($country as $key=>$vo): if($vo["isd"] == 1): ?><option value="<?php echo ($vo["code"]); ?>" selected><?php echo ($vo["name"]); ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo ($vo["code"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; ?>
                                                </select>
                                            </div>
                                        </div><?php endif; ?>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"
                                            style="border-top-left-radius: 30px;border-bottom-left-radius: 30px; background-color:#222; color:white;border:1px solid #666;">指定手机号</label>
                                        <div class="layui-input-block">
                                            <input type="text" class="layui-input" id="pointPhone"
                                                style="border-top-right-radius: 30px;border-bottom-right-radius: 30px; background-color:#222; color:white;border:1px solid #666;"
                                                placeholder="如需指定手机号，请输入手机号码">
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"
                                            style="border-top-left-radius: 30px;border-bottom-left-radius: 30px; background-color:#222; color:white;border:1px solid #666;">卡密</label>
                                        <div class="layui-input-block">
                                            <input type="text" class="layui-input" id="code"
                                                style="border-top-right-radius: 30px;border-bottom-right-radius: 30px; background-color:#222; color:white;border:1px solid #666;"
                                                placeholder="请先输入卡密">
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="isture" style="display: none;">
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"
                                            style="border-top-left-radius: 30px;border-bottom-left-radius: 30px;background-color:#222; color:white;border:1px solid #666;display: flex;justify-content: center;">手机号&nbsp;<span id="region"></span></label>
                                        <div class="layui-input-block  copyphone">
                                            <input type="text" class="layui-input" id="phone" readonly="readonly"
                                                   style="border-top-right-radius: 30px;border-bottom-right-radius: 30px;background-color:#222; color:white;border:1px solid #666;">
                                            <button class="layui-btn layui-btn-primary layui-btn-normal" id="cp" data-clipboard-action="copy" data-clipboard-target="#phone"
                                                    style="color: #ffffff;border-radius:0 30px 30px 0;">
                                                复制手机号
                                            </button>
                                        </div>
                                    </div>
                                    <div class="layui-form-item copycode">
                                        <label class="layui-form-label"
                                            style="border-top-left-radius: 30px;border-bottom-left-radius: 30px;background-color:#222; color:white;border:1px solid #666;">验证码</label>
                                        <div class="layui-input-block"   style="vertical-align: center">
                                            <input type="text" class="layui-input" id='codes'  readonly="readonly" 
                                                   style="border-top-right-radius: 30px;border-bottom-right-radius: 30px;background-color:#222; color:white;border:1px solid #666;">

                                            <button class="layui-btn layui-btn-primary layui-btn-normal" id="cc" data-clipboard-action="copy" data-clipboard-target="#codes"
                                                    style="color: #ffffff;border-radius: 0 30px 30px 0;">
                                                复制验证码
                                            </button>
                                        </div>
                                    </div>
                                    <span></span>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"
                                            style="border-top-left-radius: 30px;border-bottom-left-radius: 30px;background-color:#222; color:white;border:1px solid #666;">内容</label>
                                        <div class="layui-input-block">
                                            <input type="text" class="layui-input" id="sms" disabled="disabled"
                                                style="border-top-right-radius: 30px;border-bottom-right-radius: 30px;background-color:#222; color:white;border:1px solid #666;">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="list-group-item" style="text-align: center">
                            <button class="layui-btn layui-btn-primary layui-btn-normal"
                                style="width: 65%;color: #ffffff;border-radius: 30px;" id="btn" tid="1">
                                登录获取手机号
                            </button>
                            <?php if($buyurl): ?><div class="layui-buy-url">
                                    <div class="layui-buy-title">卡密购买链接</div>
                                    <div class="layui-btn-group">
                                        <?php if(is_array($buyurl)): foreach($buyurl as $key=>$vo): ?><a href="<?php echo ($vo["url"]); ?>" class="layui-btn layui-btn-primary layui-btn-sm layui-buy-item" target="_blank" style="margin-left: 5px !important;border-radius: 5px;">
                                                <?php echo ($vo["title"]); ?>
                                            </a><?php endforeach; endif; ?>
                                    </div>
                                </div><?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="layui-tab-item">
                        <span> 使用说明</span>
                        <?php echo (htmlspecialchars_decode($extra["content"])); ?>
                    </div>
                    <div class="layui-tab-item">
                        <hr>
                        <div style="margin:5px;0 px;text-indent:28px;"><?php echo ($extra["indextimgtip"]["0"]); ?></div>
                        <?php if($config.indextimg[0]): ?><img src="<?php echo ($extra["indextimg"]["0"]); ?>" tppabs="<?php echo ($extra["indextimg"]["0"]); ?>" width="100%" height="100%/"><?php endif; ?>
                        <br>
                        <!-- <hr> -->
                        <div style="margin:5px;0 px;text-indent:28px;"><?php echo ($extra["indextimgtip"]["1"]); ?></div>
                        <?php if($config.indextimg[0]): ?><img src="<?php echo ($extra["indextimg"]["1"]); ?>" tppabs="<?php echo ($extra["indextimg"]["1"]); ?>" width="100%" height="100%/"><?php endif; ?>
                        <br>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="footer-notice">
            <?php echo ($notice["content"]); ?>
        </div>
        <div class="footer-extra" hidden="true">
            <?php echo (htmlspecialchars_decode($extra["notice"])); ?>
        </div>
    </div>
    <input type="hidden" id="time" value="<?php echo ($config["time"]); ?>">
</body>
<script type="text/javascript" src="layui/layui.all.js"></script>
<script type="text/javascript" src="js/jquery-3.1.0.js"></script>
<script type="text/javascript" src="js/layer.js"></script>
<script type="text/javascript" src="js/clipboard.min.js"></script>
<script>
    layui.use(['element','layer',], function () {
        var element = layui.element,
        layer = parent.layer === undefined ? layui.layer : top.layer;
    });

    time = $("#time").val();
    alltime = $("#time").val();
    num = 0;
    set= '';
    sets = '';
    let sphone = '';
    codes = '';
    let code = '';
    let pk = '';
    let region = '';
    let proid = '';
    let country = '';
    let pointPhone = '';
    $("#btn").click(function(){
            code = $("#code").val();
            time = $("#time").val();
            proid = $('#project').val();
            country = $('#country').val();
            pointPhone = $('#pointPhone').val();
            num = 0;
            $("#codes").val("");
            if(code == ''){
                layer.msg("<span style='color: black'>请正确输入卡密</span>",{icon:5});
                return false;
            }
            $.post('/home/index/getcode',{code:code},function(res){
                if(res.code==0){
                    var index = layer.msg("<span style='color: black'>"+res.msg+"，请稍后...</span>",{icon:16,time:false});
                    $.post('/home/index/getphone',{code:code,phone:pointPhone,project:proid,country:country},function(result){
                        layer.close(index);
                        if(result.code==0){
                            var msg = result.msg;
                            msg = msg.substring(1,7);
                            layer.msg("<span style='color: black'>"+result.msg+"，手机号获取成功</span>",{icon:6,time:2000});
                            $("#isture").show();
                            var phone = result.phone;
                            if (result.pkey) {
                                region = result.region;
                                $('#region').show();
                                $('#region').html(region);
                            }
                            if (result.time) {
                                time = time - result.time;
                                num = Math.ceil(result.time/10);
                                $("#codes").val("获取验证码第("+num+")次");
                            }
                            sphone = phone;
                            $("#phone").val(sphone);
                            $("#btn").attr('tid',2);
                            pk = result.pkey;
                            countDown();
                            // countnum();
                        }else{
                            layer.msg("<span style='color: black'>"+result.msg+"</span>",{icon:5,time:2000});
                        }
                    })
                }else{
                    layer.msg("<span style='color: black'>"+res.msg+"</span>",{icon:5});
                    if(res.code==2){
                        $("#isture").show();
                        $("#btn").text("成功获取验证码");
                        $("#btn").attr('disabled','disabled');
                        $("#phone").val(res.phone);
                        sphone = res.phone;
                        var sms = res.sms;
                        $("#sms").val(res.sms);
                        var scode = sms.match(/\d+/);
                        codes = scode[0];
                        $("#codes").val(scode);
                    }
                }
            })
    })

    
    function countDown(){
        if (time%10 == 0) {
            countnum();
        }
        time = time-1;
        if(time<=0){
            $("#btn").text("点击重新获取手机号");
            $("#btn").removeAttr('disabled');
        }else{
            $("#btn").text("正在接收验证码("+time+"秒)");
            $("#btn").attr('disabled','disabled');
            set = setTimeout(countDown, 1000);
        }
    }

    function countnum(){
        num = num +1;
        let all = Math.ceil(alltime/10);
        getCodes();
        if (all+1 <= num) {
            clearTimeout(sets);
            return;
        }
        $("#codes").val("获取验证码第("+num+")次");
        // sets = setTimeout(countnum, 10000);
    }

    function getCodes()
    {
        $.post('/home/index/getcodes',{phone:sphone,code:code,key:pk,region:region,project:proid,country:country,pointphone:pointPhone},function(result1){
            if(result1.code == 0){
                clearTimeout(set);
                clearTimeout(sets);
                var msg = result1.msg;
                msg = msg.substring(1,7);
                layer.msg("<span style='color: black'>"+result1.msg+"，验证码获取成功</span>",{icon:6,time:2000});
                $("#btn").text("成功获取验证码");
                $("#btn").attr('disabled','disabled');
                var sms = result1.sms;
                var scode = sms.match(/\d+/);
                codes = scode[0];
                $("#codes").val(scode);
                $("#sms").val(sms);
            }
            else if(result1.code == 1){
                clearTimeout(set);
                clearTimeout(sets);
                layer.msg("<span style='color: black'>"+result1.msg+"</span>",{icon:5,time:2000});
                $("#sms").val('获取失败，请点击按钮重新获取');
                $("#btn").text("点击重新获取手机号");
                $("#btn").removeAttr('disabled');
            }
        })
    }
    $('.layui-tab-title li').click(function(){
        var tag = $(this).data('tag');
        if (tag == 'addtitle') {
            $('.footer-notice').hide();
            $('.footer-extra').show();
        }else{
            $('.footer-extra').hide();
            $('.footer-notice').show();
        }
    })
    var clipboard = new ClipboardJS('#cp');

    clipboard.on('success', function(e) {
        layer.msg("<span style='color: black'>复制成功！</span>",{icon:6});
    });

    clipboard.on('error', function(e) {
        layer.msg("<span style='color: black'>复制失败，请手动复制</span>",{icon:5});
    });

    var clipboard1 = new ClipboardJS('#cc');

    clipboard1.on('success', function(e) {
        layer.msg("<span style='color: black'>复制成功！</span>",{icon:6});
    });

    clipboard1.on('error', function(e) {
        layer.msg("<span style='color: black'>复制失败，请手动复制</span>",{icon:5});
    });
</script>

</html>