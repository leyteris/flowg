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
            	<span id="thistitle">>>系统设置</span>
            	<a class="floatright" href="<?php echo U('global/logout');?>">注销</a>
	            <span class="floatright">欢迎您！<?php echo $_SESSION["BackUserName"];?>  </span>
            </div>
            <div id="main">
                <form name="form" id="form" action="<?php echo U('system/doedit');?>" method="post">
                    <div class="item">
                        <label for="ftitle">
                           	站点名称：
                        </label>
                        <input type="text" name="ftitle" id="ftitle" class="input" value="<?php echo ($r["ftitle"]); ?>"/>
                    </div>
                    <div class="item">
                        <label for="title">
                           	站点标题：
                        </label>
                        <input type="text" name="title" id="title" class="input" value="<?php echo ($r["title"]); ?>" style="width:400px;"/>
                    </div>
                    <div class="item">
                        <label for="description">
                           	站点描述：
                        </label>
                        <input type="text" name="description" id="description" class="input" value="<?php echo ($r["description"]); ?>" style="width:400px;"/>
                    </div>
                    <div class="item">
                        <label for="keyword">
                           	关键词：
                        </label>
                        <input type="text" name="keyword" id="keyword" class="input" value="<?php echo ($r["keyword"]); ?>" style="width:400px;"/>
                    </div>
                    <div class="item">
                        <label for="domain">
                           	域名：
                        </label>
                        <input type="text" name="domain" id="domain" class="input" value="<?php echo ($r["domain"]); ?>" />
                    </div>
                    <div class="item">
                        <label for="no_user">
                          	 限制注册账号名
                        </label>
                        <input type="text" name="no_user" id="no_user" class="input" value="<?php echo ($r["no_user"]); ?>" />
                    </div>
                    <div class="item">
                        <label for="no_tag">
                          	 限制发布话题
                        </label>
                        <input type="text" name="no_tag" id="no_tag" class="input" value="<?php echo ($r["no_tag"]); ?>"/>
                    </div>
                    <div class="item">
                        <label for="no_word">
                          	 限制发布词汇
                        </label>
                        <input type="text" name="no_word" id="no_word" class="input" value="<?php echo ($r["no_word"]); ?>"/>
                    </div>
                    <div class="item">
                        <label for="send_check">
                           	 限制发言时间
                        </label>
                        <input type="text" name="send_check" id="send_check" class="input" value="<?php echo ($r["send_check"]); ?>"/>
                    </div>
                    <div class="item">
                        <label for="ip_check">
                           	是否限制ip
                        </label>
                        <select name="ip_check" class="input" id="ip_check">
                        	<option value="0">否</option>
                            <option value="1" <?php if($r["ip_check"] == 1): ?>selected=""<?php endif; ?>>是</option>
                        </select>
                    </div>
                    <div class="item">
                        <label for="is_reg">
                           	是否允许注册
                        </label>
                        <select name="is_reg" class="input" id="is_reg">
                        	<option value="0">否</option>
                            <option value="1" <?php if($r["is_reg"] == 1): ?>selected=""<?php endif; ?>>是</option>
                        </select>
                    </div>
                    <div class="item">
                        <label for="file_size">
                           	上传限制大小
                        </label>
                        <input type="text" name="file_size" id="file_size" class="input" value="<?php echo ($r["file_size"]); ?>"/>
                    </div>
                    <div class="item">
                        <label for="comment_open">
                           	 评论是否开启
                        </label>
                        <select name="comment_open" class="input" id="comment_open">
                        	<option value="0">否</option>
                            <option value="1" <?php if($r["comment_open"] == 1): ?>selected=""<?php endif; ?>>是</option>
                        </select>
                    </div>
                    <input name="id" type="hidden"  value="<?php echo ($r["id"]); ?>"  />
                    <input type="submit" class="inputneedmar" name="submit" id="submit" value="  提 交  " tabindex="120" />
                </form>
            </div>
        </div>
        <div id="footer">
        <?php echo ($site["copyright"]); ?>
        </div>
    </body>
</html>