<?php
/*
	@	Helper.php
	@	此文件为后台调用方法帮助文档
	@	罗列后台公用调用方法与调用方法	
	#	对应文件：同目录Common.php	
*/
// ----------------------------------------->

	/*
		@	tableName
		@	根据传入参数来获取表名
		@	必传参数：$type
	*/
	tableName($type);

// ----------------------------------------->


	/*
		@	tableNums
		@	根据传入的表类型来获取表的总数量
		@	必传参数：$type
	*/
	tableNums($type);

// ----------------------------------------->

	/*
		@	getMessageForPage
		@	根据传入的页码与每页分页数量来返回查询数组
		@	必传参数：$type,$page,$pageShowNum
		@	提示：如果都传入0的话则获取所有数据
	*/
	getMessageForPage($type,$page,$pageShowNum);

// ----------------------------------------->

	/*
		@	pageination
		@	分页，返回分页数据
		@	必传参数：$type,$showPageNum
	*/
	pageination($type,$showPageNum);

// ----------------------------------------->

	/*
		@	getOneRowArr
		@	根据条件来获取表内某一行数据
		@	返回一维数组
		@	必传参数：
					$type  -->  表类型
					$char  -->	条件字段
					$value -->	条件值
	*/
	getOneRowArr($type,$char,$value);

// ----------------------------------------->

	/*
		@	getAllRowOf
		@	根据条件获取表内所有符合条件的数据
		@	返回多维数组
		@	必传参数：
					$type             -->	表类型
					$willChar         -->	条件字段
					$willCharContent  -->	条件值
	*/
	getAllRowsOf($type,$willChar,$willContent);

// ----------------------------------------->

	/*
		@	getAllRowsFor
		@	复杂版查询数据，默认page，limit等于0查询所有数据，如果指定则按照条件来查询
		@	返回多多维数组
		@	必传参数：
					$type            -->表类型
					$orderBy         -->排序字段
					$orderChar       -->排序规则
					$page            -->页码0
					$limit           -->与page一起用，每页分多少条数据
					$nums            -->单独使用，取几条数据
	*/
	getAllRowsFor($type,$orderBy,$orderChar,$page,$limit,$nums);

// ----------------------------------------->

	/*	
		@	getTableLastId
		@	获取表内最后一个id
		@	必传参数：$type
	*/
	getTableLastId($type);

// ----------------------------------------->

	/*
		@	getRowContentOf
		@	根据指定条件来查询某一行的某个字段值，如果不存在可以新建
		@	必传参数：
					$type-->			表类型
					$willChar-->		条件字段
					$willContent-->		条件值
					$char-->			要获取的字段值
					$new-->				是否新建：传入yes或者no
	*/
	getRowContentOf($type,$willChar,$willContent,$char,$new)

// ----------------------------------------->

	/*
		@	newMessage
		@	添加新内容，包括文章，页面，分类，页面
		@	必传参数：$type
	*/
	newMessage($type);

// ----------------------------------------->

	/*
		@	updateMessage
		@	更新内容，包括文章，页面，分类，页面
		@	必传参数：$type
	*/
	updateMessage($type);

// ----------------------------------------->

	/*
		@	deleteMessage
		@	删除内容，包括文章，页面，分类，页面
		@	必传参数：$type
	*/
	deleteMessage($type);
?>