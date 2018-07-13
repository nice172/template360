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
{block name="head"}{/block}
<!--[if lt IE 9]>
  <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">Template360</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="">控制台</a></li>
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
          	<dd><a href="{$child.url}">{$child.name}</a></dd>
          	{/if}
            {if condition="isset($child['items']) && !empty($child['items'])"}
                <dd><a href="javascript:;">{$child.name}</a></span>
                    <dl class="layui-nav-child">
               {foreach name="child.items" item="childSub"}
                        <dd><a href="{$childSub.url}">{$childSub.name}</a></dd>
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
  
  <div class="layui-body">
    <div class="layui-card layadmin-header">
      <div class="layui-breadcrumb" lay-filter="breadcrumb" style="visibility: visible;">
        <a href="{:url('index/main')}">主页</a><span lay-separator="">/</span>
        <a lay-href="">管理员管理</a><span lay-separator="">/</span>
        <a><cite>管理员列表</cite></a>
      </div>
    </div>
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">
    {block name="main"}{/block}
    </div>
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
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
});
</script>
{block name="script"}{/block}
</body>
</html>