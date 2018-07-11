<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"E:\job\template360\public/../application/admin\view\user\edituser.php";i:1531285022;s:63:"E:\job\template360\application\admin\view\public\layer_base.php";i:1531277464;}*/ ?>
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

<style>
.layui-form-item .layui-form-label{width: 50px !important;}
.layui-input-block{margin-left:80px !important;}
.margin-bottom {margin-top:55px;margin-bottom:0px !important;}
</style>

<!--[if lt IE 9]>
  <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="layui-layout-body" style="background: #fff;">
<div class="layui-layout layui-layout-admin">
  <div class="layui-body layer-body-main">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">
    
<form class="layui-form" action="" lay-filter="example">
	<input type="hidden" value="<?php echo $info['id']; ?>" name="id" />
  <div class="layui-form-item">
    <label class="layui-form-label">用户名</label>
    <div class="layui-input-block">
      <input type="text" name="username" value="<?php echo $info['username']; ?>" lay-verify="username" autocomplete="off" placeholder="请输入用户名" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">密码</label>
    <div class="layui-input-block">
      <input type="password" name="password" lay-verify="password" placeholder="密码留则不修改" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">邮箱</label>
    <div class="layui-input-block">
      <input type="text" name="email" value="<?php echo $info['email']; ?>" lay-verify="inputemail|email" autocomplete="off" placeholder="请输入邮箱" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">手机号码</label>
    <div class="layui-input-block">
      <input type="text" name="mobile" value="<?php echo $info['mobile']; ?>" lay-verify="inputPhone|phone" autocomplete="off" placeholder="请输入手机号码" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">管理员组</label>
    <div class="layui-input-block">
      <select name="group_id" lay-verify="group_id">
        <option value="0">请选择分组</option>
        <option value="1">普通管理员</option>
      </select>
    </div>
  </div>
  
  <div class="layui-form-item">
    <label class="layui-form-label">状态</label>
    <div class="layui-input-block">
      <input type="checkbox" <?php if($info['status']): ?>checked="checked"<?php endif; ?> value="1" name="status" lay-skin="switch" lay-text="开启|禁用">
    </div>
  </div>
  
  <div class="layui-form-item margin-bottom">
    <div class="layui-input-block" style="margin-left:0px !important;">
      <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="submit">立即提交</button>
    </div>
  </div>
</form>

    </div>
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
var form = layui.form;
var layedit = layui.layedit;
  /* 自定义验证规则 */
  form.verify({
	username: function(value,item){
      if(value.length <= 0){
        return '请输入用户名';
      }
    },
    password: function(value, item){
		var pattern = /(.+){6,12}$/;
		if(value.length != 0){
			if(!pattern.test(value)) return '密码至少6位';
		}
    },
    inputemail: function(value,item){
		if(value.length <= 0) return '请输入邮箱';
    },
    inputPhone: function(value,item){
		if(value.length <= 0) return '请输入手机号码';
    },
    group_id: function(value,item){
		if(value <= 0) return '请选择管理员组';
    }
  });
  
  /* 监听指定开关 */
  form.on('switch(component-form-switchTest)', function(data){
//     layer.msg('开关checked：'+ (this.checked ? 'true' : 'false'), {
//       offset: '6px'
//     });
//     layer.tips('温馨提示：请注意开关状态的文字可以随意定义，而不仅仅是ON|OFF', data.othis)
  });
  
  /* 监听提交 */
  form.on('submit(submit)', function(data){
//     layer.alert(JSON.stringify(data.field), {
//       title: '最终的提交信息'
//     })
	$.post("<?php echo url('edituser'); ?>",data.field,function(res){
		if(res.code == 1){
			closeWin();
			showMsg(res.msg,1,1);
			setTimeout(() => {parent.window.location.reload();},2000);
		}else{
			showMsg(res.msg,2);
		}
	});

    return false;
  });

</script>

<script>
<?php if(isset($close)): ?>
showMsg('<?php echo $msg; ?>',2);
closeWin();
<?php endif; ?>
</script>
</body>
</html>