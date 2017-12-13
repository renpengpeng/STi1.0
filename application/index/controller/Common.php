<?php
namespace app\index\controller;

use think\Session;
use think\Db;
use think\Request;
use think\Env;
use think\Controller;

/*
	@	公共方法调用文件
	@	适用于前台
*/

class Common extends Controller{
	public function index(){
		$this->error('index/index/index','禁止访问');
		exit;
	}
// ----------------------------------------->

	/*
		@	获取时间
		@	为了统一时间格式
		@	timer
	*/	
	public function getTime(){
		$time = date("Y-m-d H:i:s");
		return $time;
	}

// ----------------------------------------->

	/*
		@	获取ip
	*/
	public function getIp(){
		$ip = request()->ip();
		return $ip;
	}

// ----------------------------------------->

		/*
		@	过滤html标签
		@	暂时最多只支持二维数组过滤
		@	数组过滤必须指定layer为层级，比如一维数组为1，二维数组为2以此类推
	*/
	public function htmls($char,$layer=0){
		// 不能为空
		if(!$char){
			return false;
			exit;
		}

		// 如果不是数组直接过滤
		if(!is_array($char)){
			$result = htmlspecialchars($char);
			return $result;
			exit;
		}

		// 如果为一维数组
		if($layer == 1){
			foreach ($char as $key => $value) {
				$char[$key] = htmlspecialchars($char[$key]);
			}
			return $char;
			exit;
		}

		// 如果为二维数组
		if($layer == 2){
			foreach ($char as $key => $value) {
				foreach ($char[$key] as $k => $v) {
					$char[$key][$k] = htmlspecialchars($char[$key][$k]);
				}
			}
			return $char;
			exit;
		}

	}

// ----------------------------------------->

	/*
		@	还原html标签
		@	htmls_decode
		@	char   -->	要还原的字符或者数组
		@	layer  -->	如果是数组指定层级
	*/
	public function htmls_decode($char,$layer=0){
		if(!$char){
			return false;
			exit;
		}

		if(!is_array($char)){
			$char = htmlspecialchars_decode($char);
			return $char;
			exit;
		}

		if($layer == 1){
			foreach ($char as $key => $value) {
				$char[$key] = htmlspecialchars_decode($char[$key]);
			}
			return $char;
			exit;
		}

		if($layer == 2){
			foreach ($char as $key => $value) {
				foreach ($char[$key] as $k => $v) {
					$char[$key][$k] = htmlspecialchars_decode($char[$key][$k]);
				}
			}
			return $char;
			exit;
		}
	}

	/*
		@	根据type返回表名称
	*/
	public function tableName($type){
		if(!$type){
			return 'error';
			exit;
		}
		// 开始根据分类选择数据库
		switch($type){
			// 文章
			case 'post':
				$db = config('db_posts');
			break;
			// 分类
			case 'cate':
				$db = config('db_cates');
			break;
			// 标签
			case 'tag':
				$db = config('db_tags');
			break;
			// 页面
			case 'page':
				$db = config('db_pages');
			break;
			// 关联表
			case 'later':
				$db = config('db_tag_later');
			break;
			// 用户表
			case 'user':
				$db = config('db_users');
			break;
			// 友情链接表
			case 'link':
				$db = config('db_links');
			break;
			// 系统设置表
			case 'setting':
				$db = config('db_setting');
			break;
			// 菜单
			case 'menu':
				$db = config('db_menus');
			break;
 			// 如果未知
			default:
				return false;
				exit;
			break;
		}
		return $db;
	}

// ----------------------------------------->	

	/*
		@	根据条件获取某一行内容
		@	返回一维数组
		@	参数：$type,$willChar,$willContent
	*/
	public function getOneRowOf($type,$willChar,$willContent){
		if(!$type || !$willChar || !$willContent){
			return false;
			exit;
		}

		// 选择数据库
		$db = action('index/Common/tableName',['type'=>$type]);
		if(!$db){
			return false;
			exit;
		}

		// 开始查询
		$result = Db::table($db)->where($willChar,$willContent)->order('id','desc')->find();
		if(!$result){
			return false;
			exit;
		}

		return $result;
	}
	/*
		@	获取所有文章for page
	*/
	public function getAllRowsOfPage($type,$willChar,$willContent,$page,$limit){
		$db = action('index/Common/tableName',['type'=>$type]);
		$result = Db::table($db)->where($willChar,$willContent)->order('id','desc')->limit($limit)->page($page)->select();

		return $result;
	}
// ----------------------------------------->

	/*
		@	根据字段与值获取特定的字段
		@	getRowContentOf
	*/
	public function getRowContentOf($type,$willChar,$willContent,$value){
		if(!$type || !$willChar || !$willContent || !$value){
			return false;
			exit;
		}

		$db = action('index/Common/tableName',['type'=>$type]);

		$result = Db::table($db)->where($willChar,$willContent)->find();
		if(!$result){
			return false;
			exit;
		}

		return $result[$value];
	}

// ----------------------------------------->

	/*
		@	根据条件来查询所有符合的内容
		@	返回多维数组
		@	参数：$type,$willChar,$willContent
	*/
	public function getAllRowsOf($type,$willChar,$willContent){
		if(!$type || !$willChar || !$willContent){
			return false;
			exit;
		}

		// 选择数据库
		$db = action('index/Common/tableName',['type'=>$type]);
		if(!$db){
			return false;
			exit;
		}

		// 开始查询
		$result = Db::table($db)->where($willChar,$willContent)->order('id','desc')->select();
		if(!$result){
			return false;
			exit;
		}

		return $result;
	}

// ----------------------------------------->

	/*
		@	无条件获取某个表总数
	*/
	public function getTableNums($type){
		if(!$type){
			return false;
			exit;
		}
		$db = action('index/Common/tableName',['type'=>$type]);

		$result = Db::table($db)->count();

		return $result;
	}

// ----------------------------------------->

	/*
		@	获取某个表内共多少符合条件的数据
		@	返回num
		@	必传参数：$type,$willChar,$willContent
	*/
	public function getTableNumsOf($type,$willChar,$willContent){
		if(!$type || !$willChar || !$willContent){
			return false;
			exit;
		}

		// 选择数据库
		$db = action('index/Common/tableName',['type'=>$type]);
		if(!$db){
			return false;
			exit;
		}

		// 开始查询
		$result = Db::table($db)->where($willChar,$willContent)->count();
		if(!$result){
			return false;
			exit;
		}
		return $result;
	}

// ----------------------------------------->	

	/*
		@	分页
		@	pageination
		@	必传参数:$type,$showPageNum
	*/
	public function pageination($type,$showPageNum,$willChar=0,$willContent=0){
		if(!$type || !$showPageNum){
			return false;
			exit;
		}

		// 选择数据库
		$db = action('index/Common/tableName',['type'=>$type]);

		// 开始获取分页数据
		if($willChar == 0 && $willContent == 0){
			$pageArr = Db::table($db)->limit($showPageNum)->paginate($showPageNum);
			if(!$pageArr){
				return false;
			}
			return $pageArr;
			exit;
		}

		if($willChar != 0 || $willContent != 0){
			$pageArr = Db::table($db)->where($willChar,$willContent)->limit($showPageNum)->paginate($showPageNum);
			if(!$pageArr){
				return false;
			}
			return $pageArr;
			exit;
		}
		
		
	}
	/*
		@	按照分页来查询数据
		@	参数全部必传
		@	willchar 为条件字段 willContent 为条件值
		@	如果按照分页查询参数都必须给
		@	如果只查询多少条数据给另外一方为0
		
	*/
	public function getMessageForPage($type,$limit,$page){
		if(!$type){
			return false;
			exit;
		}

		$db = action('index/Common/tableName',['type'=>$type]);
		if(!$db){
			return false;
		}

		// 如果双方都不等于0按照分页查询所有
		if($limit != 0 && $page != 0 ){
			$result = Db::table($db)->order('id','desc')->limit($limit)->page($page)->select();
			return $result;
			dump($result);
			exit;
		}

		// 如果limit不等于0按照limit查询
		if($limit != 0 && $page == 0 ){
			$result = Db::table($db)->order('id','desc')->limit($limit)->select();
			return $result;
			dump($result);
			exit;
		}


		// 如果双方都等于0查询所有数据
		if($limit == 0 && $page == 0 ){
			$result = Db::table($db)->order('id','desc')->select();
			return $result;
			dump($result);
			exit;
		}


	}
	/*
		@	根据条件与分页获取
	*/
	public function getMessageForCharPage($type,$willChar,$willContent,$limit,$page){
		$db = action('index/Common/tableName',['type'=>$type]);
		$result = Db::table($db)->where($willChar,$willContent)->order('id','desc')->limit($limit)->page($page)->select();
		return $result;
	}
	/*
		@	获取li导航菜单
	*/
	public function getMenuForLi($type,$pid=0,$id=0){
		$db = action('index/Common/tableName',['type'=>'menu']);
		// dump($db);
		// 开始循环读取返回li
		$menuTxt = '<ul class>';
		$menuArr = Db::table($db)->where('pid',$pid)->select();
		// dump($menuArr);
		
		if($menuArr){
			foreach ($menuArr as $key => $value) {
				$pids = $menuArr[$key]['id'];
				$pidc = $menuArr[$key]['pid'];
				if($pidc == 0){
					$menuTxt .= "<li class='ding'>";
				}else{
					$menuTxt .= "<li>";
				}
				$menuTxt .= "<a href='{$menuArr[$key]["url"]}'>";
				$menuTxt .= $menuArr[$key]['name'];
				$menuTxt .= "</a>";
				$menuTxt .= "";
				$nums = Db::table($db)->where('pid',$pids)->count();
				if($nums != 0){
					$id+=1;
					$menuTxt .=action('index/Common/getMenuForLi',[
						'type'=>'menu',
						'pid'=>$pids
					])."</li>";
					
				}
			}
		}
		$menuTxt .= "</ul>";
		// return $menuArr;
		return $menuTxt;
		// dump($menuTxt);
	}
	/*
		@	侧边栏随机文章推荐
		@	默认调用所有栏目内文章	调用数量10篇
	*/
	public function sideBarSuiji($cates=0,$nums=10){
		// 判断是否为0，如果为0则调用所有分类文章
		if($cates==0){
			// 查询所有文章
			$select = Db::table(config('db_posts'))->limit($nums)->order('rand()')->select();

			return $select;
		}
	}
	/*
		@	获取网站友情链接
	*/
	public function getLinks(){
		$db = action('index/Common/tableName',['type'=>'link']);
		$arr = Db::table($db)->select();
		return $arr;
	}
	/*
		@	计算网站运行了多少天
	*/
	public function operationDays(){
		$createTime = action('index/Common/getRowContentOf',[
			'type'=>'setting',
			'willChar'=>'web_key',
			'willContent'=>'STi',
			'value'=>'web_reg_time'
		]);
		$nowTime = date('Y-m-d');
		$times = strtotime($nowTime) - strtotime($createTime);
		$days = $times/(3600*24);
		return $days;
		// var_dump($days);
	}
	/*
		@	给展示列表添加详细信息
		@	根据type来添加
	*/
	public function getMessageDetail($type,$data){
		if(!$type || !$data){
			return false;
			exit;
		}

		$db_post = action('index/Common/tableName',['type'=>'post']);
		$db_tag  = action('index/Common/tableName',['type'=>'tag']);
		$db_later  = action('index/Common/tableName',['type'=>'later']);
		$db_user  = action('index/Common/tableName',['type'=>'user']);

		switch($type){
			// 列表List 相当于 Article List
			case 'list':
				/*
					@	list列表需要添加：分类名称、用于名称;
				*/
				// 遍历提取分类id与用户id
				foreach ($data as $key=>$value) {

					// 处理分类
					$cateId = $data[$key]['cates_id'];
					$cateName = action('index/Common/getRowContentOf',[
						'type'=>'cate',
						'willChar'=>'id',
						'willContent'=>$cateId,
						'value'=>'name'
					]);
					$cateNameArr = ['cateName'=>$cateName];
					$data[$key] = $data[$key] + $cateNameArr;

					// 处理用户名称
					$userId = $data[$key]['user_id'];
					$userName = action('index/Common/getRowContentOf',[
						'type'=>'user',
						'willChar'=>'id',
						'willContent'=>$userId,
						'value'=>'name'
					]);
					$userNameArr = ['userName'=>$userName];
					$data[$key] = $data[$key] + $userNameArr;
					// 过滤html标签
					foreach ($data[$key] as $k => $v) {
						$data[$key][$k] = htmlspecialchars_decode($data[$key][$k]);
						$data[$key][$k] = strip_tags($data[$key][$k]);
					}
				}
				
				return $data;
			break;
			// 文章页面
			case 'post':
					$cateId = $data['cates_id'];
					$cateName = action('index/Common/getRowContentOf',[
						'type'=>'cate',
						'willChar'=>'id',
						'willContent'=>$cateId,
						'value'=>'name'
					]);
					$cateNameArr = ['cateName'=>$cateName];
					$data = $data + $cateNameArr;

					// 处理用户名称
					$userId = $data['user_id'];
					$userName = action('index/Common/getRowContentOf',[
						'type'=>'user',
						'willChar'=>'id',
						'willContent'=>$userId,
						'value'=>'name'
					]);
					$userNameArr = ['userName'=>$userName];
					$data = $data + $userNameArr;
					// 恢复html标签
					foreach ($data as $key => $value) {
						$data[$key] = htmlspecialchars_decode($data[$key]);
					}
					return $data;
			break;
			// 给文章加标签
			case 'tag':
				$postId = $data['id'];
				// 根据文章id查询
				$laterArr = action('index/Common/getAllRowsOf',[
					'type'			=>	'later',
					'willChar'		=>	'wzid',
					'willContent'	=>	$postId
				]);
				if(!$laterArr){
					$data = $data + ['tags'=>''];
					return $data;
				}
				foreach ($laterArr as $key => $value) {
					$tagId[] = $laterArr[$key]['glid'];
				}
				foreach ($tagId as $key => $value) {
					$tagName = action('index/Common/getRowContentOf',[
						'type'			=>	'tag',
						'willChar'		=>	'id',
						'willContent'	=>	$tagId[$key],
						'value'			=>	'name'
					]);
					$newArr[] = ['id'=>$tagId[$key],'name'=>$tagName];
				}
				$newArr = ['tags'=>$newArr];
				return $newArr;
			break;
		}
	}
}
?>