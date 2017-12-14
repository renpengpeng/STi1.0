<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:59:"D:\phpstudy1\WWW\blog\template\admin\setting\menusedit.html";i:1512484726;s:34:"../template/admin/common/head.html";i:1512288094;}*/ ?>
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
	<div class="content">
		<div class="content_title">
			菜单编辑
		</div>
		<!-- 开始 -->
		<div class="edit">
			<form action="<?php echo url('admin/common/updatemessage',['type'=>'menu']); ?>" method="post">
				<!-- 隐藏域菜单id -->
				<input type="hidden" name="id" value="<?php echo $menuArr['id']; ?>">
				<div class="form-group">
					<label>菜单名称</label>
					<input type="text" name="name" class="form-control" value="<?php echo $menuArr['name']; ?>">
				</div>
				<div class="form-group">
					<label>菜单链接</label>
					<input type="text" name="url" class="form-control" value="<?php echo $menuArr['url']; ?>">
				</div>
				
				<div class="form-group">
					<label>菜单</label>
					<select name="pid" class="form-control">
						<option value="0">不改变</option>
						<option value="-1">顶级菜单</option>
						<?php echo $selectArr; ?>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" value="提交" class="btn btn-success">
				</div>
			</form>	
		</div>
	</div>
</div>
</body>
</html>