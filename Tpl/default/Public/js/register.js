
/**
 * 全局命名空间flowg
 */
if (typeof flowg == "undefined" || !flowg) {
    var flowg = {};
}

/**
 * 非jQ插件的HTML直接调用函数或常用工具函数定义于此工具类中
 */
flowg.utils = {

	/**
	 * IE6透明替换代码
	 * @param {Object} ele
	 * @param {Object} src
	 */
	alphaImg : function(ele,src){
		
		var _ele = (typeof ele == 'string') ? $(ele) : ele;
		var arVersion = navigator.appVersion.split("MSIE");
		var version = parseFloat(arVersion[1]);
		if ((version >= 5.5) && (version < 7) && (document.body.filters)) {
			_ele.css({"filter":"progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true,src='" + src + "'",
			"background":"none"});
		}
	}
	
};

/**
 * short of flowg.utils
 */
var F = flowg.utils;

$(function(){
    init();
});
function init(){
	//IE6 png透明问题初始化
	F.alphaImg(".logo",__PUBLIC + "images/logo-small.png");
	$('#username').changeURLText('#homepagetext span');
	validateData($('#regform'));
	$('#regsubmit').hover(function(){
        $(this).addClass('hover');
    }, function(){
        $(this).removeClass('hover');
    });
}

function validateData(form){
	
	form.find('#username').validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "请输入账号"
                });
	form.find('#username').validate({
                    expression: "if (VAL.match(/^[a-zA-Z0-9]+$/)) return true; else return false;",
                    message: "账号必须英文或拼音"
                });
	form.find('#username').validate({
        expression: "if (VAL.length >= 5 && VAL.length <= 21 && VAL ) return true; else return false;",
        message: "用户名要在5到20位"
    });
	form.find('#userpass').validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "请输入密码"
                });
	form.find('#userpass').validate({
                    expression: "if (VAL.length > 5 && VAL.length < 16 && VAL ) return true; else return false;",
                    message: "密码要在6到16位"
                });
				
	form.find('#repass').validate({
                    expression: "if ((VAL == $('#userpass').val()) && VAL) return true; else return false;",
                    message: "两次输入密码须一致，请检查"
                });
				
	form.find('#nickname').validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "请输入昵称"
                });
	form.find('#email').validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "请输入邮箱地址"
                });
	form.find('#email').validate({
                    expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                    message: "邮箱格式错误"
                });
	form.find('#V').validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "请输入验证码"
                });
}

(function($){
	
	/**
	 * 对URL后加入账号
	 * @param {jQObject} targetBox
	 */
	$.fn.changeURLText = function(targetBox){
		
		var _targetBox = (typeof targetBox == 'string') ? $(targetBox) : targetBox;
		var _yval = _targetBox.text();
		
		var _changeText = function(){
			var _val = $(this).val();
			_targetBox.text(_yval + _val);
		}
		
		$(this).bind('keyup change', _changeText);
	};
	
})(jQuery);
