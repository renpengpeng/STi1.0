<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:55:"D:\phpstudy1\WWW\blog\template\admin\setting\menus.html";i:1512485463;s:34:"../template/admin/common/head.html";i:1512288094;}*/ ?>
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
			菜单设置
		</div>
		<!-- 提示 -->
		<div class="alert alert-success">
			提示：最大三级菜单，如果插入四级菜单会归为三级菜单
		</div>
		<div class="menus">
			<div class="list-group">
				<li class="list-group-item active">当前菜单<span class="badge" onclick="settingMenus()">收缩</span></li>
				<div class="setting_menus_sc">
					<?php echo $menuArr; ?>
				</div>
			</div>
		</div>
		<div class="content_title">
			添加菜单
		</div>
		<div class="new_menus">
			<form action="<?php echo url('admin/common/newmessage',['type'=>'menu']); ?>" method="post">
				<div class="form-group">
					<label>菜单名称</label>
					<input type="text" name="name" class="form-control">
				</div>
				<div class="form-group">
					<label>菜单链接</label>
					<input type="text" name="url" class="form-control">
				</div>
				<div class="form-group">
					<label>父菜单</label>
					<select name="pid" class="form-control">
						<option value="0">顶级分类</option>
						<?php echo $menuArrS; ?>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-success" value="添加">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>