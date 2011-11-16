<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Flowg微博 - 分享沟通 从这里开始 </title>
<script type="text/javascript" src="__TMPL__Public/js/jquery-1.4.4.js"></script> 
<script type="text/javascript" src="__TMPL__Public/js/jquery.validate.js"></script> 
<script type="text/javascript" src="__TMPL__Public/js/register.js"></script> 
<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/reset.css" /> 
<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/fonts.css" /> 
<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/jquery.validate.css" /> 
<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/reg.css" /> 
<script type="text/javascript">
	var __PUBLIC = "__TMPL__Public/";
</script>
</head>
<body>
<div class="layout">
	<div class="header">
    	<div class="logo">
        	<a class="linklogo" href="<?php echo ($thisSiteURL); ?>"><span>Flowg 微博 - Beta 2.1 测试版</span></a>
        </div>
    </div>
    <div class="wrapper">
    	<div class="wrapperheader"><span>注册微博账号，享受Flowg微博带来的体验感受。注册仅需1分钟。</span></div>
		<form name="regform" id="regform" action="__URL__/registerSubmit" method="post">
        	<div class="item">
                <label for="username">账号</label>
                <input type="text" name="username" id="username" class="input" value="" size="20" tabindex="10" />            
            </div>
            <div id="homepagetext"><span><?php echo ($thisSiteURL); ?></span></div>
            <div class="item">
                <label for="userpass">密码</label>
                <input type="password" name="userpass" id="userpass" class="input" value="" size="20" tabindex="20" />
            </div>
            <div class="item">
                <label for="repass">重复密码</label>
                <input type="password" name="repass" id="repass" class="input" value="" size="20" tabindex="30" />             
            </div>
            <div class="item">
                <label for="nickname">昵称</label>
                <input type="text" name="nickname" id="nickname" class="input" value="" size="20" tabindex="40" />        
            </div>
            <div class="item">
                <label for="email">电子邮箱</label>
                <input type="text" name="email" id="email" class="input" value="" size="20" tabindex="50" />        
            </div>
            <div class="item">
                <label for="V">验证码</label>
                <input type="text" name="V" id="V" class="input" value="" size="20" tabindex="60" />     
            </div>
            <div class="img">
            	<img src="__URL__/verify">    
            </div>
            <input type="submit" name="regsubmit" id="regsubmit" value="注册" tabindex="70" />          
       </form>
    </div>
</div>
    <div class="footer">
    	<div class="footer-wrapper">
        	<p>Copyright 2009 - 2011 Flowg. All Rights Reserved</p>
            <p><a href="leyteris.javaeye.com">Design By Leyteris</a></p>
        </div>
    </div>
</body>
</html>