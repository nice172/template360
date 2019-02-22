{extend name="public/base" /}
{block name="main"}
<div class="layui-fluid layui-main-content">
  <div class="layui-row layui-col-space15">
    <div class="layui-col-md12">
      <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
              <a href="{:url('add')}" class="layui-btn layui-btn-primary">新增分类</a>
         </div>
        <div class="layui-card-body">
<table class="layui-table layui-form">
				<thead>
					<tr>
						<th width="50">排序</th>
						<th width="50">ID</th>
						<th>分类名称</th>
						<th>描述</th>
						<th width="180">操作</th>
					</tr>
				</thead>
				<tbody>
					{$category_tree}
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
