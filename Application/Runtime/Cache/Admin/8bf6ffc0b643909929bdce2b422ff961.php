<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Notice--管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/Public/static/layui/css/layui.css" media="all"/>
    <link rel="stylesheet" href="/Public/static/css/public.css" media="all"/>
</head>
<body class="childrenBody">
    <blockquote class="layui-elem-quote quoteBox">
        <form class="layui-form">
            <div class="layui-inline">
                <div class="layui-input-inline" style="width: 16%">
    <input type="search" name="id" autocomplete="off" class="layui-input" placeholder="ID"/>
</div>
                <div class="layui-btn-group">
                    <a class="layui-btn layui-btn-green  layui-btn-sm search_btn" title="搜索">
                        <i class="layui-icon layui-icon-search "></i>
                    </a>
                    <a class="layui-btn layui-btn-normal layui-btn-sm add_btn layui-hide" title="添加">
                        <i class="layui-icon layui-icon-add-circle"></i>
                    </a>
                    <a class="layui-btn layui-btn-danger layui-btn-sm layui-hide delAll_btn" title="批量删除">
                        <i class="layui-icon layui-icon-delete"></i>
                    </a>
                    <a class="layui-btn layui-btn-sm" title="刷新当前页" href="javascript:void(0);"
                            onclick="layer.load(1);window.location.reload(true);"><i class="layui-icon">&#xe669;</i></a>
                </div>
            </div>
        </form>
    </blockquote>
    <table id="table" lay-filter="table"></table>
    <!--操作-->
    <script type="text/html" id="tool">
        <div class="layui-btn-group">
        <a class="layui-btn layui-btn-sm " lay-event="edit" title="编辑">
            <i class="layui-icon layui-icon-edit"></i>
        </a>
        <a class="layui-btn layui-btn-sm layui-btn-danger layui-hide" lay-event="del" title="删除">
            <i class="layui-icon layui-icon-delete"></i>
        </a>
        </div>
    </script>
<script type="text/javascript" src="/Public/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/static/layui/layui.js"></script>
<script type="text/javascript">
    var tablist = '';
    layui.use(['form', 'layer', 'table', 'laytpl'], function () {
        let form = layui.form,
            layer = parent.layer === undefined ? layui.layer : top.layer,
            laytpl = layui.laytpl,
            table = layui.table;
        //规则列表
        tablist = table.render({
            elem: '#table',
            url: '/admin/Notice/index',
            method: 'post',
            page:true,
            limit: 15,
            limits: [15, 20, 50, 100],
            cellMinWidth: 95,
            height: "full-85",
            id: "table",
            cols: [[
                
{field:'id',title:'ID',align:'center',width:80},{field:'text',title:'顶部公告',align:'center'},{field:'content',title:'底部公告',align:'center'},
{title: '操作',templet:'#tool', width:130,fixed: "right", align: "center"}
            ]]
        });
        //搜索
        $(".search_btn").on("click", function () {
            tablist.reload({
                where:{
                    para:$('form').serialize()
                }
            });
        });

        //添加
        function addoredit(url,name) {
            let index = layui.layer.open({
                title: name,
                type: 2,
                content: url,
                area:['60%','96%'],
                maxmin:true
            });
        }

        $(".add_btn").on('click',function () {
            addoredit('/admin/Notice/add','添加');
        });

        //批量删除
        $(".delAll_btn").on('click',function () {
            let checkStatus = table.checkStatus('table'),
                data = checkStatus.data,
                ids = [];
            if (data.length > 0) {
                for (let i in data) {
                    ids.push(data[i].id);
                }
                layer.confirm('确定删除选中的数据？', {icon: 3, title: '提示信息'}, function (index) {
                    $.post("/admin/Notice/delete",{'id':ids},function(data){
                        window.parent.toast(data.info,data.code);
                        if(data.code === 0)
                        tablist.reload();
                    });
                    layer.close(index);
                })
            } else {
                layer.msg("请选择需要删除的数据");
            }
        });

        //列表操作
        table.on('tool(table)', function (obj) {
            let layEvent = obj.event,
                data = obj.data;
            if (layEvent === 'edit') { //编辑
                addoredit('/admin/Notice/edit/id/'+data.id,'修改');
            } else if (layEvent === 'del') { //删除
                layer.confirm('确定删除这条数据？', {icon: 3, title: '提示'}, function (index) {
                    layer.close(index);
                    $.post("/admin/Notice/delete",{'id':data.id},function(data){
                        window.parent.toast(data.info,data.code);
                        if(data.code === 0)
                            tablist.reload();
                    });
                });
            }
        });
        if(window.parent.NProgress){
            window.parent.NProgress.done();
        }
    })
</script>
</body>
</html>