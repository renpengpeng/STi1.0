<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:55:"D:\phpstudy1\WWW\blog\template\admin\page\pageedit.html";i:1512049003;s:34:"../template/admin/common/head.html";i:1512033721;}*/ ?>
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
			页面编辑
		</div><hr>
		<div class="cateedit">
			<form action="<?php echo url('admin/common/updatemessage',['type'=>'page']); ?>" method="post" role='form'>
				<!-- 隐藏域ID -->
				<input type="hidden" name="id" value="<?php echo $pageArr['id']; ?>">
				<!-- 分类标题 -->
				<div class="form-group">
					<label>页面标题：</label>
					<input type="text" name="title" class="form-control" value="<?php echo $pageArr['title']; ?>">
				</div>
				<!-- 便捷 -->
				<!-- <div class="post_edit_shortcuts">
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
				<div class="form-group">
					<label>页面内容：</label>
					<textarea name="content" class="form-control shortcutsInput" style="min-height:500px;"></textarea> -->
					<textarea name="content" id="container" ></textarea>
				</div>
				<!-- 分类SEO关键词 -->
				<div class="form-group">
					<label>页面SEO关键词：</label>
					<input type="text" name="seo_keywords" class="form-control" value="<?php echo $pageArr['seo_keywords']; ?>">
				</div>
				<!-- 分类SEO描述 -->
				<div class="form-group">
					<label>页面SEO描述：</label>
					<textarea name="seo_description" class="form-control" value="<?php echo $pageArr['seo_description']; ?>"></textarea>
				</div>
				<div class="form-group">
					<input type="submit" name="pageEdit" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	var ue = UE.getEditor('container',{
		initialFrameHeight:500
	});
	ue.ready(function() {
    //设置编辑器的内容
    ue.setContent('<?php echo $pageArr['content']; ?>');
   
});
</script>
</body>
</html>