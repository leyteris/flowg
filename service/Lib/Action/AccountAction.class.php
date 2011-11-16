<?php
/**
 * 
 * 检测账号登陆状态
 * @author Leyteris
 *
 */
class AccountAction extends Action{
	/*
	protected $error;
	protected function __construct(){
		import( '@.Common.ErrorUtil' );
		$error = new ErrorUtil();
	}
	*/
	/**
	 * 
	 * 设置单体session
	 */
	private function set_singleton_session($source,$user_obj){
		if (!isset($_SESSION['USER_AUTH_KEY'])) {  
            $_SESSION['USER_AUTH_KEY'] = $source;  
            $_SESSION['USER_OBJ'] = $user_obj;  
        }  
        return $source;
	}
	
	/**
	 * 
	 * 登录检测
	 */
	protected function verify_credentials($source) {  
		if(isset($_SESSION['USER_AUTH_KEY']) && $_SESSION['USER_AUTH_KEY'] == $source){
			if(isset($_SESSION['USER_OBJ'])){
				return 'T';
			}
			return 'F';
		}{
			return 'F';
		}
	}  
	
	/**
	 * 
	 * 读取当前登陆user
	 * @param $source
	 */
	protected function get_selfuser(){
		if(isset($_SESSION['USER_OBJ'])){
			return $_SESSION['USER_OBJ'];
		}else{
			return 'F';
		}
	}
	
	/**
	 * 
	 * 登陆检测
	 */
	public function check_login($account,$password){
		$user = M('User');
		$urs = $user->where('userid = "'.$account.'" and password="'.md5($password).'"')->find();
		if($urs){
			import('ORG.Util.String');
        	$randval = String::rand_string(20);
			return $this->set_singleton_session(md5($account.$randval.$password),$urs);
		}else{
			return 'F';
		}
		
	}
	
	/**
	 * 
	 * 注销用户
	 * @param mix $source
	 */
	public function end_session($source){
		Session::set('USER_AUTH_KEY',null);
		Session::set('USER_OBJ',null);
		Session::destroy();
	}
	

}
?>