<?php
// 命名空间
namespace app\index\Controller;
// 数据库操作
use think\Db;
// 系统控制器
use think\Controller;
// ENV
use think\Env;

class Cates extends Controller {

	public function index(){
		// 判断分类id
		if(input('?cateId')){
    		$cateId = input('cateId');
    	}else {
    		$this->error('非法闯入');
    		exit;
    	}
    	// 判断当前页码
		// 获取每页显示多少文章
		
		if(input('?page')){
			$page = input('page');
		}else {
			$page = 1;
		}

		/*
			@	开始设置网站标题，描述等基本信息
			@	判读当前ID，根据id调用index控制器的cateName 方法拼接原本title
		*/

		// 获取网站基本信息
    	$webArr = action('index/Common/getOneRowOf',[
    		'type'			=>	'setting',
    		'willChar'		=>	'web_key',
    		'willContent'	=>	'STi'
    	]);

    	// var_dump($webArr);
    	// 网站标题
    	$webTitle    = $webArr['web_title'];
    	// 网站url
    	$webUrl  	   = $webArr['web_url'];
    	// 网站标题拼接符号
    	$webTitleSplicing  = $webArr['title_splicing'];
    	// 网站logo
    	$webLogo       = $webArr['web_logo'];
    	// 每页多少文章
    	$showPageNum = $webArr['show_page_num'];

    	if(empty($webLogo)){
    		$webLogo = $webTitle;
    	}else {
    		$webLogo = "<img src='{$webLogo}'>";
    	}

    	// 取出当前分类列
    	$cateRow = action('index/Common/getOneRowOf',[
    		'type'			=>	'cate',
    		'willChar'		=>	'id',
    		'willContent'	=>	$cateId
    	]);
    	if($page >1){
    		$webTitle = $cateRow['name'].$webTitleSplicing."第{$page}页";
    	}else {
    		$webTitle = $cateRow['name'];
    	}
    	$webKeywords 	= $cateRow['seo_keywords'];
    	$webDescription = $cateRow['seo_description'];

    	// 如果页码超出则退出
    	$totalNum = action('index/Common/getTableNumsOf',[
    		'type'			=>	'post',
    		'willChar'		=>	'cates_id',
    		'willContent'	=>	$cateId
    	]);
    	if($page != 1){
    		if(ceil($totalNum/$showPageNum)<$page){
    			$this->error('没有此页面','index/index/index');
    			exit;
    		}
    	}
    	



		/*
			@	取出菜单
		*/
		// $menuArr = action('index/Common/getMessageForPage',[
  //   		'type'	=>'cate',
  //   		'limit'	=>0,
  //   		'page'	=>0
  //   	]);
		$menuArr = action('index/Common/getMenuForLi',['type'=>'menu']);
		/*
			@	取出文章
		*/

		$articlesArr = action('index/Common/getMessageForCharPage',[
			'type'			=>	'post',
			'willChar'		=>	'cates_id',
			'willContent'	=>	$cateId,
			'page'			=>	$page,
			'limit'			=>	$showPageNum
		]);
		// 增加详细信息
		$articlesArr = action('index/Common/getMessageDetail',[
			'type'=>'list',
			'data'=>$articlesArr
		]);
		

		/*
			@	分页
		*/
		$pageList = action('index/Common/pageination',[
			'type'			=>	'post',
			'showPageNum'	=>	$showPageNum,
			'willChar'		=>	'cates_id',
			'willContent'	=>	$cateId
		]);

		/*
			@	运行天数
		*/
		$days = action('index/Common/operationDays');
		/*
			@	侧边栏
		*/
		$sidebarList = action('index/Common/sideBarSuiji');

		/*
			@	友情链接
		*/
		$linkList = action('index/Common/getLinks');
		/*
			@	统一赋值
		*/
		$this->assign('web_title',$webTitle);
		$this->assign('web_keywords',$webKeywords);
		$this->assign('web_description',$webDescription);
		$this->assign('menuArr',$menuArr);
		$this->assign('articlesArr',$articlesArr);
		$this->assign('days',$days);
		$this->assign('pageList',$pageList);
		$this->assign('sidebarList',$sidebarList);
		$this->assign('logo_name',$webLogo);
		$this->assign('linkList',$linkList);
		return view();
	}
	/*
		@	空类
    */
	public function _empty(){
		$this->error('','index/index/index');
	}
}

