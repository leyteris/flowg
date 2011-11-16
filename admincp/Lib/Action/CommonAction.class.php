<?php
/**
 * @Date 2011.4.12
 * @File: CommonAction.class.php
 * @Author Leyteris
 */
class CommonAction extends Action {

	/**
	 * 
	 * 初始化
	 */
	function _initialize(){
		
		define('USERRIGHT','1');
		define('SYSRIGHT','2');
		define('TAGRIGHT','3');
		define('TOPICRIGHT','4');
		define('NEWSRIGHT','5');
		define('STYLERIGHT','6');
		define('DELRIGHT','7');
		define('EDITRIGHT','8');
		define('CRERIGHT','9');
		define('ISSUPER','0');
		
		header("Content-Type:text/html; charset=utf-8");
		$this->open();
		
    }
    
    /**
     * 
     * 访问网站是否需要登陆
     */
	public function open(){
		
		load('extend');
		
		if(!$this->isLoginBool()){
			$this->redirect('global/login');
		}
		
	}
	
	/**
	 * 
	 * 判断登陆
	 * @return boolean
	 */
	public function isLoginBool(){
		
		if(!Session::is_set(C('USER_AUTH_KEY'))){
			return false;
		}else{
			return true;
		}
		
	}

	/**
	 * 
	 * 普通提示
	 */
	public function isLogin(){
		
		if(!Session::is_set(C('USER_AUTH_KEY'))){
			$this->assign("jumpUrl",getFlcmsPath()."global/login"); 
			$this->error('您还没有登陆或者登陆已经超时，请重新登陆系统！');
			exit;
		}
		
	}

	/**
	 * 
	 * 显示网站信息
	 * @param String $title
	 */
	protected function showSiteInfo($title=""){
		
		$sep=' - ';
		$data['systitle']=C('SYSTITL');
		$data['title']=$title?$title.$sep.C('SYSTITL'):C('SYSTITL');
		$data['version']=C('FLCMS_VERSION');
		$data['copyright']=C('COPYRIGHT');
		$this->assign('site',$data);
		
	}
	
	/**
	 * 
	 * 检查权限
	 */
	function checkRight($op){
		
		$uid = getUID();
		$model = D("Adminview");
		$ulist = $model->where("User.id='".$uid."'")
					->find();
		if(!isset($op)){
			exit;
		}else{
			switch($op){
				case USERRIGHT:
					if($ulist['user_right'] != '1'){
						$this->error('您没有管理用户权限，请联系超级管理员');
						exit;
					}
					break;
				case SYSRIGHT:
					if($ulist['sys_right'] != '1'){
						$this->error('您没有系统管理权限，请联系超级管理员');
						exit;
					}
					break;
				case TAGRIGHT:
					if($ulist['tag_right'] != '1'){
						$this->error('您没有话题管理权限，请联系超级管理员');
						exit;
					}
					break;
				case TOPICRIGHT:
					if($ulist['topic_right'] != '1'){
						$this->error('您没有微博管理权限，请联系超级管理员');
						exit;
					}
					break;
				case NEWSRIGHT:
					if($ulist['news_right'] != '1'){
						$this->error('您没有管理公告权限，请联系超级管理员');
						exit;
					}
					break;
				case STYLERIGHT:
					if($ulist['style_right'] != '1'){
						$this->error('您没有管理皮肤权限，请联系超级管理员');
						exit;
					}
					break;
				case DELRIGHT:
					if($ulist['del_right'] != '1'){
						$this->error('您没有删除权限，请联系超级管理员');
						exit;
					}
					break;
				case EDITRIGHT:
					if($ulist['edit_right'] != '1'){
						$this->error('您没有编辑权限，请联系超级管理员');
						exit;
					}
					break;
				case CRERIGHT:
					if($ulist['cre_right'] != '1'){
						$this->error('您没有创建权限，请联系超级管理员');
						exit;
					}
					break;
				case ISSUPER:
					if($ulist['issuper'] != '1'){
						$this->error('您还不是超级管理员，请联系现有超级管理员');
						exit;
					}
					break;
				default:
					$this->error('系统出错！');
			}
			
		}
		
	}
    
}