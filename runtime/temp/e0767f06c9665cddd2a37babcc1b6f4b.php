<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"D:\phpstudy1\WWW\blog\template\admin\login\index.html";i:1511360523;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/css/style.css" rel="stylesheet" type="text/css">
	<link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/css/media.css" rel="stylesheet" type="text/css">
	<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/static/admin/js/jquery-3.1.1.min.js"></script>
	<title>登录</title>
</head>
<body>
<div class="container">
	<div class="panel login">
		<div class="panel-heading login_heading">
			登录
		</div>
		<div class="panel-body">
			<form action="<?php echo url('admin/login/loginYz'); ?>" method="post">
				<p>
					<label>用户名：</label><input type="text" name="admin_username">
				</p>
				<p>
					<label>&nbsp;&nbsp;&nbsp;密码：</label><input type="password" name="admin_password">
				</p>
				<p>
					<label>验证码：</label><input type="text" name="admin_yzm">
				</p>
				<p>
					<img src="<?php echo captcha_src(); ?>" alt="captcha" height="30" onclick="this.src='<?php echo captcha_src(); ?>'" />
				</p>
				<p>
					<input type="submit" name="admin_sub" value="登录" class="login_sub">
				</p>

			</form>
		</div>
	</div>
</div>
<div class="login_body"></div>
<div class="bo"></div>
</body>
</html>