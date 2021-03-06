{extend name="public/base" /}
{block name="main"}
<div class="layui-fluid layui-main-content">
  <div class="layui-row layui-col-space15">
    <div class="layui-col-md12">
      <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
              <button class="layui-btn layui-btn-primary openWindow" window-size="400,450" url="{:url('adduser')}" data-type="add">新增管理员</button>
         </div>
        <div class="layui-card-body">
          
<table class="layui-table layui-form">
  <thead>
    <tr>
      <th>ID</th>
      <th>用户名</th>
      <th>所属分组</th>
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
  {foreach name="list" item="v"}
    <tr>
      <td>{$v.id}</td>
      <td>{$v.username}</td>
      <td>{if condition="$v['id']==1"}超级管理员{else}普通管理员{/if}</td>
      <td>{$v.email}</td>
      <td>{$v.last_login_ip}</td>
      <td>{$v.last_login_time|date='Y-m-d H:i:s',###}</td>
      <th>
       {if condition="$v['status']"}
       <input type="checkbox" {if condition="$v['id']==1"}disabled="disabled"{/if}  value="{$v['id']}" checked="checked" name="open" lay-skin="switch" lay-filter="switchTest" title="开启">
       {else}
       <input type="checkbox" value="{$v['id']}" name="open" lay-skin="switch" lay-filter="switchTest" title="禁用">
       {/if}
      </th>
      <td>{$v.register_ip}</td>
      <td>{$v.add_time|date='Y-m-d H:i:s',###}</td>
      <td>
    	{if condition="$user['id']!=1 && $v['id']==1"}
    	<button class="layui-btn layui-btn-disabled layui-btn-xs">编辑</button>
    	{else}
    	<button class="layui-btn layui-btn-xs openWindow" window-size="400,450" url="{:url('edituser',['id' => $v['id']])}">编辑</button>
    	{/if}
    	{if condition="$v['id']==1"}
    	<button class="layui-btn layui-btn-disabled layui-btn-xs">删除</button>
      	{else}
      	<button class="layui-btn layui-btn-danger layui-btn-xs ajax-confirm" url="{:url('delete',['id' => $v['id']])}">删除</button>
      	{/if}
      </td>
    </tr>
   {/foreach}
  </tbody>
</table>
          
          
        </div>
      </div>
    </div>
  </div>
    </div>
{/block}

{block name="footer"}
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
			url:'{:url("status")}',type:'POST',
			data:{id:data.value,status:status},success: function(res){
				if(res.code == 0){
					$(data.othis).addClass('layui-form-onswitch');
					layer.msg(res.msg,{shade:0.3,icon:2,shift:6});
					}
			}
		});
	});

	//判断权限问题，如果是修改用户，点击编辑先请求ajax返回数据判断是否有权限
	//如果有权限显示模板，则否提示没有权限

</script>
{/block}
