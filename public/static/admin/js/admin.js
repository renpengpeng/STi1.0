/*
	手机菜单开始
*/
// 获取手机菜单id
$(function(){
	var adminBar = $('.adminBar_menu');
	// 获取激活id
	var mobileMenu = $('.mobile_menu');

	mobileMenu.bind('click',function(){
		adminBar.stop().fadeToggle(500);
	});
});
	/*
		@	删除文章ajax
	*/
	function deleteOneRow(url){
		$.ajax({
			'url':url,
			'async':false,
			'success':function(data){
				switch(data) {
					case 'error':
						alert('返回error可能是配置错误');
					break;
					case 'yes':
						alert('删除成功');
						window.location=location;
					break;
					case 'no':
						alert('删除失败');
						break;
					default:
						alert('系统未知错误');
					break;
				}
			}
		});

	}

/*
	菜单设置收缩
*/
function settingMenus(){
	var menuClass = $('.setting_menus_sc');
	menuClass.fadeToggle(500);
}
