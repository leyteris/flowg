<?php
/**
 * @Date 2010.12.12
 * @File: CommonAction.class.php
 * @Author Leyteris
 */
class CommonAction extends Action{
	
	protected $userDetail = array();
	
	/**
	 * 
	 * 初始化
	 */
	function _initialize(){
		
		header("Content-Type:text/html; charset=utf-8");
		checkCache();//生成网站总体配置
		$this->autoLogin();
		$this->open();
		$this->showLoginUserInfo();
		
    }
    
    /**
     * 
     * 访问网站是否需要登陆
     */
	public function open(){
		

		if(!$this->isLoginBool()){
			$this->redirect('global/login');
		}
		
		load('extend');
		
		$this->assign('uploadpath',getUploadPath());
		$this->assign('toptag',$this->getHotTag());
		$this->assign('hotman',$this->getHotMan());
		$this->assign('webpath',getFlowgPath());
		
	}
	
	/**
	 * 
	 * Cookie验证登陆
	 */
	public function autoLogin(){
		
		if(!$this->isLoginBool()){
			$loginID=$loginPWD=NULL;
			if(Cookie::is_set("loginID"))
				$loginID=Cookie::get("loginID");
			if(Cookie::is_set("loginPWD"))
				$loginPWD=Cookie::get("loginPWD");
			if($loginID&&$loginPWD){
				$user=D('User');
				$user->checkAutoLogin($loginID,$loginPWD);	
			}
		}
		
	}
	
	/**
	 * 
	 * 显示登陆用户信息
	 */
	protected function showLoginUserInfo(){
		
		$rs = array();
		$isadmin = 0;
		$isLogin = 0;
		if($this->isLoginBool()){
			$user=M('User');
			$rs=$user->find(getUserID());
			$isLogin=1;
			if($rs['roleid']==1){
				$isadmin=1;
			}else{
				$isadmin=0;
			}
		}else{
			$isLogin=0;
			$isadmin=0;
		}
		$this->assign('userinfo',$rs);
		
		//显示关注信息
		$fol=M('Follow');
		$fans=$fol->where('objuid='.$rs['id'])->count();
		$follows=$fol->where('uid='.$rs['id'])->count();
		$this->assign('loginUserFans',$fans);
		$this->assign('loginUserFollows',$follows);
		
		//获得所发微博数
		$tp=M("Topic");
		$tpcount=$tp->where('uid='.$rs['id'].' and status=1 and (type="first" or type="transmit")')->count();
		$this->assign('loginUserTpCount',$tpcount);
		
		$this->assign('isadmin',$isadmin);
		$this->assign('isLogin',$isLogin);
		
		//获取style属性
		if($rs['styleid']){
			$st = M('Style');
			$strs=$st->where('id='.$rs['styleid'])->find();
			if($strs){
				$this->assign('stylers',$strs);
			}
		}
		
		$this->userDetail=$rs;
		
		
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
			$this->error('您还没有登陆或者登陆已经超时，请重新登陆系统！');
			exit;
		}
		
	}
	
	/**
	 * 
	 * 用于ajax
	 */
	public function isAjaxLogin(){
		
		if(!Session::is_set(C('USER_AUTH_KEY'))){
			$this->ajaxReturn(null,'您还没有登陆微博！',0,null);
			exit;
		}
		
	}
	
	/**
	 * 
	 * 重定向到首页
	 */
	public function flowgIndex(){
		
		$site=F('site');
		$domain=$site['domain'];
		redirect($domain);
		
	}
	
	/**
	 * 
	 * 显示网站信息
	 * @param String $title
	 * @param String $key
	 * @param String $des
	 * @param String $copy
	 */
	protected function showSiteInfo($title="",$key="",$des="",$copy=""){
		
		$site=F('site');
		$sep=' - ';
		$data['title']=$title?$title.$sep.$site['title']:$site['title'];
		$data['ftitle']=$site['ftitle'];
		$data['version']=$site['version'];
		$data['keyword']=$key?$key.$sep.$site['keyword']:$site['keyword'];
		$data['description']=$des?$des.$sep.$site['description']:$site['description'];
		$data['copyright']=$copy?$copy.$sep.$site['copyright']:$site['copyright'];
		$data['domain']=$site['domain'].'/';
		$data['text_len']=$site['text_len'];
		$this->assign('site',array_merge($site,$data));
		
	}
	
	/**
	 * 
	 * 取得热门话题
	 * @param int $len
	 */
	protected function getHotTag($len = 8){
		
		$tv = D('Tagview');
		$list =  $tv->field('id,tagname,count')->where("Topic.status=1")->group("Tag.id")->order("Count desc")->limit($len)->select();
		return $list;
		
	}
	
	/**
	 * 
	 * 取得可能感兴趣的人
	 * @param int $len
	 */
	protected function getMayInt($len = 2){
		
		$tv = D('Tagview');
		$list =  $tv->field('id,tagname,count')->where("Topic.status=1")->group("Tag.id")->order("Count desc")->limit($len)->select();
		return $list;
		
	}
	
	/**
	 * 
	 * 取得可能感兴趣的人
	 * @param int $len
	 */
	protected function getHotMan($len = 3){
		
		$u=D('Hotuserview');

		$list=$u->where("User.status=1")
			->order('Count desc')
			->group("User.id")
			->limit($len)
			->select();
		return $list;
		
	}

}
?>