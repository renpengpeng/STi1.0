<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"D:\phpstudy1\WWW\blog\template\admin\post\postadmin.html";i:1512564589;s:34:"../template/admin/common/head.html";i:1512288094;}*/ ?>
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

<!-- 文章管理页面html -->
<div class="content">
	<div class="content_title">
		写文章:<a href="<?php echo url('admin/post/postnew'); ?>">点我新建文章</a>
	</div>
	<div class="content_title">
		文章管理
	</div>
	<div class="content_content">
		<!-- 文章搜索 -->
		<div class="form-group" style="text-align: center;">
			<form action="<?php echo url('admin/post/postsearch'); ?>" method="post">
				<input type="text" name="post_search_title" class="form-control" placeholder="请输入文章关键字"><br>
			<input type="submit" name="post_administer_sub" value="搜索" class="btn btn-success" style="width: 80%;">
			</form>
		</div>
		<ul class="list list-group">
			<li class="list-group-item active">共<?php echo $postNums; ?>篇文章</li>
			<?php foreach($postArr as $posts): ?>
			<li class="list-group-item">
					<a href=""><?php echo $posts['title']; ?></a>
					<span class="badge list_up"><a href="<?php echo url('admin/post/postedit',[
						'postId'=>$posts['id']
					]); ?>">编辑</a></span>
				    <span class="badge">
				    	<a href="<?php echo url('admin/Common/deletemessage/',[
				    		'type'=>'post',
				    		'willChar'=>'id',
				    		'willContent'=>$posts['id']
				    	]); ?>">删除</a>
				    </span>
				    <span class="badge"><?php echo $posts['views']; ?></span>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="post_administer_page">
		<?php echo $postPageArr->render(); ?>
	</div>
</div>
</div>
<script>

</script>
</body>
</html>