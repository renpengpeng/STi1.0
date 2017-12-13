<?php
namespace app\Admin\controller;

use think\Db;
use think\Env;
use think\Controller;
use think\Session;

class Index extends Controller {
	public function index(){
		// 判断如果session不正确则跳转登录界面

		$administerHas = Session::has('administer');
		if(!$administerHas){
			$this->error('没有登录','admin/Login/index');
		}else {
			$administer = Session::get('administer');
		}
		$administers = action('admin/Common/getAdministerForSession',['administer'=>$administer]);
		if(!$administers){
			$this->error('权限不够','admin/Login/index');
			exit;
		}

		
		/*
			@	获取基本信息数量
		*/

		// 获取分类个数
		$cateNums = action('admin/Common/tableNums',['type'=>'cate']);

		// 获取标签个数
		$tagNums =  action('admin/Common/tableNums',['type'=>'tag']);

		// 获取文章总数量
		$postNums = action('admin/Common/tableNums',['type'=>'post']);

		// 获取页面总数量
		$pageNums = action('admin/Common/tableNums',['type'=>'page']);
		
		// 获取管理员信息row

			// 开始获取当前id的信息
			// $administerRow = action('admin/Common/getRowArr',['administerId'=>$administerId]);
			$administerRow = action('admin/Common/getOneRowArr',[
				'type'=>'user',
				'char'=>'id',
				'value'=>Session::get('administerId')
			]);

		// 获取上次登录时间
		$lastLoginTime = $administerRow['last_time'];
		// 获取上次登录ip
		$lastLoginIp = $administerRow['last_ip'];
		// 获取本次登录ip
		$thisLoginIp = $administerRow['login_ip'];



		// 开始统一赋值
		$this->assign('postNums',$postNums);
		$this->assign('tagNums',$tagNums);
		$this->assign('pageNums',$pageNums);
		$this->assign('cateNums',$cateNums);
		// 
		$this->assign('lastLoginTime',$lastLoginTime);
		$this->assign('lastLoginIp',$lastLoginIp);
		$this->assign('thisLoginIp',$thisLoginIp);
		return view();
	}
}

?>