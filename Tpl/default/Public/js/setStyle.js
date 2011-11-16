$(function(){	
	$('#stylelist>a').click(function(){

		var _this = $(this).get(0);
		var bt = false;
		var $us = $('#userStyle')
		var rehref = $us ? $us.attr('href') : null;
		var boolF = function(){
			$('#userStyle').remove();
			$('head').append('<link rel="stylesheet" type="text/css" id="userStyle" href="' + rehref + '" /> ');
		}
		
		if(_this.className == 'thisstyle'){
			jAlert('已使用此皮肤','提示');
		}else{
			rehref ? $('#userStyle').remove() : null;
			if(_this.id != '0'){
				bt = true;
				$('head').append('<link rel="stylesheet" type="text/css" id="userStyle" href="' + _this.href + 'css/style.css" /> ');
			}
			setTimeout(function(){
				jConfirm('确定使用这个皮肤？','提示',function(i){
					if(i){
						actionUrl = $('#setStyleForm').get(0).action;
						id = _this.id;
						$.getJSON(actionUrl,{styleId:id},function(data){
							if(!data.status){
								bt ? boolF() : $('#userStyle').remove();
							}else{
								$('.thisstyle').get(0).className="styleimg";
								_this.className = 'thisstyle';
							}
						});
					}else{
						bt ? boolF() : $('head').append('<link rel="stylesheet" type="text/css" id="userStyle" href="' + rehref + '" /> ');
					}
				});
			},2400);
		}
		return false;
	});
});