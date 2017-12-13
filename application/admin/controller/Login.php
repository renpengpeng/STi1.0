<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Env;
use think\Session;

class Login extends controller{
	public function index(){
		// 判断如果session已经设置，则跳转到首页
		$administer = session::has('administer');
		if(!$administer){
			return view();
		}else {
			$this->success('已经登录','admin/index/index');
		}
		
		
	}
	/*
		@	登录验证
	*/
	public function loginYz(){
		// 准备公用数据
			// 时间
			$nowTime = action('admin/Common/getTime');
			// ip
			$nowIp = action('admin/Common/getIp');


		// 获取用户表
		$db_admin = action('admin/Common/tableName',['type'=>'user']);

		// 如果没有设置参数跳转否则赋值
		if(!input()){
			$this->error('admin/Login/index');
			exit;
		}else {
			$data = input();
		}

		// 过滤html
		$data = action('admin/Common/htmls',[
			'char'=>$data,
			'layer'=>1
		]);

		// 获取一行数组
		$administerArr = action('admin/Common/getOneRowArr',[
			'type'=>'user',
			'char'=>'s_name',
			'value'=>$data['admin_username']
		]);
		if(!$administerArr){
			// $this->error('系统错误','admin/Login/index');
			dump($administerArr);
			exit;
		}

		// 判断权限
		if($administerArr['garden'] != 'admin'){
			$this->error('没有权限','admin/Login/index');
		}

		// 判断密码
		if($administerArr['password'] != md5($data['admin_password'])){
			$this->error('密码错误','admin/Login/index');
			exit;
		}

		// 判断验证码
		if(!captcha_check($data['admin_yzm'])){
 			$this->error('验证码错误','admin/Login/index');
			exit;
		}

		// 登录成功

			// 获取数据库时间登录信息
			$userLoginIp = $administerArr['login_ip'];
			$userLoginTime = $administerArr['login_time'];

			// 准备更新信息
			$updateData = [
				'last_time'=>$userLoginTime,
				'login_time'=>$nowTime,
				'last_ip'=>$userLoginIp,
				'login_ip'=>$nowIp
			];
			// 开始更新
			$db = action('admin/Common/tableName',['type'=>'user']);
			$update = Db::table($db)->where('s_name',$data['admin_username'])->update($updateData);
			if(!$update){
				$this->error('系统错误(update)','admin/Login/index');
				exit;
			}

			// 设置session
			$settingSessionGraden = Session::set('administer','admin');
			$settingSessionId	  = Session::set('administerId',$administerArr['id']);
			if(empty(Session::get('administer')) || empty(Session::get('administerId'))){
				$this->error('系统错误(session)','admin/Login/index');
				exit;
			}

			// 跳转首页
			$this->success('登录成功','admin/index/index');


	}
	/*
		@	登出
	*/
	public function loginout(){
		Session::pull('administer');
		Session::pull('administerId');
		$this->success('登出成功','admin/Login/index');
	}
	public function _empty(){
		$this->error('错误','admin/Login/index');
	}
}
?>