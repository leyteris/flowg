<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="sitename" content="Flowg微博">
<meta name="author" content="Leyteris">
<meta name="keyword" content="<?php echo ($site["keyword"]); ?>">
<meta name="description" content="<?php echo ($site["description"]); ?>">
<title><?php echo ($site["title"]); ?></title>
<script type="text/javascript">
	var __PUBLIC = "__TMPL__Public/";
	var __AJAXREPLY = "<?php echo U('ajax/ajaxReply');?>";
	var __AJAXATTA = "<?php echo U('ajax/ajaxAtta');?>";
	var __WEBPATH = "<?php echo ($webpath); ?>";
	var __SHOWREPLYLIST = "<?php echo U('ajax/showReplyList');?>";
	var __NICKNAME = "<?php echo ($userinfo["nickname"]); ?>";
	var __HOMEPAGE = "<?php echo ($userinfo["homepage"]); ?>";
	var __USERAVATAR = "<?php echo getUserAvatar($userinfo['avatar'],50);?>"
	var __AJAXUPLOADIMGURL = "<?php echo U('ajax/ajaxUploadImage');?>";
	var __AJAXDELMYTOPIC = "<?php echo U('ajax/ajaxDeleteMyTopic');?>";
	var __AJAXADDFAV = "<?php echo U('ajax/ajaxAddFavorite');?>";
	var __AJAXAUTOCOMPLETE = "<?php echo U('ajax/ajaxAutoComplete');?>";
</script>
<script type="text/javascript" src="__TMPL__Public/js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="__TMPL__Public/js/jquery-ui-1.8.4.custom.js"></script>
<script type="text/javascript" src="__TMPL__Public/js/jquery.form.js"></script> 
<script type="text/javascript" src="__TMPL__Public/js/jquery.alerts.js"></script> 
<script type="text/javascript" src="__TMPL__Public/js/jquery.ajaxfileupload.js"></script>
<script type="text/javascript" src="__TMPL__Public/js/global.js"></script> 
<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/reset.css" /> 
<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/fonts.css" /> 
<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/jQcss/jquery.ui.all.css" />
<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/jquery.alerts.css" /> 
<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/css.css" />

<?php if($stylers != 0): ?><link rel="stylesheet" type="text/css" id="userStyle" href="<?php echo ($webpath); ?><?php echo ($stylers["path"]); ?>css/style.css" /><?php endif; ?>
</head>
<body>
<div class="top-toolbar">
	<div class="top-toolbar-bg"></div>
	<div class="top-toolbar-div">
    	<div class="left left-toolbar">
            <span><a href="<?php echo U('piazza/index');?>">微博广场</a></span>
            <span><a href="<?php echo U('hall/index');?>">风云堂</a></span>
            <span><a href="<?php echo U('piazza/stroll');?>">随便看看</a></span>
            <span><a href="<?php echo U('lab/index');?>">Lab实验室</a></span>
            <span><a href="<?php echo U('index/api');?>" target="_blank">开放API</a></span>
    	</div>
    	<div class="right">
            <span class="top-username">
                <a href="<?php echo ($webpath); ?><?php echo ($userinfo["homepage"]); ?>" title="<?php echo ($userinfo["userid"]); ?>(@<?php echo ($userinfo["userid"]); ?>)"><?php echo ($userinfo["nickname"]); ?></a>
            </span>
            <span><a href="<?php echo U('setting/index');?>">设置</a></span>
            <span><a href="<?php echo U('news/index');?>" target="_blank">公告</a></span>
            <span><a href="<?php echo U('index/log');?>" target="_blank">开发日志</a></span>
            <span><a href="<?php echo U('global/logout');?>">注销</a></span>
        </div>
    </div>
</div>
<div class="wrapper">
	<div class="header">
    	<div class="logo">
        	<a class="linklogo" href="<?php echo ($webpath); ?>"><span>Flowg 微博 - Beta 2.1 测试版</span></a>
        </div>
        <div class="header-menu"> 
        	<div class="header-menu-bg"></div>
            <div class="menu-c"> 
                <ul> 
                	<li class="cur"><a href="<?php echo U('index/index');?>">首页</a></li> 
                	<li class="line">|</li> 
                	<li><a href="<?php echo U('piazza/index');?>">微博广场</a></li> 
                 	<li class="line">|</li> 
                 	<li><a href="<?php echo U('hall/index');?>">风云堂</a></li> 
                	<li class="line">|</li> 
               	 	<li><a href="<?php echo U('setting/setStyle');?>">换肤</a></li> 
                </ul> 
                <form id="searchForm" method="post" action="<?php echo U('search/index');?>">
                	<input type="text" id="searchTxt" maxlength="50" name="searchTxt"/>
                	<input type="submit" id="searchbtn" value="搜索"/>
                </form>
            </div>
        </div>  
    </div>
<style type="text/css">
    .blogbody {
        overflow: hidden;
        text-align: left;
        border-radius: 5px; /*for opera*/
        -moz-border-radius: 5px; /*for firefox*/
        -webkit-border-radius: 5px; /*for webkit*/
    }
    
    .map-left {
        float: left;
    }
    
    .map-right {
        float: left;
		margin-left:10px;
        width: 220px;
    }
</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
if (typeof flowg == "undefined" || !flowg) {
    var flowg = {};}
flowg.initMap = (function(){

	var htmlString = '<div style="overflow: auto;">' +
    '<div style="width:300px;overflow:hidden;" class="map-item">' +
    '<div class="map-left">' +
    '<img src="<?php echo getUserAvatar($addrList["avatar"],50);?>" alt="<?php echo ($addrList["nickname"]); ?>" style="border:1px solid #ccc;padding:1px;">' +
    '</div><div class="map-right">' +
    '<div class="map-content"><?php echo ($addrList["nickname"]); ?> ： <?php echo ($addrList["content"]); ?></div>' +
	'<div class="time">他在<?php echo ($addrList["address"]); ?></div>' +
    '</div>' +
    '</div>';
    var geocoder;
    var map;
    var oldinfo = null;
    function initialize(){
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(34.016, 103.535);
        var myOptions = {
            zoom: 8,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        codeAddress("<?php echo ($addrList["address"]); ?>", htmlString);
    }
    
    function codeAddress(address, html){
        geocoder.geocode({
            'address': address
        }, function(results, status){
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
                var contentString = html;
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                infowindow.open(map, marker);
                if (oldinfo != null) {
                    oldinfo.close();
                }
                oldinfo = infowindow;
            }
            else {
                return false;
            }
        });
    }

    return initialize;
	
})();

$(flowg.initMap);
</script>
<div class="blogbody">
    <div id="map_canvas" style="width:801px; height:600px;margin:0 auto;">
    </div>
</div>
</div>
<div class="footer">
    <p>Copyright © 2009 - 2011 Flowg . All Rights Reserved . Design By <a href="http://leyteris.javaeye.com">Leyteris</a>
    <?php if($isadmin != 0): ?><a href="<?php echo U('index/flush');?>" target="_blank">刷新缓存</a><?php endif; ?>
    </p>
</div>
</body>
</html>