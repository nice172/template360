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
<link rel="stylesheet" href="__LAYUI__/css/layui.css">
<link rel="stylesheet" href="__CSS__/admin.css">
{block name="header"}{/block}
<!--[if lt IE 9]>
  <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
{block name="main"}{/block}
</div>
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.form.js"></script>
<script type="text/javascript" src="__LAYUI__/layui.all.js"></script>
<script type="text/javascript" src="__JS__/common.js"></script>
{block name="footer"}{/block}
<script>
layui.use('element', function(){
  var element = layui.element;
});
$(function(){
    $('.three-url').click(function(){
    	alert($(this).text());
    });
    $('.ajaxForm').submit(function(){
		$(this).ajaxSubmit({
			type: 'POST',
			success: function(res){
				if(res.code == 1){
					showMsg(res.msg,1);
				}else{
					showMsg(res.msg,2);
				}
				}
		});
    	return false;
    });
});
</script>
</body>
</html>