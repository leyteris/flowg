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
            	<span id="thistitle">>>管理权限等级</span>
            	<a class="floatright" href="<?php echo U('global/logout');?>">注销</a>
	            <span class="floatright">欢迎您！<?php echo $_SESSION["BackUserName"];?>  </span>
            </div>
            <div id="main">
              <table id="listtable" width="100%" border="1" align="center" cellpadding="0"  cellspacing="0">
                <tr>
                  <th width="6%" scope="col">编号</th>
                  <th width="14%" scope="col">权限</th>
                  <th width="6%" scope="col">用户</th>
                  <th width="6%" scope="col">系统</th>
				  <th width="6%" scope="col">话题</th>
				  <th width="6%" scope="col">微博</th>
                  <th width="6%" scope="col">公告</th>
                  <th width="6%" scope="col">皮肤</th>
                  <th width="6%" scope="col">删除</th>
                  <th width="6%" scope="col">编辑</th>
                  <th width="6%" scope="col">创建</th>
                  <th width="13%" scope="col">超级管理员</th>
                  <th width="20%" scope="col">操作</th>
                </tr>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr>
                  <td><?php echo ($vo["id"]); ?></td>
                  <td><?php echo ($vo["rolename"]); ?></td>
                  <td><?php echo ($vo["user_right"]); ?></td>
                  <td><?php echo ($vo["sys_right"]); ?></td>
                  <td><?php echo ($vo["tag_right"]); ?></td>
                  <td><?php echo ($vo["topic_right"]); ?></td>
                  <td><?php echo ($vo["news_right"]); ?></td>
                  <td><?php echo ($vo["style_right"]); ?></td>
                  <td><?php echo ($vo["del_right"]); ?></td>
                  <td><?php echo ($vo["edit_right"]); ?></td>
                  <td><?php echo ($vo["cre_right"]); ?></td>
                  <td><?php echo ($vo["issuper"]); ?></td>
                  <td><a href="<?php echo U('role/edit');?>?id=<?php echo ($vo["id"]); ?>">编辑</a>/<a href="<?php echo U('role/delete');?>?id=<?php echo ($vo["id"]); ?>">删除</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
              </table>
              <div class="left"><a href="<?php echo U('role/add');?>">增加权限等级</a></div>
              <div id="page"><?php echo ($page); ?></div>
          </div>
        </div>
        <div id="footer">
        <?php echo ($site["copyright"]); ?>
        </div>
    </body>
</html>