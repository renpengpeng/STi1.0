<?php
namespace app\admin\controller;

use think\Controller;
use think\Session;

class Postedit extends Controller{
	public function index(){
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
			exit;
		}

		// 根据post信息获取一行信息
		$postArr = action('admin/Login/getOneRow',[
			'type'=>'post',
			'char'=>'id',
			'value'=>$postId
		]);
		// 如果获取失败
		if($postArr == 'error'){
			$this->error('获取文章信息失败');
			exit;
		}
		// 转换html标签
		foreach ($postArr as $key => $value) {
			$postArr[$key] = htmlspecialchars_decode($value);
		}
		// 获取文章分类名称
		$cateName = action('admin/Login/getRowContent',[
			'type'=>'cate',
			'willChar'=>'id',
			'willContent'=>$postArr['cates_id'],
			'char'=>'name',
			'new'=>'no'

		]);
		// 如果失败
		if($cateName == 'error'){
			return '获取文章分类失败';
			exit;
		}
		// var_dump($postArr);
		// 准备分类名称数组
		$cateArr = ['cateName'=>$cateName];
		// 将分类名称数组与原数组合并
		$postArr = $cateArr + $postArr;

		// 获取标签名字
		$tagArr = action('admin/Login/getAllRowOf',[
			'type'=>'later',
			'willChar'=>'wzid',
			'willContent'=>$postId,
		]);
		// 如果获取失败
		if($tagArr == 'error'){
			$tagArr = '';
		}
		// tagId放到一个数组并直接获取名称
		$tagName = '';
		// var_dump($tagArr[0]['glid']);
		if(is_array($tagArr)){
			foreach ($tagArr as $key => $value) {
			$tagName .= action('admin/Login/getRowContent',[
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



		// 赋值文章数组
		$this->assign('postArr',$postArr);

		return view();
	}
}


?>