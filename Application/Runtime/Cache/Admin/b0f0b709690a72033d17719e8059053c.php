<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>X-Man管理模板</title>
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

	<div class="layui-row">
			<table class="layui-table layui-form">
		        <tbody class="x-cate">
		          <tr>
	                    <th>网站名称</th>
	                    <td><?php echo ($info['网站名称']); ?></td></tr>
	                <tr>
	                    <th>操作系统</th>
	                    <td><?php echo ($info['操作系统']); ?></td></tr>
	                <tr>
	                    <th>运行环境</th>
	                    <td><?php echo ($info['运行环境']); ?></td></tr>
	                <tr>
	                    <th>PHP运行方式</th>
	                    <td><?php echo ($info['PHP运行方式']); ?></td></tr>
	                <tr>
	                    <th>PHP版本</th>
	                    <td><?php echo ($info['PHP版本']); ?></td></tr>
	                <tr>
	                    <th>上传附件限制</th>
	                    <td><?php echo ($info['上传附件限制']); ?></td></tr>
	                <tr>
	                    <th>执行时间限制</th>
	                    <td><?php echo ($info['执行时间限制']); ?></td></tr>
	                <tr>
	                    <th>服务器时间</th>
	                    <td><?php echo ($info['服务器时间']); ?></td></tr>
	                <tr>
	                    <th>北京时间</th>
	                    <td><?php echo ($info['北京时间']); ?></td></tr>
	                <tr>
	                    <th>服务器域名/IP</th>
	                    <td><?php echo ($info['服务器域名/IP']); ?></td></tr>
	                <tr>
	                    <th>剩余空间/IP</th>
	                    <td><?php echo ($info['剩余空间']); ?></td></tr>
		        </tbody>
		      </table>
	</div>
	<script type="text/javascript" src="/Public/static/layui/layui.js"></script>
	<script type="text/javascript" src="/Public/static/js/jquery-3.2.0.min.js"></script>
	<script type="text/javascript" src="/Public/static/js/main.js"></script>
	<script type="text/javascript">
		

	</script>
</body>
</html>