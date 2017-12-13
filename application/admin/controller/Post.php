<?php
namespace app\admin\controller;

use think\Session;
use think\Controller;

class Post extends controller{
	public function index(){
		$this->success('正在跳转','post/postadmin');
	}
	/*
		@	文章管理列表
		@	postadmin
	*/
	public function postadmin(){
		// 判断如果session不正确则跳转登录界面

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

		// 

		// 获取总共多少篇文章
		$postNums = action('admin/Common/tableNums',['type'=>'post']);
		// 获取env中每页分多少
		$showPageNum = 10;
		// 文章分页
		$postPageArr = action('admin/Common/pageination',[
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
		$postArr = action('admin/Common/getAllRowsFor',[
			'type'=>'post',
			'orderBy'=>'id',
			'orderChar'=>'desc',
			'limit'=>$showPageNum,
			'page'=>$page
		]);



		// 统一赋值
		$this->assign('postNums',$postNums);
		$this->assign('postPageArr',$postPageArr);
		$this->assign('postArr',$postArr);
		return view();
	}
	/*
		@	文章编辑
		@	postedit
	*/
	public function postedit(){
		// 判断如果session不正确则跳转登录界面

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

		// 开始获取postId 如果没有设置则跳转到上一页
		$postId = input('postId');

		if(!$postId){
			$this->error('没有设置id');
		}
		// 根据post信息获取一行信息
		$postArr = action('admin/Common/getOneRowArr',[
			'type'=>'post',
			'char'=>'id',
			'value'=>$postId
		]);

		// 如果获取失败
		if(!$postArr){
			$this->error('获取文章信息失败');
			exit;
		}

		// 获取文章分类名称
		$cateName = action('admin/Common/getRowContentOf',[
			'type'=>'cate',
			'willChar'=>'id',
			'willContent'=>$postArr['cates_id'],
			'char'=>'name',
			'new'=>'no'

		]);
		// 如果失败
		if(!$cateName){
			return '获取文章分类失败';
			exit;
		}

		// 准备分类名称数组
		$cateArr = ['cateName'=>$cateName];
		// 将分类名称数组与原数组合并
		$postArr = $cateArr + $postArr;

		// 获取标签名字
		$tagArr = action('admin/Common/getAllRowsOf',[
			'type'=>'later',
			'willChar'=>'wzid',
			'willContent'=>$postId,
		]);
		// 如果获取失败
		if(!$tagArr){
			$tagArr = '';
		}
		// tagId放到一个数组并直接获取名称
		$tagName = '';
		// var_dump($tagArr[0]['glid']);
		if(is_array($tagArr)){
			foreach ($tagArr as $key => $value) {
			$tagName .= action('admin/Common/getRowContentOf',[
				'type'=>'tag',
				'willChar'=>'id',
				'willContent'=>$tagArr[$key]['glid'],
				'char'=>'name',
				'new'=>'no'
			]).',';
			}
		}else {
			$tagName = '暂无标签';
		}
		
		// 准备标签数组信息
		$tagNameArr = ['tagName'=>$tagName];
		// 合并到文章数组信息里面
		$postArr = $tagNameArr + $postArr;

		// 还原转义
		$postArr = action('admin/Common/htmls_decode',[
			'char'=>$postArr,
			'layer'=>1
		]);


		// 赋值文章数组
		$this->assign('postArr',$postArr);

		return view();
	}
	/*
		@	新建文章
		@	postnew
	*/
	public function postnew(){
		// 判断如果session不正确则跳转登录界面

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

		// 开始获取所有的分类
		$cateArr = action('admin/Common/getAllRowsFor',[
			'type'=>'cate',
			'orderBy'=>'id',
			'orderChar'=>'desc'
		]);
		// 获取预计文章链接
			// 获取最后一篇文章id
			$lastId = action('admin/Common/getTableLastId',['type'=>'post']);
			// 生成预计链接
			$extecpedUrl = url('index/posts/index',['postId'=>$lastId]);
			// 去除多余部分
			$postUrl = str_replace('/admin.php', '', $extecpedUrl);


		// 统一赋值
		$this->assign('cateArr',$cateArr);
		$this->assign('postUrl',$postUrl);


		return view();
	}
	/*
		@	文章搜索
	*/
	public function postsearch(){
		if(!input()){
			$this->error('非法访问','admin/post/postadmin');
			exit;
		}	
		$data = input();

		$searchStr = $data['post_search_title'];

		// 开始搜索
		$searchArr = action('admin/Common/messageSearch',['type'=>'post','char'=>$searchStr]);

		// 赋值
		$this->assign('searchstr',$searchStr);
		$this->assign('searchArr',$searchArr);
		return view();
	}
}

?>