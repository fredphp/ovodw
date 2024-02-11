<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>接口设置</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/Public/static/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/Public/static/css/public.css" media="all" />
    <style> .layui-form-label {
        width: 160px !important;
    }

    .layui-input-block {
        margin-left: 160px !important;
    }
    </style>
</head>
<body class="childrenBody">
<form class="layui-form layui-form-pane" style="width:60%;padding-left: 10%; margin-top: 20px;" >
    <div class="layui-form-item" pane="">
        <div class="layui-input-block">
            <?php if(is_array($api)): $k = 0; $__LIST__ = $api;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><input type="radio" lay-filter="channel" name="channel" value="<?php echo ($v["id"]); ?>" title="接口通道<?php echo ($k); ?>" <?php if($v["isuse"] == 1): ?>checked=""<?php endif; ?> ><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <?php if(is_array($api)): $k = 0; $__LIST__ = $api;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div style="display: <?php if($v["isuse"] == 1): ?>block <?php else: ?> none;<?php endif; ?>;" class="form-api form-api-<?php echo ($v["id"]); ?>">
            <div class="layui-form-item" <?php if($v["id"] != 2): ?>hidden="true"<?php endif; ?> >
                <label class="layui-form-label">所在国家<?php echo ($v["nation"]); ?></label>
                <div class="layui-input-block">
                    <!-- <input type="text" name="nation[<?php echo ($v["id"]); ?>]" placeholder="所在国家"  autocomplete="off"  maxlength="255" value="<?php echo ($v["nation"]); ?>"  class="layui-input"> -->
                    <select name="nation[<?php echo ($v["id"]); ?>]" lay-filter="nation">
                        <option value="">-所在国家-</option>
                        <?php if(is_array($nation)): $ke = 0; $__LIST__ = $nation;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($ke % 2 );++$ke; if($vo["code"] == $v['nation']): ?><option value="<?php echo ($vo["code"]); ?>"  selected=""><?php echo ($vo["name"]); ?></option>
                            <?php else: ?>
                                <option value="<?php echo ($vo["code"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">接码等待时间(秒)</label>
                <div class="layui-input-block">
                    <input type="number" name="time[<?php echo ($v["id"]); ?>]" placeholder="接码等待时间"  autocomplete="off"  maxlength="255" value="<?php echo ($v["time"]); ?>"  class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">购卡地址</label>
                <div class="layui-input-block">
                    <input type="text" name="url[<?php echo ($v["id"]); ?>]"  placeholder="购卡地址"  autocomplete="off"  maxlength="255" value="<?php echo ($v["url"]); ?>"  class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">项目ID</label>
                <div class="layui-input-block">
                    <input type="text" name="project[<?php echo ($v["id"]); ?>]" placeholder="项目ID"  autocomplete="off"  maxlength="255" value="<?php echo ($v["project"]); ?>"  class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">API用户名</label>
                <div class="layui-input-block">
                    <input type="text" name="username[<?php echo ($v["id"]); ?>]" placeholder="API用户名"  autocomplete="off"  maxlength="255" value="<?php echo ($v["username"]); ?>"  class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">API密码</label>
                <div class="layui-input-block">
                    <input type="password" name="password[<?php echo ($v["id"]); ?>]" placeholder="API密码"  autocomplete="off"  maxlength="255" value="<?php echo ($v["password"]); ?>"  class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">接码token</label>
                <div class="layui-input-block">
                    <input type="text" name="token[<?php echo ($v["id"]); ?>]" placeholder="接码token"  autocomplete="off"  maxlength="255" value="<?php echo ($v["token"]); ?>"  class="layui-input api-token">
                    <button class="layui-btn btn-token" type="button" id="btn" data-api="<?php echo ($v["id"]); ?>">获取token</button>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">API地址</label>
                <div class="layui-input-block">
                    <input type="text" name="api[<?php echo ($v["id"]); ?>]" placeholder="API地址"  autocomplete="off"  maxlength="255" value="<?php echo ($v["api"]); ?>"  class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">成功状态码</label>
                <div class="layui-input-block">
                    <input type="number" name="code[<?php echo ($v["id"]); ?>]" placeholder="成功状态码"  autocomplete="off"  maxlength="255" value="<?php echo ($v["code"]); ?>"  class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">提示信息内容字段</label>
                <div class="layui-input-block">
                    <input type="text" name="msg[<?php echo ($v["id"]); ?>]" placeholder="提示信息内容字段"  autocomplete="off"  maxlength="255" value="<?php echo ($v["msg"]); ?>"  class="layui-input">
                </div>

            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">手机号内容字段</label>
                <div class="layui-input-block">
                    <input type="text" name="phone[<?php echo ($v["id"]); ?>]" placeholder="手机号内容字段"  autocomplete="off"  maxlength="255" value="<?php echo ($v["phone"]); ?>"  class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">短信内容字段</label>
                <div class="layui-input-block">
                    <input type="text" name="sms[<?php echo ($v["id"]); ?>]" placeholder="短信内容字段"  autocomplete="off"  maxlength="255" value="<?php echo ($v["sms"]); ?>"  class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" style="margin-top: 30px;">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="addData">提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
</form>
<script type="text/javascript" src="/Public/static/js/jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="/Public/static/layui/layui.js"></script>
<script type="text/javascript">
    layui.use(['form','layer','laydate','upload','layedit'],function(){
        let form = layui.form,
            laydate = layui.laydate,
            upload = layui.upload,
            layedit = layui.layedit,
            layer = parent.layer === undefined ? layui.layer : top.layer;

        form.on("submit(addData)",function(data){
            let index = layer.msg('数据提交中，请稍候',{icon: 16,time:false});
            $.post("/admin/Api/index",data.field,function(res){
                layer.close(index);

                window.parent.window.parent.toast(res.msg,res.code);
                layer.close(index);
                if(0 === res.code){
                    window.location.reload();
                }
            });
            return false;
        });


        form.on('radio(channel)', function (data) {　　
        　　var value = data.value;   //  当前选中的value值
            $('.form-api').css("display","none");
            $('.form-api-'+value).css("display","block");
        });


    });

    $(".btn-token").click(function(){
        let index = layer.msg('获取中，请稍候',{icon: 16,time:false});
        let _this = $(this);
        let id = _this.data('api');
        $.post('/admin/api/gettoken',{id:id},function (res) {
            layer.close(index);
            if(0 === res.code){
                layer.msg(res.msg,{icon: 6,time:2000});
                // $("#token").val(res.token);
                _this.prev().val(res.token);
                return false;
            }else{
                layer.msg(res.msg,{icon:5,time:2000});
                return false;
            }
        })
    })


</script>
</body>
</html>