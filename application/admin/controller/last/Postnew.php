<?php
namespace app\admin\controller;

use think\Controller;
use think\Session;

class Postnew extends Controller{
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

		// 开始获取所有的分类
		$cateArr = action('admin/Login/selectOneRow',['type'=>'cate']);
		// 获取预计文章链接
			// 获取最后一篇文章id
			$lastId = action('admin/Login/getLastId',['type'=>'post']);
			// 生成预计链接
			$extecpedUrl = url('index/posts/index',['postId'=>$lastId]);
			// 去除多余部分
			$postUrl = str_replace('/admin.php', '', $extecpedUrl);


		// 统一赋值
		$this->assign('cateArr',$cateArr);
		$this->assign('postUrl',$postUrl);


		return view();
	}
}