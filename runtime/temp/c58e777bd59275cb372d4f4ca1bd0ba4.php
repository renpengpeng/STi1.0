<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"D:\phpstudy1\WWW\blog\template\admin\pageadmin\index.html";i:1511874401;s:34:"../template/admin/common/head.html";i:1511957843;}*/ ?>
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
	<!-- 分类管理 -->
	<div class="content">
		<div class="content_title">
			页面管理
		</div>
		<!-- 所有分类 -->
		<div class="cate_administer_suoyou">
			<ul class="list-group">
				<li class="list-group-item active">所有分类</li>
				<?php if(is_array($pageArr) || $pageArr instanceof \think\Collection || $pageArr instanceof \think\Paginator): $i = 0; $__LIST__ = $pageArr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pages): $mod = ($i % 2 );++$i;?>
				<li class="list-group-item">
					<?php echo $pages['title']; ?>
					 <span class="badge">
					 	<a href='javascript:'>删除</a>
					 </span>
					 <span class="badge">
					 	<a href="<?php echo url('admin/Pageedit/index',['pageId'=>$pages['id']]); ?>">编辑</a>
					 </span>
				</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
	</div>
	<!-- 添加分类 -->
	<div class="content_title">
		添加页面
	</div>
	<div class="cate_administer_tianjia">
		<form action="<?php echo url('admin/Login/newMessage',['type'=>'page']); ?>" method="post">
			<!-- 分类标题 -->
			<div class="form-group">
				页面标题：
				<input type="text" name="title" class="form-control">
			</div>
			<!-- 分类别名 -->
			<div class="form-group">
				页面内容：
				<textarea name="content" class="form-control"></textarea>
			</div>
			<!-- 分类SEO keywords -->
			<div class="form-group">
				页面seo关键词：
				<input type="text" name="seo_keywords" class="form-control">
			</div>
			<!-- 分类SEO description -->
			<div class="form-group">
				页面seo描述：
				<textarea name="seo_description" class="form-control"></textarea>
			</div>
			<!-- 添加按钮 -->
			<div class="form-group">
				<input type="submit" name="newPageSub" value='添加' class="btn btn-success">
			</div>
		</form>
	</div>
</div>
</body>
</html>