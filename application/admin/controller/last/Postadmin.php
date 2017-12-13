<?php
namespace app\admin\controller;

use think\Controller;
use think\Session;
use think\Env;

class Postadmin extends Controller{
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

		// 获取基本信息表
			// 会员信息表
			$db_users = config('db_users');
			// 文章表
			$db_posts = config('db_posts');
			// 标签表
			$db_tags = config('db_tags');
			// 文章表
			$db_posts = config('db_posts');
			// 分类表
			$db_cates = config('db_cates');
			// 页面表
			$db_pages = config('db_pages');

		// 获取总共多少篇文章
		$postNums = action('admin/Login/tableNums',['table'=>$db_posts]);
		// 获取env中每页分多少
		$showPageNum = Env::get('showPageNum');
		// 文章分页
		$postPageArr = action('admin/Login/postPage',[
			'type'=>'post',
			'showPageNum'=>$showPageNum
		]);

		// 通过判断是否设置page来显示文章
		$page = input('page');
		if(!$page){
			$page = 1;
		}else {
			$page = input('page');
		}
		// 获取数据
		$postArr = action('admin/Login/getAllRows',[
			'type'=>'post',
			'orderBy'=>'id',
			'orderChar'=>'asc',
			'limit'=>$showPageNum,
			'page'=>$page
		]);



		// 统一赋值
		$this->assign('postNums',$postNums);
		$this->assign('postPageArr',$postPageArr);
		$this->assign('postArr',$postArr);
		return view();
	}
}

