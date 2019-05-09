<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>座位管理后台 - Layui</title>
  <link rel="stylesheet" href="/tsg/Public/Admin/./layui/css/layui.css">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">座位管理后台</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">

    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
          贤心
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="">安全设置</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="">退了</a></li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
      

        <li class="layui-nav-item">
          <a href="javascript:;">用户管理</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo U('User/showList');?>">用户列表</a></dd>
            <dd><a href="<?php echo U('User/add');?>">添加用户</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
            <a href="javascript:;">座位管理</a>
            <dl class="layui-nav-child">
                <dd><a href="<?php echo U('Seat/showList');?>">座位列表</a></dd>
                <dd><a href="<?php echo U('Seat/add');?>">添加座位</a></dd>
   
            </dl>
        </li>
        <li class="layui-nav-item">
            <a href="javascript:;">座位使用表</a>
            <dl class="layui-nav-child">
                <dd><a href="<?php echo U('Uselog/showList');?>">使用列表</a></dd>
            </dl>
        </li>
      </ul>
    </div>
  </div>
  
  <div class="layui-body">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">
        <fieldset class="layui-elem-field">
            <legend>座位管理-系统介绍</legend>
            <div class="layui-field-box">
                <table class="layui-table">
                    <colgroup>
                        <col width="150">
                        <col width="200">
                        <col>
                    </colgroup>
                    <thead>
                        <tr>
  
                        </tr> 
                    </thead>
                    <tbody>
                     <tr>
                        <td>1.作为一名新时代的大学生，手机自然是离不开大家左右的。我们做的这个产品正是基于手机微信小程序的，一个手机即可实现通过查看、选择座位等操作，快速的选上适合自己的座位，准确找到所占位置，然后进行学习，方便快捷。</td>
                     </tr>                                     
                     <tr>
                        <td>2. web后台管理系统包括用户管理、座位管理和使用记录。在用户管理系统可以很清晰的看到用户的信息，可以很方便的对用户信息进行修改或删除增加用户信息。</td>
					 </tr>
					 <tr>
                        <td>3. 数字化，人性化，智能化将会成为以后图书馆发展的方向。我们开发的这款基于微信小程序的图书馆扫码占座系统，通过让座位“上网”、“上云”，运用物联网的思维，将座位和网络连接起来，形成一套完整的座位管理体系。</td>
                     </tr>
                      
                    </tbody>
                </table>
            </div>
        </fieldset>
        <fieldset class="layui-elem-field">
          <legend>最新公告</legend>
          <div class="layui-field-box">
              <table class="layui-table">
                  <colgroup>
                      <col width="150">
                      <col width="200">
                      <col>
                  </colgroup>
                  <thead>
                      <tr>
                      <th>昵称</th>
                      <th>加入时间</th>
                      <th>签名</th>
                      </tr> 
                  </thead>
                  <tbody>
                      <tr>
                      <td>贤心</td>
                      <td>2016-11-29</td>
                      <td>人生就像是一场修行</td>
                      </tr>
                      <tr>
                      <td>许闲心</td>
                      <td>2016-11-28</td>
                      <td>于千万人之中遇见你所遇见的人，于千万年之中，时间的无涯的荒野里…</td>
                      </tr>
                      <tr>
                      <td>sentsin</td>
                      <td>2016-11-27</td>
                      <td> Life is either a daring adventure or nothing.</td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </fieldset>
    </div>
  </div>
  
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    临沂大学
  </div>
</div>
<script type="text/javascript" src="/tsg/Public/Admin/./javascript/jquery.min.js"></script>
<script type="text/javascript" src="/tsg/Public/Admin/./layui/layui.js"></script>
<script type="text/javascript" src="/tsg/Public/Admin/./javascript/index.js"></script>
</body>
</html>