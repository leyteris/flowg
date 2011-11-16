<?php  function getFlowgPath(){ return __APP__.'/'; } function getUploadPath(){ return APP_PATH.'/images/upload/'; } function getShowPath(){ return getFlowgPath().'images/upload/'; } function getAvatarTempPath(){ return getFlowgPath().'images/avatar/temp/'; } function checkUserName($content){ $noname="adminsys,admincp,adminu,blog,index,user,public,install"; if(stripos($noname,strtolower($content))===FALSE){ $siteconfig=F('site'); $nouser=$siteconfig['no_user']; if(!empty($nouser)){ $f=FALSE; $narr=explode("|",$nouser); for($i=0;$i<count($narr);$i++){ if(stripos(strtolower($content),strtolower($narr[$i]))===FALSE){ $f=FALSE; }else{ $f=TRUE; break; } } return $f; } }else{ return TRUE; } } function str_len($str){ $length = strlen(preg_replace('/[\x00-\x7F]/', '', $str)); if ($length){ return strlen($str) - $length + intval($length / 3) * 2; }else{ return strlen($str); } } function getUserAvatar($avatar,$type=50){ $avatarpath=getFlowgPath()."images/avatar/"; $c=""; if($type){ $c=$type.'_'; } if($avatar){ return $avatarpath."flowg_".$c.$avatar; }else{ return $avatarpath.'default_'.$c.'avatar.jpg'; } } function checkCache(){ $site=FALSE; $site=F('site'); if(!$site){ $s=M('site'); $rs=$s->find(); F('site',$rs); } } function filterHtmlCode($content){ return preg_replace ("/<\/?[^>]*>/i","", $content); } function filterSpecial($content){ $content=strip_tags($content); $search = array ("'<script[^>]*?>.*?</script>'si","'([\r\n])'","'(\')'"); $replace = array ("","","’"); return preg_replace ($search, $replace, $content); } function replaceSpaceGe($str){ if($str){ return preg_replace('/\s/',' ',$str); } } function getUserID(){ $user=getSession(); if($user){ $u=M('User'); $rsinfo=$u->where("userid='".$user."'")->find(); if($rsinfo){ return $rsinfo['id']; }else{ return '0'; } } } function cutText($str = '', $len = 0, $etc = ' ...') { if(0 == $len) return ""; $str_len = preg_match_all('/[\x00-\x7F\xC0-\xFD]/', $str, $dummy); if($len >= $str_len){ return $str; }else{ $newstr = mb_substr($str,0,$len,'utf-8'); return $newstr.$etc; } } function getUserNameID($uid){ if($uid){ $u=M('User'); $rs=$u->field('id,userid,nickname')->where("id=".$uid)->find(); if($rs){ if(!empty($rs['nickname'])){ return $rs['nickname']; }else{ return $rs['userid']; } }else{ return "火星"; } }else{ return "火星"; } } function getSession(){ return Session::get(C('USER_AUTH_KEY')); } function getTime($time){ $re=""; if($time){ $sec=time()-$time; if($sec>=2*24*3600) $re=date("Y-m-d H:i",$time); else if(($sec>=24*3600)&&($sec<2*24*360)) $re="1天前"; else if($sec>3600) $re=intval($sec/3600).'小时前'; else if($sec>120) $re=intval($sec/60).'分钟前'; else $re=$sec.'秒前'; } return $re; } function getRealTime($time){ $re=""; if($time){ $re=date("Y-m-d H:i",$time); } return $re; } function checkId32($id){ if(preg_match("/^[0-9]*$/",$id)){ return $id; }else{ return false; } } function getBlogReplay($content){ $content=preg_replace ("/\((.+?)\.gif\)/i","<img src='".APP_TMPL_PATH."Public/images/icon/$1.gif' /> ", $content); return $content; } function ismail($mail){ if ( ereg("^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9\-\.])+",$mail)){ return true; }else{ return false; } } function getCheckHttp($content){ $sconfig=F('site'); $http=$sconfig['http_check']; if($http){ if($content){ if(stripos($content,"http")===FALSE){ return FALSE; }else{ return TRUE; } } }else{ return FALSE; } } function checkSendTime($send_check){ if($send_check){ $user=M('user'); $rs=$user->find(getUserID()); if(time()-$rs['create_time']<$send_check*60){ return false; }else{ return true; } } } function checkUserStatus(){ $user=M('User'); $rs=$user->find(getUserID()); if($rs['status']!=1){ return false; }else{ return true; } } function checkTag($content){ $site=F('site'); $no_tag=$site['no_tag']; $arr=explode("|",$no_tag); $b = true; for($i=0;$i<count($arr);$i++){ if($content == $arr[$i]){ $b = false; break; } } return $b; } function replaceNoTag($content){ $site=F('site'); $no_word=$site['no_word']; $arr=explode("|",$no_word); for($i=0;$i<count($arr);$i++){ $content=str_replace($arr[$i],'**',$content); } return $content; } return array ( 'app_debug' => false, 'app_domain_deploy' => false, 'app_sub_domain_deploy' => false, 'app_plugin_on' => false, 'app_file_case' => false, 'app_group_depr' => '.', 'app_group_list' => '', 'app_autoload_reg' => false, 'app_autoload_path' => 'Think.Util.', 'app_config_list' => array ( 0 => 'taglibs', 1 => 'routes', 2 => 'tags', 3 => 'htmls', 4 => 'modules', 5 => 'actions', ), 'cookie_expire' => 3600, 'cookie_domain' => '', 'cookie_path' => '/', 'cookie_prefix' => '', 'default_app' => '@', 'default_group' => 'Home', 'default_module' => 'Index', 'default_action' => 'index', 'default_charset' => 'utf-8', 'default_timezone' => 'PRC', 'default_ajax_return' => 'JSON', 'default_theme' => 'default', 'default_lang' => 'zh-cn', 'db_type' => 'mysql', 'db_host' => 'localhost', 'db_name' => 'tflowg', 'db_user' => 'root', 'db_pwd' => 'ilikedoom3', 'db_port' => '3306', 'db_prefix' => 'fl_', 'db_suffix' => '', 'db_fieldtype_check' => false, 'db_fields_cache' => true, 'db_charset' => 'utf8', 'db_deploy_type' => 0, 'db_rw_separate' => false, 'data_cache_time' => -1, 'data_cache_compress' => false, 'data_cache_check' => false, 'data_cache_type' => 'File', 'data_cache_path' => 'D:/wamp/www/Tflowg/Runtime/Temp/', 'data_cache_subdir' => false, 'data_path_level' => 1, 'error_message' => '您浏览的页面暂时发生了错误！请稍后再试～', 'error_page' => '/404.html', 'html_cache_on' => false, 'html_cache_time' => 60, 'html_read_type' => 0, 'html_file_suffix' => '.shtml', 'lang_switch_on' => false, 'lang_auto_detect' => true, 'log_exception_record' => true, 'log_record' => false, 'log_file_size' => 2097152, 'log_record_level' => array ( 0 => 'EMERG', 1 => 'ALERT', 2 => 'CRIT', 3 => 'ERR', ), 'page_rollpage' => 5, 'page_listrows' => 20, 'session_auto_start' => true, 'show_run_time' => false, 'show_adv_time' => false, 'show_db_times' => false, 'show_cache_times' => false, 'show_use_mem' => false, 'show_page_trace' => false, 'show_error_msg' => true, 'tmpl_engine_type' => 'Think', 'tmpl_detect_theme' => false, 'tmpl_template_suffix' => '.html', 'tmpl_content_type' => 'text/html', 'tmpl_cachfile_suffix' => '.php', 'tmpl_deny_func_list' => 'echo,exit', 'tmpl_parse_string' => '', 'tmpl_l_delim' => '{', 'tmpl_r_delim' => '}', 'tmpl_var_identify' => 'array', 'tmpl_strip_space' => false, 'tmpl_cache_on' => true, 'tmpl_cache_time' => -1, 'tmpl_action_error' => 'Public:success', 'tmpl_action_success' => 'Public:success', 'tmpl_trace_file' => './Core/Tpl/PageTrace.tpl.php', 'tmpl_exception_file' => './Core/Tpl/ThinkException.tpl.php', 'tmpl_file_depr' => '/', 'taglib_begin' => '<', 'taglib_end' => '>', 'taglib_load' => true, 'taglib_build_in' => 'cx', 'taglib_pre_load' => '', 'tag_nested_level' => 3, 'tag_extend_parse' => '', 'token_on' => true, 'token_name' => '__hash__', 'token_type' => 'md5', 'url_case_insensitive' => true, 'url_router_on' => false, 'url_route_rules' => array ( ), 'url_model' => 2, 'url_pathinfo_model' => 2, 'url_pathinfo_depr' => '/', 'url_html_suffix' => '.shtml', 'var_group' => 'g', 'var_module' => 'm', 'var_action' => 'a', 'var_router' => 'r', 'var_page' => 'p', 'var_template' => 't', 'var_language' => 'l', 'var_ajax_submit' => 'ajax', 'var_pathinfo' => 's', 'hash_code_key' => 'HashCode', 'user_auth_key' => 'UserID', 'attachdir' => 'D:/wamp/www/Tflowg/images/avatar', 'attachsize' => 2097192, 'attachext' => 'jpg,gif,png', ); ?>