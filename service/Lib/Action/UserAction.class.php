<?php
/**
 * 
 * 用户接口
 * @author Leyteris
 *
 */
class UserAction extends AccountAction{
	
	/**
	 * 
	 * 获取当前用户资料（授权用户）
	 */
	public function show_selfuser_info($source){
		
		if(parent::verify_credentials($source)){
			
			$user_obj = $_SESSION['USER_OBJ'];
			
			$fol=M('Follow');
			$tp=M("Topic");
			$fanCount=$fol->where('objuid='.$user_obj['id'])
							->count();
			$followCount=$fol->where('uid='.$user_obj['id'])
							->count();
			$topicCount=$tp->where('uid='.$user_obj['id'].' and status=1 and (type="first" or type="transmit")')
							->count();
			$user_obj['fanCount'] = $fanCount;
			$user_obj['followCount'] = $followCount;
			$user_obj['topicCount'] = $topicCount;
			
			return $user_obj;
		}else{
			
			return 'F';
		}

	}
	
	/**
	 * 
	 * 根据用户ID获取用户资料（授权用户）
	 * @param $source
	 * @param $id
	 */
	public function show_user_info($source,$id){
		
		if(parent::verify_credentials($source)){
			
			$user = M('User');
			
			$urs = $user->where('id = '.$id)->find();
			
			return $urs;
		}else{
			
			return 'F';
			
		}

	}

	/**
	 * 
	 * 取得关注的人
	 * @param int $id
	 */
	public function followers($id){
		echo 's';
		throw new Exception('asd', 1);
	}
	
	/**
	 * 
	 * 取得粉丝信息
	 * @param unknown_type $id
	 */
	public function fans($id){
		
	}
}

?>