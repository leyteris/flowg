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
    	<div id="settingbody">
    	<script type="text/javascript" src="__TMPL__Public/js/jquery.validate.js"></script> 
    	<script type="text/javascript" src="__TMPL__Public/js/setting.js"></script>
        	<ul id="settingtitle">
            	<li>
                	<a href="<?php echo U('setting/index');?>">个人资料</a>
                </li>
                <li>
                	<a href="<?php echo U('setting/setAvatar');?>">头像设置</a>
                </li>
                <li>
                	<a href="<?php echo U('setting/setPassword');?>">密码设置</a>
                </li>
                <li>
                	<a href="<?php echo U('setting/setStyle');?>">皮肤设置</a>
                </li>
            </ul>
            <div>
            <?php switch($menu_item): ?><?php case "0":  ?><form name="settingform" id="settingform" action="<?php echo U('setting/doSetting');?>" method="post">
                    <div class="item">
                        <label for="username">账号</label>
                        <input type="text" name="username" id="username" class="input" value="<?php echo ($userinfo["userid"]); ?>"  disabled=""/>              
                    </div>
                    <div class="item">
                        <label for="homepage">个性域名</label>
                        <div id="homepagetext">t.flowg.com/</div><input type="text" name="homepage" id="homepage" class="input" value="<?php echo ($userinfo["homepage"]); ?>" tabindex="10"  />     
                    </div>
                    <div class="inputneedmar">
                    	<span>建议不要随意更改（作为@关于的我的参考）</span>
                    </div>
                    <div class="item">
                        <label for="nickname">昵称</label>
                        <input type="text" name="nickname" id="nickname" class="input" value="<?php echo ($userinfo["nickname"]); ?>" tabindex="20" />            
                    </div>
                    <div class="item">
                        <label for="sex">性别</label>
                        <input type="radio" value="2" name="sex" id="sex" checked=""  tabindex="30" >男   
                        <input type="radio" value="1" name="sex" id="sex"  tabindex="40" >女
                    </div>
                    <div class="item">
                        <label for="email">电子邮箱</label>
                        <input type="text" name="email" id="email" class="input" value="<?php echo ($userinfo["email"]); ?>" tabindex="50" />          
                    </div>                  
                    <div class="item">
                        <label for="personalpage">个人主页</label>
                        <input type="text" name="personalpage" id="personalpage" class="input" value="<?php echo ($userinfo["personalpage"]); ?>" tabindex="60" />           
                    </div>
                    <div class="inputneedmar">
                    	<span>没有的话也可以填写微博网址</span>
                    </div>
                    <div class="item">
                        <label for="msn">MSN账号</label>
                        <input type="text" name="msn" id="msn" class="input" value="<?php echo ($userinfo["msn"]); ?>" tabindex="70" />         
                    </div>
                    <div class="item">
                        <label for="qq">QQ号码</label>
                        <input type="text" name="qq" id="qq" class="input" value="<?php echo ($userinfo["qq"]); ?>" tabindex="80" />          
                    </div>
                    <div class="item">
                        <label for="mobile">手机号码</label>
                        <input type="text" name="mobile" id="mobile" class="input" value="<?php echo ($userinfo["mobile"]); ?>" tabindex="90" />         
                    </div>
                    <div class="item">
                        <label for="memo">自我介绍</label>
                        <textarea type="text" name="memo" id="memo" class="input" tabindex="100"><?php echo ($userinfo["memo"]); ?></textarea>     
                    </div>
                    <!-- <div class="item">
                        <label for="V">验证码</label>
                        <input type="text" name="V" id="V" class="input" value="" size="20" tabindex="110" />         
                    </div> -->
                    <div class="inputneedmar">
                    	<input type="submit" name="settingsubmit" id="settingsubmit" value="  提交   " tabindex="120" />  
                    </div>     
               </form><?php break;?> 
            <?php case "1":  ?><?php if($cutimg != 1): ?><form name="avatarform" id="avatarform" action="<?php echo U('setting/doCutimg');?>" method="post" enctype="multipart/form-data">
                	<div>
                    	<img src="<?php echo getUserAvatar($userinfo['avatar'],120);?>" alt="<?php echo ($userinfo["nickname"]); ?>" id="avatarPic">
                    <div>
                	<div class="item">
                        <label for="avatar">选择图片</label>
                        <input type="file" name="avatar" id="avatar" class="input"/>              
                    </div>
                    <div class="inputneedmar">
                    	<input type="submit" name="settingsubmit" id="settingsubmit" value="  提交   " tabindex="120" />  
                    </div>  
                </form>
                <?php else: ?>
                <script type="text/javascript" src="__TMPL__Public/js/drag.js"></script> 
                <div class="pleft">
					<div class="leftspace">
					<table width="100%" border="0">
						<tbody><tr>
							<td rowspan="2" valign="top">
							<form name="setavatar" id="setavatar" action="<?php echo U('setting/doSetAvatar');?>" method="post" onsubmit="return getcutpos();">
							<input name="imgname" type="hidden" value="<?php echo ($imgname); ?>">
							<div id="cut_div" style="border: 2px solid #888888; width: 284px; height: 266px; overflow: hidden; position: relative; top: 0px; left: 0px; margin: 4px; cursor: pointer;">
							<table style="border-collapse: collapse; z-index: 10; filter: alpha(opacity = 75); position: relative; left: 0px; top: 0px; width: 284px; height: 266px; opacity: 0.75;" cellspacing="0" cellpadding="0" border="0" unselectable="on">
								<tbody><tr>
									<td style="background: #cccccc; height: 73px;" colspan="3"></td>
								</tr>
								<tr>
									<td style="background: #cccccc; width: 82px;"></td>
									<td style="border: 1px solid red; width: 120px; height: 120px;"></td>
									<td style="background: #cccccc; width: 82px;"></td>
								</tr>
								<tr>
									<td style="background: #cccccc; height: 73px;" colspan="3"></td>
								</tr>
							</tbody></table>
							<img id="cut_img" style="position: relative; top: -266px; left: 0px; " src="<?php echo ($imgurl); ?>" width="284" height="178"></div>
							<table cellspacing="0" cellpadding="0">
								<tbody><tr>
									<td><img style="margin-top: 5px; cursor: pointer;" src="__TMPL__Public/images/avatar/_h.gif" alt="图片缩小" onmouseover="this.src" =="" '="" dadao="" www="" tpl="" default="" public="" resource="" images="" avatar="" _c.gif';="" onmouseout="this.src" _h.gif';="" onclick="imageresize(false);"></td>
									<td><img id="img_track" style="width: 250px; height: 18px; margin-top: 5px" src="__TMPL__Public/images/avatar/track.gif"></td>
									<td><img style="margin-top: 5px; cursor: pointer;" src="__TMPL__Public/images/avatar/hh.gif" alt="图片放大" onmouseover="this.src" =="" '="" dadao="" www="" tpl="" default="" public="" resource="" images="" avatar="" +c.gif';="" onmouseout="this.src" +h.gif';="" onclick="imageresize(true);"></td>
								</tr>
							</tbody></table>
							<img id="img_grip" style="position: absolute; z-index: 100; cursor: pointer; left: 221.732px; top: 380px; " src="__TMPL__Public/images/avatar/grip.gif">
							<div style="padding-top: 15px; padding-left: 5px;"><input type="hidden" name="action" id="action" value="cutsave"> <input type="hidden" name="cut_pos" id="cut_pos" value=""> <input type="submit" class="button" name="submit" id="submit" value=" 确认裁剪并提交 "> &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="button" name="cancel" id="cancel" value=" 取消 " onclick="javascript:" history.back(1);;=""></div>
							</form>
					
							</td>
							
						</tr>
						
					</tbody></table>
					<script type="text/javascript" src="__TMPL__Public/js/setAvatar.js"></script> 
					</div>
				</div><?php endif; ?><?php break;?>
            <?php case "2":  ?><form name="setPassform" id="setPassform" action="<?php echo U('setting/doSetPassword');?>" method="post">
                    <div class="item">
                        <label for="passwd">密码</label>
                        <input type="password" name="passwd" id="passwd" class="input"/>              
                    </div>
                    <div class="item">
                        <label for="repasswd">重复密码</label>
                        <input type="password" name="repasswd" id="repasswd" class="input"/>              
                    </div>
                        
                    <div class="inputneedmar">
                    	<input type="submit" name="setpasssubmit" id="setpasssubmit" value="  提交   " tabindex="120" />  
                    </div>     
               </form><?php break;?>
            <?php case "3":  ?><script type="text/javascript" src="__TMPL__Public/js/setStyle.js"></script>
            	<form name="setStyleForm" id="setStyleForm" action="<?php echo U('setting/doSetStyle');?>" method="post">
                    <div id="stylelist">
                    <a title="默认皮肤" class="<?php if($thisStyle == '0'): ?>thisstyle<?php else: ?>styleimg<?php endif; ?>" href="javascript:void(0);" id="0"><img alt="默认皮肤" src="__TMPL__Public/thumb.jpg"><p class="name">默认皮肤</p></a>    
                    <?php if(is_array($stlist)): $i = 0; $__LIST__ = $stlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><a title="<?php echo ($vo["title"]); ?>" class="<?php if($thisStyle == $vo['id']): ?>thisstyle<?php else: ?>styleimg<?php endif; ?>" href="<?php echo ($webpath); ?><?php echo ($vo["path"]); ?>" id="<?php echo ($vo["id"]); ?>"><img alt="<?php echo ($vo["title"]); ?>" src="<?php echo ($webpath); ?><?php echo ($vo["path"]); ?>thumb.jpg"><p class="name"><?php echo ($vo["title"]); ?></p></a><?php endforeach; endif; else: echo "" ;endif; ?>  
                    </div>                    
               </form><?php break;?><?php endswitch;?> 
            </div>
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