<?php
namespace app\index\Controller;

use think\Controller;
use think\Db;
use think\Env;

class Posts extends Controller{
	public function index(){
		/*
			@	通过id获取文章基本信息
		*/
		if(!input('?postId')){
			$this->error();
			exit();
		}else {
			$postId = input('postId');
		}
		
		$postArr = action('index/Common/getOneRowOf',[
			'type'			=>	'post',
			'willChar'		=>	'id',
			'willContent'	=>	$postId
		]);
		if(empty($postArr)){
			$this->error('无此文章','index/index/index');
			exit;
		}
		$postArr = action('index/Common/getMessageDetail',[
			'type'=>'post',
			'data'=>$postArr,
		]);
		/*
			@	定义网站标题、描述、关键字
		*/
		// 获取Env定义网站标题
		// 获取网站基本信息
    	$webArr = action('index/Common/getOneRowOf',[
    		'type'			=>	'setting',
    		'willChar'		=>	'web_key',
    		'willContent'	=>	'STi'
    	]);
		// $menuArr = action('index/Common/getMenuForLi',['type'=>'menu']);

    	// var_dump($webArr);
    	// 网站标题
    	$webTitle      = $webArr['web_title'];
    	// 网站url
    	$webUrl   	   = $webArr['web_url'];
    	// 网站logo
    	$webLogo       = $webArr['web_logo'];
    	// 网站关键词
    	$webKeywords   = $postArr['seo_keywords'];
    	// 网站描述
    	$webDescription = $postArr['seo_description'];
    	if(empty($webLogo)){
    		$webLogo = $webTitle;
    	}else {
    		$webLogo = "<img src='{$webLogo}'>";
    	}

		/*
			@	获取菜单
		*/
		// $menuArr = action('index/Common/getMessageForPage',[
  //   		'type'	=>'cate',
  //   		'limit'	=>0,
  //   		'page'	=>0
  //   	]);
			$menuArr = action('index/Common/getMenuForLi',['type'=>'menu']);


		/*
			@	侧边栏天数
		*/
		$days = action('index/Common/operationDays');

		/*
			@	侧边栏随机文章
		*/
		$sidebarList = action('index/Common/SideBarSuiji');

		/*
			@	友情链接
		*/
		$linkList = action('index/Common/getLinks');

		/*
			@	获取标签
		*/
		$postTagArr = action('index/Common/getMessageDetail',[
			'type'=>'tag',
			'data'=>$postArr
		]);
		$postArr = $postArr + $postTagArr;


		/*
			@	统一赋值
		*/
		$this->assign('logo_name',$webLogo);
		$this->assign('web_title',$webTitle);
		$this->assign('web_keywords',$webKeywords);
		$this->assign('web_description',$webDescription);
		$this->assign('menuArr',$menuArr);
		$this->assign('days',$days);
		$this->assign('sidebarList',$sidebarList);
		$this->assign('linkList',$linkList);
		$this->assign('postArr',$postArr);


		return view();
	}
	/*
		@	空类
    */
	public function _empty(){
		$this->error();
	}
}
?>