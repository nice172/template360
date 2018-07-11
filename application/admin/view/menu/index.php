{extend name="public/base" /}
{block name="head"}
<link rel="stylesheet" href="__PUBLIC__/js/treeTable/css/jquery.treetable.css" />
{/block}
{block name="main"}

  <div class="layui-row layui-col-space15">
    <div class="layui-col-md12">
      <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
              <button class="layui-btn layui-btn-primary" onclick="window.location.href='{:url('add')}'" data-type="add">添加菜单</button>
         </div>
        <div class="layui-card-body">
          
<table class="layui-table layui-form" id="treeTable">
  <thead>
    <tr>
      <th>排序</th>
      <th>ID</th>
      <th>菜单名称</th>
      <th>URL</th>
      <th>状态</th>
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
  {$category}
  </tbody>
</table>
          
          
        </div>
      </div>
    </div>
  </div>

{/block}

{block name="script"}
<script type="text/javascript" src="__PUBLIC__/js/treeTable/jquery.treetable.js"></script>
<script>

$(function(){

	　$("#treeTable").treetable({ 
		expandable: true,
		stringCollapse: '收起',
		stringExpand:'展开',
		clickableNodeNames: false,
		expandable: true,
		expanderTemplate:'<i class="layui-icon layui-icon-triangle-r" style="cursor:pointer;"></i>' });
	 $('body').on('click','#treeTable .indenter i',function(){
		 
		 if($(this).hasClass('layui-icon-triangle-r')){
			 $(this).removeClass('layui-icon-triangle-r');
			 $(this).addClass('layui-icon-triangle-d');
			 }else{
				 $(this).removeClass('layui-icon-triangle-d');
				 $(this).addClass('layui-icon-triangle-r');
		}
	 });
	
});

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



</script>
{/block}
