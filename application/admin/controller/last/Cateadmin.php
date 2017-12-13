<?php
namespace app\admin\controller;

use think\Controller;
use think\Session;


class Cateadmin extends Controller{
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

		// 获取所有的分类
		$cateArr = action('admin/Login/getAllRows',[
			'type'=>'cate',
			'orderBy'=>'id',
			'orderChar'=>'asc'
		]);


		// 统一赋值
		$this->assign('cateArr',$cateArr);
		return view();
	}
}


?>