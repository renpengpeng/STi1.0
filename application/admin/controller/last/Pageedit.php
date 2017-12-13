<?php
namespace app\admin\controller;

use think\Controller;
use think\Session;


class Pageedit extends Controller{
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

		//	判断如果没有设置pageid跳转
		if(!input('?pageId')){
			$this->error('非法闯入','admin/pageadmin/index');
			exit;
		}else {
			$pageId = input('pageId');
		}
		// 获取数组
		$pageArr = action('admin/Login/getOneRow',[
			'type'=>'page',
			'char'=>'id',
			'value'=>$pageId
		]);

		// 赋值
		$this->assign('pageArr',$pageArr);
		return view();
	}
}