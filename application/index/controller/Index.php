<?php
namespace app\index\controller;
// 引入数据库Db类
use think\Db;
// 引入控制器
use think\Controller;
// 引入env
use think\Env;
class Index extends Controller
{

    public function index()
    {
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
    	// 网站关键词
    	$webKeywords   = $webArr['web_keywords'];
    	// 网站描述
    	$webDescription = $webArr['web_description'];
    	// 网站logo
    	$webLogo       = $webArr['web_logo'];
    	if(empty($webLogo)){
    		$webLogo = $webTitle;
    	}else {
    		$webLogo = "<img src='{$webLogo}'>";
    	}

    	// 获取菜单
    	$menuArr = action('index/Common/getMenuForLi',['type'=>'menu']);


    	//	----------------------------------

    	/* 获取网站文章 */
    	// 设置每页展示数量
    	$showPageNum = $webArr['show_page_num'];

    	// 判断是否设置分页 如果有分页page为分页值，如果没有则page=1
    	if(input('?page')){
    		$page = input('page');
    		// 获取文章总数判断
    		$totalNum = action('index/Common/getTableNums',[
    			'type'=>'post'
    		]);
    		if(ceil($totalNum/$showPageNum)<$page){
    			$this->error('没有该页面','index/index/index');
    			exit;
    		}
    	}else {
    		$page = 1;
    	}

    	// 取出分页数据
    	$pageList = action('index/Common/pageination',[
    		'type'			=>'post',
    		'showPageNum'	=>$showPageNum
    	]);


    	// 根据分页文章取出数据
    	$articlesArr = action('index/Common/getMessageForPage',[
    		'type'		=>	'post',
    		'limit'		=>	$showPageNum,
    		'page'		=>	$page
    	]);

    	// 添加详细信息
    	$articlesArr = action('index/Common/getMessageDetail',[
    		'type'=>'list',
    		'data'=>$articlesArr
    	]);

		
    	// dump($articlesArr);
		//	----------------------------------

		/* 侧边栏随机文章获取 */

		$sidebarArr = action('index/Common/sideBarSuiji',['cates'=>0,'nums'=>10]);

    	//	----------------------------------

    	/* 网站运行天数获取 */

    	$days = action('index/Common/operationDays');

    	//	----------------------------------

    	/* 获取友情链接 */
    	$linkList = action('index/Common/getLinks');



    	//	----------------------------------

    	/****** 统一赋值 ******/
    	// 赋值菜单
    	$this->assign('menuArr',$menuArr);
    	// 赋值网站标题
    	$this->assign('web_title',$webTitle);
    	// 赋值logo标题
    	$this->assign('logo_name',$webLogo);
    	// 赋值网站关键词
    	$this->assign('web_keywords',$webKeywords);
    	// 赋值网站描述
    	$this->assign('web_description',$webDescription);
    	// 赋值文章信息
    	$this->assign('articlesArr',$articlesArr);
    	// 赋值分页信息
    	$this->assign('pageList',$pageList);
    	// 赋值侧边栏
    	$this->assign('sidebarList',$sidebarArr);
    	// 赋值网站运行时间
    	$this->assign('days',$days);
    	// 赋值友情链接数组
    	$this->assign('linkList',$linkList);
        return view();

        //	----------------------------------
    }
    /*
		@	空类
    */
	public function _empty(){
		$this->error();
	}
}

