<?php
namespace app\admin\controller;

use think\Session;
use think\Controller;

class Tag extends Controller{
	public function index(){
		// 跳转到tagadmin
		$this->success('正在跳转','tagadmin');
	}
	/*
		@	标签管理
		@	tagadmin
	*/
	public function tagadmin(){
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


		// 获取page
		if(!input('?page')){
			$page = 1;
		}else {
			$page = input('page');
		}
		// 根据分页获取标签
		$tagArr = action('admin/Common/getAllRowsFor',[
			'type'=>'tag',
			'orderBy'=>'id',
			'orderChar'=>'desc',
			'page'=>$page,
			'limit'=>'10'
		]);

		// 分页
		$pageArr = action('admin/Common/pageination',[
			'type'=>'tag',
			'showPageNum'=>10
		]);


		// 统一赋值到页面
		$this->assign('tagArr',$tagArr);
		$this->assign('pageArr',$pageArr);
		return view();
	}
	/*
		@	标签编辑
		@	tagedit
	*/
	public function tagedit(){
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

		// 判断是否有tagId
		if(!input('?tagId')){
			$this->error('非法闯入','admin/tag/tagadmin');
			exit;
		}else{
			$tagId = input('tagId');
		}

		// 获取标签信息
		$tagArr = action('admin/Common/getOneRowArr',[
			'type'=>'tag',
			'char'=>'id',
			'value'=>$tagId
		]);

		// 统一模板赋值
		$this->assign('tagArr',$tagArr);
		return view();
	}
}

?>