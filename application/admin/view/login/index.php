<!doctype html>
<html lang="zh-cn">
<head>
<meta charset="UTF-8" />
<meta http-equiv="pragma" content="no-cache"> 
<meta http-equiv="cache-control" content="no-cache, must-revalidate"> 
<meta http-equiv="expires" content="0">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<meta content="email=no" name="format-detection">
<title>后台登录</title>
<link rel="stylesheet" href="__LAYUI__/css/layui.css" />
<link rel="stylesheet" href="__CSS__/login.css" />
</head>
<body>

<div class="login-main">
<h2>后台管理登录</h2>	
	
	<div class="login">
		<form action="{:url('doLogin')}" class="layui-form" method="post" id="loginForm">
          {:token()}
          <div class="layui-form-item">
            <div class="layui-input-block">
              <label class="layui-form-label"><i class="layui-icon layui-icon-username"></i></label>
              <input type="text" name="username" placeholder="请输入用户名" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <label class="layui-form-label"><i class="layui-icon layui-icon-password"></i></label>
              <input type="password" name="password" placeholder="请输入登录密码" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <label class="layui-form-label"><i class="layui-icon layui-icon-auz"></i></label>
              <input type="text" name="verifycode" placeholder="请输入验证码" autocomplete="off" class="layui-input verifycode">
              <img src="{:url('verify')}" alt="" class="verify"/>
            </div>
          </div>
          <div class="layui-form-item">
          	<div class="layui-input-block">
          	<button type="button" class="layui-btn layui-btn-fluid">登录</button>
          	</div>
          </div>
		</form>
	</div>

</div>
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__LAYUI__/layui.all.js"></script>
<script type="text/javascript">
$(function(){

	function clickVerify(){
		var src = $('.verify').attr('src');
		if(src.indexOf('?') > 0) src = src.split('?')[0];
		$('.verify').attr('src', src+'?mt='+Math.random());
	}

	$('.verify').click(function(){
		clickVerify();
	});
	
	$('.layui-btn').click(function(){
		if($('input[name=username]').val() == ''){
			layer.msg('请输入用户名',{shade:0.3,icon:2,shift:6});
			$('input[name=username]').focus();
			return;
		}
		if($('input[name=password]').val() == ''){
			layer.msg('请输入登录密码',{shade:0.3,icon:2,shift:6});
			$('input[name=password]').focus();
			return;
		}
		if($('input[name=verifycode]').val() == ''){
			layer.msg('请输入验证码',{shade:0.3,icon:2,shift:6});
			$('input[name=verifycode]').focus();
			return;
		}
		$.ajax({
			type:'POST',
			url:'{:url('dologin')}',
			data:$('#loginForm').serialize(),
			success:function(res){
				layer.msg(res.msg,{shade:0.3,icon:2,shift:6});
				if(res.data == 1){
					//clickVerify();
				}
				if(res.code == 1) {
					window.location = res.url;
				}else{
					setTimeout(function(){
						window.location.reload();
						},3000);
				}
			}
		});
	});
});
</script>
</body>
</html>