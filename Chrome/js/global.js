/**
 * @author Leyteris
 */
function init(){
	var doMain = 'http://127.0.0.1/tflowg/service.php';
	var imgRoot = 'http://127.0.0.1/tflowg/images/avatar/flowg_50_';
    var source = "";
    var client = new PHPRPC_Client(doMain, ['hello', 'home_timeline', 'check_login', 'update','show_selfuser_info']);
    var _listBody = $('#list-body');
    var insertHtml = function(opt, type){
        htmlString = '<div class="list-item new-item" style="display:none;">' +
        '	<div class="list-left">' +
        '		<a href="#"><img src="' + imgRoot + opt['avatar'] + '" alt="#"/></a>' +
        '	</div>' +
        '	<div class="list-right">' +
        '		<div class="list-content"><a href="#">' + opt['nickname'] + ':</a>' + opt['content'] + '</div>' +
        '       <div class="list-footer">' + opt['topic_create_time'] + ' 来自' + opt['from'] + '</div>'
		'	</div>' +
        '</div>';
        _listBody.prepend(htmlString);
        if (type == 'slideDown') {
            $('.new-item').slideDown(function(){
                $(this).removeClass('new-item');
            });
        }
        else {
            $('.new-item').fadeIn(500, function(){
                $(this).removeClass('new-item');
            });
        }
    };
	
    client.check_login('leyteris', 'admin', function(result, args, output, warning){
        source = result;
    });
	
	
    client.show_selfuser_info(source,function(result, args, output, warning){
		$('#user-info-img').attr('src',imgRoot + result['avatar'])
		$('#user-info-name').html(result['nickname']);
		$('#fan-count').html(result['fanCount']);
		$('#follow-count').html(result['followCount']);
		$('#topic-count').html(result['topicCount']);
	});
    client.home_timeline(source, 0, 20, function(result, args, output, warning){
		_listBody.html("");
        for (var i = 19; i >= 0; --i) {
            insertHtml({
                'avatar': result[i]['avatar'],
                'content': result[i]['content'],
				'topic_create_time': result[i]['topic_create_time'],
				'from': result[i]['from'],
                'nickname': result[i]['nickname']
            });
        }
    });
    $('#post').toggle(function(){
        var postfun = function(content){
            client.update(source, content, 'Chrome Plugin', function(result, args, output, warning){
                insertHtml({
                    'avatar': result['avatar'],
                    'content': result['content'],
                    'nickname': result['nickname'],
					'topic_create_time': '刚刚',
					'from': result['from']
                }, 'slideDown');
				$('#post-area').slideUp();
            });
        };
        $('#post-area').slideDown(function(){
            $('#post-btn').click(function(){
                postfun($('#post-editer').val());
            });
        });
    },function(){
		$('#post-area').slideUp();
	});
	
	$('.list-item').live('hover', function(event){
	    if (event.type =='mouseover'){
			$(this).addClass('hover');
	        return false;
	    }else {
			$(this).removeClass('hover')
	        return false;
	    }
	});
}

$(init);