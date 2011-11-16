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
	h1.lab-title{
		text-align:left;
		margin:40px 100px 0 100px;
		display:block;
		height:123px;
		padding-left:100px;
		font-size:40px;
		line-height:123px;
		font-family:"微软雅黑","宋体";
		color:#5C8C00!important;
		background:url(__TMPL__Public/images/flask.png) left center no-repeat;
		text-shadow: 2px 2px 1px #c0c0c0;
	}
	h1.lab-title em{
		font-size:20px;
		margin-left:10px;
	}
	.blogbody{
		background:#FFF;
		overflow:hidden;
		border-radius: 5px; /*for opera*/
		-moz-border-radius: 5px;/*for firefox*/
		-webkit-border-radius:5px;/*for webkit*/
	}
	.icon-list{
		zoom:1;
		margin:80px auto 120px;
		overflow:hidden;
		width:600px;
	}
	.icon-list li {
		float: left!important;
		margin-right:80px;
	}
	.icon-list li dl{
		width:135px;
		overflow:hidden;
	}
	.icon-list li dd{
		margin-top:3px;
		text-align:left;
		overflow:hidden;
	}
	.icon-list li.last-col{
		margin-right:0;
	}
	a.a-img, a.a-mix {
		display: inline-block;
		font-size: 0;
		line-height: 0;
	}
	a.a-mix img {
		margin-bottom: 2px;
	}
	a.a-mix span, a.a-mix .description {
		margin-top:3px;
		display: block;
		font-size: 12px;
		line-height: 1.5;
		font-weight:bold;
		color:#282828;
	}
	.blogbody iframe{
		margin:30px 0;
		color:#FFF;
		border:none;
	}
</style>
<div class="blogbody">
	<h1 class="lab-title">Plugin For Chrome<em>Beta1.0</em></h1>
	<iframe src="<?php echo ($webpath); ?>Chrome/popup.htm" width="400px" height="600px"></iframe>
</div>
</div>
<div class="footer">
    <p>Copyright © 2009 - 2011 Flowg . All Rights Reserved . Design By <a href="http://leyteris.javaeye.com">Leyteris</a>
    <?php if($isadmin != 0): ?><a href="<?php echo U('index/flush');?>" target="_blank">刷新缓存</a><?php endif; ?>
    </p>
</div>
</body>
</html>