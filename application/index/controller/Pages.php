<?php
namespace app\index\Controller;

use think\Controller;
use think\Env;

class Pages extends Controller {
	public function index(){
		// 判断是否有pageId
		if(!input('?pageId')){
			$this->error('非法闯入','index/index/index');
		}else {
			$pageId = input('pageId');
		}

		// 根据ID获取文章信息
		$articlesArr = action('index/Common/getOneRowOf',[
			'type'=>'page',
			'willChar'=>'id',
			'willContent'=>$pageId
		]);
		// 还原html
		$articlesArr = action('index/Common/htmls_decode',[
			'char'=>$articlesArr,
			'layer'=>1
		]);
		// 如果没有信息，则跳转
		if(!$articlesArr){
			$this->error('暂无信息','index/index');
			exit;
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
    	// 获取网站基本信息》》标题 
    	$webArr = action('index/Common/getOneRowOf',[
    		'type'=>'setting',
    		'willChar'=>'web_key',
    		'willContent'=>'STi'
    	]);

    	$webTitle = $webArr['web_title'];
    	$webSplicing = $webArr['title_splicing'];

    	$pageTitle = $articlesArr['title'];

    	$webTitles = $pageTitle.$webSplicing.$webTitle;
    	$webKeywords = $articlesArr['seo_keywords'];
    	$webDescription = $articlesArr['seo_description'];

    	// logoname
    	$webLogo     = $webArr['web_logo'];
    	if(empty($webLogo)){
    		$webLogo = $webTitle;
    	}else {
    		$webLogo = "<img src='{$webLogo}'>";
    	}


		
		

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
		// $this->assign('logo_name',$);
		$this->assign('web_title',$webTitles);
		$this->assign('web_keywords',$webKeywords);
		$this->assign('web_description',$webDescription);
		$this->assign('menuArr',$menuArr);
		$this->assign('days',$days);
		$this->assign('sidebarList',$sidebarList);
		$this->assign('logo_name',$webLogo);
		$this->assign('linkList',$linkList);
		$this->assign('articlesArr',$articlesArr);
		return view();
	}
}

?>