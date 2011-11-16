$(function(){
	
	//$('#settingform').settingSubimt();
	validateData($('#settingform'));
});

function validateData(form){
	
	form.find('#homepage').validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "请输入个性域名"
                });
	form.find('#homepage').validate({
                    expression: "if (VAL.match(/^[a-zA-Z0-9]+$/)) return true; else return false;",
                    message: "个性域名必须英文或拼音"
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
	form.find('#personalpage').validate({
			        expression: "if (VAL.match(/^http:\/\/([a-zA-Z0-9\\_\\-\\.]+.)[a-zA-Z]{2,4}$/)) return true; else return false;",
			        message: "主页地址错误（以http://开头）"
			    });
	form.find('#msn').validate({
			        expression: "if (!VAL || VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
			        message: "msn账号格式错误"
			    });
	form.find('#qq').validate({
			        expression: "if (!VAL || VAL.match(/^[0-9]+$/)) return true; else return false;",
			        message: "QQ号码格式错误"
			    });
	form.find('#mobile').validate({
			        expression: "if (!VAL || VAL.match(/^[0-9]+$/)) return true; else return false;",
			        message: "手机号码格式错误"
			    });
	form.find('#V').validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "请输入验证码"
                });
}

(function ($){
	
	$.fn.settingSubimt = function (){
		
        $(this).ajaxForm({
            beforeSubmit: checkForm,
            success: completeForm,
            dataType: 'json'
        });
        
        function checkForm(){
        	
        	da =$('#settingform').find('#homepage').validate({
			                expression: "if (VAL) return true; else return false;",
			                message: "请输入个性域名"
			            });
        	
			$(this).find('#homepage').validate({
			                expression: "if (VAL.match(/^[a-zA-Z0-9]+$/)) return true; else return false;",
			                message: "个性域名必须英文或拼音"
			            });
			$(this).find('#nickname').validate({
			                expression: "if (VAL) return true; else return false;",
			                message: "请输入昵称"
			            });
			$(this).find('#email').validate({
			                expression: "if (VAL) return true; else return false;",
			                message: "请输入邮箱地址"
			            });
			$(this).find('#email').validate({
			                expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
			                message: "邮箱格式错误"
			            });
			$(this).find('#personalpage').validate({
					        expression: "if (VAL.match(/^http:\/\/([a-zA-Z0-9\\_\\-\\.]+.)[a-zA-Z]{2,4}$/)) return true; else return false;",
					        message: "主页地址错误（以http://开头）"
					    });
			$(this).find('#msn').validate({
					        expression: "if (!VAL || VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
					        message: "msn账号格式错误"
					    });
			$(this).find('#qq').validate({
					        expression: "if (!VAL || VAL.match(/^[0-9]+$/)) return true; else return false;",
					        message: "QQ号码格式错误"
					    });
			$(this).find('#mobile').validate({
					        expression: "if (!VAL || VAL.match(/^[0-9]+$/)) return true; else return false;",
					        message: "手机号码格式错误"
					    });
			$(this).find('#V').validate({
			                expression: "if (VAL) return true; else return false;",
			                message: "请输入验证码"
			            });
        	alert(da);
        }
        
        function completeForm(data){
        	
        	jAlert(data.info);
        	
        }
		
	}
	
})(jQuery)