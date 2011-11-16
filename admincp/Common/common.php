<?php

/**
 * 
 * 取得网站目录
 */
function getFlcmsPath(){
	return __APP__.'/';
}

function getSession(){
	return Session::get(C('USER_AUTH_KEY'));
}

/**
 * 
 * 取得用户id
 */
function getUID(){
	$username=getSession();
	if($username){
		$u=M('User');
		$rsinfo=$u->where("userid='".$username."'")->find();
		if($rsinfo){
			return $rsinfo['id'];
		}else{
			return '0';	
		}
	}
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
 * 传入为时间戳
 * @param int $time
 */
function getTime($time){
	
	$re="";
	if($time){
		$re=date("Y-m-d H:i",$time);
	}
	
	return $re;
	
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

?>