<?php
/**
 * 
 * 微博访问接口
 * @author Leyteris
 *
 */
class TopicAction extends AccountAction{

	/**
	 * 
	 * 根据ID获取单条微博信息内容
	 * @param mix $source
	 * @param int $id
	 */
	public function show_topic($source,$id){
		
		if(parent::verify_credentials($source)){
			
			if(!checkId32($id)){
				return 'F';
			}
			$tv = D('Topicview');
			
			$list = $tv->field('id,nickname,homepage,avatar,create_time,topic_from,type,imgid,content,status')
				->where("Topic.status=1 and Topic.uid=".$id)
				->find();
        
			return $list;
		}else{
			
			return 'F';
		}
		
	}
	
	/**
	 * 
	 * 发布消息
	 * @param mix $content
	 */
	public function update($source,$content,$client,$tid = 0){
		
		if(parent::verify_credentials($source)){
			
			load('extend');
			$content=trim(filterSpecial($content));//过滤恶意代码
			$uid=$_SESSION['USER_OBJ']['id'];
			$tagid=$tid;
			
			if($tagid){
				if(!checkId32($tagid)){
					return 'F';
				}
			}
			checkSendTime();
			if(empty($content)){
				return 'F';
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
						return 'F';
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
				
				/*$attpic=$_POST['attpic'];
				if($attpic){
					if(!checkId32($attpic)){
						return 'F';
						exit;
					}
				}*/
				
				$status=1;
				$tagid = $tagid ? $tagid : 0;
				if($tagid){
					$tagpath=U('tag/index')."?tagid=".$tagid;
					$content=preg_replace('/#' . $subject . '#/',"<a href='".$tagpath."' target='_blank'>#".$subject."#</a>",$content);
				}
				//$data['imgid'] = $attpic && $attpic != '0' ? $attpic : 0;
				$data['content']=$content;
				$data['uid']=$uid;
				$data['create_time']=time();
				$data['rootid']=0;
				$data['from']=$client? $client : null;
				$data['tagid']=$tagid;
				$data['status']=$status;
				$topic=M('Topic');
				$rsid=$topic->add($data); //插入数据
				
				if(!$rsid){
					return 'F';
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
	
					$vouser=M('User');
					$vouserlist = $vouser->where('id = '.$uid)->find();
					$vo['id']=$rsid;
					$vo['nickname']=$vouserlist['nickname'];
					$vo['homepage']=$vouserlist['homepage'];
					$vo['avatar']=$vouserlist['avatar'];
					$vo['content'] =nl2br($data['content']);
					$vo['topic_create_time'] = getTime($data['create_time']);
					$vo['from'] = $data['from'];
					/*
					$vo['imgid'] = $data['imgid'];
					if($vo['imgid'] != '0'){
						$voimg=M('Image');
						$voimglist=$voimg->find($vo['imgid']);
						$vo['imgurl'] = $voimglist['url'];
						$vo['imgthumb_url']=$voimglist['thumb_url'];
					}*/
					return $vo;
				}
			}
		}else{
			return 'F';
		}

	}
	
	/**
	 * 
	 * 根据ID删除一条微博
	 * @param int $id
	 */
	public function delete($id){
		
	}
	
	/**
	 * 
	 * 根据ID转发一条微博
	 * @param int $id
	 */
	public function transmit($id,$content){
		
	}
	
	/**
	 * 
	 * 根据ID评论一条微博
	 * @param unknown_type $id
	 * @param unknown_type $content
	 */
	public function comment($id,$content){
		
	}
}
?>