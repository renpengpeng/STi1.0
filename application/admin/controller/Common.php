<?php
namespace app\admin\controller;

use think\Controller;
use think\Session;
use think\Db;
/*
	@	此文件为后台公用调用类
	@	help帮助文档请看同文件夹：helper.php
*/
class Common extends Controller{
	public function index(){
		// 没有方法所以自动返回后台
		$this->error('空','admin/index/index');
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
			// 系统设置表
			case 'setting':
				$db = config('db_setting');
			break;
			// 菜单表
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
		@	验证管理权限 * 根据用户ID
		@	适用于登录页面
	*/
	public function getAdministerForLogin($type,$id){
		// 不能为空
		if(!$type || !$id){
			return false;
			exit;
		}

		// 查询权限
		$administers = action('admin/Common/getRowContentOf',[
			'type'=>$type,
			'willChar'=>'id',
			'willContent'=>$id,
			'new'=>'no'
		]);
		if(!$administers){
			return false;
			exit;
		}

		// 判断 权限
		if($administers == 'admin'){
			return true;
		}else{
			return false;
		}
	}

// ----------------------------------------->

	/*
		@	验证管理权限 * 根据session
		@	适用于已经登录，在后台中
	*/
	public function getAdministerForSession($administer){
		// 不能为空
		if(!$administer){
			return false;
			exit;
		}

		// 如果权限等于user则返回false
		if($administer == 'admin'){
			return true;
		}else {
			return false;
		}
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

// ----------------------------------------->

	/*
		@	获取某个表总数量
	*/
	public function tableNums($type){
		if(!$type){
			return false;
			exit;
		}

		$db = action('admin/Common/tableName',['type'=>$type]);

		// 开始查询
		$nums = Db::table($db)->count();
		// 返回数据
		return $nums;
	}

// ----------------------------------------->

	/*
		@	如果设置了page和showPageNum 则按照设置读取 
		@	不设置设置所有为0
		@	如果没有设置则获取所有文章
	*/
	public function getMessageForPage($type,$page,$showPageNum){

		if(!$page || !$showPageNum || !$type){
			return 'error';
			exit;
		}
		// 开始选择数据库
		$db = action('admin/Common/tableName',['type'=>$type]);

		// 开始判断类型 -->如果都等于0则读取所有文章
		if($page == '0' || $showPageNum == '0'){
			$postArr = Db::table($db)->select();
		}else {
			// 相反则按照设置来读取
			$postArr = Db::table($db)->order('id','desc')->limit($showPageNum)->page($page)->select();
		}
		return $postArr;
	}

// ----------------------------------------->

	/*
		@	分页
	*/
	public function pageination($type,$showPageNum){

		// 如果有任何一项没有设置则返回error
		if(!$showPageNum || !$type){
			return 'error';
			exit;
		}
		// 根据type开始分页
		$db = action('admin/Common/tableName',['type'=>$type]);

		// 否则开始分页
		$pageArr = Db::table($db)->paginate($showPageNum);

		return $pageArr;
	}

// ----------------------------------------->

	/*
		@	根据类型和某个字段获取某一行数组
		@	type -->	类型
		@	char -->	字段
		@	value -->	值
	*/
	public function getOneRowArr($type,$char,$value){
		// 如果有一项没有设置返回eror
		if(!$type || !$char || !$value){
			return false;
			exit;
		}
		// 根据类型选择数据库
		$db = action('admin/Common/tableName',['type'=>$type]);
		if(!$db){
			return false;
			exit;
		}

		$arr = Db::table($db)->where($char,$value)->find();

		if(!$arr){
			return false;
			exit;
		}

		return $arr;
	}

// ----------------------------------------->

	/*
		@	根据条件查询表内所有符合条件的信息
	*/
	public function getAllRowsOf($type,$willChar,$willContent){
		if(!$type || !$willChar || !$willContent){
			return false;
			exit;
		}
		// 获取数据表
		$db = action('admin/Common/tableName',['type'=>$type]);

		// 根据表查询
		$arr = Db::table($db)->where($willChar,$willContent)->select();
		// 如果查询失败
		if(!$arr){
			return false;
		}else {
			return $arr;
		}
	}

// ----------------------------------------->

	/*
		@	查询某个表内的所有信息
		@	type --> 类型
		@   orderBy --> 根据什么来排序
		@	orderChar --> 排序规则
		@	page -->页数 默认为0
		@	limit -->配合页数使用，默认为0
		@	nums --> 默认为0查询所有
		@	注：page和limit一起使用，但是不能和nums并列使用，因为limit=nums
	*/
	public function getAllRowsFor($type,$orderBy,$orderChar,$page=0,$limit=0,$nums=0){
		// 判断是否设置  ** 没设置返回false
		if(!$type || !$orderBy ||!$orderChar){
			return false;
			exit;
		}
		// 开始根据type选择数据表
		$db = action('admin/Common/tableName',['type'=>$type]);

		// 开始判断类型
			// 一、limit和page和nums都没设置，默认查询所有
			if($page == 0 || $limit == 0 || $nums == 0){
				$arr = Db::table($db)->order($orderBy,$orderChar)->select();
			}
			// 二、设置了limit和page
			if($page != 0 || $limit != 0){
				$arr = Db::table($db)->order($orderBy,$orderChar)->limit($limit)->page($page)->select();
			}
			// 三、指定nums
			if($nums != 0){
				$arr = Db::table($db)->order($orderBy,$orderChar)->limit($nums)->select();
			}

			return $arr;
			// dump($arr);

	}

// ----------------------------------------->

	/*
		@	获取表内最后一个id为多少
	*/
	public function getTableLastId($type){
		// 如果没有设置type则返回error
		if(!$type){
			return 'error';
			exit;
		}
		// 根据type查询id
		$db = action('admin/Common/tableName',['type'=>$type]);
		// 开始查询最后一个的数组
		$lastIdArr = Db::table($db)->order('id','desc')->find();
		// 获取最后一个id
		$lastId = $lastIdArr['id'];

		// 返回id
		return $lastId;
	}

// ----------------------------------------->

	/*
		@	根据表与表内id获取对于的数据
		@	type --> 数据表
		@	willChar   --> 可以是id字段也可以是其他字段
		@	willContent --> 将要查询的字段的值
		@	char --> 要获取的字段
		@	new --> 是否新建
	*/
	public function getRowContentOf($type,$willChar,$willContent,$char,$new){
		// 如果都没有设置返回error
		if(!$type || !$willChar || !$willContent || !$char || !$new){
			return 'error';
			exit;
		}
		// 开始根据type选择表
		$db = action('admin/Common/tableName',['type'=>$type]);
		// 开始根据will字段查询
		$row = Db::table($db)->where($willChar,$willContent)->find();
		// 如果没有查询到返回error
		if(empty($row) || !$row){
			// 如果为新建值则创建否则返回error
			if($new == 'yes'){
				// 准备新建数据
				$insertData = [
					$willChar=>$willContent,
					$char=>''
				];
				$insertNew = Db::table($db)->insert($insertData);
				if(!$insertNew){
					return false;
					exit;
				}
				$insertId = Db::table($db)->getLastInsId();
				return $insertId;
				exit;
			}else {
				return false;
				exit;
			}
			return $row[$char];
		}
		// 否则返回值
		return $row[$char];
	}

// ----------------------------------------->

	/*
		@	获取菜单For Li
	*/
	public function getMenusForLi($type,$pid=0){
		if(!$type){
			return false;
			exit;
		}

		$db = action('admin/Common/tableName',['type'=>'menu']);

		$selectArr = [];
		$selectArr += Db::table($db)->where('pid',$pid)->select();
		$titles = '';
		if($selectArr){
			foreach($selectArr as $key=>$value){
				$titles .= 
				"<li class='list-group-item'>"
				.str_repeat("|—", $selectArr[$key]['lever'])
				.$selectArr[$key]['name']
				."<span class='badge'>"
				."<a href='"
				.url('admin/Common/deletemessage',[
					'type'=>'menu',
					'willChar'=>'id',
					'willContent'=>$selectArr[$key]['id']
				])
				."'>"
				."删除"
				."</a>"
				."</span>"
				."<span class='badge'>"
				."<a href='"
				.url('admin/setting/menusedit',[
					'menuId'=>$selectArr[$key]['id']
				])
				."'>编辑"
				."</a>"
				."</span>"
				."</li>";

				$ids = $selectArr[$key]['id'];
				$nums = Db::table($db)->where('pid',$ids)->count();
				if($nums >= 1){
					$titles .= action('admin/Common/getMenusForLi',[
						'type'=>'menus',
						'pid'=>$ids
					]);
				}
			}
		}
		// dump($deleteUrl);
		return $titles;
	}

// ----------------------------------------->

	/*
		@	获取菜单For select
	*/
	public function getMenusForSelect($type,$pid=0){
		if(!$type){
			return false;
			exit;
		}

		$db = action('admin/Common/tableName',['type'=>'menu']);

		$selectArr = [];
		$selectArr += Db::table($db)->where('pid',$pid)->select();
		$titles = '';
		if($selectArr){
			// $titles .= "<ul>";
			foreach($selectArr as $key=>$value){
				$titles .= 
				"<option value='{$selectArr[$key]["id"]}'>"
				.str_repeat("|—", $selectArr[$key]['lever'])
				.$selectArr[$key]['name']
				."</option>";

				$ids = $selectArr[$key]['id'];
				$nums = Db::table($db)->where('pid',$ids)->count();
				if($nums >= 1){
					// $titles .= "子菜单";
					$titles .= action('admin/Common/getMenusForSelect',[
						'type'=>'menus',
						'pid'=>$ids
					]);
				}
			}
		}
		return $titles;
	}
// ----------------------------------------->

	/*
		@	判断菜单 lever
	*/
	public function menuLever($type,$id){
		$db = action("admin/Common/tableName",['type'=>$type]);
		$ids = 2;
		$fu = Db::table($db)->where('id',$id)->find();
		if($fu){
			if($fu['pid'] != 0){
				$c = action('admin/Common/menuLever',[
					'type'=>'menu',
					'id'=>$fu['pid']
				]);
				$ids +=1;
			}
		}
		return $ids;
	}

// ----------------------------------------->

	/*
		@	搜索
	*/
	public function messageSearch($type,$char){
		$db = action('admin/Common/tableName',['type'=>$type]);

		// 根据搜索类型来搜索
		switch ($type) {
			case 'post':
				$searchNums = Db::table($db)->where('title&content','like',"%{$char}%")->count();
				if($searchNums != 0){
					$searchArr = Db::table($db)
								->where('title','like',"%{$char}%")
								->select();
					return $searchArr;
				}
			break;
			
			default:
				# code...
				break;
		}
	}

// ----------------------------------------->

	/*
		@	获取数组某个元素
	*/

// ----------------------------------------->

	/*
		@	添加新内容，包括文章，页面，分类，页面
	*/
	public function newMessage($type){
		// 如果type不存在则返回error
		if(!$type){
			return 'error';
			exit;
		}
		// 开始通过type选择数据库
		$db 	 = action('admin/Common/tableName',['type'=>$type]);
		$db_menu = action('admin/Common/tableName',['type'=>'menu']);

		// 准备公用参数
		$time = action('admin/Common/getTime');

		$data = input();
		if(!$data){
			$this->error('非法闯入','admin/index/index');
			exit;
		}

		// 开始判断添加类型并执行添加
		switch($type){
			// 文章
			case 'post':
				// 获取所有提交form信息
				$messages = $data;
				// 过滤所有html标签放置sql注入
				$data = action('admin/Common/htmls',[
					'char'=>$data,
					'layer'=>1
				]);
				// 传递一个新的数组
				$newMessage = $messages;
				// 删除新数组的标签键值与type键值
				foreach ($newMessage as $key => $value) {
					if($key == 'tags'){
						unset($newMessage[$key]);
					}
					if($key == 'type'){
						unset($newMessage[$key]);
					}
				}
				// 给数组添加time
				$timeArr = ['time'=>$time];
				$newMessage = $newMessage + $timeArr;
				/*开始根据标签名字获取id*/
					/*检查tag最后一个是否有逗号 ，如果没有则添加一个逗号*/
					// 获取长度
					$tagsStr = $messages['tags'];
					$tagsLen = strlen($tagsStr);
					$tagsEnd = substr($tagsStr,$tagsLen-1);
					if($tagsEnd != ','){
						$tagsStr = $tagsStr.',';
					}
					// 如果有中文逗号替换成英文逗号
					if(mb_strstr($tagsStr,'，')){
						$tagsStr = str_replace('，', ',', $tagsStr);
					}
					// 根据逗号拆分成数组
					$tagArr = explode(',',$tagsStr);
					// 遍历去除空数组
					foreach($tagArr as $key=>$value ){
						if($tagArr[$key] == ''){
							unset($tagArr[$key]);
						}
					}
					// 开始循环获取标签id
					$tagIdArr = [];
					foreach ($tagArr as $key => $value) {
						$tagIdArr[] = action('admin/Common/getRowContentOf',[
							'type'=>'tag',
							'willChar'=>'name',
							'willContent'=>$tagArr[$key],
							'char'=>'id',
							'new'=>'yes'
						]);
					}
					
				// 开始插入数据
				$insertMessage = Db::table($db)->insert($newMessage);
				// 如果插入失败
				if(!$insertMessage){
					$this->error('插入失败 提示：整体','admin/post/postadmin');
					exit;
				}
				// 如果标签为0直接退出
				if(strlen($messages['tags']) == 0 || empty(strlen($messages['tags']))){
					$this->success('插入成功','admin/post/postadmin');
					exit;
				}
				// 开始插入关联表
					// 获取最后一次添加的id
					$lastId = Db::table($db)->getLastInsId();
					
					// 插入关联表
						// 获取关联表名
						$db_later = action('admin/Common/tableName',['type'=>'later']);
						// 插入标签数据
							$insertTagLaterData = [];
							foreach ($tagArr as $key => $value) {
								// 准备插入数据
								$insertTagLaterData = [
									'wzid'=>$lastId,
									'glid'=>$tagIdArr[$key],
									'time'=>$time
								];
								// 开始插入
								$insertTagLater = Db::table($db_later)->insert($insertTagLaterData);
								dump($insertTagLater);
								if(!$insertTagLater){
									$this->error('插入失败 提示：标签','admin/post/postadmin');
									exit;
								}else {
									$this->success('新建文章成功','admin/post/postadmin');
								}
							}
			break;
			// 如果是分类
			case 'cate':
				if($data['name'] == '' || empty($data['name'])){
					$this->error('不能为空','admin/cate/cateadmin');
					exit;
				}
				// 过滤html字符
				$data = action('admin/Common/htmls',[
					'char'=>$data,
					'layer'=>1
				]);
				// 赋值给新的变量，放置丢失
				$newCateData = $data;
				// 去除不必要的参数
				foreach ($newCateData as $key => $value) {
					if($key == 'newCateSub' || $key == 'type'){
						unset($newCateData[$key]);
					}
				}
				// 添加时间参数
				$timeArr = ['time'=>$time];
				// 合并
				$newCateData = $newCateData + $timeArr;

				// 开始插入
				$insertCateData = Db::table($db)->insert($newCateData);
				if($insertCateData){
					$this->success("插入成功！",'admin/cate/cateadmin');
				}else {
					$this->error('插入成功','admin/cate/cateadmin');
				}
			break;
			// 如果是标签
			case 'tag':
				// 判断是否为空
				if($data['name'] == ''){
					$this->error('名称不能为空！','admin/tag/tagadmin');
					exit;
				}
				// 开始过滤html
				$data = action('admin/Common/htmls',[
					'char'	=>	$data,
					'layer'	=>	1
				]);
				// 给一个新变量防止丢失
				$newData = $data;
				// 去除多余key
				foreach ($newData as $key => $value) {
					if($key == 'type' || $key == 'newTagSub'){
						unset($newData[$key]);
					}
				}
				// 准备time数组
				$timeArr = ['time'=>$time];
				// 合并
				$newData = $newData + $timeArr;
				// 开始插入
				$insertTag = Db::table($db)->insert($newData);
				if($insertTag){
					$this->success('插入标签成功','admin/tag/tagadmin');
				}else {
					$this->error('插入标签失败','admin/tag/tagadmin');
				}
			break;
			case 'page':
				// 判断如果没有标题或者内容返回
				if($data['title'] == '' || $data['content'] == ''){
					$this->error('标题和内容不能为空','admin/pageadmin/index');
					exit;
				}

				// 过滤html
				
				$data = action('admin/Common/htmls',[
					'char' 	=>	$data,
					'layer'	=>	1
				]);
				// 赋值新数组去除不必要的元素
				$newData = $data;
				foreach ($newData as $key => $value) {
					if($key == 'newPageSub' || $key = 'type'){
						unset($newData[$key]);
					}
				}
				// 准备时间数组
				$timeArr = ['time'=>$time];
				// 合并
				$newData = $newData + $timeArr;
				// 开始插入
				$insert = Db::table($db)->insert($newData);
				if($insert){
					$this->success('新建成功','admin/page/pageadmin');
				}else {
					$this->error('创建失败','admin/page/pageadmin');
				}
			break;
			// 添加菜单操作
			case 'menu':
				// 统一去除type
				foreach ($data as $key => $value) {
					if($key == 'type'){
						unset($data[$key]);
					}
				}
				// 增加时间参数
				$timeArr = ['time'=>$time];
				$data = $data + $timeArr;
				// 检测有一项为空不插入
				if(!$data['name'] || !$data['url']){
					$this->error('其中一项不能为空','admin/Setting/menus');
					exit;
				}
				// 判断lever
				if($data['pid'] == 0){
					$leverArr = ['lever'=>1];
				}else {
					$leverNum = action('admin/Common/menuLever',[
						'type'=>'menu',
						'id'=>$data['pid']
					]);
					$leverArr = ['lever'=>$leverNum];
				}
				$data = $data + $leverArr;
				// 开始添加
				$insert = Db::table($db)->insert($data);
				if(!$insert){
					$this->error('添加菜单失败','admin/Setting/menus');
					exit;
				}else {
					$this->success('添加菜单成功','admin/Setting/menus');
				}		
			break;
		}
	}

// ----------------------------------------->

	/*
		@	更新某行数据用于文章、标签、页面、
		@	type --> 	类型
		@	willchar -->	凭据字段
		@	willContent -->	凭据字段值
		@	data -->	要更新的数据   在类中自动获取
	*/
	public function updateMessage($type){
		if(!$type){
			return 'error';
			exit;
		}
		// 判断是否传入数据 * 如果没有返回error
		$data = input();
		if(!$data){
			return 'error';
			exit;
		}
		// 根据type选择数据库
		$db       = action('admin/Common/tableName',['type'=>$type]);
		$db_later = action('admin/Common/tableName',['type'=>'later']);
		// 获取当前时间
		$time = action('admin/Common/getTime');

		// 根据type更新数据，不同的type更新不同
		switch($type){
			// 文章
			case 'post':

				// 过滤html标签
				$data = action('admin/Common/htmls',[
					'char' => $data,
					'layer'=> 1
				]);
				// 复制一个新数组postData
				$postData = $data;
				// 原数组去除不必要的属性
				foreach ($data as $key => $value) {
					// 去除tags  type willchar willcontent
					if($key == 'id' || $key == 'tags' || $key == 'type' || $key == 'willChar' || $key == 'willContent')
					{
						unset($data[$key]);
					}
				}
				// 插入文章信息
				$updatePostResult = Db::table($db)->where('id',$postData['id'])->update($data);
				// 如果插入失败
				if(!$updatePostResult){
					$this->error('修改失败','admin/post/postadmin');
					exit;
				}

				// 根据标签获取标签id ** 关联信息
					
					$tagStr = $postData['tags'];
					// 判断tags是不是空 * 如果是空停止操作返回更新成功
					if(strlen($tagStr) == '0'){
						$this->success('更新成功！','admin/post/postadmin');
						exit;
					}
					// 如果标签中右中文逗号替换为英文逗号
					if(mb_strstr($tagStr,'，')){
						$tagStr = str_replace('，', ',', $tagStr);
					} 
					// explode将标签分割为数组
					$tagNameArr = explode(',', $tagStr);
					// 去除空数组
					foreach ($tagNameArr as $key => $value) {
						if($tagNameArr[$key] == ''){
							unset($tagNameArr[$key]);
						}
					}
					// 获取id
					foreach ($tagNameArr as $key => $value) {
						$tagIdArr[] = action('admin/Common/getRowContentOf',[
							'type'=>'tag',
							'willChar'=>'name',
							'willContent'=>$tagNameArr[$key],
							'char'=>'id',
							'new'=>'yes'
						]);
					}
					// 删除关联表内此文章的所有关联信息
					$deleteLater = Db::table($db_later)->where('wzid',$postData['id'])->delete();
					// 开始插入标签关联信息
					foreach ($tagIdArr as $key => $value) {
						$insertTagData = [
							'wzid'=>$postData['id'],
							'glid'=>$tagIdArr[$key],
							'time'=>$time
						];
						$insertTagResult = Db::table($db_later)->insert($insertTagData);
						if(!$insertTagResult){
							$this->error('文章更新成功，关联表更新失败','admin/post/postadmin');
							exit;
						}else {
							// 跳转操作
							$this->success("文章更新成功",'admin/post/postadmin');
						}
					}


			break;
			case 'cate':
				// 赋值给新变量防止丢失
				$newData = $data;

				// 去除不必要的变量
				foreach ($newData as $key => $value) {
					if($key == 'type' || $key == 'cateEdit'){
						unset($newData[$key]);
					}
				}

				// 准备时间数组
				$timeArr = ['time'=>$time];
				// 合并
				$newData = $newData + $timeArr;

				// 更新
				$updateData = Db::table($db)->where('id',$newData['id'])->update($newData); 
				// 判断更新
				if($updateData){
					$this->success("修改成功",'admin/cate/cateadmin');
				}else {
					$this->error('修改失败','admin/cate/cateadmin');
				}

			break;
			// 如果是标签
			case 'tag':
				// 去除html标签
				foreach ($data as $key => $value) {
					$data[$key] = htmlspecialchars($data[$key]);
				}
				// 赋值给新数组
				$newData = $data;

				// 去除不必要的元素
				foreach ($newData as $key => $value) {
					if($key == 'tagEditSub' || $key == 'type'){
						unset($newData[$key]);
					}
				}
				// 准备时间数组
				$timeArr = ['time'=>$time];
				// 合并数组
				$newData = $newData + $timeArr;
				// 开始修改
				$update = Db::table($db)->where('id',$newData['id'])->update($newData);
				// 判断
				if($update){
					$this->success("修改成功",'admin/tag/tagadmin');
				}else {
					$this->error('修改失败','admin/tag/tagadmin');
				}
				
			break;
			// 页面
			case 'page':
				// 过滤html
				foreach ($data as $key => $value) {
					$data[$key] = htmlspecialchars($data[$key]);
				}
				// 赋值新的并删除不必要的元素
				$newData = $data;
				foreach ($newData as $key => $value) {
					if($key == 'pageEdit' || $key == 'type') {
						unset($newData[$key]);
					}
				}
				// 准备时间数组 并添加
				$timeArr = ['time'=>$time];
				$newData = $newData + $timeArr;
				// 开始更新
				$update = Db::table($db)->where('id',$newData['id'])->update($newData);
				if($update){
					$this->success('更新成功！','admin/page/pageadmin');
				}else {
					$this->error('更新失败！可能是没有发生变化','admin/page/pageadmin');
				}
			break;
			// 菜单更新
			case 'menu':
				// 去除type
				foreach ($data as $key => $value) {
					if($key == 'type'){
						unset($data[$key]);
					}
				}
				// 增加time
				$timeArr = ['time'=>$time];
				$data += $timeArr;
				// 如果pid等于0 直接修改
				if($data['pid'] == 0){
					// 遍历删除pid
					foreach ($data as $key => $value) {
						if($key == 'pid'){
							unset($data[$key]);
						}
					}
					// 直接修改
					$update = Db::table($db)->where('id',$data['id'])->update($data);
					if($update){
						$this->success('修改成功','admin/Setting/menus');
					}else {
						$this->success('修改失败','admin/Setting/menus');
					}
				}

				// 如果修改为顶级菜单
				elseif($data['pid'] == '-1'){
					// 修改pid 与lever
					$data['pid'] 	= 0;
					$data['lever'] 	= 1;

					$update = Db::table($db)->where('id',$data['id'])->update($data);
					if($update){
						$this->success('修改成功','admin/Setting/menus');
					}else {
						$this->success('修改失败','admin/Setting/menus');
					}

				}

				 //  修改为其他菜单的附属菜单
				 else{
				 	// 判断上级级别
				 	$lever = action('admin/Common/menuLever',[
				 		'type'=>'menu',
				 		'id'=>$data['pid']
				 	]);
				 	// 现有菜单级别
				 	$data['lever'] = $lever;

				 	$update = Db::table($db)->where('id',$data['id'])->update($data);
					if($update){
						$this->success('修改成功','admin/Setting/menus');
					}else {
						$this->success('修改失败','admin/Setting/menus');
					}
				 } 
			break;
			default:
				return 'error';
			exit;
		}
	}

// ----------------------------------------->

	/*
		@	根据类型删除数据
		@	type 		  -->表类型
		@	willchar      -->条件字段
		@	willContent   -->条件值
	*/
	public function deleteMessage($type,$willChar,$willContent){
		// 不能为空
		if(!$type || !$willChar || !$willContent){
			return false;
			exit;
		}

		// 获取数据
		if(!input() || empty(input())){
			return false;
			exit;
		}else {
			$data = input();
		}

		// 准备公用参数
		$time = action('admin/Common/getTime');
		$ip   = action('admin/Common/getIp');

		// 选择数据库
		$db = action('admin/Common/tableName',['type'=>$type]);	
		$db_later = action('admin/Common/tableName',['type'=>'later']);
		$db_post = action('admin/Common/tableName',['type'=>'post']);
		if(!$db){
			return false;
			exit;
		}


		// 根据删除类型来判断
		switch ($type) {
			// 文章
			case 'post':
				// 开始删除文章
				$deletePostData = Db::table($db)->where($willChar,$willContent)->delete();
				if(!$deletePostData){
					$this->error('文章删除失败','admin/post/postadmin');
					exit;
				}

				// 删除关联表信息
				$db_later = action('admin/Common/tableName',['type'=>'later']);
				// 获取文章id
				if($willChar == 'id'){
					$posId = $willContent;
				}else{
					$posId = action('admin/Common/getRowContentOf',[
						'type'       	=> 'post',
						'willChar'   	=> $willChar,
						'willContent'	=> $willContent,
						'new'        	=> 'no'
					]);
				}
				$deletePostLater = Db::table($db_later)->where('wzid',$posId)->delete();
				if(!$deletePostLater){
					$this->error('文章已删除 but 删除关联信息失败','admin/post/postadmin');
					exit;
				}else {
					$this->success('文章删除成功！','admin/post/postadmin');
				}

			break;
			// 分类删除
			case 'cate':
				// 删除分类
				$deleteCateDate = Db::table($db)->where($willChar,$willContent)->delete();
				if(!$deleteCateDate){
					$this->error('分类删除失败','admin/cate/cateadmin');
				}
				// 删除分类下的所有文章
					// 获取分类id
					if($willChar == 'id'){
						$cateId = $willContent;
					}else{
						$cateId = action('admin/Common/getRowContentOf',[
							'type'			=>	'cate',
							'willChar'		=>	$willChar,
							'willContent'	=>	$willContent,
							'char'			=>	'id',
							'new'			=>	'no'
						]);
						if(!$cateId){
							$this->error('获取分类id失败','admin/cate/cateadmin');
							exit;
						}
					}
					// 获取所有分类id为$cateId的文章
					$postCateArr = action('admin/Common/getAllRowsOf',[
						'type'			=>	'post',
						'willChar'		=>	'cates_id',
						'willContent'	=>	$cateId
					]);
					// 如果不为空则删除
					if(!empty($postCateArr)){

						// 遍历获取文章id 赋值给$postIdArr 
						$postIdArr = [];
						foreach ($postCateArr as $key => $value) {
							$postIdArr[] = $postCateArr[$key]['id'];
						}

						// 遍历文章id并删除
						foreach ($postIdArr as $key => $value) {
							$deletePostArr = Db::table($db_post)->where('id',$postIdArr[$key])->delete();
						}
						if(!$deletePostArr){
							$this->error('删除文章信息失败，可能分类下没有文章','admin/cate/cateadmin');
							exit;
						}
						// 开始删除关联信息
						// 查询是否有关联信息
						$postLaterNum = [];	
						foreach ($postIdArr as $key => $value) {
							$postLaterNum = Db::table($db)->where('wzid',$postIdArr[$key])->count();
						}
						if(empty($postLaterNum)){
							$this->success('删除分类成功，分类下的文章已经一并删除','admin/cate/cateadmin');
							exit;
						}
						// 准备数据表
						$db_later = action('admin/Common/tableName',['type'=>'later']);
						// 开始遍历id并删除
						foreach ($postIdArr as $key => $value) {
							$deleteLaterArr = Db::table($db_later)->where('wzid',$postIdArr[$key])->delete();
						}
						if(!$deleteLaterArr){
							$this->error('删除分类下文章关联信息失败，该分类下没有文章或者文章无关联标签','admin/cate/cateadmin');
							exit;
						}
					}
					// 如果为空则成功！
					$this->success('删除分类成功，分类下的文章已经一并删除','admin/cate/cateadmin');
			break;
			// 如果为标签
			case 'tag':
				// 获取id
				if($willChar == 'id'){
					$tagId = $willContent;
				}else{
					$tagId = action('admin/Common/getRowContentOf',[
						'type'			=>	'tag',
						'willChar'		=>	$willChar,
						'willcontent'	=>	$willContent,
						'char'			=>	'id',
						'new'			=>	'no'
					]);
					if(!$tagId){
						$this->error('获取标签id失败','admin/tag/tagId');
						exit;
					}
				}
				// 删除标签信息
				$deleteTagData = Db::table($db)->where($willChar,$willContent)->delete();
				if(!$deleteTagData){
					$this->error('标签删除失败','admin/tag/tagadmin');
					exit;
				}
				// 删除关联信息
				$deleteTagLaterNum = Db::table($db_later)->where('glid',$tagId)->count();
				if($deleteTagLaterNum != '0'){
					$deleteTagLater = Db::table($db_later)->where('glid',$tagId)->delete();
					if(!$deleteTagLater){
						$this->error('删除标签关联信息失败','admin/tag/tagadmin');
						exit;
					}else {
						$this->success('删除标签成功！','admin/tag/tagadmin');
					}
				}else {
					$this->success('删除标签成功！','admin/tag/tagadmin');
				}
			break;
			// 删除标签
			case 'menu':
				// 判断是否为id //
				if($willChar == 'id'){
					$id = $willContent;
				}else {
					$id = action('admin/Common/getRowContentOf',[
						'type'=>'menu',
						'willChar'		=>	$willChar,
						'willContent'	=>	$willContent,
						'char'			=>	'id',
						'new'			=>	'no'
					]);
				}
				// 判断是否有子菜单
				$zi = Db::table($db)->where('pid',$id)->count();
				// 如果没有直接删除
				if($zi == 0){
					$delete = Db::table($db)->where($willChar,$willContent)->delete();
					if($delete){
						$this->success('删除成功','admin/Setting/menus');
					}else{
						$this->error('删除失败','admin/Setting/menus');
					}
					exit;
				}else{
					// 连同子菜单一同删除
					// 先删除子菜单
					$deleteZi = Db::table($db)->where('pid',$id)->delete();
					if($deleteZi){
						// 开始删除子菜单
						$deleteZhu = Db::table($db)->where($willChar,$willContent)->delete();
						if($deleteZhu){
							$this->success('菜单删除成功','admin/Setting/menus');
						}else{
							$this->success('删除菜单失败(主菜单)','admin/Setting/menus');
						}
					}else{
						$this->error('删除子菜单失败','admin/Setting/menus');
					}
				}
			break;
			default:
				return false;
			break;
		}
	}

}

?>