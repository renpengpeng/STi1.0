<?php
namespace app\admin\controller;

use think\Controller;
use think\Session;

class Tagadmin extends Controller{
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
		// 获取page
		if(!input('?page')){
			$page = 1;
		}else {
			$page = input('page');
		}
		// 根据分页获取标签
		$tagArr = action('admin/Login/getAllRows',[
			'type'=>'tag',
			'orderBy'=>'id',
			'orderChar'=>'asc',
			'page'=>$page,
			'limit'=>'10'
		]);
		// 分页
		$pageArr = action('admin/Login/postPage',[
			'type'=>'tag',
			'showPageNum'=>10
		]);


		// 统一赋值到页面
		$this->assign('tagArr',$tagArr);
		$this->assign('pageArr',$pageArr);
		return view();
	}
}

