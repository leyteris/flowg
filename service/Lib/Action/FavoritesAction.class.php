<?php
/**
 * 
 * 收藏接口
 * @author Leyteris
 *
 */
class FavoritesAction extends AccountAction{

	/**
	 * 
	 * 收藏某微博
	 * @param mix $source
	 * @param int $tid
	 */
	public function create_favorite($source,$tid){
		
		if(parent::verify_credentials($source)){
			
			if($tid){
				if(!checkId32($tid)){

					return 'F';
				}
			}
			$fav = M('Favorites');
			$data['uid'] = $_SESSION['USER_OBJ']['id'];
			$data['tid'] = $tid;
			$crs=$fav->where($data)
				->find();
				
			if(!$crs){
				$data['create_time']=time();
				if($fav->add($data)){
					return $data;
				}else{
					return 'F';
				}
			}else{
				return 'F';
			}
		}else{
			return 'F';
		}
	}
	
	/**
	 * 
	 * 取消收藏某微博
	 * @param mix $source
	 * @param int $tid
	 */
	public function delete_favorite($source,$tid){

		if(parent::verify_credentials($source)){
			
			if($tid){
				if(!checkId32($tid)){

					return 'F';
				}
			}
			
			$fav=M('Favorites');
			
			$crs=$fav->where('uid='.$_SESSION['USER_OBJ']['id'].' and tid='.$tid)->delete();
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