{extend name="public/base" /}
{block name="header"}
<link rel="stylesheet" href="__PUBLIC__/js/treeTable/css/jquery.treetable.css" />
<style>.layui-form-switch{margin-top:0;}.layui-table td{padding-top:5px;padding-bottom:5px;}</style>
{/block}
{block name="main"}
<div class="layui-fluid">
  <div class="layui-row layui-col-space15">
    <div class="layui-col-md12">
      <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
              <button class="layui-btn layui-btn-primary" onclick="window.location.href='{:url('add')}'" data-type="add">添加菜单</button>
         </div>
        <div class="layui-card-body">
        <form class="layui-form" action="{:url('listorder')}" method="post">
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
         <div class="layui-card-footer">
              <button type="submit" lay-submit lay-filter="submit" class="layui-btn layui-btn-primary order-btn">排序</button>
         </div>
         </form>
        </div>
      </div>
    </div>
  </div>
</div>
{/block}

{block name="footer"}
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

	var form = layui.form;

	form.on('switch(switchTest)',function(data){
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
					showMsg(res.msg);
				}
			}
		});
	});
	
	form.on('submit(submit)', function(data){
		$('.order-btn').addClass('layui-btn-disabled').attr('disabled','disabled').text('更新中...');
		$.ajax({
			url:'{:url("listorder")}',type:'POST',
			data:$('.layui-form').serialize(),success: function(res){
				$('.order-btn').removeClass('layui-btn-disabled').removeAttr('disabled').text('更新');
				showMsg(res.msg);
			}
		});
		return false;
	});



</script>
{/block}
