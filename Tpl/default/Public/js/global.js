/**
 * @auther:leyteris
 * @date:2010-12-8
 * @lastmodify:2011-3-24
 * @file:globle.js
 */

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
	 * 转发列表中回复ta
	 */
	replyTa : function(str){
		str = this.setContent(str);
		$('#tmbox').val(str).setFocus('first');
	},
	
	/**
	 * 过滤html代码
	 */
	setContent : function(str) {
		str = str.replace(/<\/?[^>]*>/g,'');
		str.value = str.replace(/[ | ]*\n/g,'\n');
		return str;
	},
	
	/**
	 * 通过rel属性取得转发内容反馈
	 * @param {Object} str
	 */
	getZhuanContent : function(str){
		var strArray = str.split(' %&% '); 
		if(strArray[0] == '0'){
			return "";
		}else{
			return strArray[1];
		}
	},

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

/**
 * 入口函数
 */
$(function(){
    flowg.init();
});

flowg.init = (function(){
	
	//常量定义
	var transmitboxHtml =
	'<div class="transmitbox" style="display:none;">' +
	'<a class="closeBox" href="javascript:void(0);" title="关闭">关闭</a>' +							
	'<span class="boxsat"></span>' +                             	
	'<span class="boxsab"></span>' +                				
	'<form action="' + __AJAXREPLY + '" method="post" id="tmform" name="tmform">' +                                
	'<label for="tmbox">转发原文，转发内容会发送给你的粉丝<br/>顺便说两句:</label>' +                                	
	'<textarea id="tmbox" name="content"></textarea>' +	
	'<input name="rootid" id="rootid" type="hidden"/>' +  
	'<input name="isTransmit"type="hidden" value="1"/>' +           				
	'<input name="tmtalkbtn" id="tmtalkbtn" type="submit" value="转发"/>' +									
	'<span id="tmlefttext">你还可以输入<em>140</em>字</span>' +	                				
	'</form>' +								
	'</div>';
	
	var commentboxHtml =
	'<div class="commentbox" style="display:none;">' + 
	'<a class="closeBox" href="javascript:void(0);" title="关闭">关闭</a>' +		        
	'<span class="boxsat"></span>' +                             	
	'<span class="boxsab"></span>' +   
	'<form action="' + __AJAXREPLY + '" method="post" id="cmform" name="cmform">' +                                 
	'<label for="cmbox">点评原文，点评内容不会发送给你的粉丝</label>' +                                 	
	'<textarea id="cmbox" name="content"></textarea>' + 	            
	'<input name="rootid" id="rootid" type="hidden"/>' + 		    				
	'<input name="cmtalkbtn" id="cmtalkbtn" type="submit" value="转发"/>' + 									
	'<span id="cmlefttext">你还可以输入<em>140</em>字</span>' + 	                				
	'</form>' + 								
	'</div>';
	
	var attaboxHtml =
	'<div class="attabox" style="display:none;">' +
	'<a class="closeBox" href="javascript:void(0);" title="关闭">关闭</a>' +							
	'<span class="boxsat"></span>' +                             	
	'<span class="boxsab"></span>' +                				
	'<form action="' + __AJAXATTA + '" method="post" id="atform" name="atform">' +                                
	'<label for="atbox">@TA不会出现在你粉丝的主页上，但可以在你的页面看到<br/>想对TA说：</label>' +                                	
	'<textarea id="atbox" name="content"></textarea>' +	
	'<input name="rootid" id="rootid" type="hidden"/>' +          				
	'<input name="attalkbtn" id="attalkbtn" type="submit" value="转发"/>' +									
	'<span id="atlefttext">你还可以输入<em>140</em>字</span>' +	                				
	'</form>' +								
	'</div>';
	
	var replylistboxHtml=
	'<div class="replylistbox" style="display:none;">' +
	'<a class="closeBox" href="javascript:void(0);" title="关闭">关闭</a>' +		
    '<form action="' + __AJAXREPLY + '" method="post" id="tmform" name="tmform">' +                      	
    '<label for="tmbox">转发原文，转发内容会发送给你的粉丝<br/>顺便说两句:</label>' +                         	
	'<textarea id="tmbox" name="content"></textarea>' +             	
	'<input name="rootid" id="rootid" type="hidden"/>' + 
	'<input name="isTransmit"type="hidden" value="1"/>' +  			
	'<input name="tmtalkbtn" id="tmtalkbtn" type="submit" value="转发"/>' +							
	'<span id="tmlefttext">你还可以输入<em>140</em>字</span>' +            				
	'</form>' +						
    '<ul id="replylist">' +                                              
    '</ul>' +                         
    '<span class="right clear"><a href="#" id="seetrans">查看全部转发和评论 >></a></span>' +  
	'<div class="clear"></div>' + 
    '</div>';
	
	//下列类只能出现一个
	var preRemoveNodes = Array('.transmitbox','.commentbox','.replylistbox','.attabox');

	/**
	 * 初始化函数
	 */
	function init(){
	
		//IE6 png透明问题初始化
		F.alphaImg(".logo",__PUBLIC + "images/logo-small.png");
		
		//搜索框初始化
		$('#searchTxt').attr('value','搜索用户，微博').focus(function(){
			$(this).get(0).value == '搜索用户，微博' ? $(this).get(0).value = '' : null;
		}).blur(function(){
			$(this).get(0).value == '' ? $(this).get(0).value = '搜索用户，微博' : null;
			
		});
		
		//发布微博文本域初始化
	    $('#talkbox').textCountable('#lefttext', 140);
	    $('#insertActivity').insertTag('#talkbox', '#插入话题#');
	    $('#msgform').ajaxFormSubmit('#talkbox', '#lefttext', 140, '#talklist');
	    $('.listbody').listHoverable();
		
		//表情框图片框并绑定事件
	    $('#insertExpressionBtn').showIconBox('#talkbox');
		$('#insertPicBtn').showPicInsertBox();
		
		//@TA，评论，转发，转发列表框初始化
		$('.attabtn').showTalkBox('.attabox', '.listbodyright', attaboxHtml, preRemoveNodes,function(e){
			
			var ab = $('#atbox');
			
			$('#rootid').val($('.attabox').parents('.listbody').attr('id'));
			ab.textCountable('#atlefttext', 140).textAreaExpander(19);
			$(".attabox a.closeBox").closeBox('.attabox',false,100,true);
			$('.attabox #atform').ajaxCommentSubmit('#atbox', '#atlefttext', 140,'.attabox');
			$('.attabox textarea').text();
			
			ab.text(e.attr('rel'));
			ab.setFocus('last');
		});
		
		$('.transmitbtn').showTalkBox('.transmitbox', '.listbodyright', transmitboxHtml, preRemoveNodes,function(e){
			
			var tb = $('#tmbox');
			
			$('#rootid').val($('.transmitbox').parents('.listbody').attr('id'));
			tb.textCountable('#tmlefttext', 140).textAreaExpander(19);
			$(".transmitbox a.closeBox").closeBox('.transmitbox',false,100,true);
			$('.transmitbox #tmform').ajaxCommentSubmit('#tmbox', '#tmlefttext', 140,'.transmitbox');
			
			var relTxt = e.attr('rel');
			
			tb.text(F.getZhuanContent(relTxt));
			tb.setFocus('first');
			
		});
		
		$('.commentbtn').showTalkBox('.commentbox', '.listbodyright', commentboxHtml, preRemoveNodes, function(e){
			
			var cb = $('#cmbox');
			$('#rootid').val($('.commentbox').parents('.listbody').attr('id'));
			cb.textCountable('#cmlefttext', 140).textAreaExpander(19);
			$(".commentbox a.closeBox").closeBox('.commentbox',false,100,true);
			$('.commentbox #cmform').ajaxCommentSubmit('#cmbox', '#cmlefttext', 140,'.commentbox');
			cb.focus();
			
		});
		
		$('.replylistbtn').showTalkBox('.replylistbox', '.listbodyright', replylistboxHtml, preRemoveNodes,function(e){
			
			var _id = $('.replylistbox').parents('.listbody').attr('id');
			var tb = $('#tmbox');
			
			$('#rootid').val(_id);
			tb.textCountable('#tmlefttext', 140).textAreaExpander(19);
			$(".replylistbox a.closeBox").closeBox('.replylistbox',false,100,true);
			$('.replylistbox #replylist').showReplyList(__SHOWREPLYLIST+'?tid='+_id,true);
			$('.replylistbox #tmform').ajaxCommentSubmit('#tmbox', '#tmlefttext', 140,'.replylistbox', function(data){
				var replylistbodyHtml=
				'<li class="replylistbody newreplylistbody" style="display:none">' +                          
				'<strong>' +                            	
				'<a href="' + __WEBPATH + __HOMEPAGE + '" target="_blank">' + __NICKNAME + '</a>:' +                                	
				'</strong>' +                              
				'<span>' + data.data + '</span>' +                               
				'<span class="despan">刚刚   来自Web</span>' +								
				'<a href="javascript:void(0)" class="huizhuanbtn" onclick="F.replyTa(\' //@'+ __HOMEPAGE +' :' + F.setContent(data.data) + '\')">转发</a>' +                               
				'</li>';
				$('.replylistbox #replylist').prepend(replylistbodyHtml);
				$('.newreplylistbody').slideDown(500).removeClass('newreplylistbody');
				$('#tmbox').text("").focus();
			});
			$('#seetrans')[0].href=e[0].href;
			tb.focus();
			
		});
		
		//分享图片放大旋转初始化
		$('a.artZoom').artZoom();
		$("#floatWrap a.closeBox").closeBox('#floatWrap',false,300,false);
		
		//关注，收藏按钮动作初始化,普通ajax控制器参数对照
		//successType,errorType,loadingText,callback
		$('.followta').addAjaxAction();
		$('.deltpbtn').addAjaxAction('remove',null,null,function(e){
			e.parents('li.listbody').slideUp(function(){
				e.remove()
			});
		});
		$('.addfavoritebtn').addAjaxAction();
		$('.delfavoritebtn').addAjaxAction('remove',null,null,function(e){
			e.parents('li.listbody').slideUp(function(){
				e.remove()
			});
		});
		
		//var $data = ['asd','a','fj','ty','po','i'];
		/*
		$("#talkbox").autocomplete({
			source: $data
		});
		
		$("#searchTxt").autocomplete({
			source: $data
		});*/
		//焦点到微博文本域
		$('#talkbox').focus();
	
	}
	
	return init;
	
})();

/**
 * jQ 自定义系列插件集闭包
 */
(function($){
	
	/**
	 * 显示图片插入框
	 * @param {mix} targetBox 插入图片的目标文本框
	 * @param {Function} callBack 回调函数
	 */
	$.fn.showPicInsertBox = function(targetBox,callBack){
		
		var _targetBox = (typeof targetBox == 'string') ? $(targetBox) : targetBox;
		
		$(this).click(function(){
			
			var picBoxHtml = 
			'<form id="picInsertForm" action="' + __AJAXUPLOADIMGURL + '" method="post" enctype="multipart/form-data">' + 
			'<label for="fileToUpload">从本地选择图片：</label><input type="file" name="fileToUpload" id="fileToUpload" style="width:250px;"><br/>' +
			'<input type="submit" name="filesend" id="filesend" value="确认上传"><500KB,gif,jpg,png图片' +
			'</form>'; 

			$("#floatWrap h1").text('插入图片');
		    $("#floatWrap").show(300);
			$("#floatWrap>#floatWrapBody").empty().prepend(picBoxHtml);
			
			$('form#picInsertForm').ajaxImgUpload(function(data){
				
				var _data = data.data;
				$("#floatWrap>#floatWrapBody").html('<a class="artZoom" href="' + _data.url + '" rel="' + _data.url + '"><img src="' + _data.thumb_url + '"/></a>');
				
				$('#msgbox #attpic').val(_data.id);
				
				//jAlert(data.info);
				
			});
			
		});
		
		return this;
		
	};
	
	/**
	 * ajax上传图片
	 * @param {Function} successCall 成功后的回调函数
	 */
	$.fn.ajaxImgUpload = function(successCall){
		
		$(this).ajaxForm({
            success: completeForm,
			dataType: 'json'
        });
		
    	function completeForm(data){
			if (data.status == 1) {
				successCall(data);
			} else {
				jAlert(data.info);
			}
		}
	    
	    return this;
		
	};
	
	/**
	 * 列表Ajax显示
	 * @param {String} actionURL 后台控制器接口
	 * @param {Boolean} isCache 是否需要缓冲视觉
	 */
	$.fn.showReplyList = function(actionURL,isCache){
		
		var _this = $(this);
		
		if(isCache){
			_this.html('列表读取中<img src="' + __PUBLIC + '/images/loading.gif"/>');
		}
		
		$.getJSON(actionURL,function(data){

			if(data.status == 1){
						
				var listHtml ='';
				for(var i = 0 ; i < data.data.length ; ++i){
					
					var obj = data.data[i];
					var replylistbodyHtml=
					'<li class="replylistbody">' +                          
				    '<strong>' +                            	
				    '<a href="' + __WEBPATH + obj['homepage'] + '" target="_blank">' + obj['nickname'] + '</a>:' +                                	
				    '</strong>' +                              
				    '<span>' + obj['content'] + '</span>' +                               
					'<span class="despan">' + obj['topiccreate_time'] + '   来自' + obj['from'] + '</span>' +								
				    '<a href="javascript:void(0)" class="huizhuanbtn" onclick="F.replyTa(\' //@'+ obj['homepage'] +' :' + F.setContent(obj['content']) + '\')">转发</a>' +                               
				    '</li>';
					
					listHtml += replylistbodyHtml;
				}
				_this.empty().prepend(listHtml);
				
			}else{
				_this.html(data.info);
			}
		});
		
		return this;
	}
	
	/**
	 * ajax 通用控制器
	 * @param {String} successType 成功形式:'alert','innerHTML','remove';
	 * @param {String} errorType 异常提示形式:'alert','innerHTML' 
	 * @param {String} loadingText 载入字符串
	 * @param {Function} callback 回调函数
	 */
	$.fn.addAjaxAction = function(successType,errorType,loadingText,callback){

		var _successType = successType || 'innerHTML';
		var _errorType = successType || 'alert';
		var _loadingText = loadingText || '<img src="' + __PUBLIC + '/images/loading.gif"/>';
		
		$(this).live('click',function(e){
			
			if (e.target == this) {
				
				var _target = e.target;
				var _beHTML = _target.innerHTML;
				
				_target.innerHTML = _loadingText;
				
				var _typeFuction = function(data,type){
				
					switch(type){
						case 'innerHTML' : 
							_target.innerHTML = data;
							break;
						case 'alert':
							_target.innerHTML = _beHTML;
							jAlert(data,'提示');
							break;
						case 'remove':
							callback($(_target));
							break;
						default:break;
					}
					/*if(type === 'innerHTML'){
						_target.innerHTML = data;
					}else if(type === 'alert' ){
						_target.innerHTML = _beHTML;
						jAlert(data,'提示');
						//alert(data);
					}else if(type === 'remove'){
						if(jAlert(data,'提示')){
							
						}
					}*/
				}
				
				var _getJSON = function(){
					$.getJSON(_target.href,function(data){
						if (data.status == '1') {
							//alert(_target.innerHTML);
							//_target.innerHTML = data.info;
							_typeFuction(data.info,_successType);
						}else{
							//alert(data.info);
							_typeFuction(data.info,_errorType);
						}
					});
				}
				
				if(_successType === 'remove'){
					jConfirm('确定此操作？','提示',_getJSON);
				}else{
					_getJSON();
				}
				
			}
			
			return false;
			
		});

	};

	/**
	 * 设置光标指针工具函数
	 * @param {mix} pos
	 */
	$.fn.setFocus = function (pos){
		
		var DOMele = $(this).get(0);
		
		var _pos = 0;
		if(typeof pos == 'string'){
			if(pos == 'first'){
				_pos = 0;
			}else if(pos == 'last'){
				_pos = DOMele.value.length;
			}
		}else if(typeof pos == 'number'){
			_pos = pos;
		}

		if (document.all && DOMele.createTextRange) {//IE
            var range = DOMele.createTextRange();
			range.move("character",_pos);
			//range.moveStart('character',_pos);
			//range.collapse(true);
			range.select();
        }else {//FF
            if (DOMele.setSelectionRange) {
                DOMele.setSelectionRange(_pos, _pos);
				DOMele.focus();
            }
        }
		
		return this;
		
	};
	
	/**
	 * 对关闭控件实时添加事件
	 * @param {String} parentString 请求被关闭的父标签
	 * @param {Boolean} removeAble 消失后是否执行移除
	 * @param {int} time 隐藏的动画时间
	 * @param {Boolean} isSlideUp 是否以slideUp的形式消失，否则用hide消失
	 */
	$.fn.closeBox = function(parentString,removeAble,time,isSlideUp){
		
		$(this).live('click',function(){
			
			var _parentNode = $(this).parents(parentString);
			
			if (removeAble) {
				if(isSlideUp){
					_parentNode.slideUp(time).remove();
				}else{
					_parentNode.hide(time).remove();
				}
			}else {
				if(isSlideUp){
					_parentNode.slideUp(time);
				}else{
					_parentNode.hide(time);
				}
			}
		});
		
		return this;
	};
	
	/**
	 * 显示表情框
	 * @param {String || jQobj} targetBox 对于表情的添加对象
	 */
	$.fn.showIconBox = function(targetBox){
		
		$(this).click(function(){

			var icon = "";   
		    for (var i = 0; i < 50; i++) {    
		        icon += "<img src='"+__PUBLIC+"images/icon/" + i + ".gif'>";        
		    }    
			$("#floatWrap h1").text('插入表情');
		    $("#floatWrap").show(300);
			$("#floatWrap>#floatWrapBody").html(icon);
			
			$.each($("#floatWrap img"), function(i, n){
	  			$(this).click(function(){
					var _targetBox = (typeof targetBox == 'string') ? $(targetBox) : targetBox;
			    	_targetBox.insertAtCaret('(' + i + '.gif)', false);
					$("#floatWrap").hide(300);
					_targetBox.focus();
				});
			}); 
		});
		
		return this;
		
	};
	
	/**
	 * 对于Ajax添加转发评论的盒子显示函数
	 * @param {String} thisBoxName 本HTML代码段中的节点名
	 * @param {String} parentBox 需要添加到哪个父节点中
	 * @param {String} boxHtml 添加的HTML代码段
	 * @param {Array} removeNodes 事先需要清空的节点
	 * @param {Function} callback 回调函数
	 */
	$.fn.showTalkBox = function(thisBoxName,parentBox, boxHtml, removeNodes, callBack){
		
		$(this).live("click",function(){
			var that = $(this);
			$.each(removeNodes, function(i, n){
	  			$(n).remove();
			}); 
			that.parents(parentBox).append(boxHtml);
			$(thisBoxName).show();
			callBack(that);
			
			return false;
		});		
		
		return this;
	};
	
    /**
     * 提示弹出插件
     * @param {String} showText 弹出信息
     * @param {int} speed 弹出速度
     */
    $.fn.toast = function(showText,speed){
    
		var that = $(this);
        if (showText != '') {
            that.hide().html(showText).fadeIn(speed).show();
        }else {
            that.hide().fadeIn(speed).show();
        }
		
        return this;
    }
    
	/**
	 * ajax提交评论转发等
	 * @param {mix} commentBox
	 * @param {mix} targetTextBox
	 * @param {int} textAreaMaxLen
	 * @param {mix} thisBox
	 */
	$.fn.ajaxCommentSubmit = function(commentBox, targetTextBox, textAreaMaxLen, thisBox, callback){
		
		var _commentBox = (typeof commentBox == 'string') ? $(commentBox) : commentBox;
		var _targetTextBox = (typeof targetTextBox == 'string') ? $(targetTextBox) : targetTextBox;
		var _thisBox = (typeof thisBox == 'string') ? $(thisBox) : thisBox;
		var _len = 0;

		$(this).ajaxForm({
            beforeSubmit: checkForm,
            success: completeForm,
            dataType: 'json'
        });

        function checkForm(){
			
			_len = _commentBox.val().length;
            if(_len == 0) {
				_targetTextBox.toast('<span class="error">请输入内容！</span>','slow');
				//alert(_len);
				return false;
			}else{
				if((_len - textAreaMaxLen) > 0){
					_targetTextBox.toast('','slow');
					return false;
				}else{
					_targetTextBox.toast('发布中<img src="' + __PUBLIC + '/images/loading.gif"/>', 'slow');
					return true;
				}
			}

        }

    	function completeForm(data){
			
			if (data.status == 1) {
				_targetTextBox.toast(data.info,'slow');
				
				if(callback){
					callback(data);
				}else{
					_thisBox.wait().slideUp(100);
				}
			}else {
				_targetTextBox.toast('<span class="error">'+data.info+'</span>','slow');
			}
			
		}

		return this;
		
	}
	
    /**
     * ajax提交表单
     * @param {Object || String} talkBox 文本数据源节点
     * @param {Object || String} targetTextBox 弹出提示的目标文本节点
     * @param {int} textAreaMaxLen 文本数据源节点最大文本容量，用于校验并弹出提示
     * @param {Object || String} talkList 目标数据节点
     */
    $.fn.ajaxFormSubmit = function(talkBox, targetTextBox, textAreaMaxLen, talkList){

		var _talkList = (typeof talkList == 'string') ? $(talkList) : talkList;
		var _talkBox = (typeof talkBox == 'string') ? $(talkBox) : talkBox;
		var _targetTextBox = (typeof targetTextBox == 'string') ? $(targetTextBox) : targetTextBox;
		var _len = 0;

		$(this).ajaxForm({
            beforeSubmit: checkForm,
            success: completeForm,
            dataType: 'json'
        });

        function checkForm(){
			_len = _talkBox.val().length;
            if(_len == 0) {
				_targetTextBox.toast('<span class="error">请输入内容！</span>','slow');
				//alert(_len);
				return false;
			}else{
				if((_len - textAreaMaxLen) > 0){
					_targetTextBox.toast('','slow');
					return false;
				}else{
					_targetTextBox.toast('发布中<img src="' + __PUBLIC + '/images/loading.gif"/>', 'slow');
					return true;
				}
			}

        }
		//提交表单后的回调函数
    	function completeForm(data){
			if (data.status == 1) {
				_targetTextBox.toast(data.info,'slow');
				data = data.data;
				htmlString = '<li class="listbody newlistbody" id="' + data.id + '" style="display:none;">' +
				'<div class="userpic">' +
				'<a href="' + __WEBPATH + data.homepage + '"><img alt="头像" src="' + __USERAVATAR + '" alt="' + __NICKNAME + '"/></a>' +
				'</div>' +
				'<div class="listbodyright">' +
				'<a class="username" href="' + __WEBPATH + __HOMEPAGE + '">' + data.nickname + ':</a>' +
				'<p class="usermsg">' + data.content + '</p>';
				
				if(data.imgid != '0'){
					htmlString +=
					'<div class="useruppic">' +
                    '<a class="artZoom" href="' + data.imgurl + '" rel="' + data.url + '">' +       	
                    '<img src="' + data.imgthumb_url + '" />'  +     		
					'</a>' +			
					'</div>';		
				}

				htmlString +=
				'<div class="listfooter">' +
				'<div class="listfooterl">' +
				'<span class="listuptime">刚刚</span>' +
				'<span class="listupclt">来自<a href="#">' + data.from + '</a></span>' +
				'</div>' +
				'<div class="listfooterr">' +
				'<span><a href="javascript:void(0)" class="transmitbtn">转发</a></span>' +
				'<span><a href="javascript:void(0)" class="commentbtn">评论</a></span>' +
				'<span><a href="' + __AJAXDELMYTOPIC + '?tid=' + data.id + '" class="deltpbtn">删除</a></span>' +
				'<span><a href="' + __AJAXADDFAV + '?tid=' + data.id + '" class="addfavoritebtn">收藏</a></span>' +
				'</div>' +
				'</div>' +
				'</div>' +
				'</li>';
				
				_talkList.prepend(htmlString);
				$('.newlistbody').slideDown(600).listHoverable().removeClass('newlistbody');
				
			}else {
				_targetTextBox.toast('<span class="error">'+data.info+'</span>','slow');
			}
			
			$('#msgbox #attpic').val() == '0' ? null : $('#msgbox #attpic').val('0');
			$('#floatWrap').hide(300);
			_talkBox.text('').focus();
		};

		return this;

	}
    
    /**
     * 字数变换检测插件
     * @param {String} targetText 需要适时显示剩余字符数的目标文本节点
     * @param {int} maxNum 最大字符数
     */
    $.fn.textCountable = function(targetText, maxNum){
		
        var _targetText = (typeof targetText == 'string') ? $(targetText) : targetText;
        var _targetText = $(targetText);
        var _btn = $(this).closest('form').find(':submit');
        var _len = 0;
		
        var _countText = function(){
            _len = $(this).val().length;
            disabled = {
                on: function(){
                    // _btn.removeAttr('disabled');
                    _targetText.html('你还可以输入<em>' + (maxNum - _len) + '</em>字');
                },
                off: function(){
                    // _btn.attr('disabled', 'disabled');
                    _targetText.html('超出<em class="error">' + (_len - maxNum) + '</em>字');
                }
            };
            if (_len <= maxNum && _len >= 0) {
                disabled.on();
            }
            else {
                disabled.off();
            }
        };
        /*
         var _btnChange = function(){
         //alert(maxNum + "  " +  _len);
         if(_len == 0) {
         _targetText.hide().html('<span class="error">请输入内容！').fadeIn('slow').show();
         }else{
         if((_len - maxNum) > 0){
         _targetText.hide().fadeIn('slow').show();
         }
         }
         };
         _btn.click(_btnChange);
         */
        $(this).bind('keyup change', _countText);
        return this;
    };
    
    /**
     * 列表hover事件属性插件
     */
    $.fn.listHoverable = function(){
		
        $(this).hover(function(){
            $(this).addClass('hover');
        }, function(){
            $(this).removeClass('hover');
        });
		
        return this;
		
    };
    
    /**
     * 插入话题插件
     * @param {Object || String} targetBox 目标文本框或文本域
     * @param {String} tagTpl 需要插入的文本模板 
     */
    $.fn.insertTag = function(targetBox, tagTpl){
    
        var _targetBox = (typeof targetBox == 'string') ? $(targetBox) : targetBox;
        var _targetBoxText = '';
        var _targetBoxNewText = '';
		
        $(this).click(function(){
            _targetBoxText = _targetBox.val();
            if (_targetBoxText.indexOf(tagTpl) >= 0) {
                _targetBox.selectTag(tagTpl);
            } else {
                _targetBox.insertAtCaret(tagTpl,true);
            }
        })
		
        return this;
		
    };
	  
    /**
     * 插入tagTpl文字内容
     * @param {String} tagTpl 需要插入的文本模板 
     * @param {Boolean} selectAble 是否需要选中
     */
    $.fn.insertAtCaret = function(tagTpl,selectAble){
		
        var textObj = $(this).get(0);
		
        if (document.all && textObj.createTextRange && textObj.caretPos) {
            var caretPos = textObj.caretPos;
            caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == "" ? tagTpl + "" : tagTpl;

			var re = eval("/" + tagTpl + "/i");
	        var startPos = textObj.value.search(re);
	        var endPos = textObj.innerHTML.length;
	        var endPosOffset = -(endPos - startPos - tagTpl.length) - 1;
	        var range = textObj.createTextRange();
	        var sel = range.duplicate();
			if(selectAble){
	        	sel.moveStart("character", startPos + 1);
	            sel.moveEnd("character", endPosOffset);
			}else{
				sel.move("character", endPos);
			}
	        sel.select();

        }else {
            if (textObj.setSelectionRange) {
                var rangeStart = textObj.selectionStart;
                var rangeEnd = textObj.selectionEnd;
                var tempStr1 = textObj.value.substring(0, rangeStart);
                var tempStr2 = textObj.value.substring(rangeEnd);
                textObj.value = tempStr1 + tagTpl + tempStr2;
				var len = tagTpl.length;
				if (selectAble) {
					textObj.setSelectionRange(rangeStart + 1, rangeStart + len - 1);
				}else{
					textObj.setSelectionRange(rangeStart + len, rangeStart + len);
				}
				textObj.focus();
            }else {
                if (document.all && textObj.createTextRange) {
                    textObj.value += tagTpl;
					var re = eval("/" + tagTpl + "/i");
					var startPos = textObj.value.search(re);
					var endPos = textObj.innerHTML.length;
					var endPosOffset = -(endPos - startPos - tagTpl.length) - 1;
					var range = textObj.createTextRange();
					var sel = range.duplicate();
					if (selectAble) {
						sel.moveStart("character", startPos + 1);
						sel.moveEnd("character", endPosOffset);
					} else {
						sel.move("character", endPos);
					}
					sel.select();
                } else {
                    textObj.value += tagTpl
                }
            }
        }
		
        return this;
		
    };
    
    /**
     * 选中tagTpl文字内容
     * @param {String} tagTpl 需要选中的文本模板 
     */
    $.fn.selectTag = function(tagTpl){
		
        var textObj = $(this).get(0);
		
        textObj.focus();
		
        if (document.all && textObj.createTextRange) {
            var re = eval("/" + tagTpl + "/i");
            var startPos = textObj.value.search(re);
            var endPos = textObj.innerHTML.length;
            var endPosOffset = -(endPos - startPos - tagTpl.length) - 1;
            var range = textObj.createTextRange();
            var sel = range.duplicate();
            sel.moveStart("character", startPos + 1);
            sel.moveEnd("character", endPosOffset);
            sel.select()
        }else {
            if (textObj.setSelectionRange) {
                var re = eval("/" + tagTpl + "/i");
                var startPos = textObj.value.search(re);
                textObj.setSelectionRange(startPos + 1, startPos + tagTpl.length - 1)
            }
        }
		
        return this;
		
    }
	
	/**
	 * 微博简约贴图缩放插件
	 */
	$.fn.artZoom = function(){
		$(this).live('click', function(){
			var maxImg = $(this).attr('href'),
			viewImg = $(this).attr('rel').length === '0' ? $(this).attr('rel') : maxImg; // 如果连接含有rel属性，则新窗口打开的原图地址为此rel里面的地址
			
			if ($(this).find('.loading').length == 0) $(this).append('<span class="loading" title="Loading..">Loading..</span>');
			imgTool($(this), maxImg, viewImg);
			return false;
		});
		
		// 图片预先加载
		var loadImg = function (url, fn){
			var img = new Image();
			img.src = url;
			if (img.complete){
				fn.call(img);
			}else{
				img.onload = function(){
					fn.call(img);
				};
			};
		};
		
		// 图片工具条
		var imgTool = function(on, maxImg, viewImg) {
			var width = 0,
			height = 0,
			tool = function(){
				on.find('.loading').remove();
				on.hide();
				
				if (on.next('.artZoomBox').length != 0){
					return on.next('.artZoomBox').show();
				};
				
				// 等比例限制宽度
				var maxWidth = on.parent().innerWidth() - 12; // 获取父级元素宽度
				if (width > maxWidth) {
					height = maxWidth / width * height;
					width = maxWidth;
				};
				
				var html = '<div class="artZoomBox"><div class="tool"><a class="hideImg" href="#" title="收起">收起</a><a class="imgLeft" href="#" title="向左转">向左转</a><a class="imgRight" href="#" title="向右转">向右转</a><a class="viewImg" href="' + viewImg + '" title="查看原图">查看原图</a></div><a href="' + viewImg + '" class="maxImgLink"> <img class="maxImg" width="' + width + '" height="' + height + '" src="' + maxImg + '" /></a></div>';
				on.after(html);
				var box = on.next('.artZoomBox');
				box.hover(function(){
					box.addClass('js_hover');
				}, function(){
					box.removeClass('js_hover');
				});
				box.find('a').bind('click', function(){
					// 收起
					if($(this).hasClass('hideImg') || $(this).hasClass('maxImgLink')) {
						box.hide();
						box.prev().show();
					};
					// 左旋转
					if($(this).hasClass('imgLeft')) {
						box.find('.maxImg').rotate('left')
					};
					// 右旋转
					if($(this).hasClass('imgRight')) {
						box.find('.maxImg').rotate('right')
					};
					// 新窗口打开
					if($(this).hasClass('viewImg')) window.open(viewImg);
					
					return false;
				});
				
			};
			
			loadImg(maxImg, function(){
				width = this.width;
				height= this.height;
				tool();
			});
			
			// 图片旋转
			$.fn.rotate = function(p){

				var img = $(this)[0],
					n = img.getAttribute('step');

				// 保存图片大小数据
				if (!this.data('width') && !$(this).data('height')) {
					this.data('width', img.width);
					this.data('height', img.height);
				};

				if(n == null) n = 0;
				if(p == 'left'){
					(n == 3) ? n = 0 : n++;
				}else if(p == 'right'){
					(n == 0)? n = 3 : n--;
				};
				img.setAttribute('step', n);

				// IE浏览器使用滤镜旋转
				if(document.all) {
					img.style.filter = 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ n +')';
					// IE8高度设置
					if ($.browser.version == 8) {
						switch(n){
							case 0:
								this.parent().height('');
								//this.height(this.data('height'));
								break;
							case 1:
								this.parent().height(this.data('width') + 10);
								//this.height(this.data('width'));
								break;
							case 2:
								this.parent().height('');
								//this.height(this.data('height'));
								break;
							case 3:
								this.parent().height(this.data('width') + 10);
								//this.height(this.data('width'));
								break;
						};
					};
				// 对现代浏览器写入HTML5的元素进行旋转： canvas
				}else{
					var c = this.next('canvas')[0];
					if(this.next('canvas').length == 0){
						this.css({'visibility': 'hidden', 'position': 'absolute'});
						c = document.createElement('canvas');
						c.setAttribute('class', 'maxImg canvas');
						img.parentNode.appendChild(c);
					}
					var canvasContext = c.getContext('2d');
					switch(n) {
						default :
						case 0 :
							c.setAttribute('width', img.width);
							c.setAttribute('height', img.height);
							canvasContext.rotate(0 * Math.PI / 180);
							canvasContext.drawImage(img, 0, 0);
							break;
						case 1 :
							c.setAttribute('width', img.height);
							c.setAttribute('height', img.width);
							canvasContext.rotate(90 * Math.PI / 180);
							canvasContext.drawImage(img, 0, -img.height);
							break;
						case 2 :
							c.setAttribute('width', img.width);
							c.setAttribute('height', img.height);
							canvasContext.rotate(180 * Math.PI / 180);
							canvasContext.drawImage(img, -img.width, -img.height);
							break;
						case 3 :
							c.setAttribute('width', img.height);
							c.setAttribute('height', img.width);
							canvasContext.rotate(270 * Math.PI / 180);
							canvasContext.drawImage(img, -img.width, 0);
							break;
					};
				};
			};
			
		};
		
		return this;
	};
	
	/**
	 * 等待插件
	 * @param {int} time
	 * @param {String} type
	 */
	$.fn.wait = function(time, type) {
       	time = time || 2000;
       	type = type || "fx";
       	return this.queue(type, function(){
       		var self = this;
          	setTimeout(function(){
             	$(self).dequeue();
         	}, time);
     	});
 	};
	
	/**
	 * 文本框自适应插件
	 * @param {int} minHeight
	 * @param {int} maxHeight
	 */
	$.fn.textAreaExpander = function(minHeight, maxHeight) {

		var hCheck = !($.browser.msie || $.browser.opera);

		function ResizeTextarea(e) {

			e = e.target || e;

			var vlen = e.value.length, ewidth = e.offsetWidth;
			if (vlen != e.valLength || ewidth != e.boxWidth) {

				if (hCheck && (vlen < e.valLength || ewidth != e.boxWidth)) e.style.height = "0px";
				var h = Math.max(e.expandMin, Math.min(e.scrollHeight, e.expandMax));

				e.style.overflow = (e.scrollHeight > h ? "auto" : "hidden");
				e.style.height = h + "px";

				e.valLength = vlen;
				e.boxWidth = ewidth;
			}

			return true;
		};

		this.each(function() {

			if (this.nodeName.toLowerCase() != "textarea") return;
			var p = this.className.match(/expand(\d+)\-*(\d+)*/i);
			this.expandMin = minHeight || (p ? parseInt('0'+p[1], 10) : 0);
			this.expandMax = maxHeight || (p ? parseInt('0'+p[2], 10) : 99999);

			ResizeTextarea(this);

			if (!this.Initialized) {
				this.Initialized = true;
				$(this).css("padding-top", 0).css("padding-bottom", 0);
				$(this).bind("keyup", ResizeTextarea).bind("focus", ResizeTextarea);
			}
		});

		return this;
	};
	
})(jQuery);
