<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:55:"D:\phpstudy1\WWW\blog\template\admin\tagedit\index.html";i:1511874449;s:34:"../template/admin/common/head.html";i:1511957843;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/css/style.css" rel="stylesheet" type="text/css">
	<link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/css/media.css" rel="stylesheet" type="text/css">
	<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/js/jquery-3.1.1.min.js"></script>
	<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/js/admin.js"></script>
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
				<li><a href="<?php echo url('admin/post/postadmin'); ?>">分类</a></li>
				<li><a href="<?php echo url('admin/tagadmin/index'); ?>">标签</a></li>
				<li><a href="<?php echo url('admin/pageadmin/index'); ?>">页面</a></li>
			</ul>
		</div>
		<div class="mobile_menu"><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/img/admin-menu.png"></div>
	</div>
</div>
<div class="container">
	<!-- 标签管理 -->
	<div class="content">
		<div class="content_title">
			标签编辑
		</div>
		<div class="tagedit">
			<form action="<?php echo url('admin/Login/updatemessage',['type'=>'tag']); ?>" method="post">
				<!-- 隐藏域id -->
				<input type="hidden" name="id" value="<?php echo $tagArr['id']; ?>">
				<div class="form-group">
					<label>标签标题：</label>
					<input type="text" name="name" class="form-control" value="<?php echo $tagArr['name']; ?>">
				</div>
				<div class="form-group">
					<label>标签别名：</label>
					<input type="text" name="s_name" class="form-control" value="<?php echo $tagArr['s_name']; ?>">
				</div>
				<div class="form-group">
					<label>标签SEO关键词：</label>
					<input type="text" name="seo_keywords" class="form-control" value="<?php echo $tagArr['seo_keywords']; ?>">
				</div>
				<div class="form-group">
					<label>标签SEO描述：</label>
					<textarea name="seo_description" class="form-control" value="<?php echo $tagArr['seo_description']; ?>"></textarea>
				</div>
				<div class="form-group">
					<input type="submit" name="tagEditSub" value="修改" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>