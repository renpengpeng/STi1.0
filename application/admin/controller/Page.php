<?php
namespace app\admin\controller;

use think\Session;
use think\Controller;

class Page extends Controller{
	public function index(){
		// 开始跳转页面管理
		$this->success('正在跳转','pageadmin');
	}
	/*
		@	页面管理
		@	pageadmin
	*/
	public function pageadmin(){
		// 判断session
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

		// 判断是否分页
		if(!input('?page')){
			$page = 1;
		}else {
			$page = input('page');
		}

		// 获取所有页面
		$pageArr = action('admin/Common/getAllRowsFor',[
			'type'=>'page',
			'orderBy'=>'id',
			'orderChar'=>'desc',
			'page'=>$page,
			'limit'=>10
		]);

		// 分页
		$pageination = action('admin/Common/pageination',[
			'type'=>'page',
			'showPageNum'=>10
		]);

		// 统一赋值
		$this->assign('pageArr',$pageArr);
		$this->assign('pageination',$pageination);

		return view();
	}
	/*
		@	页面编辑
		@	pageedit
	*/
	public function pageedit(){
		// 判断session
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

		//	判断如果没有设置pageid跳转
		if(!input('?pageId')){
			$this->error('非法闯入','admin/page/pageadmin');
			exit;
		}else {
			$pageId = input('pageId');
		}
		// 获取数组
		$pageArr = action('admin/Common/getOneRowArr',[
			'type'=>'page',
			'char'=>'id',
			'value'=>$pageId
		]);
		// 编码复原
		$pageArr = action('admin/Common/htmls_decode',[
			'char'		=>	$pageArr,
			'layer'		=>	1
		]);
		// 赋值
		$this->assign('pageArr',$pageArr);
		return view();
	}
}

?>