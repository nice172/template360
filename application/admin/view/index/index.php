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
  <div class="layui-header header header-demo">
    <div class="layui-main">
    <div class="layui-logo">Template360</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="{:url('index/index')}">控制台</a></li>
      <li class="layui-nav-item"><a href="javascript:;" class="ajax-url" url="{:url('clear/cache')}">清空缓存</a></li>
      <li class="layui-nav-item"><a href="">用户</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">其他操作</a>
        <dl class="layui-nav-child">
          <dd><a href="">邮件管理</a></dd>
          <dd><a href="">消息管理</a></dd>
          <dd><a href="">授权管理</a></dd>
        </dl>
      </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">{$user['username']}</a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="{:url('user/logout')}">安全退出</a></dd>
        </dl>
      </li>
<!--       <li class="layui-nav-item"><a href="{:url('user/logout')}">退出</a></li> -->
    </ul>
    </div>
  </div>
  
  <div class="layui-side layui-bg-black layui-side-menu">
    <div class="layui-side-scroll">
     
      <ul class="layui-nav layui-nav-tree">
      <?php $i=0; ?>
      {foreach name="admin_menus" item="value"}
        <li class="layui-nav-item {if condition="$i==0"}layui-nav-itemed{/if}"><?php $i++;?>
          <a class="" href="javascript:;">{$value.name}</a>
          <dl class="layui-nav-child">
          {if condition="isset($value['items']) && !empty($value['items'])"}
          	{foreach name="value.items" item="child"}
          	{if condition="!isset($child['items']) || empty($child['items'])"}
          	<dd><a href="javascript:;" url="{$child.url}" class="createIframe">{$child.name}</a></dd>
          	{/if}
            {if condition="isset($child['items']) && !empty($child['items'])"}
                <dd><a href="javascript:;">{$child.name}</a></span>
                    <dl class="layui-nav-child">
               {foreach name="child.items" item="childSub"}
                        <dd><a href="javascript:;" url="{$childSub.url}" class="createIframe">{$childSub.name}</a></dd>
               {/foreach} 
                   </dl>
                </dd>
            {/if}
          	{/foreach}
          {/if}
          </dl>
        </li>
        {/foreach}
      </ul>
    </div>
        
  </div>
  
  <div class="layui-tab layui-tab-brief">
  	  <div class="layui-tab-title site-demo-title">
        <div class="layui-card layadmin-header">
          <div class="layui-breadcrumb" lay-filter="breadcrumb">
            <div class="layui-tab">
              <ul class="layui-tab-title">
                <li class="layui-this">首页</li>
              </ul>
            </div>
          </div>
        </div>
  	  </div>

  </div>

     <div class="layui-body index-layui-body">
        <!-- 内容主体区域 -->
        <div class="layadmin-tabsbody-item layui-show">
        	<iframe src="{:url('index/home')}" frameborder="0" class="layadmin-iframe"></iframe>
        </div>
        <div class="app-content"></div>
    </div>
  
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © template360.com - 底部固定区域
  </div>
</div>
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__LAYUI__/layui.all.js"></script>
<script type="text/javascript" src="__JS__/common.js"></script>
<script>
layui.use('element', function(){
  var element = layui.element;
});
$(function(){
var menuList = new Array();
$('.createIframe').click(function(){
	for(var i in menuList){
		if($(this).attr('url') == menuList[i]){
			var click_index = parseInt(i)+1;
			var li = $('.layui-tab-title li');
			var contentItem = $('.index-layui-body .layadmin-tabsbody-item');
			li.removeClass('layui-this');
			li.eq(click_index).addClass('layui-this');
			contentItem.removeClass('layui-show').addClass('layui-hide');
			contentItem.eq(click_index).removeClass('layui-hide').addClass('layui-show');
			return;
		}
	}
	$('.index-layui-body .layadmin-tabsbody-item').removeClass('layui-show').addClass('layui-hide');
    var html = '<div class="layadmin-tabsbody-item layui-show">';
		html += '<iframe src="'+$(this).attr('url')+'" frameborder="0" class="layadmin-iframe"></iframe>';
		html += '</div>';
	$('.index-layui-body .app-content').before(html);
	$('.layui-tab-title li').removeClass('layui-this');
	$('.layui-tab-title li').last().after('<li class="layui-this">'+$(this).text()+'<i class="layui-icon layui-unselect layui-tab-close">ဆ</i></li>');
	menuList.push($(this).attr('url'));
});
$('body').on('click','li .layui-tab-close',function(event){
	if(event.target.nodeName == 'I'){
		var obj = $('.layui-tab-title li');
		var content = $('.index-layui-body .layadmin-tabsbody-item');
		content.addClass('layui-hide');
		var index = obj.index($(this).parent());
		if(obj.eq(index).next().length > 0){
			obj.removeClass('layui-this');
			if(!$('.layui-tab-title li').hasClass('layui-this')){
				obj.eq(index).next().addClass('layui-this');
				content.eq(index).next().removeClass('layui-hide').addClass('layui-show');
			}
		}else{
			obj.eq(index).prev().addClass('layui-this');
			content.eq(index).prev().removeClass('layui-hide').addClass('layui-show');
		}
		obj.eq(index).remove();
		content.eq(index).remove();
		var newList = new Array();
		for(var i in menuList){
			if(i != index-1) newList.push(menuList[i]);
		}
		menuList = newList;
	}
});
$('body').on('click','.layui-tab-title li',function(event){
	if(event.target.nodeName == 'LI'){
		var items = $('.index-layui-body .layadmin-tabsbody-item');
		items.removeClass('layui-show').addClass('layui-hide');
		items.eq($(this).index()).removeClass('layui-hide').addClass('layui-show');
	}
});

});
</script>
{block name="footer"}{/block}
</body>
</html>