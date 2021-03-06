<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"D:\phpstudy1\WWW\blog\template\admin\cate\cateadmin.html";i:1512039527;s:34:"../template/admin/common/head.html";i:1512288094;}*/ ?>
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
	<!-- 分类管理 -->
	<div class="content">
		<div class="content_title">
			分类管理
		</div>
		<!-- 所有分类 -->
		<div class="cate_administer_suoyou">
			<ul class="list-group">
				<li class="list-group-item active">所有分类</li>
				<?php if(is_array($cateArr) || $cateArr instanceof \think\Collection || $cateArr instanceof \think\Paginator): $i = 0; $__LIST__ = $cateArr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cates): $mod = ($i % 2 );++$i;?>
				<li class="list-group-item">
					<?php echo $cates['name']; ?>
					 <span class="badge">
					 	<a href="<?php echo url('admin/common/deletemessage',[
					 		'type'=>'cate',
					 		'willChar'=>'id',
					 		'willContent'=>$cates['id']
					 	]); ?>">删除</a>
					 </span>
					 <span class="badge">
					 	<a href="<?php echo url('admin/cate/cateedit',['cateId'=>$cates['id']]); ?>">编辑</a>
					 </span>
				</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
	</div>
	<!-- 添加分类 -->
	<div class="content_title">
		添加分类
	</div>
	<div class="cate_administer_tianjia">
		<form action="<?php echo url('admin/common/newmessage',['type'=>'cate']); ?>" method="post">
			<!-- 分类标题 -->
			<div class="form-group">
				分类标题：
				<input type="text" name="name" class="form-control">
			</div>
			<!-- 分类别名 -->
			<div class="form-group">
				分类别名：
				<input type="text" name="s_name" class="form-control">
			</div>
			<!-- 分类SEO keywords -->
			<div class="form-group">
				分类seo关键词：
				<input type="text" name="seo_keywords" class="form-control">
			</div>
			<!-- 分类SEO description -->
			<div class="form-group">
				分类seo描述：
				<textarea name="seo_description" class="form-control"></textarea>
			</div>
			<!-- 添加按钮 -->
			<div class="cate_administer_sub">
				<input type="submit" name="newCateSub" value='添加' class="btn btn-success">
			</div>
		</form>
	</div>
</div>
</body>
</html>