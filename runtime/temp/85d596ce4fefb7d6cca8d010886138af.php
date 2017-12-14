<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:55:"D:\phpstudy1\WWW\blog\template\admin\cate\cateedit.html";i:1512039468;s:34:"../template/admin/common/head.html";i:1512033721;}*/ ?>
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
				<li><a href="<?php echo url('admin/login/loginout'); ?>">登出</a></li>
			</ul>
		</div>
		<div class="mobile_menu"><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/img/admin-menu.png"></div>
	</div>
</div>
<div class="container">
	<!-- 分类管理 -->
	<div class="content">
		<div class="content_title">
			分类编辑
		</div><hr>
		<div class="cateedit">
			<form action="<?php echo url('admin/common/updatemessage',['type'=>'cate']); ?>" method="post" role='form'>
				<!-- 隐藏域ID -->
				<input type="hidden" name="id" value="<?php echo $cateArr['id']; ?>">
				<!-- 分类标题 -->
				<div class="form-group">
					<label>分类标题：</label>
					<input type="text" name="name" class="form-control" value="<?php echo $cateArr['name']; ?>">
				</div>
				<!-- 分类别名 -->
				<div class="form-group">
					<label>分类别名：</label>
					<input type="text" name="s_name" class="form-control" value="<?php echo $cateArr['s_name']; ?>">
				</div>
				<!-- 分类SEO关键词 -->
				<div class="form-group">
					<label>分类SEO关键词：</label>
					<input type="text" name="seo_keywords" class="form-control" value="<?php echo $cateArr['seo_keywords']; ?>">
				</div>
				<!-- 分类SEO描述 -->
				<div class="form-group">
					<label>分类SEO描述：</label>
					<textarea name="seo_description" class="form-control"><?php echo $cateArr['seo_description']; ?></textarea>
				</div>
				<div class="form-group">
					<input type="submit" name="cateEdit" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>