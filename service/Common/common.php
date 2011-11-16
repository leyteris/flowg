<?php
/**
 * 返回汉字长度1汉字=2
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
 * 替换字符串里面的多的空格为一个-,
 */
function replaceSpaceGang($str){
	if($str){
		return preg_replace('/\s/','-',$str);
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
 * 
 * 判断用户发言时间限制
 */
function checkSendTime(){
	$sconfig=F('site');
	$send_check=$sconfig['send_check'];
	if($send_check){
		$user=M('user');
		$rs=$user->find(getUserID());
		if(time()-$rs['create_time']<$send_check*60){//为零则不阻止
			echo "新注册用户".$send_check."分钟内禁止发微博！";exit;
		}
	}
}
?>