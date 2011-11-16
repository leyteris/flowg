<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo ($site["title"]); ?></title>
        <link rel="stylesheet" type="text/css" href="__TMPL__Public/css/reset.css" /> 
		<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/fonts.css" />
		<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/css.css" /> 
    </head>
    <body>
        <div id="header">
            <div id="logo">
                <span><a><?php echo ($site["systitle"]); ?><em><?php echo ($site["version"]); ?></em></a></span>
            </div>
            <div id="c-menu">
             	<span><a href="<?php echo U('index/index');?>">系统首页</a></span>
             	<span><a href="<?php echo U('system/index');?>">系统设置</a></span>
             	<span><a href="<?php echo U('user/index');?>">用户管理</a></span>
             	<span><a href="<?php echo U('topic/index');?>">微博管理</a></span>
             	<span><a href="<?php echo U('tag/index');?>">话题管理</a></span>
                <span><a href="<?php echo U('news/index');?>">公告管理</a></span>
                <span><a href="<?php echo U('style/index');?>">皮肤管理</a></span>
                <span><a href="<?php echo U('role/index');?>">权限管理</a></span>
                <span><a href="<?php echo U('admin/index');?>">管理员管理</a></span>
            </div>
        </div>
        <div id="wrapper">
        	<div id="maintitle">
            	<span id="thistitle">>>管理文章</span>
            	<a class="floatright" href="<?php echo U('global/logout');?>">注销</a>
	            <span class="floatright">欢迎您！<?php echo $_SESSION["BackUserName"];?>  </span>
            </div>

            <div id="main">
            	本系统是由基于ThinkPHP框架开发而成，为Flowg微博提供后台支持，本系统可以与微博<br/>前端后台放于不同服务器作分布化应用，但在系统设置出域名必须与前端服务器域名一致，<br/>否则无法同步，其功能包括： <br><br>
				<span><a href="<?php echo U('system/index');?>">系统设置</a></span>
             	<span><a href="<?php echo U('user/index');?>">用户管理</a></span><br>
             	<span><a href="<?php echo U('topic/index');?>">微博管理</a></span> 
             	<span><a href="<?php echo U('tag/index');?>">话题管理</a></span><br>
                <span><a href="<?php echo U('news/index');?>">公告管理</a></span>
                <span><a href="<?php echo U('style/index');?>">皮肤管理</a></span><br>
                <span><a href="<?php echo U('role/index');?>">权限管理</a></span>
                <span><a href="<?php echo U('admin/index');?>">管理员管理</a></span> <br> <br>
                <div>
                	系统参数 <br>
                	版本号：v1.2 <br>
                	UI界面：leyteris <br>
                	后台开发：leyteris <br>
                	邮箱：liyichaodoom3@hotmail.com <br>
                	QQ:582377620 <br>
                	Blog:leyteris.javaeye.com <br><br>
                	基于Flowg旗下开源CMS——Flcms二次开发而成，一次迭代开发周期为两天 <br><br><br><br>
                </div>
	        </div>
	      </div>
        <div id="footer">
        <?php echo ($site["copyright"]); ?>
        </div>
    </body>
</html>