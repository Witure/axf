<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>提交用户信息</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">

		<link rel="stylesheet" href="/tsg/Public/Admin1/plugins/layui/css/layui.css" media="all" />
		<link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">
	</head>

	<body>
		<div style="margin: 15px;">
			<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
				<legend>用户信息添加
				</legend>
			</fieldset>

			<form class="layui-form" action="" method="POST">
				<div class="layui-form-item">
					<label class="layui-form-label">
						学号
					</label>
					<div class="layui-input-block">
						<input style="width: 190px" type="text" name="studyid"  autocomplete="off" placeholder="请输入学号" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">
						姓名
					</label>
					<div class="layui-input-block">
						<input style="width: 190px" type="text" name="name"  placeholder="请输入姓名" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">
						手机号码
					</label>
					<div class="layui-input-inline">
						<input type="tel" name="phone"  autocomplete="off" placeholder="请输入手机号码" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">
							选择学院

						</label>
						<div class="layui-input-block">
								<select name="unit" >
								  <option value=""></option>
								  <option value="信息科学与工程学院">信息科学与工程学院</option>
								  <option value="商学院">商学院</option>
								  <option value="机械车辆与工程学院">机械车辆与工程学院</option>
								  <option value="药学院">药学院</option>
								  <option value="音乐学院">音乐学院</option>
								</select>
							  </div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">
							所学专业
						</label>
						<div class="layui-input-block">
								<input type="text" name="major" required  placeholder="请输入所学专业" autocomplete="off" class="layui-input">   						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">班级</label>
						<div class="layui-input-block">
								<select name="class">
									<option value="">请选择班级</option>
									<option value="01班">01班</option>
									<option value="02班">02班</option>
									<option value="03班">03班</option>
								</select>
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">单选框</label>
					<div class="layui-input-block">
						<input type="radio" name="sex" value="1" title="男" checked="">
						<input type="radio" name="sex" value="2" title="女">
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
		<script type="text/javascript" src="/tsg/Public/Admin1/plugins/layui/layui.js"></script>
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