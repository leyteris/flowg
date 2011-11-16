<?php
/**
 * @Date 2010.12.12
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
		checkCache();
        $this->assign('webpath',getFlowgPath());
        
    }
    
    /**
     * 
     * 令牌验证
     * 取得令牌原始字符
     * @param int $length
     */
    private function getHashCode($length=64){
    	
    	import('ORG.Util.String');
        $randval = String::rand_string($length);
        Session::set(C('HASH_CODE_KEY'),md5($randval));
        return $randval;
        
    }
    
    /**
     * 
     * 网站标题显示
     * @param string $title
     */
	private function site($title){
		
		$site=F('site');
		$site['title']=$title." - ".$site['title'];
		$this->assign('site',$site);
		//$this->assign('msg',$msg);
		
	}
	
	/**
	 * 
	 * 用户登陆Action
	 */
	public function login(){
		
		$this->site('用户登陆');
		$this->assign('hashCode',$this->getHashCode());
		if(Session::is_set(C('USER_AUTH_KEY'))){
			$this->redirect('index/index');
			exit;
		}
		
		$this->showList(6);
		
		$this->display();
		
	}
	
	/**
	 * 
	 * 用户注销
	 */
	public function logout(){
		
		Session::set(C('USER_AUTH_KEY'),null);
		Session::destroy();
		Cookie::delete('loginID');
		Cookie::delete('loginPWD');
		$site=F('site');
		header("location:".$site['domain']);
		
	}
	
	/**
	 * 
	 * 检查是否登陆
	 */
	public function checkLogin(){
		
		load('extend');
		import("ORG.IPA.MapService");
        $siteconfig=F('site');
        $ipaddress = get_client_ip();
		$userid=filterSpecial(H($_POST['username']));
		$passwd=filterSpecial(H($_POST['userpass']));
		$rememberme=filterSpecial(H($_POST['rememberme']));
		$hashCode=$_POST['hashCode'];
		$adrInfo=MapService::getIPaddress($ipaddress);
		if(empty($userid)||empty($passwd)){
			$this->error("所有信息必须输入！" ); 
			exit;
		}
		if($_SESSION[C('HASH_CODE_KEY')] != md5($hashCode)){
			$this->error("令牌错误，异常错误！" ); 
			exit;
		}
        $logok=false;
		$user=M('User');
		$data=array();
		$data['userid']=$userid;
		$data['password']=md5($passwd);
		$rs=$user->where($data)->find();
		if($rs){	
			if(!$rs['status']){
				$this->error("您的帐号还没有通过审核，暂时不能登陆系统" ); 
				exit;
			}
            $logok=true;
		}else{
			$this->error("密码或用户名错误" ); 
			exit;
        }
        
        if($logok){ 
            $updt['login_time']=time();
			$updt['login_ip']=$ipaddress;
			$updt['address']=$adrInfo;
			$user->where('id='.$rs['id'])->save($updt);
			if($rememberme){
				Cookie::set('loginID',$userid,60*60*24*7);
				Cookie::set('loginPWD',md5($passwd),60*60*24*7);
				//echo Cookie::get('loginPWD');
			}
			Session::set(C('USER_AUTH_KEY'),$userid);
			$this->assign("jumpUrl",getFlowgPath()."index"); 
			$this->success("登录成功 " ); 
			//$this->redirect('index/index');
			exit;
        }else{
            $this->error("登录失败！" ); 
        }
	}
	
	/**
	 * 
	 * 显示注册页面
	 */
    public function register(){
    	
    	$siteconfig=F('site');
    	$this->assign('thisSiteURL',getFlowgPath());
		$this->site('用户注册');
	    $this->display();
    }
    
    /**
     * 
     * ajax更新login页面列表项
     */
    public function ajaxShowListBody(){
    	
    }
    
    /**
     * 
     */
    public function showList($len = 5){
    	
    	$topic=M('Topic');
    	
    	$list=$topic->where('status=1 and type="first"')->order('id desc')->limit($len)->select();
    	
    	foreach($list as $key=>$topic){
    		
			$user = D('User');
			
			$volist = $user->getInfo($topic['uid'],"nickname,homepage,avatar");
			$list[$key]['avatar']=$volist['avatar'];
			$list[$key]['nickname']=$volist['nickname'];
			$list[$key]['homepage']=$volist['homepage'];
			$list[$key]['content']=getBlogReplay($list[$key]['content']);
			$list[$key]['topiccreate_time'] = getTime($list[$key]['create_time']);//strtotime  String =>int
		}
		
    	$this->assign('list',$list);
    	
    }
	/**
	 * 
	 * 注册action
	 */
	public function registerSubmit(){
		
		$siteconfig=F('site');
		
		load('extend');
		$invitecode=filterSpecial(H($_POST['invitecode']));
		if(!$invitecode){
			if(!$siteconfig['is_reg']){
				$this->error("系统已经关闭注册，请联系系统管理员");
				exit;
			}	
		}else{
			$in=M('Invite');
			
			$where['code']=$invitecode;
			$rs=$in->where($where)->find();
			if($rs){
				if($rs['is_use']==1){
					$this->error("已经使用过的邀请码");
					exit;
				}
			}else{
				$this->error("不存在的激活码");
				exit;
			}
		}
		$userid=filterSpecial(H($_POST['username']));
		$passwd=filterSpecial(H($_POST['userpass']));
		$repasswd=H($_POST['repass']);
		$nickname=filterSpecial(H($_POST['nickname']));
		$verifycode=filterSpecial(H($_POST['V']));
		$mail=$_POST['email'];
		$temp_user=$temp_home="";
		if(empty($userid)||empty($passwd)||empty($verifycode)){
			$this->error("所有信息必须输入");
			exit;
		}
		if($_SESSION['verify'] != md5($verifycode)){
			$this->error("验证码错误");
			exit;
		}
		if(checkUserName($userid)){
			$this->error("禁止注册的用户名");
			exit;
		}
		if(checkUserName($homepage)){
			$this->error("禁止注册的个人主页名称");
			exit;
		}
		if((str_len($userid)>=5)&&(str_len($userid)<=20)){
			$temp_user=$userid;
		}else{
			$this->error("用户名长度错误，长度必须是5-20位");
			exit;
		}
		if(!preg_match("/^[0-9a-zA-Z]{6,16}$/",$passwd)){
			$this->error("密码不能含有特殊字符，长度必须是6-16位");
			exit;
		}
		if($passwd!=$repasswd){
			$this->error("两次密码必须一致");
			exit;
		}
		//判断注册限制用户名 执行模糊匹配
		if(checkUserName($temp_home)){
			$this->error("禁止使用的个人主页名称");
			exit;
		}
		if(checkUserName($temp_user)){
			$this->error("禁止使用的登陆帐号");
			exit;
		}
		if(!ismail($mail)){
			$this->error("错误的电子邮件格式");
			exit;
		}

		$user=M('User');
		$cdata=array();
		$cdata['userid']=$temp_user;
		if($user->where($cdata)->find()){
			$this->error("该用户名已经存在,请更换一个");
			exit;
		}
		if($user->where("mail='".$mail."' and status=1")->find()){
			$this->error("该电子邮件已经存在");
			exit;
		}

		$ip_check=$siteconfig['ip_check'];
		if($ip_check){
			$ip=get_client_ip();
			$iprs=$user->where("create_ip='".$ip."'")->order('id desc')->find();
			if(time()-$iprs['create_time']<$ip_check*60){
				$this->error("同IP".$ip_check."分钟内限制注册");
				exit;
			}
		}
		$u_status=0;
		$msg="";

		if($siteconfig['is_invite']){
			$u_status=1;
		}else{

			if($siteconfig['mail_check']){
				if($siteconfig['user_check']){
					$u_status=0;
					$msg="请先通过您的email激活然后等待人工审核";
				}else{
					$u_status=0;
					$msg="请通过email激活您的帐号";
				}
			}else{
				if($siteconfig['user_check']){
					$u_status=0;
					$msg="等待人工审核";
				}
				else
					$u_status=1;
			}	
		}
        //uc
        
		$arr=array();
		$arr['userid']=$temp_user;
		$arr['nickname']=$nickname;
		$arr['homepage']=$temp_user;
		$arr['password']=md5($passwd);
		$arr['create_time']=time();
		$arr['create_ip']=get_client_ip();
		$arr['email']=$mail;
		$arr['address']='';
		$arr['status']=$u_status;
		$ok=$user->add($arr);
		if($ok){
			if($u_status)
				Session::set(C('USER_AUTH_KEY'),$temp_user);
			if($invitecode){
				//销毁邀请码
				$in=M('invite');
				$in->where("code='".$invitecode."'")->setField('is_use',1);
				//	
			}
			//发送邮件
			if($siteconfig['mail_check']){
					$htmlbody=$siteconfig['mailtext'];
					$mailcode=uniqid();
					S($mailcode,$ok,24*3600);
					if($htmlbody){
						$path=$siteconfig['app_path']?"/".$siteconfig['app_path']."/":"";
						$htmlbody=str_replace("@userid@",$temp_user,$htmlbody);
						$htmlbody=str_replace("@site@",$siteconfig['ftitle'],$htmlbody);
						$htmlbody.="<a href='".$siteconfig['domain'].$path.U("public/checkmail?code=".$mailcode."")."'>激活连接</a>,如果不能点击请复制到浏览器中激活".$siteconfig['domain'].$path.U("public/checkmail?code=".$mailcode."")."";
					}
					$mailtitle="来自".$siteconfig['ftitle']."的激活邮件";
					sendMail($mail,$mailtitle,$htmlbody);
			}
			//echo '恭喜您注册成功'.$msg;
			$this->assign("jumpUrl",$siteconfig['domain']."/index"); 
			$this->success("恭喜您注册".$msg); 
		}
		else{
			$this->error("注册失败".$msg);
		}
	}
	
	/**
	 * 
	 * 验证码图片输出函数
	 */
	public function verify(){   
		import("ORG.Util.Image");   
		Image::buildImageVerify();   
	}
}
?>