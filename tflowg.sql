-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2011 年 11 月 16 日 08:23
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `tflowg`
--

-- --------------------------------------------------------

--
-- 表的结构 `fl_favorites`
--

CREATE TABLE `fl_favorites` (
  `id` int(10) NOT NULL auto_increment,
  `uid` int(10) NOT NULL,
  `tid` int(10) NOT NULL,
  `create_time` int(10) default NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=41 ;

--
-- 导出表中的数据 `fl_favorites`
--

INSERT INTO `fl_favorites` (`id`, `uid`, `tid`, `create_time`) VALUES
(1, 1, 141, 1294205552),
(2, 1, 142, 1294205751),
(3, 1, 138, 1294205785),
(4, 1, 140, 1294207136),
(5, 1, 135, 1294207391),
(6, 1, 133, 1294207612),
(15, 7, 228, 1294649580),
(14, 7, 199, 1294456373),
(10, 1, 153, 1294379677),
(17, 1, 209, 1294736745),
(16, 1, 206, 1294650814),
(18, 1, 231, 1294741142),
(19, 1, 228, 1294741262),
(20, 1, 232, 1294751378),
(21, 1, 236, 1294752557),
(22, 1, 237, 1294752596),
(23, 9, 225, 1294758685),
(24, 1, 248, 1294808592),
(27, 1, 265, 1297743029),
(26, 1, 7, 1297742800),
(28, 1, 249, 1297743352),
(29, 1, 255, 1297743436),
(30, 1, 18, 1298002758),
(31, 1, 288, 1298002785),
(32, 1, 11, 1298003437),
(34, 1, 175, 1299316981),
(35, 1, 4, 1299322390),
(36, 1, 372, 1299327217),
(37, 1, 416, 1301034425),
(38, 1, 468, 1303485943),
(39, 1, 485, 1303532309),
(40, 1, 492, 1313556311);

-- --------------------------------------------------------

--
-- 表的结构 `fl_follow`
--

CREATE TABLE `fl_follow` (
  `id` int(10) NOT NULL auto_increment,
  `uid` int(10) NOT NULL,
  `objuid` int(10) NOT NULL,
  `fol_time` int(10) default NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`),
  KEY `objuid` (`objuid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=22 ;

--
-- 导出表中的数据 `fl_follow`
--

INSERT INTO `fl_follow` (`id`, `uid`, `objuid`, `fol_time`) VALUES
(11, 1, 2, 1298267063),
(2, 1, 4, 1294062950),
(3, 1, 6, 1294215854),
(4, 7, 1, 1294290254),
(12, 1, 8, 1299238721),
(6, 9, 1, 1294742962),
(13, 1, 7, 1299238728),
(8, 9, 6, 1294801020),
(9, 2, 1, 1297746213),
(17, 6, 1, 1302853541),
(15, 6, 2, 1302452027),
(16, 6, 9, 1302452044),
(18, 1, 3, 1303358425),
(19, 13, 6, 1303524705),
(20, 1, 13, 1303532293),
(21, 1, 12, 1313556285);

-- --------------------------------------------------------

--
-- 表的结构 `fl_image`
--

CREATE TABLE `fl_image` (
  `id` int(10) NOT NULL auto_increment,
  `uid` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumb_url` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `filesize` int(10) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=37 ;

--
-- 导出表中的数据 `fl_image`
--

INSERT INTO `fl_image` (`id`, `uid`, `title`, `thumb_url`, `url`, `filesize`, `create_time`) VALUES
(1, 1, '', '/Tflowg/images/upload/thumb_4d2983b8b9659.jpg', '/Tflowg/images/upload/4d2983b8b9659.jpg', 73321, 1294566329),
(2, 1, '2000.jpg', '/Tflowg/images/upload/thumb_4d29858803b4f.jpg', '/Tflowg/images/upload/4d29858803b4f.jpg', 73321, 1294566792),
(3, 1, 'wrapBg.jpg', '/Tflowg/images/upload/thumb_4d298961c8be8.jpg', '/Tflowg/images/upload/4d298961c8be8.jpg', 126091, 1294567778),
(4, 1, 'back.png', '/Tflowg/images/upload/thumb_4d2989d42d295.png', '/Tflowg/images/upload/4d2989d42d295.png', 125714, 1294567893),
(5, 1, 'back.png', '/Tflowg/images/upload/thumb_4d298a4585c5f.png', '/Tflowg/images/upload/4d298a4585c5f.png', 125714, 1294568006),
(6, 1, '160.jpg', '/Tflowg/images/upload/thumb_4d298af80078f.jpg', '/Tflowg/images/upload/4d298af80078f.jpg', 9074, 1294568184),
(7, 1, '2000.jpg', '/Tflowg/images/upload/thumb_4d298b521439a.jpg', '/Tflowg/images/upload/4d298b521439a.jpg', 73321, 1294568274),
(8, 1, 'lwrapBg.jpg', '/Tflowg/images/upload/thumb_4d298dab086da.jpg', '/Tflowg/images/upload/4d298dab086da.jpg', 59571, 1294568875),
(9, 1, 'yuBg.gif', '/Tflowg/images/upload/thumb_4d2990d253a59.gif', '/Tflowg/images/upload/4d2990d253a59.gif', 19734, 1294569682),
(10, 7, 'talkbtn.gif', '/Tflowg/images/upload/thumb_4d29912c0bccf.gif', '/Tflowg/images/upload/4d29912c0bccf.gif', 2213, 1294569772),
(11, 7, '6b96acb4jw6dc361q96wnj.jpg', '/Tflowg/images/upload/thumb_4d29917ab8ede.jpg', '/Tflowg/images/upload/4d29917ab8ede.jpg', 4746, 1294569850),
(12, 1, '120.jpg', '/Tflowg/images/upload/thumb_4d29927ba6f79.jpg', '/Tflowg/images/upload/4d29927ba6f79.jpg', 4650, 1294570107),
(13, 1, '120.jpg', '/Tflowg/images/upload/thumb_4d29939eeefd6.jpg', '/Tflowg/images/upload/4d29939eeefd6.jpg', 4650, 1294570399),
(14, 1, '160.jpg', '/Tflowg/images/upload/thumb_4d2994894b722.jpg', '/Tflowg/images/upload/4d2994894b722.jpg', 9074, 1294570633),
(15, 1, 'back.png', '/Tflowg/images/upload/thumb_4d29a437d3783.png', '/Tflowg/images/upload/4d29a437d3783.png', 125714, 1294574649),
(16, 1, '8388d33678d3ae2a91ef39534.jpg', '/Tflowg/images/upload/thumb_4d29a4759a9ec.jpg', '/Tflowg/images/upload/4d29a4759a9ec.jpg', 102452, 1294574710),
(17, 1, '25b0c69126cafeb0e51d467c4efb6a8f.jpg', '/Tflowg/images/upload/thumb_4d2ac74052b20.jpg', '/Tflowg/images/upload/4d2ac74052b20.jpg', 176046, 1294649153),
(18, 1, '25b0c69126cafeb0e51d467c4efb6a8f.jpg', '/Tflowg/images/upload/thumb_4d2ac75298214.jpg', '/Tflowg/images/upload/4d2ac75298214.jpg', 176046, 1294649171),
(19, 1, '25b0c69126cafeb0e51d467c4efb6a8f.jpg', '/Tflowg/images/upload/thumb_4d2ac79da0367.jpg', '/Tflowg/images/upload/4d2ac79da0367.jpg', 176046, 1294649246),
(20, 1, '25b0c69126cafeb0e51d467c4efb6a8f.jpg', '/Tflowg/images/upload/thumb_4d2ac7de58475.jpg', '/Tflowg/images/upload/4d2ac7de58475.jpg', 176046, 1294649311),
(21, 7, 'logo-small.png', '/Tflowg/images/upload/thumb_4d2ace65d1def.png', '/Tflowg/images/upload/4d2ace65d1def.png', 23282, 1294650982),
(22, 1, 'bing54.jpg', '/Tflowg/images/upload/thumb_4d2bf1aba731b.jpg', '/Tflowg/images/upload/4d2bf1aba731b.jpg', 406752, 1294725549),
(23, 9, '25b0c69126cafeb0e51d467c4efb6a8f.jpg', '/Tflowg/images/upload/thumb_4d2d1c830e149.jpg', '/Tflowg/images/upload/4d2d1c830e149.jpg', 176046, 1294802052),
(24, 9, '25b0c69126cafeb0e51d467c4efb6a8f.jpg', '/Tflowg/images/upload/thumb_4d2d1cb3f2ad1.jpg', '/Tflowg/images/upload/4d2d1cb3f2ad1.jpg', 176046, 1294802101),
(25, 1, '8388d33678d3ae2a91ef39534.jpg', '/Tflowg/images/upload/thumb_4d2d355fe8281.jpg', '/Tflowg/images/upload/4d2d355fe8281.jpg', 102452, 1294808420),
(26, 1, '2000.jpg', '/Tflowg/images/upload/thumb_4d2d42307e7de.jpg', '/Tflowg/images/upload/4d2d42307e7de.jpg', 73321, 1294811696),
(27, 1, '120.jpg', '/Tflowg/images/upload/thumb_4d2d433d668bb.jpg', '/Tflowg/images/upload/4d2d433d668bb.jpg', 4650, 1294811965),
(28, 1, 'back.png', '/Tflowg/images/upload/thumb_4d5df280f349f.png', '/Tflowg/images/upload/4d5df280f349f.png', 125714, 1298002562),
(29, 2, 'wrapBg (1).jpg', '/Tflowg/images/upload/thumb_4d5e0d5647c7b.jpg', '/Tflowg/images/upload/4d5e0d5647c7b.jpg', 44370, 1298009431),
(30, 2, '620626d0jw6de44j4w59fj.jpg', '/Tflowg/images/upload/thumb_4d5e49d725fcb.jpg', '/Tflowg/images/upload/4d5e49d725fcb.jpg', 124363, 1298024919),
(31, 1, 'man_logo.jpg', '/Tflowg/images/upload/thumb_4d71da60a1289.jpg', '/Tflowg/images/upload/4d71da60a1289.jpg', 4310, 1299307105),
(32, 1, 'loader.gif', '/Tflowg/images/upload/thumb_4d8b19cd4e633.gif', '/Tflowg/images/upload/4d8b19cd4e633.gif', 1553, 1300961741),
(33, 1, '0645031.jpg', '/Tflowg/images/upload/thumb_4d8c35285558f.jpg', '/Tflowg/images/upload/4d8c35285558f.jpg', 29882, 1301034280),
(34, 1, '0645031.jpg', '/Tflowg/images/upload/thumb_4da698de65899.jpg', '/Tflowg/images/upload/4da698de65899.jpg', 29882, 1302763742),
(35, 1, 'flowg_chrome.png', '/Tflowg/images/upload/thumb_4db2524d8924c.png', '/Tflowg/images/upload/4db2524d8924c.png', 22544, 1303532110),
(36, 1, 'babylon.png', '/Tflowg/images/upload/thumb_4eb7a5f7b95a3.png', '/Tflowg/images/upload/4eb7a5f7b95a3.png', 4833, 1320658423);

-- --------------------------------------------------------

--
-- 表的结构 `fl_invite`
--

CREATE TABLE `fl_invite` (
  `id` int(10) NOT NULL auto_increment,
  `uid` int(10) NOT NULL,
  `time` int(10) default NULL,
  `code` varchar(20) NOT NULL,
  `is_used` tinyint(1) default NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `fl_invite`
--


-- --------------------------------------------------------

--
-- 表的结构 `fl_mention`
--

CREATE TABLE `fl_mention` (
  `id` int(10) NOT NULL auto_increment,
  `uid` int(10) NOT NULL,
  `tid` int(10) NOT NULL,
  `create_time` int(10) NOT NULL,
  `isnew` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=39 ;

--
-- 导出表中的数据 `fl_mention`
--

INSERT INTO `fl_mention` (`id`, `uid`, `tid`, `create_time`, `isnew`) VALUES
(8, 1, 273, 1297684414, 0),
(7, 1, 271, 1297680580, 0),
(9, 1, 274, 1297740439, 0),
(10, 1, 277, 1297747145, 0),
(11, 1, 346, 1299293896, 0),
(12, 1, 347, 1299294685, 0),
(13, 1, 351, 1299295387, 0),
(14, 1, 357, 1299299405, 0),
(15, 1, 361, 1299316922, 0),
(16, 2, 364, 1299323629, 0),
(17, 1, 365, 1299323714, 0),
(18, 1, 366, 1299324190, 0),
(19, 1, 367, 1299324502, 0),
(20, 1, 368, 1299324707, 0),
(21, 1, 369, 1299324775, 0),
(22, 1, 370, 1299324895, 0),
(23, 1, 371, 1299324943, 0),
(24, 1, 372, 1299326344, 0),
(25, 1, 378, 1300255827, 0),
(26, 1, 382, 1300256002, 0),
(27, 1, 383, 1300256023, 0),
(28, 1, 384, 1300256039, 0),
(29, 1, 385, 1300256307, 0),
(30, 1, 386, 1300256369, 0),
(31, 1, 396, 1300499142, 0),
(32, 1, 399, 1300961647, 0),
(33, 1, 400, 1300961654, 0),
(34, 1, 418, 1301034502, 0),
(35, 1, 424, 1302422704, 0),
(36, 1, 455, 1303199437, 0),
(37, 1, 465, 1303485696, 0),
(38, 1, 485, 1303532254, 0);

-- --------------------------------------------------------

--
-- 表的结构 `fl_news`
--

CREATE TABLE `fl_news` (
  `id` int(10) NOT NULL auto_increment,
  `uid` int(10) NOT NULL,
  `title` varchar(255) default NULL,
  `create_time` int(10) default NULL,
  `content` text,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `fl_news`
--

INSERT INTO `fl_news` (`id`, `uid`, `title`, `create_time`, `content`) VALUES
(1, 1, 'TEST01', 1303177660, '<p>							TEST01TEST01TEST01</p>\r\n<p>TEST01TEST01TEST01TEST01</p>\r\n<p>TEST01TEST01TEST01TEST01</p>\r\n<p>TEST01TEST01TEST01TEST01TEST01</p>\r\n<p>TEST01TEST01TEST01TEST01TEST01                        </p>'),
(2, 1, '纳尼？？', 1303177826, '<b>							纳尼？？纳尼？？纳尼？？纳尼？？纳尼？？纳尼？？                        </b>'),
(3, 1, 'Android', 1303189907, '<span class="Apple-style-span" style="font-family:Arial, sans-serif, Helvetica, Tahoma;"><p style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;">本来这篇文章会放Android版本做完就写的~结果由于一系列的事情而耽搁掉了，下面是我在使用phprpc协议编写android应用时出现的问题的一些心得总结。</p>\r\n<p style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;">&nbsp;</p>\r\n</span>'),
(4, 1, '明天答辩啦~~', 1303478492, '明天答辩啦~~明天答辩啦~~明天答辩啦~~明天答辩啦~~明天答辩啦~~明天答辩啦~~明天答辩啦~~明天答辩啦~~明天答辩啦~~明天答辩啦~~');

-- --------------------------------------------------------

--
-- 表的结构 `fl_role`
--

CREATE TABLE `fl_role` (
  `id` int(10) NOT NULL auto_increment,
  `rolename` varchar(40) default NULL,
  `user_right` tinyint(1) default NULL,
  `sys_right` tinyint(1) default NULL,
  `tag_right` tinyint(1) default NULL,
  `topic_right` tinyint(1) default NULL,
  `news_right` tinyint(1) default NULL,
  `style_right` tinyint(1) default NULL,
  `del_right` tinyint(1) default NULL,
  `cre_right` tinyint(1) default NULL,
  `edit_right` tinyint(1) default NULL,
  `issuper` tinyint(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `fl_role`
--

INSERT INTO `fl_role` (`id`, `rolename`, `user_right`, `sys_right`, `tag_right`, `topic_right`, `news_right`, `style_right`, `del_right`, `cre_right`, `edit_right`, `issuper`) VALUES
(1, '超级管理员', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, '普通管理员', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0),
(3, '前台管理员', 1, 0, 1, 1, 1, 1, 1, 1, 1, 0),
(4, '用户管理员', 1, 0, 1, 1, 0, 1, 1, 1, 1, 0),
(5, '公告录入员', 0, 0, 0, 0, 1, 0, 1, 1, 1, 0),
(6, '临时查看者', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `fl_site`
--

CREATE TABLE `fl_site` (
  `id` int(5) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `ftitle` varchar(20) default NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `domain` varchar(50) NOT NULL,
  `app_path` varchar(20) default NULL,
  `is_reg` tinyint(1) default NULL,
  `is_rewrite` tinyint(1) default NULL,
  `no_user` text,
  `no_word` text,
  `no_tag` text,
  `is_invite` tinyint(1) default NULL,
  `comment_open` tinyint(1) default NULL,
  `is_invite_free` int(10) default NULL,
  `copyright` text NOT NULL,
  `icp` varchar(20) default NULL,
  `user_check` tinyint(1) default NULL,
  `http_check` tinyint(1) default NULL,
  `mail_check` tinyint(1) default NULL,
  `ip_check` int(4) default NULL,
  `send_check` int(4) default NULL,
  `login_check` tinyint(1) default NULL,
  `version` varchar(30) default NULL,
  `text_len` int(5) default '140',
  `file_size` int(10) unsigned default '512000',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `fl_site`
--

INSERT INTO `fl_site` (`id`, `title`, `ftitle`, `description`, `keyword`, `domain`, `app_path`, `is_reg`, `is_rewrite`, `no_user`, `no_word`, `no_tag`, `is_invite`, `comment_open`, `is_invite_free`, `copyright`, `icp`, `user_check`, `http_check`, `mail_check`, `ip_check`, `send_check`, `login_check`, `version`, `text_len`, `file_size`) VALUES
(1, 'Flowg微博  Beta2.1 - 分享沟通 从这里开始', 'Flowg微博', 'Flowg微博  Beta2.1 - 分享沟通 从这里开始', 'Flowg微博Beta2.1', 'http://localhost/Tflowg', '', 1, 1, 'admin|flowg|vip|管理员', 'fuck|草泥马', '发票|彩票|色情|传销', 0, 0, 10, 'flowg版权所有 ©2010 <script src="http://s4.cnzz.com/stat.php?id=2145590&web_id=2145590" language="JavaScript"></script>', '您的备案号', 0, 0, 0, 0, 0, 0, 'Beta2.1', 140, 512000);

-- --------------------------------------------------------

--
-- 表的结构 `fl_style`
--

CREATE TABLE `fl_style` (
  `id` int(10) NOT NULL auto_increment,
  `title` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `create_time` int(10) default NULL,
  `uid` int(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 导出表中的数据 `fl_style`
--

INSERT INTO `fl_style` (`id`, `title`, `path`, `img`, `create_time`, `uid`) VALUES
(1, '神秘海洋', 'UserTpl/ocean/', '', 1292770291, 1),
(2, '破冰者', 'UserTpl/icebreaker/', '', 1292773291, 1),
(3, '蓝天白云', 'UserTpl/sky/', '', 1292770291, 1),
(4, '冰洁雪舞', 'UserTpl/ice/', '', 1292770291, 1),
(5, '环游世界', 'UserTpl/worldwide/\r\n/', '', 1292770291, 1),
(6, '战争与和平', 'UserTpl/warandpeace/', '', 1292770291, 1),
(7, '苹果主题', 'UserTpl/apple/', '', 1292770291, 1);

-- --------------------------------------------------------

--
-- 表的结构 `fl_tag`
--

CREATE TABLE `fl_tag` (
  `id` int(10) NOT NULL auto_increment,
  `tagname` varchar(100) NOT NULL,
  `create_uid` int(10) default NULL,
  `create_time` int(10) default NULL,
  `topic_count` int(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=27 ;

--
-- 导出表中的数据 `fl_tag`
--

INSERT INTO `fl_tag` (`id`, `tagname`, `create_uid`, `create_time`, `topic_count`) VALUES
(1, 'fd', 1, 1292659962, NULL),
(2, 'df', 1, 1292660898, NULL),
(3, '1234', 1, 1292668063, NULL),
(4, '奥斯丁', 1, 1292674418, NULL),
(5, '阿四大四大', 1, 1292677640, NULL),
(6, '阿四大四大是打算打算的', 1, 1292678175, NULL),
(7, '阿四大四大撒', 1, 1292679847, NULL),
(23, '彩票', 1, 1303485980, NULL),
(9, '才vxv ', 5, 1293786778, NULL),
(10, 'dsasdsaasdsad', 1, 1293944512, NULL),
(11, '阿斯打死打死打死的', 1, 1293944540, NULL),
(12, 'asdas', 1, 1294743866, NULL),
(13, '12312312312', 1, 1297745622, NULL),
(14, 'asdsaasdas', 1, 1297747372, NULL),
(15, 'asasasdsdasd', 1, 1297747416, NULL),
(16, '1212213', 1, 1297747465, NULL),
(17, 'asdasdas', 1, 1297747510, NULL),
(18, '鲸鱼', 1, 1298002576, NULL),
(19, 'odogai', 1, 1298080887, NULL),
(20, '444', 1, 1298899077, NULL),
(21, 'asdasasdasd', 1, 1299238782, NULL),
(22, 'asdashaskjd', 1, 1300498964, NULL),
(26, '阿萨斯', 1, 1303532074, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `fl_topic`
--

CREATE TABLE `fl_topic` (
  `id` int(10) NOT NULL auto_increment,
  `uid` int(10) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(10) NOT NULL,
  `rootid` int(10) NOT NULL,
  `tagid` int(10) NOT NULL,
  `from` enum('Air','Android','Wap','Chrome Plugin','Web') NOT NULL default 'Web',
  `type` enum('dialog','transmit','comment','first') NOT NULL default 'first',
  `imgid` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`),
  KEY `create_time` (`create_time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=495 ;

--
-- 导出表中的数据 `fl_topic`
--

INSERT INTO `fl_topic` (`id`, `uid`, `content`, `create_time`, `rootid`, `tagid`, `from`, `type`, `imgid`, `status`) VALUES
(1, 1, 'asdsd', 1291906644, 0, 0, 'Android', 'first', 0, 1),
(2, 1, 'asdfasd 按时打算大时代阿斯', 1291909644, 0, 0, 'Web', 'first', 0, 1),
(3, 1, '我是奥斯丁奥斯丁奥斯丁哈斯的', 1291909937, 0, 0, 'Web', 'first', 0, 1),
(4, 1, 'jkasddasdjk阿斯的哦阿斯大四就达斯看了', 1291946826, 0, 0, 'Web', 'first', 0, 1),
(5, 1, 'jkasddasdjk阿斯的哦阿斯大四就达斯看了阿萨斯打算打算的阿斯', 1291946914, 0, 0, 'Web', 'first', 0, 1),
(6, 1, 'asd  s adas 奥斯丁奥斯丁奥斯丁阿斯奥斯丁阿斯', 1291947069, 0, 0, 'Web', 'first', 0, 1),
(369, 1, '对 <a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 说：阿德符合卡斯的哈斯的口令卡拉斯的', 1299324775, 368, 0, 'Web', 'dialog', 0, 1),
(10, 1, 'weredasdasd as', 1292161546, 0, 0, 'Web', 'first', 0, 1),
(11, 1, '阿四大四大撒打死打死打死的', 1292161923, 0, 0, 'Web', 'first', 0, 1),
(12, 1, '阿四大四大撒打死打死打死的阿四大四大', 1292161931, 0, 0, 'Web', 'first', 0, 1),
(13, 1, '阿四大四大撒打死打死打死的阿四大四大爱仕达书店', 1292161938, 0, 0, 'Web', 'first', 0, 1),
(14, 1, 'weredasdasdasd', 1292162664, 0, 0, 'Web', 'first', 0, 1),
(15, 1, '所得税的反对法', 1292162868, 0, 0, 'Web', 'first', 0, 1),
(16, 1, '斯蒂芬斯蒂芬斯蒂芬', 1292162922, 0, 0, 'Web', 'first', 0, 1),
(17, 1, 'asdasdasd', 1292162931, 0, 0, 'Web', 'first', 0, 1),
(18, 1, 'asdasd ', 1292162942, 0, 0, 'Web', 'first', 0, 1),
(19, 1, 'asdasd ', 1292162960, 0, 0, 'Web', 'first', 0, 1),
(20, 1, 'asdassdas阿四大四大是', 1292162976, 0, 0, 'Web', 'first', 0, 1),
(21, 1, '按时打算', 1292162982, 0, 0, 'Web', 'first', 0, 1),
(22, 1, '阿四大四大是的', 1292162987, 0, 0, 'Web', 'first', 0, 1),
(23, 1, '阿四大四大', 1292162991, 0, 0, 'Web', 'first', 0, 1),
(24, 1, '阿斯', 1292163006, 0, 0, 'Web', 'first', 0, 1),
(25, 1, 'asdas ', 1292163015, 0, 0, 'Web', 'first', 0, 1),
(26, 1, 'asdasas', 1292163249, 0, 0, 'Web', 'first', 0, 1),
(27, 1, 'asasdasd', 1292163266, 0, 0, 'Web', 'first', 0, 1),
(28, 1, 'asasdasd', 1292164699, 0, 0, 'Web', 'first', 0, 1),
(29, 1, '啊啊所得税的', 1292165252, 2, 0, 'Web', 'first', 0, 1),
(30, 1, '啊啊所得税的阿斯大萨斯的', 1292165256, 0, 0, 'Web', 'first', 0, 1),
(31, 1, '啊啊所得税的阿斯大萨斯的奥斯丁', 1292165262, 0, 0, 'Web', 'first', 0, 1),
(32, 1, '啊啊所得税的阿斯大萨斯的奥斯丁四大飒飒飒飒达斯', 1292165270, 0, 0, 'Web', 'first', 0, 1),
(33, 1, '阿斯大萨斯的', 1292165338, 0, 0, 'Web', 'first', 0, 1),
(34, 1, '阿斯大萨斯的', 1292165341, 0, 0, 'Web', 'first', 0, 1),
(35, 1, '阿斯大萨斯的阿斯大萨斯的', 1292165344, 0, 0, 'Web', 'first', 0, 0),
(36, 1, '阿斯大萨斯的阿斯大萨斯的沃尔夫斯蒂芬斯蒂芬', 1292165370, 0, 0, 'Web', 'first', 0, 0),
(37, 1, 'asdasas阿四大四大阿斯', 1292379396, 0, 0, 'Web', 'first', 0, 0),
(38, 1, 'asdasd asd奥斯丁奥斯丁阿斯上嘎嘎', 1292379692, 0, 0, 'Web', 'first', 0, 0),
(39, 1, 'asdasd asd奥斯丁奥斯丁阿斯上嘎嘎', 1292507446, 0, 0, 'Web', 'first', 0, 0),
(40, 1, '#fd#12', 1292659962, 0, 1, 'Web', 'first', 0, 1),
(41, 1, '12#df#', 1292660898, 0, 2, 'Web', 'first', 0, 1),
(42, 1, 'qwe', 1292660988, 0, 0, 'Web', 'first', 0, 1),
(43, 1, 'qwe(1.gif)', 1292661014, 0, 0, 'Web', 'first', 0, 1),
(44, 1, 'qwe(1.gif)', 1292661141, 0, 0, 'Web', 'first', 0, 1),
(45, 1, 'qwe(1.gif)', 1292661142, 0, 0, 'Web', 'first', 0, 1),
(46, 1, 'qwe(1.gif)', 1292661143, 0, 0, 'Web', 'first', 0, 1),
(47, 1, 'shkasdjf', 1292661533, 0, 0, 'Web', 'first', 0, 1),
(48, 1, 'shkasdjf', 1292661548, 0, 0, 'Web', 'first', 0, 1),
(49, 1, 'shkasdjf', 1292661573, 0, 0, 'Web', 'first', 0, 1),
(50, 1, 'shkasdjf<img src=''/Tpl/default/Public/images/icon/1.gif'' /> ', 1292664894, 0, 0, 'Web', 'first', 0, 1),
(51, 1, '#1234#asdasd', 1292668063, 0, 3, 'Web', 'first', 0, 1),
(52, 1, '<img src=''/Tflowg/Tpl/default/Public/images/icon/1.gif'' /> ', 1292668292, 0, 0, 'Web', 'first', 0, 1),
(53, 1, '(1.gif)', 1292668427, 0, 0, 'Web', 'first', 0, 1),
(54, 1, 'asdgjklsdfkkasdhasdajksdh奥斯丁哈斯的啊数据库的哈数据库的爱上阿斯肯定会奥斯卡啊数据库爱仕达奥斯卡爱上阿斯肯德基鞍山的健康爱上', 1292670335, 0, 0, 'Web', 'first', 0, 1),
(55, 1, '阿四大四大', 1292672921, 0, 0, 'Web', 'first', 0, 1),
(56, 1, '阿四大四大', 1292673612, 0, 0, 'Web', 'first', 0, 1),
(57, 1, '的', 1292673868, 0, 0, 'Web', 'first', 0, 1),
(58, 1, '的', 1292673869, 0, 0, 'Web', 'first', 0, 1),
(59, 1, 'asdasasdasddd', 1292674018, 0, 0, 'Web', 'first', 0, 1),
(60, 1, 'asdasasdasdas', 1292674058, 0, 0, 'Web', 'first', 0, 1),
(61, 1, 'asd', 1292674077, 0, 0, 'Web', 'first', 0, 1),
(62, 1, 'asdasdasd', 1292674080, 0, 0, 'Web', 'first', 0, 1),
(63, 1, 'asdasdasd', 1292674081, 0, 0, 'Web', 'first', 0, 1),
(64, 1, 'asdasdasd', 1292674082, 0, 0, 'Web', 'first', 0, 1),
(65, 1, 'asdasdasdjh(3.gif)', 1292674191, 0, 0, 'Web', 'first', 0, 1),
(66, 1, '大概(4.gif)#奥斯丁#', 1292674418, 0, 4, 'Web', 'first', 0, 1),
(67, 1, '#奥斯丁#', 1292674487, 0, 4, 'Web', 'first', 0, 1),
(68, 1, 'asdasdasdjh(3.gif)sdfs', 1292676121, 0, 0, 'Web', 'first', 0, 1),
(69, 1, 'asdasdasdjh(3.gif)sdfsd', 1292676161, 0, 0, 'Web', 'first', 0, 1),
(70, 1, 'asdasdasdjh(3.gif)sdfsd', 1292676206, 0, 0, 'Web', 'first', 0, 1),
(71, 1, '阿四大四大是的', 1292676365, 0, 0, 'Web', 'first', 0, 1),
(72, 1, 'asdasdasdjh(3.gif)sdfsd', 1292676414, 0, 0, 'Web', 'first', 0, 1),
(73, 1, 'asdasdasdjh(3.gif)sdfsd (0.gif)', 1292676447, 0, 0, 'Web', 'first', 0, 1),
(74, 1, 'asdasdasdjh(3.gif)sdfsd (0.gif)d', 1292676498, 0, 0, 'Web', 'first', 0, 1),
(75, 1, 'asdasdasdjh(3.gif)sdfsd (0.gif)dd', 1292676539, 0, 0, 'Web', 'first', 0, 1),
(76, 1, 'asdasdasdjh(3.gif)sdfsd (0.gif)ddsd', 1292676671, 0, 0, 'Web', 'first', 0, 1),
(77, 1, 'asdasdasdjh(3.gif)sdfsd (0.gif)ddsd f', 1292676773, 0, 0, 'Web', 'first', 0, 1),
(78, 1, 'asdasdasdjh(3.gif)sdfsd (0.gif)ddsd fda', 1292676785, 0, 0, 'Web', 'first', 0, 1),
(79, 1, '速度vs', 1292676933, 0, 0, 'Web', 'first', 0, 1),
(80, 1, '奥斯达撒的', 1292677083, 0, 0, 'Web', 'first', 0, 1),
(81, 1, 'ASA', 1292677254, 0, 0, 'Web', 'first', 0, 1),
(82, 1, '以后', 1292677280, 0, 0, 'Web', 'first', 0, 1),
(83, 1, '是', 1292677326, 0, 0, 'Web', 'first', 0, 1),
(84, 1, '阿四大四大', 1292677583, 0, 0, 'Web', 'first', 0, 1),
(85, 1, '撒大赛的的撒#阿四大四大#', 1292677640, 0, 5, 'Web', 'first', 0, 1),
(86, 1, '#奥斯丁#阿斯打死打死打死', 1292677668, 0, 4, 'Web', 'first', 0, 1),
(87, 1, '大萨斯的(0.gif)', 1292677688, 0, 0, 'Web', 'first', 0, 1),
(88, 1, '阿四大四大是打算打算打死打死的(1.gif)', 1292677795, 0, 0, 'Web', 'first', 0, 1),
(89, 1, '阿四大四大是打算打算打死打死的(1.gif)奥斯达撒四大四大萨斯打死打死打死打死打死打死爱上爱上爱上爱上奥斯丁阿斯奥斯丁奥斯丁奥斯丁奥斯丁(2.gif)', 1292677821, 0, 0, 'Web', 'first', 0, 1),
(90, 1, '上大萨斯的', 1292678054, 0, 0, 'Web', 'first', 0, 1),
(91, 1, '上大萨斯的#阿四大四大是打算打算的#阿四大四大是的', 1292678175, 0, 6, 'Web', 'first', 0, 1),
(92, 1, '奥斯达撒上打算打算的#阿四大四大撒#', 1292679847, 0, 7, 'Web', 'first', 0, 1),
(93, 2, '阿四大四大', 1292770344, 0, 0, 'Web', 'first', 0, 1),
(94, 3, 'asdjkfhasdjkhasdfjkhdksfj', 1292770614, 0, 0, 'Web', 'first', 0, 1),
(95, 1, 'adasd', 1292851394, 0, 0, 'Web', 'first', 0, 1),
(96, 1, 'adasd(11.gif)', 1292851402, 0, 0, 'Web', 'first', 0, 1),
(97, 1, '阿四大四大是的', 1292852104, 0, 0, 'Web', 'first', 0, 1),
(98, 1, '阿四大四大是的#what#(7.gif)', 1292852118, 0, 8, 'Web', 'first', 0, 1),
(99, 1, '阿四大四大是的#what#(7.gif)(6.gif)', 1292852126, 0, 8, 'Web', 'first', 0, 1),
(100, 1, '你妹啊！！！(11.gif)', 1292852217, 0, 0, 'Web', 'first', 0, 1),
(101, 1, '你们B啊！！！(11.gif)', 1293196145, 0, 0, 'Web', 'first', 0, 1),
(102, 4, '奥斯达撒苏打水奥斯丁阿斯阿斯', 1293196256, 0, 0, 'Web', 'first', 0, 1),
(103, 5, 'dsdsdsddssdsddssdas阿萨斯撒', 1293786344, 0, 0, 'Web', 'first', 0, 1),
(104, 5, '斯蒂芬所得税的法的反对反对反对法', 1293786743, 0, 0, 'Web', 'first', 0, 1),
(105, 5, '斯蒂芬所得税的法的反对反对反对法(10.gif)(6.gif)(4.gif)(4.gif)(3.gif)#才vxv #', 1293786778, 0, 9, 'Web', 'first', 0, 1),
(106, 5, '(0.gif)', 1293786800, 0, 0, 'Web', 'first', 0, 1),
(107, 5, '(0.gif)', 1293787243, 0, 0, 'Web', 'first', 0, 1),
(108, 1, 'asad', 1293944069, 0, 0, 'Web', 'first', 0, 1),
(109, 1, 'asdassd', 1293944485, 0, 0, 'Web', 'first', 0, 1),
(110, 1, 'asdassd(15.gif)', 1293944504, 0, 0, 'Web', 'first', 0, 1),
(111, 1, 'asdassd#dsasdsaasdsad#(15.gif)', 1293944512, 0, 10, 'Web', 'first', 0, 1),
(112, 1, '阿四大四大是打算打算的打算的#阿斯打死打死打死的#', 1293944540, 0, 11, 'Web', 'first', 0, 1),
(113, 1, '(7.gif)(0.gif)(0.gif)', 1293949911, 0, 0, 'Web', 'first', 0, 1),
(114, 1, '好好', 0, 1, 0, 'Web', 'transmit', 0, 1),
(115, 1, '读书', 1293952888, 0, 0, 'Web', 'first', 0, 1),
(116, 1, 'asd', 1293953479, 115, 0, 'Web', 'transmit', 0, 1),
(117, 1, 'asdassad', 1293953630, 115, 0, 'Web', 'transmit', 0, 1),
(118, 1, 'asdasad', 1293953675, 115, 0, 'Web', 'transmit', 0, 1),
(119, 1, '方法', 1293954133, 109, 0, 'Web', 'transmit', 0, 1),
(120, 1, '湖广会馆', 1293954601, 100, 0, 'Web', 'transmit', 0, 1),
(121, 1, '阿斯的骄傲思考了的', 1293954689, 100, 0, 'Web', 'comment', 0, 1),
(122, 1, '国际化交换机和', 1293954743, 115, 0, 'Web', 'transmit', 0, 1),
(123, 1, '敖德萨的萨斯的', 1293954792, 112, 11, 'Web', 'transmit', 0, 1),
(373, 1, '(0.gif)asdadadasdasd(5.gif)asdasdasda(26.gif)', 1299418872, 0, 0, 'Web', 'first', 0, 1),
(125, 1, '奥斯丁', 1293955318, 115, 0, 'Web', 'transmit', 0, 1),
(126, 1, '阿萨斯的', 1293955359, 115, 0, 'Web', 'transmit', 0, 1),
(127, 1, '啊飒飒的', 1293955502, 113, 0, 'Web', 'transmit', 0, 1),
(128, 1, '按时打算', 1293955509, 113, 0, 'Web', 'comment', 0, 1),
(129, 1, '阿大萨斯的', 1293955610, 111, 10, 'Web', 'transmit', 0, 1),
(130, 1, '撒的会卡死的贺卡萨斯科技', 1293956246, 110, 0, 'Web', 'transmit', 0, 1),
(131, 1, '按键式的撒旦和', 1293956254, 110, 0, 'Web', 'comment', 0, 1),
(132, 1, 'awa', 1294035481, 115, 0, 'Web', 'transmit', 0, 1),
(133, 1, '阿萨斯京哈四大设计师的卡的就卡死的卡死的骄傲科技啊打开卷卡式带阿克苏的将卡斯的骄傲可间奥斯卡按时间可的骄傲卡斯大家阿卡的骄傲思考的了氨基酸的克拉斯加的卡斯的就啊了快速的间奥斯卡了的间奥斯卡了的静安寺肯德基奥斯卡的骄傲生蛋快拉丝机的考虑时间', 1294062858, 0, 0, 'Web', 'first', 0, 1),
(134, 1, 'asdas', 1294065637, 124, 11, 'Web', 'transmit', 0, 1),
(135, 1, '(0.gif)', 1294118475, 0, 0, 'Web', 'first', 0, 1),
(136, 1, '今天到爷爷家玩~~~(13.gif)', 1294123387, 0, 0, 'Web', 'first', 0, 1),
(137, 1, 'dsz', 1294196021, 0, 0, 'Web', 'first', 0, 1),
(138, 1, 'asdasdasd', 1294196035, 0, 0, 'Web', 'first', 0, 1),
(139, 1, 'asdasdasds', 1294196040, 0, 0, 'Web', 'first', 0, 1),
(140, 1, 'asdasdasd', 1294196158, 0, 0, 'Web', 'first', 0, 1),
(141, 1, 'sdasds', 1294196260, 0, 0, 'Web', 'first', 0, 1),
(142, 1, 'asdsasd', 1294198872, 0, 0, 'Web', 'first', 0, 1),
(143, 6, 'a静安寺萨科技的科技和', 1294215806, 0, 0, 'Web', 'first', 0, 1),
(144, 6, '阿萨四大四大四大', 1294215811, 0, 0, 'Web', 'first', 0, 1),
(145, 6, '奥斯达撒上打算打算的啊', 1294215819, 0, 0, 'Web', 'first', 0, 1),
(146, 6, '阿萨斯所得税的', 1294215825, 0, 0, 'Web', 'first', 0, 1),
(147, 1, '阿斯', 1294216706, 0, 0, 'Web', 'first', 0, 1),
(148, 7, 'afasasd', 1294290014, 0, 0, 'Web', 'first', 0, 1),
(149, 7, 'afasasdasjdasjkhasdj', 1294290022, 0, 0, 'Web', 'first', 0, 1),
(150, 7, '四大大声的', 1294290032, 0, 0, 'Web', 'first', 0, 1),
(151, 7, '奥斯丁哈吉斯的框架奥斯丁和科技', 1294302557, 150, 0, 'Web', 'comment', 0, 1),
(152, 1, 'akasdjkasd', 1294302606, 149, 0, 'Web', 'comment', 0, 1),
(153, 1, 'sdfsfd', 1294302752, 151, 0, 'Web', 'transmit', 0, 1),
(154, 1, '奥斯丁', 1294316882, 0, 0, 'Web', 'first', 0, 1),
(155, 1, '啊哈数据库的', 1294321695, 150, 0, 'Web', 'comment', 0, 1),
(156, 1, 'sadjkj', 1294323489, 154, 0, 'Web', 'transmit', 0, 1),
(157, 1, 'ansdasdasasdsajjsd', 1294325511, 0, 0, 'Web', 'first', 0, 1),
(158, 1, 'ajkkskjds', 1294326075, 0, 0, 'Web', 'first', 0, 1),
(159, 7, '按时打算的将', 1294326110, 0, 0, 'Web', 'first', 0, 1),
(160, 7, '按时打算的将阿萨斯达斯', 1294326164, 0, 0, 'Web', 'first', 0, 1),
(161, 7, '按时打算的将阿萨斯达斯阿萨萨斯', 1294326208, 0, 0, 'Web', 'first', 0, 1),
(162, 1, 'asaskjalksdjklaskdjaskdjasd l上打卡机的卡拉胶卡', 1294326261, 0, 0, 'Web', 'first', 0, 1),
(163, 7, '阿达萨斯', 1294326310, 0, 0, 'Web', 'first', 0, 1),
(164, 7, '阿达萨斯按时打算', 1294326371, 0, 0, 'Web', 'first', 0, 1),
(165, 7, '阿达萨斯按时打算敖德萨的', 1294326418, 0, 0, 'Web', 'first', 0, 1),
(166, 7, '阿达萨斯按时打算敖德萨的', 1294326514, 0, 0, 'Web', 'first', 0, 1),
(167, 7, '阿达萨斯按时打算敖德萨的', 1294326603, 0, 0, 'Web', 'first', 0, 1),
(168, 7, '阿达萨斯按时打算敖德萨的', 1294326607, 0, 0, 'Web', 'first', 0, 1),
(169, 1, '奥斯卡建军节的时间奥斯丁和骄傲是骄傲的哈德和', 1294326828, 168, 0, 'Web', 'transmit', 0, 1),
(170, 1, '阿卡骄傲健康的可', 1294326838, 168, 0, 'Web', 'comment', 0, 1),
(171, 7, '阿卡死了可打开了四大手机卡会计师的奥科技了四大思考卷卡式带将卡洛斯就(1.gif)', 1294327192, 0, 0, 'Web', 'first', 0, 1),
(172, 7, '阿萨斯将的哈圣诞节', 1294327210, 169, 0, 'Web', 'transmit', 0, 1),
(173, 7, 'asjdaskljkl', 1294375581, 0, 0, 'Web', 'first', 0, 1),
(174, 1, 'sdkj', 1294375634, 0, 0, 'Web', 'first', 0, 1),
(175, 1, 'asdasd', 1294375960, 0, 0, 'Web', 'first', 0, 1),
(176, 1, 'asdassadsda', 1294376876, 172, 0, 'Web', 'comment', 0, 1),
(177, 7, 'asdssd', 1294388410, 175, 0, 'Web', 'transmit', 0, 1),
(178, 1, 'fgh', 1294388666, 175, 0, 'Web', 'comment', 0, 1),
(179, 1, 'asdasdasd akd jasja阿卡勒是的间奥斯卡了的骄傲是的静安寺的了卡斯就阿斯静安寺科技上课了阿散井阿斯了卡斯就奥索卡静安寺的了卡机了肯德基', 1294397684, 172, 0, 'Web', 'comment', 0, 1),
(180, 1, '奥斯卡建军节的时间奥斯丁和骄傲是骄傲的哈德和阿四大四大', 1294398554, 168, 0, 'Web', 'comment', 0, 1),
(181, 1, '阿巴斯将哈斯的卡机的就卡死好', 1294399442, 175, 0, 'Web', 'comment', 0, 1),
(182, 1, '奥斯卡较大思考的骄傲是打算间奥斯卡拉丝机卡洛斯静安寺骄傲的卡', 1294399458, 175, 0, 'Web', 'comment', 0, 1),
(183, 1, '奥斯卡较大思考的骄傲是打算间奥斯卡拉丝机卡洛斯静安寺', 1294399482, 175, 0, 'Web', 'comment', 0, 1),
(184, 1, '思考大姐卡斯就的卡斯', 1294399529, 172, 0, 'Web', 'comment', 0, 1),
(185, 1, '阿四大四大撒飒飒的撒', 1294399548, 171, 0, 'Web', 'transmit', 0, 1),
(186, 1, '阿四大四大撒飒飒的撒', 1294399549, 171, 0, 'Web', 'transmit', 0, 1),
(187, 1, '阿斯大蒜素', 1294400085, 172, 0, 'Web', 'comment', 0, 1),
(188, 1, '阿四大四大', 1294400722, 171, 0, 'Web', 'transmit', 0, 1),
(189, 7, 'mnmasda,sdm', 1294400770, 175, 0, 'Web', 'transmit', 0, 1),
(190, 7, 'adadadasdasdas', 1294400819, 175, 0, 'Web', 'transmit', 0, 1),
(191, 7, 'adadadasdasdasasdasads', 1294400856, 175, 0, 'Web', 'transmit', 0, 1),
(192, 1, '阿斯大萨斯的', 1294400888, 172, 0, 'Web', 'transmit', 0, 1),
(193, 1, '阿斯大萨斯的奥斯达飒飒的', 1294400893, 172, 0, 'Web', 'transmit', 0, 1),
(194, 1, '萨达四大四大四大飒飒大啊啊阿斯奥斯丁阿斯阿斯达啊阿斯奥斯丁阿斯奥斯丁阿德奥斯丁阿德奥斯丁阿斯大时代阿斯达安达市阿斯阿达萨斯大大阿斯达斯', 1294400910, 172, 0, 'Web', 'transmit', 0, 1),
(195, 1, '撒萨斯的', 1294401840, 175, 0, 'Web', 'transmit', 0, 1),
(196, 1, '阿四大四大是的', 1294401847, 175, 0, 'Web', 'comment', 0, 1),
(197, 1, 'test', 1294452387, 0, 0, 'Web', 'first', 0, 1),
(198, 1, 'adasasd', 1294452430, 0, 0, 'Web', 'first', 0, 1),
(199, 7, 'asdasdasasdasd asas', 1294452632, 0, 0, 'Web', 'first', 0, 1),
(200, 1, '啊话说打算的贺卡上科技', 1294476899, 199, 0, 'Web', 'transmit', 0, 1),
(201, 1, 'asddasd', 1294496756, 0, 0, 'Web', 'first', 0, 1),
(202, 1, 'asdsad', 1294568013, 0, 0, 'Web', 'first', 5, 1),
(203, 1, 'asasd奥斯丁奥斯丁', 1294568190, 0, 0, 'Web', 'first', 6, 1),
(204, 1, '按时打算', 1294568276, 0, 0, 'Web', 'first', 7, 1),
(230, 1, '发给', 1294725535, 0, 0, 'Web', 'first', 0, 1),
(229, 7, 'xfdsf', 1294650986, 0, 0, 'Web', 'first', 21, 1),
(207, 1, '按时打算敖德萨', 1294569696, 0, 0, 'Web', 'first', 9, 1),
(237, 1, '阿大萨斯的', 1294752592, 0, 0, 'Web', 'first', 0, 1),
(238, 9, '你好啊~~', 1294752985, 0, 0, 'Web', 'first', 0, 1),
(210, 1, '按时打算敖德萨', 1294569723, 0, 0, 'Web', 'first', 9, 1),
(234, 1, '阿德奥斯丁奥斯丁', 1294752070, 0, 0, 'Web', 'first', 0, 1),
(212, 7, 'asdasdasd', 1294569774, 0, 0, 'Web', 'first', 10, 1),
(213, 7, 'asdasdasd', 1294569853, 0, 0, 'Web', 'first', 11, 1),
(236, 1, '阿四大四大的上', 1294752549, 0, 0, 'Web', 'first', 0, 1),
(215, 1, '阿四大四大撒', 1294570110, 0, 0, 'Web', 'first', 12, 1),
(216, 1, '洒大地', 1294570426, 0, 0, 'Web', 'first', 13, 1),
(217, 1, '啊加卡斯的卡接口', 1294570636, 0, 0, 'Web', 'first', 14, 1),
(218, 1, '案的，MSdn，吗', 1294570667, 217, 0, 'Web', 'transmit', 0, 1),
(219, 1, '撒大赛的', 1294570676, 217, 0, 'Web', 'transmit', 0, 1),
(220, 1, '的发生地', 1294570683, 216, 0, 'Web', 'transmit', 0, 1),
(232, 9, '那你~~~(0.gif)', 1294742984, 0, 0, 'Web', 'first', 0, 1),
(222, 7, 'asdasdasd', 1294574300, 0, 0, 'Web', 'first', 11, 1),
(223, 7, 'asdasd', 1294574309, 0, 0, 'Web', 'first', 0, 1),
(226, 1, '阿斯能打得卡死的你', 1294576341, 216, 0, 'Web', 'transmit', 0, 1),
(225, 1, '前端！！！', 1294574715, 0, 0, 'Web', 'first', 16, 1),
(235, 1, '俺打算打算的', 1294752395, 0, 0, 'Web', 'first', 0, 1),
(239, 9, '阿四大四大是的', 1294753067, 220, 0, 'Web', 'transmit', 0, 1),
(240, 9, '阿四大四大卡', 1294759285, 225, 0, 'Web', 'transmit', 0, 1),
(241, 9, '阿斯顿飞撒地方', 1294760989, 225, 0, 'Web', 'transmit', 0, 1),
(242, 9, '按时打算', 1294762189, 241, 0, 'Web', 'comment', 0, 1),
(243, 9, 'asdasd', 1294801050, 0, 0, 'Web', 'first', 0, 1),
(244, 9, 'asdasdasda', 1294801082, 0, 0, 'Web', 'first', 0, 1),
(245, 9, 'asdasd', 1294801218, 241, 0, 'Web', 'transmit', 0, 1),
(246, 9, 'dasdasda', 1294802125, 0, 0, 'Web', 'first', 24, 1),
(247, 1, 'asaksdjaks', 1294808426, 0, 0, 'Web', 'first', 25, 1),
(248, 1, 'asdasadasd阿斯打死打死打死的', 1294808535, 237, 0, 'Web', 'transmit', 0, 1),
(249, 1, '阿四大四大是的', 1294808571, 237, 0, 'Web', 'transmit', 0, 1),
(250, 1, 'asdasdasdasdasdas', 1294811625, 0, 0, 'Web', 'first', 0, 1),
(251, 1, '阿萨四大四大四大', 1294811634, 0, 0, 'Web', 'first', 0, 1),
(252, 1, '(2.gif)', 1294811699, 0, 0, 'Web', 'first', 26, 1),
(253, 1, 'ashdkajdhkjasdhjajsdlkasjd', 1294811888, 241, 0, 'Web', 'transmit', 0, 1),
(254, 1, '阿萨斯大', 1294811969, 0, 0, 'Web', 'first', 27, 1),
(255, 1, '撒达斯达斯', 1297678020, 241, 0, 'Web', 'transmit', 0, 1),
(259, 1, '<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 撒达斯', 1297678583, 0, 0, 'Web', 'first', 0, 1),
(260, 1, '<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 奥斯丁', 1297678968, 0, 0, 'Web', 'first', 0, 1),
(261, 1, '<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 123123v', 1297679031, 0, 0, 'Web', 'first', 0, 1),
(277, 2, '<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 123123213', 1297747145, 0, 0, 'Web', 'first', 0, 1),
(264, 1, '<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 123123123', 1297679228, 0, 0, 'Web', 'first', 0, 1),
(275, 1, '<a href=''/Tflowg/tag/index.shtml?tagid=13'' target=''_blank''>#12312312312#</a> asdasd', 1297745622, 0, 13, 'Web', 'first', 0, 1),
(266, 1, '1123@admin', 1297679462, 0, 0, 'Web', 'first', 0, 1),
(267, 1, '<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 挨三顶四', 1297679471, 0, 0, 'Web', 'first', 0, 1),
(268, 1, '<a href=''/Tflowg/nihaoma'' target=''_blank''>@nihaoma</a> 123123123', 1297680385, 0, 0, 'Web', 'first', 0, 1),
(269, 1, '<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 按时打算', 1297680471, 0, 0, 'Web', 'first', 0, 1),
(270, 1, '<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 按时打算', 1297680544, 0, 0, 'Web', 'first', 0, 1),
(271, 1, '<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 按时打算', 1297680580, 0, 0, 'Web', 'first', 0, 1),
(273, 1, '<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 阿四大四大', 1297684414, 0, 0, 'Web', 'first', 0, 1),
(278, 1, '#阿四大四大撒# asdasd', 1297747323, 0, 7, 'Web', 'first', 0, 1),
(282, 1, '<a href=''/Tflowg/tag/index.shtml?tagid=15'' target=''_blank''>#asasasdsdasd#</a>', 1297747416, 0, 15, 'Web', 'first', 0, 1),
(283, 1, '#asasasdsdasd# dasas', 1297747441, 0, 15, 'Web', 'first', 0, 1),
(284, 1, '<a href=''/Tflowg/tag/index.shtml?tagid=16'' target=''_blank''>#1212213#</a>', 1297747465, 0, 16, 'Web', 'first', 0, 1),
(285, 1, '#阿斯打死打死打死的# 123122312', 1297747475, 0, 11, 'Web', 'first', 0, 1),
(286, 1, '<a href=''/Tflowg/tag/index.shtml?tagid=17'' target=''_blank''>#asdasdas#</a>', 1297747510, 0, 17, 'Web', 'first', 0, 1),
(288, 1, 'hasdkhaskajsakjdshasd<a href=''/Tflowg/tag/index.shtml?tagid=18'' target=''_blank''>#鲸鱼#</a>', 1298002576, 0, 18, 'Web', 'first', 28, 1),
(289, 2, '啊，has结婚登记和就', 1298009395, 0, 0, 'Web', 'first', 0, 1),
(290, 2, 'asjdhasdhadajsdakja haah jasd asd', 1298009411, 0, 0, 'Web', 'first', 0, 1),
(291, 2, 'asdad', 1298009439, 0, 0, 'Web', 'first', 29, 1),
(292, 2, '(49.gif)asdasasd', 1298009463, 0, 0, 'Web', 'first', 0, 1),
(293, 2, 'nadniasdni', 1298015310, 0, 0, 'Web', 'first', 0, 1),
(295, 2, 'asdas', 1298024922, 0, 0, 'Web', 'first', 30, 1),
(296, 1, '<a href=''/Tflowg/tag/index.shtml?tagid=19'' target=''_blank''>#odogai#</a>asdasdasdasdasdasd', 1298080887, 0, 19, 'Web', 'first', 0, 1),
(297, 1, 'asdasd', 1298201426, 0, 0, 'Web', 'first', 0, 1),
(298, 1, 'asdasd', 1298201452, 0, 0, 'Web', 'first', 0, 1),
(299, 1, 'asdasd', 1298201785, 0, 0, 'Web', 'first', 0, 1),
(300, 1, 'asdasd', 1298201788, 0, 0, 'Web', 'first', 0, 1),
(301, 1, 'asdasd', 1298201934, 0, 0, 'Web', 'first', 0, 1),
(302, 1, 'asdhasjkdah阿苏丹哈速度快就阿海隧道客机哈萨克', 1298201954, 0, 0, 'Web', 'first', 0, 1),
(304, 1, 'Rrrrrr', 1298449109, 0, 0, 'Web', 'first', 0, 1),
(305, 2, 'asdhasjkdah阿苏丹哈速度快就阿海隧道客机哈萨克', 1298867881, 0, 0, 'Web', 'first', 0, 1),
(306, 1, 'addaadad', 1298897668, 0, 0, 'Web', 'first', 0, 1),
(416, 1, 'hakshdkjk', 1301034294, 0, 0, 'Web', 'first', 33, 1),
(308, 1, 'addaaasdnklasdnasdnasdnasd', 1298897743, 0, 0, 'Web', 'first', 0, 1),
(309, 1, 'addaaasdnklasdnasdnasdnasd', 1298897805, 0, 0, 'Web', 'first', 0, 1),
(310, 1, 'addaaasdnklasdnasdnasdnasd', 1298897810, 0, 0, 'Web', 'first', 0, 1),
(311, 1, 'addaaasdnklasdnasdnasdnasd', 1298897811, 0, 0, 'Web', 'first', 0, 1),
(312, 1, 'addaaasdnklasdnasdnasdnasd', 1298897812, 0, 0, 'Web', 'first', 0, 1),
(313, 1, 'nani!!!', 1298898002, 0, 0, 'Web', 'first', 0, 1),
(314, 1, 'nani!!!', 1298898005, 0, 0, 'Web', 'first', 0, 1),
(315, 1, 'fdgf', 1298898667, 0, 0, 'Web', 'first', 0, 1),
(316, 1, 'fdgf', 1298898755, 0, 0, 'Web', 'first', 0, 1),
(317, 1, 'fdgfhfghh', 1298898765, 0, 0, 'Web', 'first', 0, 1),
(318, 1, 'fdgfhfghh', 1298899006, 0, 0, 'Web', 'first', 0, 1),
(319, 1, 'fdgfhfghh', 1298899008, 0, 0, 'Web', 'first', 0, 1),
(320, 1, 'fdgfhfghh', 1298899009, 0, 0, 'Web', 'first', 0, 1),
(321, 1, 'fdgfhfghh', 1298899010, 0, 0, 'Web', 'first', 0, 1),
(322, 1, 'fdgfhfghh', 1298899012, 0, 0, 'Web', 'first', 0, 1),
(323, 1, 'fdgfhfghh', 1298899012, 0, 0, 'Web', 'first', 0, 1),
(324, 1, 'fdgfhfghh', 1298899012, 0, 0, 'Web', 'first', 0, 1),
(325, 1, 'fdgfhfghh', 1298899013, 0, 0, 'Web', 'first', 0, 1),
(326, 1, 'fdgfhfghh', 1298899013, 0, 0, 'Web', 'first', 0, 1),
(327, 1, 'fdgfhfghh', 1298899013, 0, 0, 'Web', 'first', 0, 1),
(328, 1, 'fdgfhfghhesh<a href=''__APP__/tag/index?tagid=20'' target=''_blank''>#444#</a>55', 1298899077, 0, 20, 'Web', 'first', 0, 1),
(329, 1, 'asd', 1298899369, 0, 0, 'Web', 'first', 0, 1),
(330, 1, 'asd', 1298899371, 0, 0, 'Web', 'first', 0, 1),
(331, 1, 'asdasdasds', 1298899375, 0, 0, 'Web', 'first', 0, 1),
(332, 1, 'fklsdasadflkdafskdfs', 1298899766, 0, 0, 'Web', 'first', 0, 1),
(334, 1, 'fklsdasadflkdafskdfsskjbasjasjjskdyumen', 1298899775, 0, 0, 'Web', 'first', 0, 1),
(335, 1, 'sui ran', 1298900462, 0, 0, 'Web', 'first', 0, 1),
(337, 1, 'sui ran', 1298901131, 0, 0, 'Web', 'first', 0, 1),
(338, 1, 'DASDSD', 1298901372, 0, 0, 'Web', 'first', 0, 1),
(339, 1, 'DASDSDasasd', 1298901540, 0, 0, 'Web', 'first', 0, 1),
(340, 1, '阿斯打死打死打死', 1298991478, 339, 0, 'Web', 'transmit', 0, 1),
(342, 1, '快递费间奥斯卡了的风景了卡斯的法律及可&#124;&#124;<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> :阿斯打死打死打死', 1299290997, 339, 0, 'Web', 'transmit', 0, 1),
(343, 1, '撒发发', 1299293072, 342, 0, 'Web', 'transmit', 0, 1),
(344, 1, 'zCzx', 1299293257, 175, 0, 'Web', 'transmit', 0, 1),
(345, 1, 'sdasdssad', 1299293295, 344, 0, 'Web', 'transmit', 0, 1),
(346, 1, 'asdasd //<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> :sdasdssad', 1299293895, 344, 0, 'Web', 'transmit', 0, 1),
(347, 1, '12313 //<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a> :asdasd //<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a> :sdasdssad', 1299294685, 175, 0, 'Web', 'transmit', 0, 1),
(348, 1, 'sasadasdasdads', 1299294755, 0, 0, 'Web', 'first', 0, 1),
(349, 1, 'asdasd', 1299294983, 348, 0, 'Web', 'comment', 0, 1),
(350, 1, 'asdasdasdas', 1299295360, 175, 0, 'Web', 'transmit', 0, 1),
(351, 1, 'adasdsadasd //<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> :asdasd', 1299295387, 348, 0, 'Web', 'transmit', 0, 1),
(352, 1, 'asdasdasdassa', 1299295426, 337, 0, 'Web', 'transmit', 0, 1),
(353, 1, 'asdasaadsadsa', 1299295450, 337, 0, 'Web', 'transmit', 0, 1),
(354, 1, 'asasd dasdas dasd ad a as 是打奥斯丁 啊阿斯书店', 1299295645, 0, 0, 'Web', 'first', 0, 1),
(364, 1, '对 <a href=''/Tflowg/leyteris'' target=''_blank''>@leyteris</a> 说：按时打算', 1299323629, 291, 0, 'Web', 'comment', 0, 1),
(356, 1, '阿斯大的//@admin:奥斯达撒苏打水', 1299299358, 354, 0, 'Web', 'transmit', 0, 1),
(357, 1, '阿四大四大//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a> :阿斯大的//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a> :奥斯达撒苏打水', 1299299405, 354, 0, 'Web', 'transmit', 0, 1),
(358, 1, '爱仕达', 1299307109, 0, 0, 'Web', 'first', 31, 1),
(367, 1, '对 <a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 说：阿四大四大是的', 1299324502, 366, 0, 'Web', 'dialog', 0, 1),
(368, 1, '对 <a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 说：大是大非has的健康厉害的讲课了地方', 1299324707, 367, 0, 'Web', 'dialog', 0, 1),
(360, 1, 'ASasAsASa是', 1299316888, 339, 0, 'Web', 'transmit', 0, 1),
(361, 1, 'AA萨达萨斯 //<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> :撒发发', 1299316922, 339, 0, 'Web', 'transmit', 0, 1),
(362, 1, '阿斯大数据库', 1299322259, 354, 0, 'Web', 'transmit', 0, 1),
(363, 1, '在司法萨斯', 1299322269, 354, 0, 'Web', 'comment', 0, 1),
(365, 1, '对 <a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 说：发生的斯蒂芬斯蒂芬', 1299323714, 358, 0, 'Web', 'comment', 0, 1),
(366, 1, '对 <a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 说：地方哈市卡拉斯的疯狂了', 1299324190, 365, 0, 'Web', 'comment', 0, 1),
(370, 1, '对 <a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 说：是的风格的分公司的风格', 1299324895, 368, 0, 'Web', 'dialog', 0, 1),
(371, 1, '对 <a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 说：ashlru89345uy3接口', 1299324943, 370, 0, 'Web', 'dialog', 0, 1),
(372, 1, '对 <a href=''/Tflowg/admin'' target=''_blank''>@admin</a> 说：克拉斯加的费', 1299326344, 4, 0, 'Web', 'dialog', 0, 1),
(374, 1, 'sdfsdfsdf', 1299423241, 0, 0, 'Web', 'first', 0, 1),
(375, 1, 'sdhfjksdh', 1300250241, 348, 0, 'Web', 'transmit', 0, 1),
(376, 1, '2//@admin2:sdhfjksdh', 1300255715, 348, 0, 'Web', 'transmit', 0, 1),
(377, 1, 'sda//@admin:sdhfjksdh', 1300255747, 348, 0, 'Web', 'transmit', 0, 1),
(378, 1, 'asd//<a href=''/Tflowg/admin'' target=''_blank''>@admin</a>:AA萨达萨斯  //<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> :撒发发', 1300255827, 339, 0, 'Web', 'transmit', 0, 1),
(379, 1, 'asd//@admin:sda//@admin:sdhfjksdh', 1300255940, 348, 0, 'Web', 'transmit', 0, 1),
(380, 1, 'zd//@admin:sdhfjksdh', 1300255962, 348, 0, 'Web', 'transmit', 0, 1),
(381, 1, 'sdaasd//@admin:zd//@admin:sdhfjksdh', 1300255977, 348, 0, 'Web', 'transmit', 0, 1),
(382, 1, 'asdad//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a> :sdaasd//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a> :zd//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a> :sdhfjksdh', 1300256002, 348, 0, 'Web', 'transmit', 0, 1),
(383, 1, 'asdasd //<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a> :asdad//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a> :sdaasd//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a> :zd//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a> :sdhfjksdh', 1300256023, 348, 0, 'Web', 'transmit', 0, 1),
(384, 1, '奥斯达大厦的//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a>:asdasd  //<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a> :asdad//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a> :sdaasd//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a> :zd//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a> :sdhfjksdh', 1300256039, 348, 0, 'Web', 'transmit', 0, 1),
(385, 1, 'has看看 // <a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a></a></a> :奥斯达大厦的 // <a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a></a></a> :asdasd // <a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a></a></a> :asdad//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a></a></a> :sdaasd//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a></a></a> :zd//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a></a></a> :sdhfjksdh', 1300256306, 348, 0, 'Web', 'transmit', 0, 1),
(386, 1, '啊啊说的 // <a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a></a></a>:has看看  // <a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a></a></a> :奥斯达大厦的 // <a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a></a></a> :asdasd // <a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a></a></a> :asdad//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a></a></a> :sdaasd//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a></a></a> :zd//<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a></a></a></a> :sdhfjksdh', 1300256369, 348, 0, 'Web', 'transmit', 0, 1),
(387, 1, 'asjhsadjkasdhbk', 1300498135, 0, 0, 'Web', 'first', 0, 1),
(388, 1, 'asjhsadjkasdhbk', 1300498146, 0, 0, 'Web', 'first', 0, 1),
(389, 1, 'asgdas', 1300498281, 0, 0, 'Web', 'first', 0, 1),
(390, 6, 'jkaskjaks', 1300498702, 0, 0, 'Web', 'first', 0, 1),
(391, 1, 'ashdasjdhasdh', 1300498924, 0, 0, 'Web', 'first', 0, 1),
(392, 1, '<a href=''/Tflowg/tag/index.shtml?tagid=22'' target=''_blank''>#asdashaskjd#</a>sdasasd(1.gif)', 1300498964, 0, 22, 'Web', 'first', 0, 1),
(393, 6, 'jkaskjaksashdjashjaskd', 1300498992, 0, 0, 'Web', 'first', 0, 1),
(395, 1, 'hasdkjasjasdj', 1300499084, 0, 0, 'Web', 'first', 0, 1),
(396, 1, 'ghagsjashj //<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> :asdasdasdas', 1300499142, 175, 0, 'Web', 'transmit', 0, 1),
(397, 1, 'jawhjkjwd', 1300961617, 0, 0, 'Web', 'first', 0, 1),
(398, 1, 'asasdds', 1300961625, 397, 0, 'Web', 'transmit', 0, 1),
(399, 1, 'asdasdn //<a href=''/Tflowg/admin'' target=''_blank''>@admin</a> :asasdds', 1300961647, 397, 0, 'Web', 'transmit', 0, 1),
(400, 1, 'ajksdhkjasda //<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a> :asdasdn //<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a> :asasdds', 1300961654, 397, 0, 'Web', 'transmit', 0, 1),
(401, 1, 'jhgjjh', 1300961753, 0, 0, 'Web', 'first', 32, 1),
(417, 1, 'fshdkfkjskj', 1301034464, 348, 0, 'Web', 'transmit', 0, 1),
(418, 1, 'sfjkshfksdfsdj //<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a> :ajksdhkjasda //<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a> :asdasdn //<a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''><a href=''/Tflowg/admin'' target=''_blank''>@admin</a></a></a> :asasdds', 1301034502, 397, 0, 'Web', 'transmit', 0, 1),
(419, 1, 'fhgg', 1301034548, 397, 0, 'Web', 'dialog', 0, 1),
(420, 1, '坑爹遭雷劈！！！', 1302279284, 0, 0, 'Web', 'first', 0, 1),
(421, 1, 'Lab实验室之Map Position 测试版放出~~', 1302336697, 0, 0, 'Web', 'first', 0, 1),
(423, 1, 'zx', 1302422688, 421, 0, 'Web', 'transmit', 0, 1),
(425, 1, 'Lab实验室之Flowg Wall 测试版放出~~Lab实验室之Flowg Wall 测试版放出~~Lab实验室之Flowg Wall 测试版放出~~截图~~~~~~', 1302434760, 0, 0, 'Web', 'first', 0, 1),
(427, 1, '毕业论文终于快写完了，放截图中，啦啦啦~~~', 1302763516, 0, 0, 'Web', 'first', 0, 1),
(428, 1, '图片微博发布演示', 1302763773, 0, 0, 'Web', 'first', 34, 1),
(429, 1, 'Android test!!!!', 1302766217, 0, 0, 'Web', 'first', 0, 1),
(430, 1, 'adasdhlkjk', 1302837427, 0, 0, 'Android', 'first', 0, 1),
(431, 1, '盛大', 1302839029, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(432, 1, '奥斯丁', 1302841780, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(433, 1, 'DASDADSSA', 1302841984, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(434, 1, '奥斯丁', 1302842109, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(435, 1, '奥斯丁阿斯大的上', 1302842141, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(436, 1, '奥斯丁强大的事', 1302842331, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(437, 1, '阿斯的快捷键', 1302846415, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(438, 1, '大时代', 1302846453, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(439, 1, 'asdhaksdkj', 1302850611, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(440, 1, 'jasdkhasdasd k', 1302851085, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(441, 1, 'test', 1302852876, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(442, 1, 'sdasdasdd', 1302852933, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(443, 1, 'asjhaskjdj', 1302853013, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(444, 2, '上帝啊啊啊啊 上帝啊啊啊啊 上帝啊啊啊啊 上帝啊啊啊啊 上帝啊啊啊啊 上帝啊啊啊啊 上帝啊啊啊啊', 1302853290, 0, 0, 'Web', 'first', 0, 1),
(445, 2, 'Flowg For Chrome 插件预览版放出~~~', 1302853380, 0, 0, 'Web', 'first', 0, 1),
(446, 1, 'chrome 插件测试~~~', 1302853501, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(447, 6, 'Flowg For Chrome 插件预览版放出~~~', 1302853571, 0, 0, 'Web', 'first', 0, 1),
(448, 1, 'test~~~', 1302853836, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(449, 2, '继续发微~~~', 1302866317, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(450, 2, '阿四大四大', 1302868521, 448, 0, 'Web', 'transmit', 0, 1),
(453, 1, 'http://www.baidu.com/s?wd=stripos&n=2 阿德', 1303196276, 0, 0, 'Web', 'first', 0, 1),
(452, 1, 'Android TEST!!!4.15', 1302870867, 0, 0, 'Android', 'first', 0, 1),
(454, 1, '纳斯达上帝', 1303199410, 453, 0, 'Web', 'transmit', 0, 1),
(455, 1, '奥斯丁// <a href=''/Tflowg/admin'' target=''_blank''>@admin</a> :纳斯达上帝', 1303199436, 453, 0, 'Web', 'transmit', 0, 1),
(456, 1, '斯蒂芬是的', 1303199449, 455, 0, 'Web', 'comment', 0, 1),
(457, 1, '看看Google Map API！！', 1303355920, 0, 0, 'Web', 'first', 0, 1),
(458, 1, 'asdasd', 1303356515, 457, 0, 'Web', 'transmit', 0, 1),
(459, 1, 'asdasasdsad', 1303356538, 458, 0, 'Web', 'comment', 0, 1),
(460, 2, 'ahuahua', 1303366801, 0, 0, 'Android', 'first', 0, 1),
(481, 1, '奥术弹幕，爱仕达，你们<a href=''/Tflowg/tag/index.shtml?tagid=26'' target=''_blank''>#阿萨斯#</a>', 1303532074, 0, 26, 'Web', 'first', 0, 1),
(464, 1, '缓存开启', 1303483283, 460, 0, 'Web', 'transmit', 0, 1),
(465, 1, '阿萨斯的// <a href=''/Tflowg/admin'' target=''_blank''>@admin</a> :缓存开启', 1303485696, 460, 0, 'Web', 'transmit', 0, 1),
(466, 1, '按时打算', 1303485703, 464, 0, 'Web', 'comment', 0, 1),
(468, 1, '阿斯撒达斯达斯', 1303485938, 0, 0, 'Web', 'first', 0, 1),
(486, 1, 'asdhjashdkj', 1303532623, 0, 0, 'Android', 'first', 0, 1),
(473, 1, '阿斯监督局ask', 1303486556, 0, 0, 'Web', 'first', 0, 1),
(474, 1, '** ！！！', 1303486807, 0, 0, 'Web', 'first', 0, 1),
(475, 1, '敖德萨', 1303487184, 0, 0, 'Web', 'first', 0, 1),
(477, 13, 'asdaas', 1303524634, 0, 0, 'Web', 'first', 0, 1),
(478, 2, 'asdasd', 1303526053, 475, 0, 'Web', 'transmit', 0, 1),
(472, 1, '萨斯的', 1303486490, 0, 0, 'Web', 'first', 0, 1),
(482, 1, '按时打算 <a href=''/Tflowg/tag/index.shtml?tagid=26'' target=''_blank''>#阿萨斯#</a>', 1303532084, 0, 26, 'Web', 'first', 0, 1),
(483, 1, '奥斯达撒', 1303532112, 0, 0, 'Web', 'first', 35, 1),
(484, 1, '洒大地', 1303532236, 483, 0, 'Web', 'transmit', 0, 1),
(485, 1, '按时打算// <a href=''/Tflowg/admin'' target=''_blank''>@admin</a> :洒大地', 1303532254, 483, 0, 'Web', 'transmit', 0, 1),
(487, 2, '啊哈sdk据鞍山的卡卡', 1303532678, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(488, 2, '阿萨斯', 1303532711, 0, 0, 'Chrome Plugin', 'first', 0, 1),
(489, 1, 'Flowg Position 测试', 1304509810, 0, 0, 'Web', 'first', 0, 1),
(490, 2, 'Flowg Position 测试', 1304509937, 0, 0, 'Web', 'first', 0, 1),
(491, 1, 'aassdsda', 1313552203, 0, 0, 'Web', 'first', 0, 1),
(492, 2, 'asdasjdhaskdjsadhdsj', 1313552293, 0, 0, 'Chrome Plugin', 'first', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `fl_user`
--

CREATE TABLE `fl_user` (
  `id` int(10) NOT NULL auto_increment,
  `userid` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `homepage` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sex` tinyint(1) NOT NULL default '1',
  `avatar` varchar(48) NOT NULL,
  `memo` varchar(160) NOT NULL,
  `personalpage` varchar(50) NOT NULL,
  `styleid` int(10) NOT NULL,
  `create_time` int(10) NOT NULL,
  `create_ip` varchar(16) NOT NULL,
  `roleid` int(10) NOT NULL,
  `login_time` int(10) NOT NULL,
  `login_ip` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `address` varchar(100) NOT NULL,
  `province` varchar(40) NOT NULL,
  `city` varchar(40) NOT NULL,
  `msn` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `qq` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`userid`),
  UNIQUE KEY `homepage` (`homepage`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=14 ;

--
-- 导出表中的数据 `fl_user`
--

INSERT INTO `fl_user` (`id`, `userid`, `password`, `nickname`, `homepage`, `email`, `sex`, `avatar`, `memo`, `personalpage`, `styleid`, `create_time`, `create_ip`, `roleid`, `login_time`, `login_ip`, `status`, `address`, `province`, `city`, `msn`, `mobile`, `qq`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 'admin@adji.com', 1, '1303532192450.jpg', '哈sdk家啊sdk', '', 1, 1292770291, '', 1, 1320658329, '127.0.0.1', 1, '浙江省杭州市下沙区', '', '', '', '12312414124', '123123123'),
(2, 'leyteris', '21232f297a57a5a743894a0e4a801fc3', 'leyteris', 'leyteris', 'asd@asd.com', 0, '1298009544495.jpg', '', '', 4, 1292770291, '127.0.0.1', 0, 1304509931, '127.0.0.1', 1, '浙江省杭州市滨江区', '', '', '', '', ''),
(3, 'asdasd', 'a8f5f167f44f4964e6c998dee827110c', 'asdasd', 'asdasd', 'asd@asd.com', 0, '', '', '', 0, 1292770576, '127.0.0.1', 0, 0, '', 1, '', '', '', '', '', ''),
(4, 'asdasdasdasd', 'a3dcb4d229de6fde0db5686dee47145d', 'asasdadas', 'asdasdasdasd', 'asdas@ad.cpm', 0, '', '', '', 0, 1293196232, '127.0.0.1', 0, 0, '', 1, '', '', '', '', '', ''),
(5, 'shgshg', 'e10adc3949ba59abbe56e057f20f883e', 'shg', 'shgshg', 'shg@sina.com', 0, '', '', '', 0, 1293786319, '127.0.0.1', 0, 0, '', 1, '', '', '', '', '', ''),
(6, 'liyichao', '4297f44b13955235245b2497399d7a93', '潭柘鸣人', 'liyichao', 'liyichaodoom3@hotmail.com', 1, '1302452143409.jpg', '', '', 3, 1294215686, '127.0.0.1', 0, 1302853528, '127.0.0.1', 1, '浙江省杭州市下沙区', '', '', '', '', ''),
(7, 'liyichao6', '4297f44b13955235245b2497399d7a93', 'liyichao', 'liyichao6', 'asd@asd.com', 1, '', '', '', 0, 1294289813, '127.0.0.1', 0, 1294374816, '127.0.0.1', 1, '', '', '', '', '', ''),
(8, 'nihao9', '4297f44b13955235245b2497399d7a93', 'nihao9', 'nihao9', 'asd@asd.com', 1, '', '', '', 0, 1294741762, '127.0.0.1', 0, 0, '', 1, '', '', '', '', '', ''),
(9, 'nihaoma', '', '呢帽', 'nihaoma', 'asd@asd.com', 1, '1294752966360.jpg', '', '', 0, 1294742921, '127.0.0.1', 6, 1294752833, '127.0.0.1', 1, '', '', '', '', '', ''),
(11, 'sys', '202cb962ac59075b964b07152d234b70', 'sys', 'sys', '', 1, '', '', '', 0, 1303476938, '', 5, 0, '', 1, '', '', '', '', '', ''),
(12, '123123123', 'f5bb0c8de146c67b44babbf4e6584cc0', '123123123', '123123123', '123@123.com', 1, '', '', '', 0, 1303483674, '127.0.0.1', 0, 0, '', 1, '', '', '', '', '', ''),
(13, 'sysys', '4297f44b13955235245b2497399d7a93', 'sysy', 'sysys', '54354@123.com', 1, '', '', '', 2, 1303522719, '127.0.0.1', 0, 1303524628, '127.0.0.1', 1, '浙江省杭州市下沙区', '', '', '', '', '');
