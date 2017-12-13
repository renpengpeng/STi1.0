<?php
namespace app\admin\controller;

use think\Session;
use think\Controller;

class Cate extends Controller{
	public function index(){
		// 跳转到分类管理
		$this->success('正在跳转','cateadmin');
	}
	/*
		@	分类管理
		@	cateadmin
	*/
	public function cateadmin(){
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

		// 获取所有的分类
		$cateArr = action('admin/Common/getAllRowsFor',[
			'type'=>'cate',
			'orderBy'=>'id',
			'orderChar'=>'desc'
		]);


		// 统一赋值
		$this->assign('cateArr',$cateArr);
		return view();
	}
	/*
		@	分类编辑
		@	cateedit
	*/
	public function cateedit(){
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

		// 判断是否有id 没有返回上一级
		if(!input('?cateId')){
			$this->error('没有id，非法闯入','admin/cate/cateadmin');
			exit;
		}
		// 赋值
		$cateId = input('cateId');
		// 获取通过该id获取一行数据
		$cateArr = action('admin/Common/getOneRowArr',[
			'type'=>'cate',
			'char'=>'id',
			'value'=>$cateId
		]);
		// 还原html
		$cateArr = action('admin/Common/htmls_decode',[
			'char'=>$cateArr,
			'layer'=>1
		]);
		// 统一赋值给模板
		$this->assign('cateArr',$cateArr);
		return view();
	}
}

?>