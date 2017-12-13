$(function(){
	var menu1 = $('.menu-list ul');
	var menu2 = $('.menu-list ul li');
	var menu3 = $('.menu-list ul li ul');
	var menu4 = $('.menu-list ul li ul li');

	menu2.bind('mouseover',function(){
		menu1.nextAll().css('display','inline');
	});
	menu2.bind('mouseout',function(){
		menu3.css('display','none');
	});
})