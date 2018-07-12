{extend name="public/base" /}
{block name="head"}
<style>/*.layui-form-select{width:300px;}*/.layui-word-aux-left{margin-left:110px;}</style>
{/block}
{block name="main"}
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
        {$select_category}
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
{/block}

{block name="script"}

<script>

$(function(){

});

//监听指定开关
	var form = layui.form;
	form.on('submit(formDemo)', function(data){
		$.post("{:url('doadd')}",data.field,function(res){
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
{/block}
