/**
 * @author Leyteris
 * @date 2010-9-25
 * @modify 2010-9-27
 * java版本移植
 */

var zi = 1; //层高递加常数

window.onload = function(){
	init(false);//初始化函数
	/*$('#fssubmit').click(function(){
		$.post('post.php', { fstext: $('#fstext').val() }, function(data){
			$('#elelist').append("<div class=\"ele new\"><div class=\"title\">adga</div><div class=\"closer\">X</div><div class=\"maxer\">口</div><div class=\"elebody\">" + data + "</div></div>");
			init(true);
		});
	});*/
};

/*
 * 初始化函数
 */
function init(hasnew){
	
	var $new = hasnew ? $('.new') : null;
	var $ele = $('.ele');
	var jeleobj = {
		'width' : $ele.css('width'),
		'height' : $ele.css('height'),
		'pw' : $ele.parent('#elelist').css('width'),
		'ph' : $ele.parent('#elelist').css('height'),
		'len' : $ele.size()
	}
	
	zi = jeleobj.len + 1;
		
	randBackPic($ele,6,$new); //随机背景
		
	randZindex($ele,jeleobj); //随机层高
		
	randPostion($ele,jeleobj); //随机位置
	
	bindAction($ele,$new);//绑定动作事件
		
	eleDraggable($ele);	


	$ele.mousedown(function(){
		$(this).css({
			'z-index' : zi++
		});
	});	
	$new ? $new.removeClass('new') : null;
}

/*
 * ele绑定事件
 */
function bindAction($ele,$new){
	if ($new) {
		bindCloser($new);
		bindMaxer($new);
	}else{
		$ele.each(function(){
			bindCloser($(this));
			bindMaxer($(this));
		});
	}
	return;
}

/*
 * 关闭绑定事件
 */
function bindCloser(ele){
	$('.closeBox').click(function(){
		$(this).parents('.ele').fadeOut('slow');
	}); 
	return;
}

/*
 * 最大化绑定事件
 */
function bindMaxer(ele){
	ele.find('.maxer').click(function(){
		var eletext = $(this).siblings('.elebody').text();
		$('body').append('<div class="bigshow">' + eletext + '</div>');
		$('.bigshow').center().css({
			'z-index': zi + 3
		}).draggable({
			scroll: false
		}).fadeIn('slow');
		
		$('body').append('<div class="coverdiv"></div>');
		
		$('.coverdiv').css({
			'width': $(document).width(),
			'height': $(document).height(),
			'background': '#000000',
			'position': 'absolute',
			'top': '0px',
			'left': '0px',
			'display': 'none'
		}).css({
			'z-index': zi + 2,
			'opacity': '0.4'
		}).fadeIn('slow').click(function(){
			$('.bigshow').fadeOut('slow', function(){
				$(this).remove()
			});
			$(this).fadeOut('slow', function(){
				$(this).remove()
			});
		});
		
	});
	
	return;
	
}

/*
 * 随机层高
 */
function randZindex($ele,jeleobj){
	var len = jeleobj.len;
	$ele.each(function(){
		$(this).css('z-index',parseInt(Math.floor(Math.random() * len)) + 1);
	});
	return;
}

/*
 * 绑定拖拽事件
 */
function eleDraggable($ele){
	$ele.draggable({containment : '#elelist', scroll : false, opacity : 0.7 , cancel:'closeBox'});
	return;
}

/*
 * 随机位置
 */
function randPostion($ele,jeleobj){
	var pw = parseInt(jeleobj.pw);
	var ph = parseInt(jeleobj.ph);
	var ew = parseInt(jeleobj.width);
	var eh = parseInt(jeleobj.height);
	var eleft = 0;
	var etop = 0;
	$ele.each(function(){
		eleft = (rw = Math.floor(Math.random() * pw)) - ew <= 0 ? rw : rw - ew;
		etop = (rh = Math.floor(Math.random() * ph)) - eh <= 0 ? rh : rh - eh;
/*
	$(this).css({
		'left' : eleft + 'px' ,
		'top' : etop + 'px' 
	});
*/
		//$(this).css({'opacity' : '0.2'});
		$(this).animate({'left' : eleft + 'px' ,'top' : etop + 'px' /*,'opacity' : '1'*/}, { duration: 600 },"swing");
		//wait(600);
	});
	return;
}

/*
 * 随机背景
 */
function randBackPic($ele,i,$new){
	if ($new) {
		$new.addClass('color' + (Math.floor(Math.random() * i) + 1));
	}else {
		$ele.each(function(){
			$(this).addClass('color' + (Math.floor(Math.random() * i) + 1));
		});
	}
	return;
}

/*
 * 锁定div置屏幕中央插件
 */
(function($){ 
	$.fn.center = function(){ 
	
		var top = ($(window).height() - this.height())/2; 
		var left = ($(window).width() - this.width())/2; 
		var scrollTop = $(document).scrollTop(); 
		var scrollLeft = $(document).scrollLeft(); 
		
		return this.css( { position : 'absolute', 'top' : top + scrollTop, left : left + scrollLeft } ).show(); 
		
	} 
})(jQuery)