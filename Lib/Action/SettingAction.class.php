<?php
/**
 * @Date 2011.1.10
 * @File: SettingAction.class.php
 * @Author Leyteris
 */
class SettingAction extends CommonAction{

	/**
	 * 
	 * 入口控制器
	 */
	public function index(){
		
		parent::islogin();
		parent::showSiteInfo('个人设置');
		
		$this->assign('menu_item',0);
        $this->display();
        
	}
	
	/**
	 * 
	 * Setting提交Action
	 */
	public function doSetting(){
		
		$user=D('User');
		
		$nickname=filterSpecial(H($_POST['nickname']));
		$mail=$_POST['email'];
		//$verifycode=filterSpecial(H($_POST['V']));
		$personalpage=$_POST['personalpage'];
		$msn=$_POST['msn'];
		$qq=checkId32($_POST['qq']);
		$mobile=checkId32($_POST['mobile']);
		$memo=filterSpecial(H($_POST['memo']));
		
		$data['nickname']=$nickname;
		$data['email']=$mail;
		$data['personalpage']=$personalpage;
		$data['msn']=$msn;
		$data['qq']=$qq;
		$data['mobile']=$mobile;
		$data['memo']=$memo;
		
		if ($user->updateInfo($data,getUserID())) {
        	$this->assign("jumpUrl",getFlowgPath()."setting/index"); 
			$this->success("设置成功");
        }else {
        	$this->error("设置失败");
        }
		/*if($user->updateInfo($data,getUserID())){
			$this->ajaxReturn(null,"设置成功",1,'json');
		}else{
			$this->ajaxReturn(null,"设置失败",0,'json');
		}*/
		
	}
	
	/**
	 * 
	 * 显示头像设置页面控制器
	 */
	public function setAvatar(){
		
		parent::islogin();
		parent::showSiteInfo('头像设置');
		$this->assign('menu_item',1);
		$this->assign('cutimg',0);
        $this->display('Setting:index');
        
	}
	
	/**
	 * 
	 * 上传临时文件，并显示cut页面
	 */
	public function doCutimg(){
		
		parent::islogin();
		
		parent::showSiteInfo('头像裁剪');
		$this->assign('menu_item',1);
		$this->assign('cutimg',1);

		$result =$this->upload('temp');
		if (!is_array($result)){
			$this->redirect('setAvatar');
		}else{
		   $this->assign('imgurl', getAvatarTempPath() . $result[0]['savename']);
		   $this->assign('imgname', $result[0]['savename']);
		   $this->display('Setting:index');
		}
		
        $this->display('Setting:index');
		
	}
	
	public function doSetAvatar(){
		
	 	parent::islogin();
	 	
		if (!empty($_POST['cut_pos'])){
			
			import('Com.ImageResize');
		    $imgresize = new ImageResize(); 
		    $url = C('ATTACHDIR') . '/temp/' . trim($_POST['imgname']);
		    $imgresize->load($url);
		    $posary = explode(',', $_POST['cut_pos']);
		    foreach($posary as $k => $v)
		    $posary[$k] = intval($v);
			if ($posary[2] > 0 && $posary[3] > 0){
				$imgresize->resize($posary[2], $posary[3]);
			}
			$uico = time().rand(100,999).'.jpg';
			$path = C('ATTACHDIR') . '/';
			
			// save 120*120 image
			$imgresize->cut(120, 120, intval($posary[0]), intval($posary[1]));
			$large = 'flowg_120_' . $uico;
			$imgresize->save($path.$large);
			$imgresize->resize(50,50);
			$small = 'flowg_50_' . $uico;
			$imgresize->save($path.$small,true);
			unlink($url);
			if($uico){
				$user=D('User');
				$s=$this->assign('info',$user->getInfo(getUserID(),'id,avatar'));
				if($s['avatar']){
					unlink($path.'flowg_120_'.$s['avatar']);
					@unlink($path.'flowg_50_'.$s['avatar']);
				}
				$data=array();
				$data['avatar']=$uico;
				$ok=$user->updateInfo($data,getUserID());
				if($ok){
					$this->redirect('setAvatar');
				}else{
					$this->error('发生错误');
				}
			}
		}else{ 
			$this->error('发生错误');
		}
	}
	
	/**
	 * 
	 * 显示密码设置页面控制器
	 */
	public function setPassword(){
		
		parent::islogin();
		parent::showSiteInfo('密码设置');
		$this->assign('menu_item',2);
        $this->display('Setting:index');
        
	}
	
	public function doSetPassword(){
		
		parent::islogin();
		
		$user=D('User');
		
		$pw=filterSpecial(H($_POST['passwd']));
		$rpw=filterSpecial(H($_POST['repasswd']));
		
		if($pw!=$rpw){
			$this->ajaxReturn(null,"两次密码必须相同",0,'json');
			exit;
		}
		
		$data['password']=$nickname;
		
		if($user->updateInfo($data,getUserID())){
			$this->ajaxReturn(null,"设置成功",1,'json');
		}else{
			$this->ajaxReturn(null,"设置失败",0,'json');
		}
        
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
    
	public function upload($module = '', $path = '', $thumb = '', $width = '', $height = ''){
	 	
		parent::islogin();
	 	
		$module = $module = ""?'temp':$module;
		switch ($module){
		   case 'temp':$path = C('ATTACHDIR') . '/temp/' . $path;
				break;
		   default:$path = C('ATTACHDIR') . '/file/' . $path;
		}
		if (!is_dir($path)) @mk_dir($path);
		import("ORG.Net.UploadFile");
		$upload = new UploadFile();
		$upload->maxSize = C(ATTACHSIZE);
		$upload->allowExts = explode(',', strtolower(C(ATTACHEXT)));
		$upload->savePath = $path;
		$upload->saveRule = 'uniqid';
		empty($thumb)?$upload->thumb = C(ATTACH):$upload->thumb = $thumb;
		empty($width)?$upload->thumbMaxWidth = C(THUMBMAXWIDTH):$upload->thumbMaxWidth = $width;
		empty($height)?$upload->thumbMaxHeight = C(THUMBMAXHEIGHT):$upload->thumbMaxHeight = $height;
		if (!$upload->upload()){
			return $this->error($upload->getErrorMsg());
		}else{
			return $upload->getUploadFileInfo();
		}
		
	 }
	 
	 public function setStyle(){
	 	
	 	parent::islogin();
	 	import("ORG.Util.Page");
		$st = M("Style");
		
        $count = $st->count();
        $listRows = 20;
        $p = new Page($count, $listRows);
        
        $list =  $st->limit($p->firstRow.','.$p->listRows)->select();

        $page = $p->show();
        $this->assign("stlist", $list);
        $this->assign("page", $page);
	 	$this->assign('thisStyle',$this->userDetail['styleid']);
	 	
		parent::showSiteInfo('皮肤设置');
		$this->assign('menu_item',3);
        $this->display('Setting:index');
	 	
	 }
	 
	 public function doSetStyle(){
	 	
	 	parent::islogin();
		$st = M("Style");
		$styleId=$_REQUEST['styleId'];
		if($styleId == '0'){
			$strs = true;
		}else{
			$styleId = checkId32($styleId);
			$strs = $st->where('id = '.$styleId)->find();
		}
		if($strs){
			$user = D('User');
			$data['styleid']=$styleId;
			$bi = $user->updateInfo($data,getUserID());
			if($bi){
				$this->ajaxReturn(null,'皮肤设置成功',1,null);
			}else{
				$this->ajaxReturn(null,'皮肤设置失败',0,null);
			}
		}else{
			$this->ajaxReturn(null,'皮肤异常',0,null);
		}
	 	
	 }
    
}

?>