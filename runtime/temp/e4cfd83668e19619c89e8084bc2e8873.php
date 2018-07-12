<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:64:"E:\job\template360\public/../application/admin\view\menu\add.php";i:1531374692;s:57:"E:\job\template360\application\admin\view\public\base.php";i:1531293051;}*/ ?>
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

<style>/*.layui-form-select{width:300px;}*/.layui-word-aux-left{margin-left:110px;}</style>

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
            <dd><a href="<?php echo url('Menu/index'); ?>">菜单管理</a></dd>
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
    
<form class="layui-form" action="">
  <div class="layui-row layui-col-space15">
	
    <div class="layui-col-md6">
      <div class="layui-card">
        <div class="layui-card-header">菜单配置</div>
        <div class="layui-card-body">
        
<div class="layui-form-item">
    <label class="layui-form-label">上级菜单</label>
    <div class="layui-input-block">
      <select name="city">
      	<option value="">顶级菜单</option>
        <?php echo $select_category; ?>
      </select>
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">菜单名称</label>
    <div class="layui-input-block">
      <input type="text" name="name" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item" style="margin-bottom: 9px;">
    <label class="layui-form-label">应用</label>
    <div class="layui-input-block">
      <input type="text" name="app" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux layui-word-aux-left" style="padding:5px 0px !important;">如：admin</div>
  </div>
    <div class="layui-form-item">
    <label class="layui-form-label">控制器</label>
    <div class="layui-input-block">
      <input type="text" name="controller" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
  </div>
    <div class="layui-form-item">
    <label class="layui-form-label">方法名称</label>
    <div class="layui-input-block">
      <input type="text" name="action" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
  </div>

        </div>
      </div>
    </div>
    
    
    
    <div class="layui-col-md6">
      <div class="layui-card">
        <div class="layui-card-header">参数状态</div>
        <div class="layui-card-body">
<div class="layui-form-item">
    <label class="layui-form-label">参数</label>
    <div class="layui-input-block">
      <input type="text" name="param" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux layui-word-aux-left">例:id=3&p=3</div>
  </div>
        <div class="layui-form-item">
    <label class="layui-form-label">图标</label>
    <div class="layui-input-block">
      <input type="text" name="icon" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux layui-word-aux-left">不带前缀layui-icon，如layui-icon-user => user</div>
  </div>
  
  <div class="layui-form-item">
    <label class="layui-form-label">状态</label>
    <div class="layui-input-block">
      <input type="checkbox" name="status" lay-skin="switch">
    </div>
  </div>
         <div class="layui-form-item">
    <label class="layui-form-label">类型</label>
    <div class="layui-input-block">
      <input type="radio" name="type" value="1" title="有界面可访问菜单" checked>
      <input type="radio" name="type" value="2" title="无界面可访问菜单">
      <input type="radio" name="type" value="0" title="只作为菜单">
    </div>
  </div> 

        </div>
      </div>
    </div>

<div class="layui-col-md12">
      <div class="layui-card">
        <div class="layui-card-header">备注信息</div>
        <div class="layui-card-body">
  <div class="layui-form-item layui-form-text">
    <div class="layui-input-block">
      <textarea name="remark" placeholder="请输入备注信息255字内" style="resize: none;" class="layui-textarea"></textarea>
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
        </div>
      </div>
    </div>


</div>
</form>

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

$(function(){

});

//监听指定开关
	var form = layui.form;
	form.on('submit(formDemo)', function(data){
		$.post("<?php echo url('doadd'); ?>",data.field,function(res){
			if(res.code == 1){
				showMsg(res.msg,1,1);
				setTimeout(() => {parent.window.location.reload();},2000);
			}else{
				showMsg(res.msg,2);
			}
		});

	    return false;
	});

</script>

</body>
</html>