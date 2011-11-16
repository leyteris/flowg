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
<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/news.css" /> 
    <div class="blogbody">
    			<div class="right-nav">
        	<div class="right-nav-bg"></div>
			    		<div class="userinfo">
            	<div class="user-head"> 
					<div class="userheadpic">
                		<a href="<?php echo ($webpath); ?><?php echo ($userinfo["homepage"]); ?>" title="<?php echo ($userinfo["nickname"]); ?>"><img src="<?php echo getUserAvatar($userinfo['avatar'],50);?>" alt="<?php echo ($userinfo["nickname"]); ?>"/></a>
               	 	</div> 
					<div class="userheadbody"> 
						<p>
                    		<a class="font_14" href="<?php echo ($webpath); ?><?php echo ($userinfo["homepage"]); ?>"><?php echo (($userinfo["nickname"])?($userinfo["nickname"]):getUserNameID); ?></a> 
						</p> 
						<p><em>浙江</em><em>杭州</em></p>
                	</div> 
				</div> 
                <div class="follow-body">
                    <ul>
                        <li class="borright">
                            <span><a href="<?php echo ($webpath); ?><?php echo ($userinfo["homepage"]); ?>">微博</a></span>
                            <span class="num"><a href="<?php echo ($webpath); ?><?php echo ($userinfo["homepage"]); ?>"><?php echo (($loginUserTpCount)?($loginUserTpCount):"0"); ?></a></span>
                        </li>
                        <li class="borright">
                            <span><a href="<?php echo U('follow/index');?>">关注</a></span>
                            <span class="num"><a href="<?php echo U('follow/index');?>"><?php echo (($loginUserFollows)?($loginUserFollows):"0"); ?></a></span>
                        </li>
                        <li>
                            <span><a href="<?php echo U('follow/fans');?>">粉丝</a></span>
                            <span class="num"><a href="<?php echo U('follow/fans');?>"><?php echo (($loginUserFans)?($loginUserFans):"0"); ?></a></span>
                        </li>
                    </ul>
                </div>
        	</div>
			        	<div class="right-nav-list">
            	<ul>
                	<li><a href="<?php echo U('index/index');?>">我的首页</a></li>
                    <li><a href="<?php echo U('index/myhome');?>">我的微博</a></li>
                    <li><a href="<?php echo U('mention/index');?>">@提到我的</a></li>
                    <li><a href="<?php echo U('favorite/index');?>">我的收藏</a></li>
                </ul>
            </div>
			            <div class="r-pro hotht">
            	<h1>热门话题</h1>
                <ul>
                <?php if(is_array($toptag)): $i = 0; $__LIST__ = $toptag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><a href="<?php echo U('tag/index');?>?tagid=<?php echo ($vo["id"]); ?>"><?php echo ($vo["tagname"]); ?><em>(<?php echo ($vo["count"]); ?>)</em></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <span class="right"><a href="<?php echo U('hall/hottag');?>">查看更多热门话题>></a></span>
            </div>
            			<div class="r-pro knowuser">
            	<h1>热门人物</h1>
                <ul>
                <?php if(is_array($hotman)): $i = 0; $__LIST__ = $hotman;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li>
                    	<div class="knowuser-pic">
                        	<a href="<?php echo ($webpath); ?><?php echo ($vo["homepage"]); ?>" title="<?php echo ($vo["nickname"]); ?>"><img src="<?php echo getUserAvatar($vo['avatar'],50);?>"/></a>
                        </div>
                        <div class="knowuser-info">
                        	<p><a title="<?php echo ($vo["nickname"]); ?>" href="<?php echo ($webpath); ?><?php echo ($vo["homepage"]); ?>"><?php echo ($vo["nickname"]); ?></a></p>
                            <p><a href="<?php echo U('ajax/ajaxFollow');?>?objuid=<?php echo ($vo["id"]); ?>" class="followta" title="关注">+加关注</a></p>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <span class="right"><a href="<?php echo U('hall/index');?>">更多>></a></span>
            </div>
			            <div class="r-pro">
            	<h1>版本信息</h1>
                <ul>
                	<li>Flowg微博系统:Beta2.1测试版</li>
                	<li>UI设计:Leyteris</li>
                    <li>前台完成时间:2010.12</li>
                    <li>后台架设:Leyteris</li>
                    <li>后台完成时间:2011.3</li>
                    <li>官方微博:<a href="http://t.sina.com.cn/flowg">t.sina.com.cn/flowg</a></li>
                </ul>
            </div>
            <div class="r-pro">
            	<h1>Flowg微博意见反馈</h1>
                <ul>
                	<li>欢迎使用本微博，并提出宝贵建议或BUG提交。</li>
                	<li>e-mail：<a href="mailto:liyichao6@sina.com">liyichao6@sina.com</a></li>
                	<li>微博:<a href="http://t.sina.com.cn/leyteris">t.sina.com.cn/leyteris</a></li>
                	<li>技术主页:<a href="http://leyteris.javaeye.com">leyteris.javaeye.com</a></li>
                    <li>QQ：<a target=blank href=tencent://message/?uin=582377620&Menu=yes>582377620</a></li>
                    <li>手机：13616545212(杭州号)</li>
                </ul>
            </div>
        </div>
        <div class="left-nav">
        <h2 class="ti">公告资讯</h2>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="artBody">
            	<h2><a href="<?php echo U('news/showNews');?>?id=<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></h2>
                <div class="dots"></div>
                <span class="details">
                	发布于<?php echo ($vo["time"]); ?>  By <?php echo ($vo["nickname"]); ?>
                </span>
                <div class="p"><?php echo ($vo["content"]); ?></div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
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