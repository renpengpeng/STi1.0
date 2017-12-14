<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:53:"D:\phpstudy1\WWW\blog\template\admin\index\index.html";i:1511874317;s:34:"../template/admin/common/head.html";i:1512288094;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/css/style.css" rel="stylesheet" type="text/css">
	<link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/css/media.css" rel="stylesheet" type="text/css">
	<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/js/jquery-3.1.1.min.js"></script>
	<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/js/admin.js"></script>
	<!-- 引入百度富文本 -->
	<!-- 配置文件 -->
    <script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/fwb/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/fwb/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    
	<title>后台</title>
</head>
<body>
<!-- adminbar -->
<div class="container-fuild">
	<div class="adminBar">
		<!-- logo -->
		<div class="adminBar_logo">
			<a href="<?php echo url('admin/index/index'); ?>">管理员后台</a>
		</div>
		<!-- 菜单 -->
		<div class="adminBar_menu">
			<ul>
				<li><a href="<?php echo url('admin/index/index'); ?>">首页</a></li>
				<li><a href="<?php echo url('admin/post/postadmin'); ?>">文章</a></li>
				<li><a href="<?php echo url('admin/cate/cateadmin'); ?>">分类</a></li>
				<li><a href="<?php echo url('admin/tag/tagadmin'); ?>">标签</a></li>
				<li><a href="<?php echo url('admin/page/pageadmin'); ?>">页面</a></li>
				<li><a href="<?php echo url('admin/setting/index'); ?>">系统</li>
				<li><a href="<?php echo url('admin/login/loginout'); ?>">登出</a></li>
			</ul>
		</div>
		<div class="mobile_menu"><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/img/admin-menu.png"></div>
	</div>
</div>
<div class="container">
	<!-- 主内容 -->
	<div class="content">
		<div class="content_title">
			站点统计
		</div>
		<div class="content_content">
			共<lc><?php echo $cateNums; ?></lc>个分类、
			<lc><?php echo $postNums; ?></lc>篇文章、
			<lc><?php echo $tagNums; ?></lc>个标签、
			<lc><?php echo $pageNums; ?></lc>个页面
		</div>
		<div class="content_title">
			登录信息
		</div>
		<div class="content_content">
			<p>上次登录IP:<lc><?php echo $lastLoginIp; ?></lc></p>
			<p>上次登录时间：<lc><?php echo $lastLoginTime; ?></lc></p>
			<hr>
			<p>本次登录IP:<lc><?php echo $thisLoginIp; ?></lc></p>
		</div>
	</div>
</div>
</body>
</html>