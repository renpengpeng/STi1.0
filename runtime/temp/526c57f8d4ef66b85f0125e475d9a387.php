<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"D:\phpstudy1\WWW\blog\template\admin\setting\xitong.html";i:1512563961;s:34:"../template/admin/common/head.html";i:1512288094;}*/ ?>
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
			系统设置
		</div>
		<div class="xitong_form">
			<form action="<?php echo url('admin/setting/xitongedit'); ?>" method="post">
				<div class="form-group">
					<label>网站标题</label>
					<input type="text" name="web_title" class="form-control" value="<?php echo $setArr['web_title']; ?>">
				</div>
				<div class="form-group">
					<label>网站地址<small>请以绝对地址开头 比如：http://demo.com</small></label>
					<input type="text" name="web_url" class="form-control" value="<?php echo $setArr['web_url']; ?>">
				</div>
				<div class="form-group">
					<label>网站logo<small>请以图片地址加入，比如&lt;img src="">，不设置默认为网站标题</small></label>
					<input type="text" name="web_logo" class="form-control" value="<?php echo $setArr['web_logo']; ?>">
				</div>
				<div class="form-group">
					<label>网站关键词 <small>请以英文逗号分隔</small></label>
					<input type="text" name="web_keywords" class="form-control" value="<?php echo $setArr['web_keywords']; ?>">
				</div>
				<div class="form-group">
					<label>网站描述</label>
					<input type="text" name="web_description" class="form-control" value="<?php echo $setArr['web_description']; ?>">
				</div>
				<div class="form-group">
					<label>标题分隔符</label>
					<input type="text" name="title_splicing" class="form-control" value="<?php echo $setArr['title_splicing']; ?>">
				</div>
				<div class="form-group">
					<label>前台每页显示多少篇文章</label>
					<input type="text" name="show_page_num" class="form-control" value="<?php echo $setArr['show_page_num']; ?>">
				</div>
				<div class="form-group">
					<label>网站注册时间 格式为：xxxx-xx-xx</label>
					<input type="text" name="web_reg_time" class="form-control" value="<?php echo $setArr['web_reg_time']; ?>">
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