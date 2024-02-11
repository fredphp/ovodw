<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>修改</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/Public/static/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/Public/static/css/public.css" media="all" />
</head>
<body class="childrenBody">
<form class="layui-form layui-form-pane" lay-filter="form1" style="width:90%;padding-left: 5%;">
	<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"><div class="layui-form-item">
	<div class="layui-form-item">
        <label class="layui-form-label" for="type">项目类型</label>
        <div class="layui-input-block">
          <input type="radio" name="type" value="1" title="1号接口">
          <input type="radio" name="type" value="2" title="2号接口">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" for="name">项目名称</label>
        <div class="layui-input-block">
            <input type="text" id="name" name="name" placeholder="请输入项目名称"  autocomplete="off" value=""  class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" for="vals">项目值</label>
        <div class="layui-input-block">
            <input type="text" id="vals" name="vals" placeholder="请输入项目值"  autocomplete="off" value=""  class="layui-input">
        </div>
    </div>
     <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
            <?php if($info["status"] == 1): ?><input type="checkbox"  lay-skin="switch" id="status-switch" lay-text="开启默认|关闭默认" checked>
            <?php else: ?>
                <input type="checkbox"  lay-skin="switch" id="status-switch" lay-text="开启默认|关闭默认"><?php endif; ?>
            <input type="hidden" name="status">
        </div>
     </div>

    <div class="layui-form-item" style="margin-top: 30px;">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="addData">提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
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

        form.val("form1",{
                    'type': '<?php echo ($info["type"]); ?>',
                    'status': '<?php echo ($info["status"]); ?>',
                    'name': '<?php echo ($info["name"]); ?>',
                    'vals': '<?php echo ($info["vals"]); ?>'});

        form.on("submit(addData)",function(data){
            let index = layer.msg('数据提交中，请稍候',{icon: 16,time:false});
            $.post("/admin/Project/edit",{para:$('form').serialize()},function(res){
                window.parent.window.parent.toast(res.info,res.code);
                layer.close(index);
                if(0 === res.code){
                    parent.layer.closeAll();
                    window.parent.tablist.reload();
                }
            });
            return false;
        });
        form.on('switch', function(data){
            var hiddenInput = $('input[name="status"]');
            if (data.elem.checked) {
                hiddenInput.val(1); // 设置开关打开时隐藏域的值为1
            } else {
                hiddenInput.val(0); // 设置开关关闭时隐藏域的值为0
            }
        });
    });
</script>
</body>
</html>