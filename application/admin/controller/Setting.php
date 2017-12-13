<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Setting extends Controller{
	public function index(){
		return view();
	}
	/*
		@	菜单设置
	*/
	public function menus(){

		// 获取菜单Li
		$menuArr = action('admin/Common/getMenusForLi',['type'=>'menu']);
		// 获取菜单Ul
		$menuArrS = action('admin/Common/getMenusForSelect',['type'=>'menu']);


		$this->assign('menuArr',$menuArr);
		$this->assign('menuArrS',$menuArrS);
		return view();
	}
	/*
		@	菜单编辑
	*/
	public function menusedit(){
		if(!input('?menuId')){
			$this->error('非法闯入','admin/Setting/menus');
		}else {
			$menuId = input('menuId');
		}

		$arrs = action('admin/Common/getOneRowArr',[
			'type'=>'menu',
			'char'=>'id',
			'value'=>$menuId
		]);
		// 获取菜单 select
		$arrsSelect = action('admin/Common/getMenusForSelect',['type'=>'menu']);
		// 赋值
		$this->assign('menuArr',$arrs);
		$this->assign('selectArr',$arrsSelect);
		return view();
	}
	/*
		@	系统设置
	*/
	public function xitong(){
		// 开始获取系统信息
		$settingArr = action('admin/Common/getOneRowArr',[
			'type'=>'setting',
			'char'=>'web_key',
			'value'=>'STi'
		]);
		// 赋值
		$this->assign('setArr',$settingArr);
		return view();
	}
	/*
		@ 系统更新数据
	*/
	public function xitongedit(){
		if(!input()){
			$this->error('非法','admin/setting/xitong');
			exit;
		}
		// 开始更新数据
		$data = input();
		$db = action('admin/Common/tableName',['type'=>'setting']);
		$updates = Db::table($db)->where('web_key','STi')->update($data);
		if($updates){
			$this->success('修改成功','admin/setting/xitong');
		}else {
			$this->error('修改失败','admin/setting/xitong');
		}
	}
}