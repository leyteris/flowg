<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Flowg微博 - 分享沟通 从这里开始 </title>
<script type="text/javascript">
	var __PUBLIC = '__TMPL__Public/';
</script>
<script type="text/javascript" src="__TMPL__Public/js/jquery-1.4.4.js"></script> 
<!--<script type="text/javascript" src="__TMPL__Public/js/login.js"></script>   -->
<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/reset.css" /> 
<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/fonts.css" /> 
<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/login.css" /> 
</head>

<body>
	<div class="header">
    	<div class="header-wrapper">
    		<div class="logo">
            	<span>Flowg 微博</span>
                <span>遨游你我的海洋，寻找一份属于自己的感动</span>
                <span>碎语人生，点点滴滴，分享沟通，从这里开始...</span>
            </div>
        	<div class="regBtn">
            	<a href="<?php echo U('global/register');?>">立即开通微博</a>
            </div>
        </div>
    </div>
    <div class="wrapper">
    	<div class="left-wrapper">
            <div class="ajaxtalkbox">
            	<h1>大家正在说事呢，加入他们吧</h1>
                <ul id="ajaxlist">
                	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li>
                    	<div class="userpic">
                        	<a href="<?php echo ($webpath); ?><?php echo ($vo["homepage"]); ?>"><img alt="头像" src="<?php echo getUserAvatar($vo['avatar'],50);?>" /></a>
                        </div>
                        <div class="listbodyright">
                            <a class="name" href="<?php echo ($webpath); ?><?php echo ($vo["homepage"]); ?>"><?php echo ($vo["nickname"]); ?>:</a>
                            <p class="msg">
                            	<?php echo ($vo["content"]); ?>
                            </p>
                            <span class="listuptime"><?php echo ($vo["topiccreate_time"]); ?></span>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="coverdiv"></div>
            </div>
        </div>
        <div class="right-wrapper">
        	<div class="loginBox">
            	<form name="loginform" id="loginform" action="__URL__/checkLogin" method="post">
            		{__NOTOKEN__} 
                    <p> 
                    	<label>账  号<br /> 
                        <input type="text" name="username" id="username" class="input" value="" size="20" tabindex="10" /></label> 
                    </p> 
                    <p> 
                        <label>密  码<br /> 
                        <input type="password" name="userpass" id="userpass" class="input" value="" size="20" tabindex="20" /></label> 
                    </p> 
                    <p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="rememberme" value="1" tabindex="90" /> 下次自动登录</label></p> 
                    <p class="submit"> 
                    	<input type="hidden" name="hashCode" value="<?php echo ($hashCode); ?>">
                        <input type="submit" name="loginsubmit" id="loginsubmit" value="登  录" tabindex="100" /> 
                    </p> 
                </form>
            </div>
            <div class="support">
                <h1>目前提供的客户端:</h1>
                <span class="IE">网页版</span>
                <span class="Wap">Wap版</span>
                <span class="Android">Android版</span>
                <span class="AIR">桌面应用版</span>
            </div>
        </div>
    </div>
    <div class="footer">
    	<div class="footer-wrapper">
        	<p>Copyright © 2009 - 2011 Flowg. All Rights Reserved</p>
            <p><a href="http://leyteris.javaeye.com">Design By Leyteris</a></p>
        </div>
    </div>
</body>
</html>