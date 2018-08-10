<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:67:"E:\job\template360\public/../application/admin\view\index\index.php";i:1531186483;s:57:"E:\job\template360\application\admin\view\public\base.php";i:1531465352;}*/ ?>
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
      <li class="layui-nav-item"><a href="javascript:;" class="ajax-url" url="<?php echo url('clear/cache'); ?>">清空缓存</a></li>
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
        <a href="javascript:;"><?php echo $user['username']; ?></a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="<?php echo url('user/logout'); ?>">安全退出</a></dd>
        </dl>
      </li>
<!--       <li class="layui-nav-item"><a href="<?php echo url('user/logout'); ?>">退出</a></li> -->
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black layui-side-menu">
    <div class="layui-side-scroll">
     
      <ul class="layui-nav layui-nav-tree">
      <?php $i=0; if(is_array($admin_menus) || $admin_menus instanceof \think\Collection || $admin_menus instanceof \think\Paginator): if( count($admin_menus)==0 ) : echo "" ;else: foreach($admin_menus as $key=>$value): ?>
        <li class="layui-nav-item <?php if($i==0): ?>layui-nav-itemed<?php endif; ?>"><?php $i++;?>
          <a class="" href="javascript:;"><?php echo $value['name']; ?></a>
          <dl class="layui-nav-child">
          <?php if(isset($value['items']) && !empty($value['items'])): if(is_array($value['items']) || $value['items'] instanceof \think\Collection || $value['items'] instanceof \think\Paginator): if( count($value['items'])==0 ) : echo "" ;else: foreach($value['items'] as $key=>$child): if(!isset($child['items']) || empty($child['items'])): ?>
          	<dd><a href="<?php echo $child['url']; ?>"><?php echo $child['name']; ?></a></dd>
          	<?php endif; if(isset($child['items']) && !empty($child['items'])): ?>
                <dd><a href="javascript:;"><?php echo $child['name']; ?></a></span>
                    <dl class="layui-nav-child">
               <?php if(is_array($child['items']) || $child['items'] instanceof \think\Collection || $child['items'] instanceof \think\Paginator): if( count($child['items'])==0 ) : echo "" ;else: foreach($child['items'] as $key=>$childSub): ?>
                        <dd><a href="<?php echo $childSub['url']; ?>"><?php echo $childSub['name']; ?></a></dd>
               <?php endforeach; endif; else: echo "" ;endif; ?> 
                   </dl>
                </dd>
            <?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
          </dl>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
  </div>
  
  <div class="layui-body">
    <div class="layui-card layadmin-header">
      <div class="layui-breadcrumb" lay-filter="breadcrumb" style="visibility: visible;">
        <a href="<?php echo url('index/main'); ?>">主页</a><span lay-separator="">/</span>
        <a lay-href="">管理员管理</a><span lay-separator="">/</span>
        <a><cite>管理员列表</cite></a>
      </div>
    </div>
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">
    




    </div>
  </div>
  
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © template360.com - 底部固定区域
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

</body>
</html>