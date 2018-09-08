{extend name="public/layer_base" /}
{block name="header"}
<style>
.layui-form-item .layui-form-label{width: 50px !important;}
.layui-input-block{margin-left:80px !important;}
.margin-bottom {margin-top:55px;margin-bottom:0px !important;}
</style>
{/block}
{block name="main"}
<form class="layui-form" action="" lay-filter="example">
  <div class="layui-form-item">
    <label class="layui-form-label">用户名</label>
    <div class="layui-input-block">
      <input type="text" name="username" lay-verify="username" autocomplete="off" placeholder="请输入用户名" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">密码</label>
    <div class="layui-input-block">
      <input type="password" name="password" lay-verify="password" placeholder="请输入密码" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">邮箱</label>
    <div class="layui-input-block">
      <input type="text" name="email" lay-verify="inputemail|email" autocomplete="off" placeholder="请输入邮箱" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">手机号码</label>
    <div class="layui-input-block">
      <input type="text" name="mobile" lay-verify="inputPhone|phone" autocomplete="off" placeholder="请输入手机号码" class="layui-input">
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
      <input type="checkbox" checked="checked" value="1" name="status" lay-skin="switch" lay-text="开启|禁用">
    </div>
  </div>
  
  <div class="layui-form-item margin-bottom">
    <div class="layui-input-block" style="margin-left:0px !important;">
      <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="submit">立即提交</button>
    </div>
  </div>
</form>
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
    password: [/(.+){6,12}$/, '密码至少6位'],
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
	$.post("{:url('adduser')}",data.field,function(res){
		if(res.code == 1){
			closeWin();
			showMsg(res.msg,1);
		}else{
			showMsg(res.msg,2);
		}
	});

    return false;
  });

</script>
{/block}