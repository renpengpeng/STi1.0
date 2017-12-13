<?php
namespace app\admin\controller;

use think\Controller;
use think\Session;


class Cateedit extends Controller{
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

		// 判断是否有id 没有返回上一级
		if(!input('?cateId')){
			$this->error('没有id，非法闯入','admin/cateadmin/index');
			exit;
		}
		// 赋值
		$cateId = input('cateId');
		// 获取通过该id获取一行数据
		$cateArr = action('admin/Login/getOneRow',[
			'type'=>'cate',
			'char'=>'id',
			'value'=>$cateId
		]);

		// 统一赋值给模板
		$this->assign('cateArr',$cateArr);
		return view();
	}
}