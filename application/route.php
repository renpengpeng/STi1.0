<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],

// ];
/*
	@	路由配置
*/

	// 前台

Route::rule([
	// 注册分类路由
	'cate/:cateId' => 'index/cates/index',
	// 注册文章路由
	'post/:postId' => 'index/posts/index',
	// 注册标签路由
	'tag/:tagId' => 'index/tags/index',
	// 注册页面路由
	'page/:pageId'=>'index/pages/index'
],'','get',['method'=>'get','ext'=>'html']);


	// 后台

Route::rule([
	
],'','get',['method'=>'get','ext'=>'html']);