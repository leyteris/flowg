<?php
/**
 * 
 * 取得网站目录
 */
function getFlowgPath(){
	return __APP__.'/';
}

/**
 * 
 * 取得上传地址
 */
function getUploadPath(){
	
	return APP_PATH.'/images/upload/';
	
}

/**
 * 
 * 取得页面显示图片目录
 */
function getShowPath(){
	
	return getFlowgPath().'images/upload/';
	
}

/**
 * 
 * 取得页面显示图片目录
 */
function getAvatarTempPath(){
	
	return getFlowgPath().'images/avatar/temp/';
	
}

/**
 * 
 * 检测账号
 * @param $content
 */
function checkUserName($content){
	
	$noname="adminsys,admincp,adminu,blog,index,user,public,install";
	if(stripos($noname,strtolower($content))===FALSE){
		
		//判断注册限制用户名 执行模糊匹配
		$siteconfig=F('site');
		$nouser=$siteconfig['no_user'];
		if(!empty($nouser)){
			
			$f=FALSE;
			$narr=explode("|",$nouser);
			for($i=0;$i<count($narr);$i++){
				
				if(stripos(strtolower($content),strtolower($narr[$i]))===FALSE){
					$f=FALSE;
				}else{
					$f=TRUE;
					break;
				}
			}
			return $f;
		}
	}else{
		return TRUE;
	}
}

/**
 * 返回汉字长度1汉字=2
 * @param $str
 */
function str_len($str){
	
    $length = strlen(preg_replace('/[\x00-\x7F]/', '', $str));
    if ($length){
        return strlen($str) - $length + intval($length / 3) * 2;
    }else{
        return strlen($str);
    }
}

/**
 * 
 * 页面中提取头像地址
 * @param $avatar
 * @param $type
 */
function getUserAvatar($avatar,$type=50){
	
	$avatarpath=getFlowgPath()."images/avatar/";
	$c="";
	if($type){
		$c=$type.'_';
	}
	if($avatar){
		return $avatarpath."flowg_".$c.$avatar;
	}else{
		return $avatarpath.'default_'.$c.'avatar.jpg';
	}
	
}
/**
 * 
 * 生成网站配置文件缓存
 */
function checkCache(){
	
	$site=FALSE;
	$site=F('site');
	if(!$site){
		$s=M('site');
		$rs=$s->find();
		F('site',$rs);
	}
	
}

/**
 * 
 * 过滤字符串里面的特殊字符
 * @param $content
 */
function filterHtmlCode($content){
	
    return preg_replace ("/<\/?[^>]*>/i","", $content);
}
/**
 * 
 * 过滤字符串里面的特殊字符
 * @param $content
 */
function filterSpecial($content){
	$content=strip_tags($content);
    $search = array ("'<script[^>]*?>.*?</script>'si","'([\r\n])'","'(\')'");                     
    $replace = array ("","","’");
    return preg_replace ($search, $replace, $content);
}

/**
 * 
 * 过滤多个空格为一个空格
 * @param $str
 */
function replaceSpaceGe($str){
	if($str){
		return preg_replace('/\s/',' ',$str);
	}
}

/**
 * 
 * 取得用户id
 */
function getUserID(){
	$user=getSession();
	if($user){
		$u=M('User');
		$rsinfo=$u->where("userid='".$user."'")->find();
		if($rsinfo){
			return $rsinfo['id'];
		}else{
			return '0';	
		}
	}
}

/**
 * 
 * 截取文章片段
 * @param $str
 * @param $len
 * @param $etc
 */
function cutText($str = '', $len = 0, $etc = ' ...') { 
	
	if(0 == $len) return "";

	$str_len = preg_match_all('/[\x00-\x7F\xC0-\xFD]/', $str, $dummy); 
	if($len >= $str_len){ 
		return $str; 
	}else{ 
		$newstr = mb_substr($str,0,$len,'utf-8'); 
		return $newstr.$etc; 
	} 
	
}
/**
 * 
 * 通过id取结果集id,userid,nickname
 * @param $name
 */
function getUserNameID($uid){
	
	if($uid){
		$u=M('User');
		$rs=$u->field('id,userid,nickname')->where("id=".$uid)->find();
		if($rs){
			if(!empty($rs['nickname'])){
				return $rs['nickname'];
			}else{
				return $rs['userid'];	
			}
		}else{
			return "火星";
		}
	}else{
		return "火星";
	}
	
}
/**
 * 
 * 取得session
 */
function getSession(){
	return Session::get(C('USER_AUTH_KEY'));
}

/**
 * 
 * 传入为时间戳
 * @param int $time
 */
function getTime($time){
	
	$re="";
	if($time){
		$sec=time()-$time;
		if($sec>=2*24*3600)
			$re=date("Y-m-d H:i",$time);
		else if(($sec>=24*3600)&&($sec<2*24*360))
			$re="1天前";
		else if($sec>3600)
			$re=intval($sec/3600).'小时前';
		else if($sec>120)
			$re=intval($sec/60).'分钟前';
		else
			$re=$sec.'秒前';
	}
	
	return $re;
	
}

/**
 * 
 * 传入为时间戳
 * @param int $time
 */
function getRealTime($time){
	
	$re="";
	if($time){
		$re=date("Y-m-d H:i",$time);
	}
	return $re;
	
}

/**
 * 
 * 检测是否是数字
 * @param $id
 */
function checkId32($id){
	
	if(preg_match("/^[0-9]*$/",$id)){
		return $id;
	}else{
    	return false;
	}
	
}

/**
 * 取得插入的东西
 * @param $content
 */
function getBlogReplay($content){
	
	$content=preg_replace ("/\((.+?)\.gif\)/i","<img src='".APP_TMPL_PATH."Public/images/icon/$1.gif' /> ", $content);
	
	return $content;
	
}


/**
 * 
 * 检测邮箱字符串
 * @param string $mail
 */
function ismail($mail){
	
	if ( ereg("^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9\-\.])+",$mail)){
		return true;
	}else{
		return false;
	}
	
}
function getCheckHttp($content){
	$sconfig=F('site');
	$http=$sconfig['http_check'];
	if($http){
		if($content){
			if(stripos($content,"http")===FALSE){
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}else{
		return FALSE;
	}
}
/**
 * 
 * 判断用户发言时间限制
 */
function checkSendTime($send_check){
	if($send_check){
		$user=M('user');
		$rs=$user->find(getUserID());
		if(time()-$rs['create_time']<$send_check*60){
			return false;
		}else{
			return true;
		}
	}
}


/**
 * 
 * 检测账号审核
 */
function checkUserStatus(){
	$user=M('User');
	$rs=$user->find(getUserID());
	if($rs['status']!=1){
		return false;
	}else{
		return true;
	}
}
/**
 * 
 * 过滤非法Tag
 * @param String $content
 */
function checkTag($content){	
	$site=F('site');
	$no_tag=$site['no_tag'];
	$arr=explode("|",$no_tag);
	$b = true;
	for($i=0;$i<count($arr);$i++){
		if($content == $arr[$i]){
			$b = false;
			break;
		}
	}
	return $b;
}
/**
 * 
 * 过滤非法Tag
 * @param String $content
 */
function replaceNoTag($content){	
	$site=F('site');
	$no_word=$site['no_word'];
	$arr=explode("|",$no_word);
	for($i=0;$i<count($arr);$i++){
		$content=str_replace($arr[$i],'**',$content);
	}
	return $content;
}
?>