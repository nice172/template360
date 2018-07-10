<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"E:\job\template360\public/../application/admin\view\user\index.php";i:1531208598;s:57:"E:\job\template360\application\admin\view\public\base.php";i:1531193304;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache"> 
<meta http-equiv="cache-control" content="no-cache, must-revalidate"> 
<meta http-equiv="expires" content="0">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<meta content="email=no" name="format-detection">
<title>Template360后台管理</title>
<link rel="stylesheet" href="/static/layui/css/layui.css">
<link rel="stylesheet" href="/static/admin/css/admin.css">

<!--[if lt IE 9]>
  <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">Template360</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="">控制台</a></li>
      <li class="layui-nav-item"><a href="">商品管理</a></li>
      <li class="layui-nav-item"><a href="">用户</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="">邮件管理</a></dd>
          <dd><a href="">消息管理</a></dd>
          <dd><a href="">授权管理</a></dd>
        </dl>
      </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;"><?php echo $user['username']; ?></a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="">安全设置</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="<?php echo url('user/logout'); ?>">退出</a></li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        <li class="layui-nav-item layui-nav-itemed">
          <a class="" href="javascript:;">基本设置</a>
          <dl class="layui-nav-child">
            <dd><a href="javascript:;">列表一</a></dd>
            <dd><a href="javascript:;">列表二</a></dd>
            <dd><a href="javascript:;">列表三</a></dd>
            <dd><a href="">超链接</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">管理员管理</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo url('user/index'); ?>">管理员列表</a></dd>
            <dd><a href="javascript:;">列表二</a></dd>
            <dd><a href="">超链接</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item"><a href="">云市场</a></li>
        <li class="layui-nav-item"><a href="">发布商品</a></li>
      </ul>
    </div>
  </div>
  
  <div class="layui-body">
    <div class="layui-card layadmin-header">
      <div class="layui-breadcrumb" lay-filter="breadcrumb" style="visibility: visible;">
        <a href="<?php echo url('index/main'); ?>">主页</a><span lay-separator="">/</span>
        <a lay-href="">管理员管理</a><span lay-separator="">/</span>
        <a><cite>管理员列表</cite></a>
      </div>
    </div>
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">
    

  <div class="layui-row layui-col-space15">
    <div class="layui-col-md12">
      <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
              <button class="layui-btn layui-btn-primary openWindow" window-size="400,450" url="<?php echo url('adduser'); ?>" data-type="add">新增管理员</button>
         </div>
        <div class="layui-card-body">
          
<table class="layui-table layui-form">
  <thead>
    <tr>
      <th>ID</th>
      <th>用户名</th>
      <th>邮箱</th>
      <th>最后登录IP</th>
      <th>最后登录时间</th>
      <th>状态</th>
      <th>注册IP</th>
      <th>新增时间</th>
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
  <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
    <tr>
      <td><?php echo $v['id']; ?></td>
      <td><?php echo $v['username']; ?></td>
      <td><?php echo $v['email']; ?></td>
      <td><?php echo $v['last_login_ip']; ?></td>
      <td><?php echo date('Y-m-d H:i:s',$v['last_login_time']); ?></td>
      <th>
       <?php if($v['status']): ?>
       <input type="checkbox"  value="<?php echo $v['id']; ?>" checked="checked" name="open" lay-skin="switch" lay-filter="switchTest" title="开启">
       <?php else: ?>
       <input type="checkbox" <?php if($v['id'] == 1): ?>disabled="disabled"<?php endif; ?> value="<?php echo $v['id']; ?>" name="open" lay-skin="switch" lay-filter="switchTest" title="禁用">
       <?php endif; ?>
      </th>
      <td><?php echo $v['register_ip']; ?></td>
      <td><?php echo date('Y-m-d H:i:s',$v['add_time']); ?></td>
      <td>
      <button class="layui-btn layui-btn-primary layui-btn-xs">查看</button>
    <button class="layui-btn layui-btn-xs">编辑</button>
    <button class="layui-btn layui-btn-danger layui-btn-xs">删除</button>
      </td>
    </tr>
   <?php endforeach; endif; else: echo "" ;endif; ?>
  </tbody>
</table>
          
          
        </div>
      </div>
    </div>
  </div>


    </div>
  </div>
  
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © template360.com - 底部固定区域
  </div>
</div>
<script type="text/javascript" src="/static/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/static/layui/layui.all.js"></script>
<script type="text/javascript" src="/static/admin/js/common.js"></script>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
});
</script>

<script>
//监听指定开关
	var form = layui.form;
	form.on('switch(switchTest)', function(data){
		if(this.checked){
			var status = 1;
		}else{
			var status = 0;
		}
		$.ajax({
			url:'<?php echo url("status"); ?>',type:'POST',
			data:{id:data.value,status:status},success: function(res){
				if(res.code == 0){
					$(data.othis).addClass('layui-form-onswitch');
					layer.msg(res.msg,{shade:0.3,icon:2,shift:6});
					}
			}
		});
	});



</script>

</body>
</html>