/**
 * @auther:leyteris
 * @date:2011-1-5
 * @file:login.js
 */

$(function(){
	
	$('.regBtn').hover(function(){
        $(this).addClass('hover');
    }, function(){
        $(this).removeClass('hover');
    });
	var listHtmlStr = '<li class="newlistbody" style="display:none;"><div class="userpic"><a href="#"><img alt="头像" src="' + __PUBLIC + 'images/50.jpg" /></a></div><div class="listbodyright"><a class="name" href="#">Leyteris:</a><p class="msg">好不容易</p><span class="listuptime">10分钟前</span></div></li>';
	
	var clInt = setInterval(function(){
		$('#ajaxlist').prepend(listHtmlStr);
		$('.newlistbody').slideDown(600).removeClass('newlistbody');
	},16000);
	
});
