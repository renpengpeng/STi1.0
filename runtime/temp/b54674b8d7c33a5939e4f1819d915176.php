<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"D:\phpstudy1\WWW\blog\template\admin\post\postedits.html";i:1511876330;s:34:"../template/admin/common/head.html";i:1511874344;}*/ ?>
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
				<li><a href="<?php echo url('admin/postadmin/index'); ?>">文章</a></li>
				<li><a href="<?php echo url('admin/cateadmin/index'); ?>">分类</a></li>
				<li><a href="<?php echo url('admin/tagadmin/index'); ?>">标签</a></li>
				<li><a href="<?php echo url('admin/pageadmin/index'); ?>">页面</a></li>
			</ul>
		</div>
		<div class="mobile_menu"><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/img/admin-menu.png"></div>
	</div>
</div>
<div class="container">
	<!-- 文章编辑 -->
	<div class="content">
		<div class="content_title">
			文章编辑	<a href="<?php echo url('admin/post/postadmin'); ?>"><button class="btn">取消编辑</button></a>
		</div>
		<div class="content_content">
			<div class="post_edit_form">
				
				<form action="<?php echo url('admin/Login/updateMessage',[
					'type'=>'post'
				]); ?>" method="post">
				<!-- 隐藏域文章id -->
				<input type="hidden" name="id" value="<?php echo $postArr['id']; ?>">
					<!-- 文章分类 -->
					<div class="form-group ">
						文章分类：
						<select name="cates_id" class="form-control input-sm">
							<option value="<?php echo $postArr['cates_id']; ?>"><?php echo $postArr['cateName']; ?></option>
						</select>
					</div>
					<!-- 文章标题 -->
					<div class="form-group">
						<input type="text" name="title" class="form-control" value="<?php echo $postArr['title']; ?>">
					</div>
					<!-- 文章链接 -->
					<div class="form-group">
						预计链接：
						<a href="javascrpt:" class="btn">http://<?php echo $_SERVER['HTTP_HOST']; ?>/<?php echo $postArr['id']; ?>.html</a>
					</div>
					<!-- 文章内容 -->
					
					<div class="form-group">
						<!-- 添加快捷代码 -->
						<div class="post_edit_shortcuts">
							<ul>
								<li><button class="btn shortcutsBtn">h1</button></li>							
								<li><button class="btn shortcutsBtn">h2</button></li>

								<li><button class="btn shortcutsBtn">h3</button></li>

								<li><button class="btn shortcutsBtn">B</button></li>

								<li><button class="btn shortcutsBtn">i</button></li>

								<li><button class="btn shortcutsBtn">ul</button></li>

								<li><button class="btn shortcutsBtn">li</button></li>

								<li><button class="btn shortcutsBtn">a</button></li>

								<li><button class="btn shortcutsBtn">backquote</button></li>

								<li><button class="btn shortcutsBtn">img</button></li>

								<li><button class="btn shortcutsBtn">br</button></li>

								<li><button class="btn shortcutsBtn">hr</button></li>

								<li><button class="btn shortcutsBtn">embed</button></li>

								<li><button class="btn shortcutsBtn">pre</button></li>

								<li><button class="btn shortcutsBtn">code</button></li>

								<li><button class="btn shortcutsBtn">左对齐</button></li>

								<li><button class="btn shortcutsBtn">中对齐</button></li>

								<li><button class="btn shortcutsBtn">右对齐</button></li>

							</ul>
						</div>
						<textarea name="content" class="form-control shortcutsInput" style="min-height: 500px;"><?php echo $postArr['content']; ?></textarea>
					</div>
					<div class="form-group">
						
						标签(用英文逗号分隔)：
						<input type="input" name="tags" class="form-control" value="<?php echo $postArr['tagName']; ?>">
					</div>
					<hr>
					<!-- SEO部分 -->
					<div class="form-group">
						seo标题：
						<input type="text" name="seo_title" value="<?php echo $postArr['seo_title']; ?>" class="form-control">
					</div>
					<div class="form-group">
						seo关键字(用英文逗号分隔)：
						<input type="text" name="seo_keywords" value="<?php echo $postArr['seo_keywords']; ?>" class="form-control">
					</div>
					<div class="form-group">
						seo描述：
						<textarea name="seo_description" class="form-control"><?php echo $postArr['seo_description']; ?></textarea>
					</div>
					<!-- 提交按钮 -->
					<input type="submit" class="btn btn-scuess" value="提交" >

				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>