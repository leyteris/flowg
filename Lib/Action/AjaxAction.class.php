<?php
/**
 * @Date 2010.12.15
 * @File: AjaxAction.class.php
 * @Author Leyteris
 */
class AjaxAction extends CommonAction{
	
    /**
     * 
     * Ajax 返回转发评论列表
     * 接受参数：tid
     */
    public function showReplyList(){
    	
    	parent::isAjaxLogin();
    	
    	$flag = false;
    	$tid=checkId32($_GET['tid']);
    	if($tid){
	    	$nowtopic=D('Topic');
			$trs=$nowtopic->getInfo($tid);
			if($trs){
				$user=M('User')->getTableName();
				$topic=M('Topic')->getTableName();
				
				$Model = new Model();
				$topicvo = $Model->query("select t.id,t.content,t.create_time,t.from,u.nickname,u.homepage from ".$topic." t,".$user." u where t.rootid=".$tid." and t.uid=u.id order by id desc");
				if($topicvo){
					foreach($topicvo as $key=>$tp){
						$tp['content']=getBlogReplay($tp['content']);
						$topicvo[$key]['topiccreate_time'] = getTime($tp['create_time']);
					}
					$this->ajaxReturn($topicvo,'成功提取列表',1,'json');
				}else{
					$this->ajaxReturn(null,'该微博没有转发和评论',0,null);
				}

				
			}else{
				$flag=true;
			}
    	}else{
    		$flag=true;
    	}	
		
		if($flag){
			$this->ajaxReturn(null,'该微博不存在！',0,null);
			exit;
		}
    	
    	
    }
    
    /**
     * 
     * Ajax 插入微博
     * 接受参数：content,tid
     */
    public function ajaxInsertTopic(){
    	
		parent::isAjaxLogin();
    	if(!checkUserStatus()){
			$this->ajaxReturn(null,'账号未通过审核',0,null);
			exit;
		}
		$content=trim(filterSpecial(H($_POST['content'])));//过滤恶意代码
		$uid=getUserID();
		$tagid=$_POST['tid'];
		if($tagid){
			if(!checkId32($tagid)){
				$this->ajaxReturn(null,'信息错误',0,null);
				exit;
			}
		}
		$sconfig=F('site');
		$send_check=$sconfig['send_check'];
		if(checkSendTime($send_check)){
			$this->ajaxReturn(null,'新注册用户'.$send_check.'分钟内禁止发微博！',0,null);
			exit;
		}
		if(empty($content)){
			$this->ajaxReturn(null,'内容不能为空！',0,null);
			exit;
		}else{
			$user=M('User');
			$content=replaceSpaceGe($content);//过滤多个空格为一个空格
			preg_match_all('/@(\S+)\s/i',$content,$me);
			$aboutme=array();
			$aboutme=$me[1];
			$oldme=array();
			$okme=array();
			foreach ($aboutme as $k=>$v){
				$oldme[$k]='/@'.$v.'/';
				$where['homepage']=$v;
				$rs=$user->where($where)->find();
				if(!$rs){
					$aboutme[$k]='@'.$v.' ';
				}else{
					$userpath=getFlowgPath().$v;
					$okme[]=$v;
					$aboutme[$k]="<a href='".$userpath."' target='_blank'>@".$v."</a>";
				}
			}
			$content=preg_replace($oldme,$aboutme,$content);//生成带有“@关于我”链接的内容
			
			if(substr_count($content,"#") > 1){ //如果有话题的话
				
				$s1=stripos($content,"#");
				$subject="";
				if($s1!==false){
					$s2=stripos($content,"#",$s1+1);
					$subject=substr($content,($s1+1),$s2-($s1+1));
				}
				if($subject=="插入话题"){
					$this->ajaxReturn(null,'请更改话题的名称！',0,null);
					exit;
				}	
				if(!checkTag($subject)){
					$this->ajaxReturn(null,'非法话题！',0,null);
					exit;
				}
			}
			$data=array();
			if(!empty($subject)){
				$sub=M("Tag");
				$subrs=$sub->where("tagname='".$subject."'")->find();
				if($subrs){
					$tagid=$subrs['id'];
				}else{
					$sdata=array();
					$sdata['tagname']=$subject;
					$sdata['create_time']=time();
					$sdata['create_uid']=$uid;
					$tagid=$sub->add($sdata);					
				}
			}
			
			$attpic=$_POST['attpic'];
			if($attpic){
				if(!checkId32($attpic)){
					$this->ajaxReturn(null,'图片信息错误',0,null);
					exit;
				}
			}
			
			$status=1;
			$tagid = $tagid ? $tagid : 0;
			if($tagid){
				$tagpath=U('tag/index')."?tagid=".$tagid;
				$content=preg_replace('/#' . $subject . '#/',"<a href='".$tagpath."' target='_blank'>#".$subject."#</a>",$content);
			}
			$data['imgid'] = $attpic && $attpic != '0' ? $attpic : 0;
			$data['content']=replaceNoTag($content);
			$data['uid']=$uid;
			$data['create_time']=time();
			$data['rootid']=0;
			$data['tagid']=$tagid;
			$data['status']=$status;
			$topic=M('Topic');
			$rsid=$topic->add($data); //插入数据
			
			if(!$rsid){
				$this->ajaxReturn(null,'数据写入错误！',0,null);
			}else{
				$ab=M('Mention');
				foreach ($okme as $k=>$v){//提到我的
					
					$urs=$user->where("homepage='".$v."'")->find();
					$adata['uid']=$urs['id'];
					$adata['tid']=$rsid;
					
					$ars=$ab->where($adata)->find();
					
					if(!$ars){
						$adata['create_time']=time();
						$ab->add($adata);
					}
					
				}

				$vouser=D('User');
				$vouserlist = $vouser->getInfo($uid,"nickname,homepage");
				$vo['id']=$rsid;
				$vo['nickname']=$vouserlist['nickname'];
				$vo['homepage']=$vouserlist['homepage'];
				$vo['content'] =getBlogReplay(nl2br($data['content']));
				$vo['create_time'] = getTime($data['create_time']);
				$vo['from'] = $vo['from'] ? nl2br($data['from']) : 'Web';
				$vo['imgid'] = $data['imgid'];
				if($vo['imgid'] != '0'){
					$voimg=M('Image');
					$voimglist=$voimg->find($vo['imgid']);
					$vo['imgurl'] = $voimglist['url'];
					$vo['imgthumb_url']=$voimglist['thumb_url'];
				}
				$this->ajaxReturn($vo,'发布成功！',1,'json');
			}
		}
	}
	
	
	/**
	 * 
	 * ajax 回复
	 * 接受参数：content,tid,isTransmit
	 */
	public function ajaxReply(){
		
		parent::isAjaxLogin();
	    if(!checkUserStatus()){
			$this->ajaxReturn(null,'账号未通过审核',0,null);
			exit;
		}
		$site=F('site');
		if(!$site['comment_open']){
			$this->ajaxReturn(null,'系统已经关闭评论！',0,null);
			exit;
		}
		
		$returnText = '转发成功';
		$topicid=0;
		$content=trim(filterSpecial(H($_POST['content'])));
		$topicid=checkId32($_POST['rootid']);
		$isTransmit=checkId32($_POST['isTransmit']) ? true : false;
		if(!$topicid){
			$this->ajaxReturn(null,'发生错误！',0,null);
			exit;
		}
		$user=M('User');
		//判断用户发言时间限制
		$sconfig=F('site');
		$send_check=$sconfig['send_check'];
		if(checkSendTime($send_check)){
			$this->ajaxReturn(null,'新注册用户'.$send_check.'分钟内禁止发微博！',0,null);
			exit;
		}
		//
		if(empty($content)){
			$this->ajaxReturn(null,'内容不能为空！',0,null);
			exit;
		}else{	
			$ok=false;
			
			preg_match_all('/@(\S+)\s/i',$content,$me);
			$aboutme=array();
			$aboutme=$me[1];
			$oldme=array();
			$okme=array();
			foreach ($aboutme as $k=>$v){
				$oldme[$k]='/@'.$v.'/';
				$where['homepage']=$v;
				$rs=$user->where($where)->find();
				if(!$rs){
					$aboutme[$k]='@'.$v.' ';
				}else{
					$userpath=getFlowgPath().$v;
					$okme[]=$v;
					$aboutme[$k]="<a href='".$userpath."' target='_blank'>@".$v."</a>";
				}
			}
			$content=preg_replace($oldme,$aboutme,$content);//生成带有“@关于我”链接的内容
			

			
			if($isTransmit){
            	$tp=M('Topic');
            	$thistp = $tp->where("id = ".$topicid)->find();
            	$topicrootid = ($thistp["rootid"] == '0') ? $topicid : $thistp["rootid"];
				
				$dtp=D('Topic');
				$ok=$dtp->transmitTopic($content,$topicrootid,getUserID());
			}else{
				$cm=D('Topic');
				$ok=$cm->addComment($content,$topicid,getUserID());
				$returnText = '评论成功';
			}
			if($ok){
				$ab=M('Mention');
				foreach ($okme as $k=>$v){//提到我的
						
					$urs=$user->where("homepage='".$v."'")->find();
					$adata['uid']=$urs['id'];
					$adata['tid']=$ok;
						
					$ars=$ab->where($adata)->find();
						
					if(!$ars){
						$adata['create_time']=time();
						$ab->add($adata);
					}
						
				}
				$this->ajaxReturn($content,$returnText,1,null);
			}else{
				$this->ajaxReturn(null,'数据写入错误！',0,null);
			}
		}	
	}
	
	/**
	 * 
	 * ajax对话
	 */
	public function ajaxAtta(){
		
		parent::isAjaxLogin();
	    if(!checkUserStatus()){
			$this->ajaxReturn(null,'账号未通过审核',0,null);
			exit;
		}
		$site=F('site');
		
		$topicid=0;
		$content=trim(filterSpecial(H($_POST['content'])));
		$topicid=checkId32($_POST['rootid']);
		if(!$topicid){
			$this->ajaxReturn(null,'发生错误！',0,null);
			exit;
		}
		$user=M('User');
		
		$sconfig=F('site');
		$send_check=$sconfig['send_check'];
		if(checkSendTime($send_check)){
			$this->ajaxReturn(null,'新注册用户'.$send_check.'分钟内禁止发微博！',0,null);
			exit;
		}

		if(empty($content)){
			$this->ajaxReturn(null,'内容不能为空！',0,null);
			exit;
		}else{	
			$ok=false;
			
			preg_match_all('/@(\S+)\s/i',$content,$me);
			$aboutme=array();
			$aboutme=$me[1];
			$oldme=array();
			$okme=array();
			foreach ($aboutme as $k=>$v){
				$oldme[$k]='/@'.$v.'/';
				$where['homepage']=$v;
				$rs=$user->where($where)->find();
				if(!$rs){
					$aboutme[$k]='@'.$v.' ';
				}else{
					$userpath=getFlowgPath().$v;
					$okme[]=$v;
					$aboutme[$k]="<a href='".$userpath."' target='_blank'>@".$v."</a>";
				}
			}
			$content=preg_replace($oldme,$aboutme,$content);//生成带有“@关于我”链接的内容

			$at=D('Topic');
			$ok=$at->addAtta($content,$topicid,getUserID());
			if($ok){
				$ab=M('Mention');
				foreach ($okme as $k=>$v){//提到我的
						
					$urs=$user->where("homepage='".$v."'")->find();
					$adata['uid']=$urs['id'];
					$adata['tid']=$ok;
						
					$ars=$ab->where($adata)->find();
						
					if(!$ars){
						$adata['create_time']=time();
						$ab->add($adata);
					}
						
				}
				$this->ajaxReturn($content,'对话成功',1,null);
			}else{
				$this->ajaxReturn(null,'数据写入错误！',0,null);
			}
		}	
		
	}
	/**
	 * 
	 * ajax关注
	 */
	public function ajaxFollow(){
		
		parent::isAjaxLogin();
		$uid=getUserID();
		$objuid=filterSpecial($_REQUEST['objuid']);
		if($objuid==$uid){
			$this->ajaxReturn(null,'不能关注自己',0,null);
			exit;
		}
		$u=M('User');
		$data=array();
		$data['id']=$objuid;
		$rs=$u->where($data)->find();
		if(!$rs){
			$this->ajaxReturn(null,'TA不存在',0,null);
			exit;
		}
		
		$follow=M('Follow');
		$da=array();
		$da['uid']=$uid;
		$da['objuid']=$objuid;
		$ok=$follow->where($da)->count();
		if($ok){
			$this->ajaxReturn(null,'已关注TA',0,null);
			exit;
		}
		$da['fol_time']=time();
		$ars=$follow->add($da);
		if($ars){
			$this->ajaxReturn(null,'成功关注TA',1,null);
		}else{
			$this->ajaxReturn(null,'发生错误',0,null);
		}
		
	}
	
	/**
	 * 
	 * 加入收藏
	 */
	public function ajaxAddFavorite(){
		
		parent::isAjaxLogin();
		
		$tid=$_REQUEST['tid'];
		
		if(!checkId32($tid)){
			$this->ajaxReturn(null,'微博信息错误',0,null);
			exit;
		}
		$fav=M('Favorites');
		$data['uid']=getUserID();
		$data['tid']=$tid;
		$crs=$fav->where($data)->find();
		if(!$crs){
			$data['create_time']=time();
			if($fav->add($data)){
				$this->ajaxReturn(null,'成功',1,null);
			}else{
				$this->ajaxReturn(null,'失败',0,null);
			}
		}else{
			$this->ajaxReturn(null,'已收藏此微博，不必重复收藏',0,null);
		}
		
	}
	
	/**
	 * 
	 * 删除收藏
	 */
	public function ajaxAutoComplete(){
		
		parent::isAjaxLogin();
		
		$q=$_REQUEST['q'];
		$array = Array('a','ac','ba','b','re');
		foreach ($array as $key=>$value) {
			if (strpos(strtolower($key), $q) !== false) {
			echo "$key|$value\n";
		}}
				
	}
	
	/**
	 * 
	 * 删除收藏
	 */
	public function ajaxDeleteFavorite(){
		
		parent::isAjaxLogin();
		
		$tid=$_REQUEST['tid'];
		if(!checkId32($tid)){
			$this->ajaxReturn(null,'信息错误',0,null);
			exit;
		}
		$fav=M('Favorites');
		$crs=$fav->where('uid='.getUserID().' and tid='.$tid)->delete();
		if($crs){
			$this->ajaxReturn(null,'成功',1,null);
		}else{
			$this->ajaxReturn(null,'该微博已取消收藏',0,null);
		}
	}
	
	/**
	 * 
	 * 取消关注
	 */
	public function ajaxDeleteFollow(){
		
		parent::isAjaxLogin();
		
		$objuid=$_REQUEST['objuid'];
		if(!checkId32($objuid)){
			$this->ajaxReturn(null,'用户信息错误',0,null);
			exit;
		}
		$fol=M('Follow');
		$crs=$fol->where('uid='.getUserID().' and objuid='.$objuid)
			->delete();
		if($crs){
			$this->ajaxReturn(null,'成功取消',1,null);
		}else{
			$this->ajaxReturn(null,'已取消关注',0,null);
		}
	}
	
    /**
     * 
     * 删除登陆用户微博
     */
    public function ajaxDeleteMyTopic(){
    	
        parent::isAjaxLogin();
        
        $id=$_REQUEST['tid'];
        
        if(!checkId32($id)){
            $this->ajaxReturn(null,'信息错误',0,null);
			exit;
        }
        $topic=D('Topic');
        $user=M('User');
        $ok=false;
        $urs=$user->find(getUserID());
       	if($urs){
       		if($urs['roleid']==9){
       			$ok=true;
       		}else{
       			$ok=false;
       		}
       	}
       	if(!$ok){
       		$trs=$topic->getinfo($id);
       		if($trs['uid']==getUserID()){
       			$ok=true;
       		}else{
       			$ok=false;
       		}
       	}
       	if($ok){
	        if($topic->deleteTopic($id)){
		        $this->ajaxReturn(null,'成功',1,null);
	        }else{
	        	$this->ajaxReturn(null,'发生错误',0,null);
	        }
       	}else{
			$this->ajaxReturn(null,'权限受限',0,null);
       	}
    }
    
    /**
     * 
     * ajax上传图片
     */
    public function ajaxUploadImage(){
		
        parent::isAjaxLogin();

		import("ORG.Net.UploadFile");
		$upload = new UploadFile();
		$site=F('site');
		$upload->maxSize=$site['file_size'];
		$upload->allowExts=array('jpg','gif','png','jpeg');
		$upload->savePath=getUploadPath();
		$upload->saveRule='uniqid';
		$upload->thumb=true;
		$upload->thumbMaxWidth="120,500";
		$upload->thumbMaxHeight="120,500";
		
		if($upload->upload()) {
			$info=$upload->getUploadFileInfo();
			$thumb=$upload->thumbPrefix;
			$data['uid']=getUserID();
			$data['title']=$info[0]['name'];
			$data['create_time']=time();
			$data['url']=getShowPath().$info[0]['savename'];
			$data['thumb_url']=getShowPath().$thumb.$info[0]['savename'];
			$data['filesize']=$info[0]['size'];
			$img=M('Image');
			if($imgid=$img->add($data)){
				$data['id']=$imgid;
				$this->ajaxReturn($data,'成功上传文件 ',1,'json');	
			}else{
				$this->ajaxReturn(null,'上传文件出错！',0,null);
			}
		}else{ 
			$this->ajaxReturn(null,$upload->getErrorMsg(),0,null);
			exit;
		} 
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/**
	 * 
	 * 更新用户信息
	 */
	public function updateUserInfo(){
		
		parent::isAjaxLogin();
		$nkname=filterSpecial(H($_POST['nickname']));
		$sex=$_POST['sex'];
		$content=filterSpecial(H($_POST['content']));
		$msn=filterSpecial(H($_POST['msn']));
		$mobile=filterSpecial(H($_POST['mobile']));
		$qq=filterSpecial(H($_POST['qq']));
		if(empty($nkname)||empty($sex)||empty($content)){
			echo '请输入所有信息';
			exit;
		}
		if($nkname!="undefined"){
			if(str_len($nkname)>8||str_len($nkname)<3){
				echo '昵称必须少于8个字符';
				exit;
			}	
		}
		if(($sex==0)||($sex!=1&&$sex!=2)){
			echo '性别信息错误'.$sex;
			exit;
		}
		if(getStringLen($content)>140){
			echo '自我介绍文字必须少于141个字符！';
			exit;
		}
		if(!empty($mobile)&&!checkId32($mobile)){
			echo "手机号码必须是数字";
			exit;
		}
		if(!empty($qq)&&!checkId32($qq)){
			echo "QQ号必须是数字";exit;	
		}
		$user=D('User');
		$data=array();
		$data['msn']=$msn;
		//检测昵称
		if($user->getInfoByWhere(array('nickname'=>$nkname))){
			echo "昵称已经存在";
			exit;
		}

		$rs=$user->getInfo(getUserID());
		$msrs=$user->getInfoByWhere($data);
		if($msrs){
			if($msrs['id']!=getUserID()){
				echo 'msn已经存在';
				exit;	
			}
		}
		$data['sex']=$sex;
		$data['memo']=$content;
		$data['mobile']=$mobile;
		$data['qq']=$qq;
		if(empty($rs['nickname'])){
			$data['nickname']=$nkname;
		}
		$ok=$user->saveInfo($data,getUserID());
		if($ok){
			echo '个人信息保存成功';
		}else{
			echo '保存失败';
		}
	}
	
	/**
	 * 
	 * 检测昵称
	 */
	public function checkNickname(){

		$nickname=filterSpecial(H($_POST['nickname']));
		if(str_len($nickname)>8||str_len($nickname)<3){
			echo "昵称长度不符合规则3-8位";
			exit;
		}
		$user=D('User');
		if($user->getInfoByWhere(array('nickname'=>$nickname))){
			echo "昵称已经存在";
		}else{
			echo "此昵称可以使用";
		}
	}
	
	/**
	 * 
	 * 更新密码
	 */
	public function updateUserPassword(){
		
		parent::isAjaxLogin();
		$pwd=$_POST['passwd'];
		$repwd=$_POST['repwd'];
		if(empty($pwd)||empty($repwd)){
			echo '请输入密码';
			exit;
		}
		
		$pwd=H($pwd);
		$repwd=H($repwd);
		if($pwd!=$repwd){
			echo '两次密码必须一致！';exit;
		}
		$user=M('User');
		$data=array();
		$data['id']=getUserID();
		$data['password']=md5($pwd);
		$rs=$user->save($data);
		if($rs)
			echo '修改成功,您的密码是:'.$pwd.',请牢记！';
		else
			echo '保存失败';
	}
	
	/**
	 * 
	 * 更新邮箱操作
	 */
	public function updateEmail(){
		
		parent::isAjaxLogin();
		$mail=$_POST['email'];
		if(ismail($mail)){
			$user=M('User');
			$data=array();
			$data['id']=getUserID();
			$data['email']=$mail;
			$rs=$user->save($data);
			if($rs){
				echo '邮件绑定成功';
			}else{
				echo '保存失败';
			}
		}else{
			echo 'E-Mail格式错误，请重新输入';
		}
	}
	

}
?>