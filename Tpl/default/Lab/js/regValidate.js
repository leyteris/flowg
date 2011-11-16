/**
 * @author Leyteris
 */
$(function(){
	$('#regform #regname').blur(function(){
		$.post('TregAction', { regname: $(this).val() }, function(data){
			$('#regform #regname + .prompt').text(data);
		});
		$(this).ajaxStart(function(){
			$('#regform #regname + .prompt').text('loading...');
		}).ajaxError(function(){
			$('#regform #regname + .prompt').text('error!');	
		});
	});
	
	$('#regsubmit').click(function(){
		$parent = $(this).parent('form');
		$.getJson('TregAction',{ regname : $('regname').val() , regpassword : $('regpassword').val() , regsubmit : $('regsubmit').val() },function(data){
			if(data.isOk){
				alert("注册成功！");
			}else{
				alert("注册失败！");
			}
		});
	});
});