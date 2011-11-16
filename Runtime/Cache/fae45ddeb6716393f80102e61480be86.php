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
			<div class="talklist" style="text-align:left;font-size:16px;line-height:18px;">
				<h1 style="font-size:30px; margin-bottom:18px;">Flowg微博开发更新日志</h1>
				<ul>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.0(2010.12.10):<br/>
						1、前端页面部分大体完成<br/>
						2、thinkphp测试项目放出<br/>
					</li>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.1(2010.12.16):<br/>
						1、login和index session互联<br/>
						2、index解决列表问题<br/>
					</li>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.2(2010.12.20):<br/>
						1、解决ajax上传博客问题<br/>
						2、用户注册并登陆解决<br/>
					</li>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.3(2010.12.31):<br/>
						1、解决分页问题<br/>
						2、解决login成功跳转问题<br/>
						3、增加转发和点评功能<br/>
						4、实现login界面list数据库同步<br/>
					</li>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.4(2011.1.6):<br/>
						1、增加图片发布功能<br/>
						2、增加收藏及取消收藏功能<br/>
						3、增加我的微博页面<br/>
						4、增加转发ajax列表功能<br/>
						5、增加设置初步功能<br/>
					</li>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.5(2011.1.12):<br/>
						1、增加头像设置功能<br/>
						2、增加话题查看功能<br/>
						3、增加微博单独查看页面<br/>
						4、增加动态关注功能<br/>
						5、增加微博关注粉丝页面<br/>
					</li>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.6(2011.2.19):<br/>
						1、增加微博广场,话题堂action<br/>
						2、对于一些Action模块关于sql查询做重构<br/>
						3、增加皮肤设置功能<br/>
						4、增加7组皮肤style以供测试<br/>
						5、增加@提到我的 功能<br/>
						6、修正homepage中个性皮肤同步问题<br/>
						7、修正收藏，关注，粉丝等timeline列表排序问题<br/>
						8、修正删除收藏按钮ajax异常问题<br/>
					</li>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.7(2011.3.7):<br/>
						1、修正ajax删除微博异常<br/>
						2、对风云堂和微博广场版块做一些调整<br/>
						3、修正转发的一些bug<br/>
						4、增加@我ajax功能<br/>
						5、修正所有页面@关于我的功能列表异常<br/>
						6、修正大部分UI的IE6异常问题<br/>
					</li>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.8(2011.4.9):<br/>
						1、提升ajax删除微博体验<br/>
						2、对Lab实验室提供后台api接口action：LabAction<br/>对于其中map部分第一次迭代<br/>
						3、对于关键前端行为层js代码进行小范围重构<br/>
						4、对Lab实验室提供后台api接口action：LabAction<br/>对于其中wall部分第一次迭代<br/>
					</li>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.8(2011.4.22):<br/>
						1、Flowg后台控制器模型层开发完成<br/>
						2、增加NewsAction控制器<br/>
						3、增加SearchAction控制器<br/>
						4、修正后台权限不匹配问题<br/>
						5、前台增加刷新缓存功能<br/>
					</li>
				</ul>
				
				<h1 style="font-size:30px; margin:25px 0;">Flowg微博开放API开发更新日志</h1>
				<ul>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.0(2011.2.19):<br/>
						1、项目启动<br/>
						2、创建service.php入口文件<br/>
						3、启用phprpc+thinkphp实现，Test调试完成，Action开始逐步导入<br/>
					</li>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.1(2011.2.21):<br/>
						1、Account,Test,Topic,Timeline,User,Favorites,Follow等接口编码完成<br/>
						2、phprpcTest工程相应接口php客户端demo测试通过并放出<br/>
						3、修正rpc中Error返回对象<br/>
					</li>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.1(2011.4.15):<br/>
						1、修正session绑定问题<br/>
						2、修正一处返回异常<br/>
					</li>
				</ul>
				<h1 style="font-size:30px; margin:25px 0;">Flowg微博Android客户端开发更新日志</h1>
				<ul>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.0(2011.3.1):<br/>
						1、PhprpcTest For Android 联网测试通过<br/>
						2、权限验证及登录界面完成 <br/>
						3、HomelineTime接口列表通信生成成功 <br/>
						4、增加用户头像异步加载功能 <br/>
						5、Post界面完成及update微博接口通信成功 <br/>
					</li>
				</ul>
				<h1 style="font-size:30px; margin:25px 0;">Flowg微博用户体验实验室开发更新日志</h1>
				<ul>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.0(2011.4.9):<br/>
						1、Lab实验室项目启动<br/>
						2、Lab模块分为Map Position ；Flowg Wall ；Plugin For Chrome<br/>
						3、Map Position部分项目启动并放出测试版本<br/>
					</li>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.1(2011.4.10):<br/>
						1、Flowg Wall部分项目启动并放出测试预览版本<br/>
					</li>
					<li style="margin-bottom:20px;margin-left:20px;">
						v1.2(2011.4.15):<br/>
						1、Plugin For Chrome部分项目启动并放出测试预览版本<br/>
						2、Plugin For Chrome部分项目改进网页iframe嵌入版本放出<br/>
					</li>
				</ul>
				<h1 style="font-size:20px; margin-top:40px;">By <a href="http://leyteris.javaeye.com" style="font-size:20px; margin-top:20px;">Leyteris</a></h1>
			</div>
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