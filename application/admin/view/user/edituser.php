{extend name="public/layer_base" /}
{block name="header"}
<style>
.layui-form-item .layui-form-label{width: 50px !important;}
.layui-input-block{margin-left:80px !important;}
</style>
{/block}
{block name="main"}
<div style="padding: 15px 20px 0 0;">
<form class="layui-form" action="" lay-filter="example">
	<input type="hidden" value="{$info.id}" name="id" />
  <div class="layui-form-item">
    <label class="layui-form-label">用户名</label>
    <div class="layui-input-block">
      <input type="text" name="username" value="{$info.username}" lay-verify="username" autocomplete="off" placeholder="请输入用户名" class="layui-input">
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
      <input type="text" name="email" value="{$info.email}" lay-verify="inputemail|email" autocomplete="off" placeholder="请输入邮箱" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">手机号码</label>
    <div class="layui-input-block">
      <input type="text" name="mobile" value="{$info.mobile}" lay-verify="inputPhone|phone" autocomplete="off" placeholder="请输入手机号码" class="layui-input">
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
      <input type="checkbox" {if condition="$info['status']"}checked="checked"{/if} value="1" name="status" lay-skin="switch" lay-text="开启|禁用">
    </div>
  </div>
  
    <div class="footer-block">
	<div class="footer-block-main">
	<button class="layui-btn layui-btn-sm" type="submit" lay-submit lay-filter="submit">保 存</button>
  <button type="button" class="layui-btn layui-btn-primary layui-btn-sm">取消</button>
  </div>
  </div>
  
</form>
</div>
{/block}

{block name="footer"}
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
	$.post("{:url('edituser')}",data.field,function(res){
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
{/block}