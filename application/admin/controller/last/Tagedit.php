<?php
namespace app\admin\controller;

use think\Controller;
use think\Session;

class Tagedit extends Controller{
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

		// 判断是否有tagId
		if(!input('?tagId')){
			$this->error('非法闯入','admin/tagadmin/index');
			exit;
		}else{
			$tagId = input('tagId');
		}

		// 获取标签信息
		$tagArr = action('admin/Login/getOneRow',[
			'type'=>'tag',
			'char'=>'id',
			'value'=>$tagId
		]);

		// 统一模板赋值
		$this->assign('tagArr',$tagArr);
		return view();
	}
}

