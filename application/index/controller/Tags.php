<?php
// 命名空间
namespace app\index\Controller;
// 数据库操作
use think\Db;
// 系统控制器
use think\Controller;
// ENV
use think\Env;

class Tags extends Controller {

	public function index(){
		// 判断是否有id
		if(!input('?tagId')){
			$this->error('非法访问','index/index/index');
			exit;
		}else {
			$tagId = input('tagId');
		}
		// 判断page
		if(!input('?page')){
			$page = 1;
		}else {
			$page = input('page');
		}
		// 获取当前标签信息
		$tagArr = action('index/Common/getOneRowOf',[
			'type'			=>'tag',
			'willChar'		=>'id',
			'willContent'	=>$tagId
		]);

		// 获取网站基本信息
    	$webArr = action('index/Common/getOneRowOf',[
    		'type'			=>	'setting',
    		'willChar'		=>	'web_key',
    		'willContent'	=>	'STi'
    	]);

    	// var_dump($webArr);
    	// 网站标题
    	$webTitle      = $webArr['web_title'];
    	// 网站url
    	$webUrl   	   = $webArr['web_url'];
    	// 获取分隔符
    	$webSplicing = $webArr['title_splicing'];
    	// 获取每页分多少
    	$showPageNum = $webArr['show_page_num'];

    	// 标签名称
    	$tagTitle = $tagArr['name'];
    	// 标签关键词
    	$webKeywords   = $tagArr['seo_keywords'];
    	// 标签描述
    	$webDescription = $tagArr['seo_description'];
    	// 网站logo
    	$webLogo       = $webArr['web_logo'];
    	if(empty($webLogo)){
    		$webLogo = $webTitle;
    	}else {
    		$webLogo = "<img src='{$webLogo}'>";
    	}
    	if($page > 1){
    		$webTitle = $tagTitle.$webSplicing."第{$page}页";
    	}

		// 判断
		$totalNum = action('index/Common/getTableNumsOf',[
			'type'=>'later',
			'willChar'=>'glid',
			'willContent'=>$tagId
		]);
		if(ceil($totalNum/$showPageNum)<$page){
			$this->error('没有此页面','index/index/index');
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
		/*
			@	取出文章
		*/
		// 查询关联表所有此标签的关联文章
		$tagLaterArr = action('index/Common/getAllRowsOfPage',[
			'type'=>'later',
			'willChar'=>'glid',
			'willContent'=>$tagId,
			'limit'=>$showPageNum,
			'page'=>$page
		]);
		// 赋值文章id
		foreach ($tagLaterArr as $key => $value) {
			$artId[] = $tagLaterArr[$key]['wzid'];
		}
		// 开始获取文章信息
		foreach ($artId as $key => $value) {
			$articlesArr[] = action('index/Common/getOneRowOf',[
				'type'=>'post',
				'willChar'=>'id',
				'willContent'=>$artId[$key]
			]);
		}
		// 添加详细信息
		$articlesArr = action('index/Common/getMessageDetail',[
			'type'=>'list',
			'data'=>$articlesArr
		]);

		// 分页
		$pageList = action('index/Common/pageination',[
			'type'=>'later',
			'showPageNum'=>$showPageNum,
			'willChar'=>'glid',
			'willContent'=>$tagId
		]);


		/*
			@	运行天数
		*/
		$days = action('index/Common/operationDays');
		/*
			@	侧边栏
		*/
		$sidebarList = action('index/Common/SideBarSuiji');
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
		$this->error();
	}
}

