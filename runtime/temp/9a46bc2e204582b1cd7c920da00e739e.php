<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:54:"D:\phpstudy1\WWW\blog\template\admin\post\postnew.html";i:1512034638;s:34:"../template/admin/common/head.html";i:1512288094;}*/ ?>
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
	<!-- 文章编辑 -->
	<div class="content">
		<div class="content_title">
			文章编辑
		</div>
		<div class="content_content">
			<div class="post_edit_form">
				<form action="<?php echo url('admin/common/newMessage',['type'=>'post']); ?>" method="post">
					<!-- 文章分类 -->
					<div class="form-group">
						文章分类：
						<select name="cates_id" class="form-control">
							<?php foreach($cateArr as $cates): ?>
								<option value="<?php echo $cates['id']; ?>"><?php echo $cates['name']; ?></option>
							<?php endforeach; ?>
						</select>
						
					</div>
					<!-- 文章标题 -->
					<div class="form-group">
						<input type="text" name="title" class="form-control">
					</div>
					<!-- 文章链接 -->
					<div class="post_edit_url">
						预计链接：
						<a href='javascript:' class="btn">http://<?php echo $_SERVER['HTTP_HOST']; ?><?php echo $postUrl; ?></a>
					</div>
					<!-- 文章内容 -->
					
					<div class="post_edit_content">
						<!-- 百度富文本 -->
						 <script id="container" name="content" type="text/plain"></script>
					</div>
					<div class="form-group">
						标签(用英文逗号分隔)：
						<input type="input" name="tags" class="form-control">
					</div>
					<hr>
					<!-- SEO部分 -->
					<div class="form-group">
						seo标题：
						<input type="text" name="seo_title" class="form-control">
					</div>
					<div class="form-group">
						seo关键字(用英文逗号分隔)：
						<input type="text" name="seo_keywords" class="form-control">
					</div>
					<div class="form-group">
						seo描述：
						<textarea name="seo_description" class="form-control"></textarea>
					</div>
					<!-- 提交按钮 -->
					<div class="form-group">
						<input type="submit" class="btn btn-success" value="提交" >
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var ue = UE.getEditor('container',{
		initialFrameHeight:500
	});
</script>
</body>
</html>