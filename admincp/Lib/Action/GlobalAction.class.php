<?php
/**
 * @Date 2011.4.12
 * @File: GlobalAction.class.php
 * @Author Leyteris
 */
class GlobalAction extends Action{
	
	/**
	 * 
	 * 初始化函数
	 */
	function _initialize(){
		
		header("Content-Type:text/html; charset=utf-8");
        
    }
    
    /**
	 * 
	 * 显示网站信息
	 * @param String $title
	 */
	private function site($title=""){
		
		$sep=' - ';
		$data['title']=$title?$title.$sep.C('SYSTITL'):C('SYSTITL');
		$data['version']=C('FLCMS_VERSION');
		$data['copyright']=C('COPYRIGHT');
		$this->assign('site',$data);
		
	}
	
	/**
	 * 
	 * 用户登陆Action
	 */
	public function login(){
		
		$this->site('用户登陆');
		if(Session::is_set(C('USER_AUTH_KEY'))){
			$this->redirect('index/index');
			exit;
		}
		
		$this->display();
		
	}
	
	/**
	 * 
	 * 用户注销
	 */
	public function logout(){
		
		Session::set(C('USER_AUTH_KEY'),null);
		Session::destroy();
		$this->assign("jumpUrl",getFlcmsPath()."global/login"); 
		$this->success("注销成功 " );
		
	}
	
	/**
	 * 
	 * 检查登陆
	 */
	public function checkLogin(){
		
		load('extend');
		
		$userid=filterSpecial(H($_POST['username']));
		$passwd=filterSpecial(H($_POST['userpass']));
		
		if(empty($userid)||empty($passwd)){
			$this->error("所有信息必须输入！" ); 
			exit;
		}
		
        $logok=false;
		$user=M('User');
		$data=array();
		
		$data['userid']=$userid;
		$data['password']=md5($passwd);
		
		$rs=$user->where($data)->find();
		
		if($rs){	
			if($rs['roleid'] == 0){
				$this->error("您没有管理权限！" ); 
				exit;
			}
            $logok=true;
		}else{
			$this->error("密码或账号错误！" ); 
			exit;
        }
        
        if($logok){
			Session::set(C('USER_AUTH_KEY'),$userid);
			$this->assign("jumpUrl",getFlcmsPath()."index/index"); 
			$this->success("登录成功 " ); 
			exit;
        }else{
            $this->error("登录失败！" ); 
        }
	}

}
?>