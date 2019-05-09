<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>提交座位信息</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">

		<link rel="stylesheet" href="/Public/Admin1/plugins/layui/css/layui.css" media="all" />
		<link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">
	</head>

	<body>
		<div style="margin: 15px;">
			<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
				<legend>座位信息添加
				</legend>
			</fieldset>

			<form class="layui-form" action="" method="POST">
				<div class="layui-form-item">
					<label class="layui-form-label">
						座位编号
					</label>
					<div class="layui-input-block">
						<input style="width: 190px" type="text" name="seatid"  autocomplete="off" placeholder="请输入编号" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">
						楼层
					</label>
					<div class="layui-input-block">
						<input style="width: 190px" type="text" name="floor"  placeholder="请输入楼层" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">
						区域
					</label>
					<div class="layui-input-inline">
						<input type="text" name="area"  autocomplete="off" placeholder="请输入区域" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">
						号码
					</label>
					<div class="layui-input-inline">
						<input type="text" name="num"  autocomplete="off" placeholder="请输入号码" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-input-block">
						<button class="layui-btn layui-btn-radius" lay-submit="" lay-filter="demo1">立即提交</button>
						<button type="reset" class="layui-btn layui-btn-warm layui-btn-radius">重置</button>
					</div>
				</div>
			</form>
		</div>
		<script type="text/javascript" src="/Public/Admin1/plugins/layui/layui.js"></script>
		<script>
			layui.use(['form', 'layedit', 'laydate'], function() {
				var form = layui.form(),
					layer = layui.layer,
					layedit = layui.layedit,
					laydate = layui.laydate;

				//创建一个编辑器
				var editIndex = layedit.build('LAY_demo_editor');
				//自定义验证规则
				form.verify({
					title: function(value) {
						if(value.length < 12) {
							return '学号需要12个字符啊';
						}
					},
					pass: [/(.+){6,12}$/, '密码必须6到12位'],
					content: function(value) {
						layedit.sync(editIndex);
					}
				});

				//监听提交
				form.on('submit(demo1)', function(data) {
					layer.alert(JSON.stringify(data.field), {
						title: '最终的提交信息'
					})
					$('form').submit();
					return false;
				});
			});
		</script>
	</body>

</html>