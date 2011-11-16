<?php
/**
 * 
 * 关注接口
 * @author Leyteris
 *
 */
class FollowAction extends AccountAction{

	/**
	 * 
	 * 关注某用户
	 * @param mix $source
	 * @param int $id
	 */
	public function create_follower($source,$id){

		if(parent::verify_credentials($source)){
			
			if($id){
				if(!checkId32($id)){
					return 'F';
				}
			}
			
			$uid=$_SESSION['USER_OBJ']['id'];
			$objuid=$id;
			
			if($objuid == $uid){
				return 'F';
			}
			$user=M('User');
			$rs=$user->where('id = '.$objuid)
				->find();
				
			if(!$rs){
				return 'F';
			}
			
			$follow=M('Follow');
			$data=array();
			$data['uid']=$uid;
			$data['objuid']=$objuid;
			$ok=$follow->where($data)
				->count();
			if($ok){
				return 'F';
			}
			$data['fol_time']=time();
			$ars=$follow->add($data);
			if($ars){
				return 'T';
			}else{
				return 'F';
			}
		}else{
			return 'F';
		}
		
	}
	
	/**
	 * 
	 * 取消关注某用户
	 * @param mix $source
	 * @param int $id
	 */
	public function delete_follower($source,$id){
		
		if(parent::verify_credentials($source)){
			
			if($id){
				if(!checkId32($id)){
					return 'F';
				}
			}
			
			$uid=$_SESSION['USER_OBJ']['id'];
			$objuid=$id;
			
			$fol=M('Follow');
			$crs=$fol->where('uid='.$uid.' and objuid='.$objuid)
				->delete();
				
			if($crs){
				return 'T';
			}else{
				return 'F';
			}
		}else{
			return 'F';
		}
		
	}
}
?>