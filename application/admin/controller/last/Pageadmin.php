<?php
namespace app\admin\controller;

use think\Controller;
use think\Session;

class Pageadmin extends Controller {
	public function index(){
		// 判断session
		$administer = session::get('administer');
		if(!$administer){
			$this->error('非法闯入','admin/login/index');
			exit;
		}else {
			if(session::get('administer') != 'admin'){
				$this->error('非法闯入','admin/login/index');
				exit;
			}
		}

		// 判断是否分页
		if(!input('?page')){
			$page = 1;
		}else {
			$page = input('page');
		}

		// 获取所有页面
		$pageArr = action('admin/Login/getAllRows',[
			'type'=>'page',
			'orderBy'=>'id',
			'orderChar'=>'asc',
			'page'=>$page,
			'limit'=>10
		]);

		// 分页
		$pageination = action('admin/Login/postPage',[
			'type'=>'page',
			'showPageNum'=>10
		]);

		// 统一赋值
		$this->assign('pageArr',$pageArr);
		$this->assign('pageination',$pageination);

		return view();
	}
}

?>