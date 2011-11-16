<?php
/**
 * @Date 2010.12.18
 * @File: FollowAction.class.php
 * @Author Leyteris
 */
class FollowAction extends CommonAction{
	
	/**
	 * 
	 * index入口控制器
	 */
	public function index(){
		
		parent::islogin();
		
		$id=checkId32($_GET['uid']);
		
		if($id && $id != getUserID()){
			$nowuser=D('User');
			$rs=$nowuser->getInfoByWhere("id=".$id);
			if($rs){
				$this->assign('rs',$rs);
				$this->assign('detailflag',1);
				
				$fol=M('Follow');
				$fans=$fol->where('objuid='.$id)->count();
				$follows=$fol->where('uid='.$id)->count();
				$this->assign('fans',$fans);
				$this->assign('follows',$follows);
				$username = $rs['userid'];
				
				$title=$username."的关注";
				
				$topic=M("Topic");
				$tpcount=$topic->where('uid='.$id.' and status=1')->count();
				$this->assign('topiccount',$tpcount);
			}else{
				$site=F('site');
				$this->error("<a href='".$site['domain']."'>Error:404，点击访问首页</a>");
				exit();
			}	
		}else{
			$id=getUserID();
			$username = getSession();
			$title="我的关注";
			$this->assign('detailflag',0);
		}
		
		
		$tguserid='';
		$fol=M('Follow');
		$follist=$fol->where('uid='.$id)->select();
		for($i=0;$i<count($follist);$i++){
			$tguserid.=$follist[$i]['objuid'].',';
		}
		$where=" instr('".$tguserid."',id) and status=1";
		
		$u=M('User');
		import("ORG.Util.Page");
		$count=$u->where($where)->count();
		$page=new Page($count,20);
		$show=$page->show();
		$list=$u->where($where)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		foreach($list as $key=>$arr){
			$id=$arr['id'];
			$tp=M('Topic');

			$list[$key]['lasttopic']=$tp->where('status=1 and uid='.$id)->order('id desc')->find();
			if($list[$key]['lasttopic']){
				$list[$key]['lasttopic']['create_time'] = getTime($list[$key]['lasttopic']['create_time']);
				$list[$key]['lasttopic']['content']=getBlogReplay($list[$key]['lasttopic']['content']);
			}else{
				$list[$key]['lasttopic']['from']="神器";
				$list[$key]['lasttopic']['create_time'] = "未出生时";
				$list[$key]['lasttopic']['content']="这位同学实在太懒啦！！什么都没留下~~";
			}
			$fol=M('Follow');
			$list[$key]['thisfollowerfans']=$fol->where('objuid='.$id)->count();
			$list[$key]['thisfollowerfollows']=$fol->where('uid='.$id)->count();
		}
		$this->assign('list',$list);
		$this->assign('page',$show);
			
		parent::showSiteInfo($title,$username,$username);

        $this->display();
        
	}
	
	/**
	 * 
	 * 显示粉丝
	 */
	public function fans(){
		
		parent::islogin();
		

		$id=checkId32($_GET['uid']);
		
		if($id && $id != getUserID()){
			$nowuser=M('User');
			$rs=$nowuser->where("id=".$id)->find();
			if($rs){
				$this->assign('rs',$rs);
				$this->assign('detailflag',1);
				
				$fol=M('Follow');
				$fans=$fol->where('objuid='.$id)->count();
				$follows=$fol->where('uid='.$id)->count();
				$this->assign('fans',$fans);
				$this->assign('follows',$follows);
				$username = $rs['userid'];
				
				$title=$username."的粉丝";
				
				$topic=M("Topic");
				$tpcount=$topic->where('uid='.$id.' and status=1')->count();
				$this->assign('topiccount',$tpcount);
			}else{
				$site=F('site');
				$this->error("<a href='".$site['domain']."'>Error:404，点击访问首页</a>");
				exit();
			}	
		}else{
			$id=getUserID();
			$username = getSession();
			$title="我的粉丝";
			$this->assign('detailflag',0);
		}
		

		$tguserid='';
		$fol=M('Follow');
		$follist=$fol->where('objuid='.$id)->select();
		for($i=0;$i<count($follist);$i++){
			$tguserid.=$follist[$i]['uid'].',';
		}
		$where=" instr('".$tguserid."',id) and status=1";
		
		$u=M('User');
		import("ORG.Util.Page");
		$count=$u->where($where)->count();
		$page=new Page($count,20);
		$show=$page->show();
		$list=$u->where($where)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		foreach($list as $key=>$arr){
			
			$id=$arr['id'];
			$tp=M('Topic');
			
			$list[$key]['lasttopic']=$tp->where('status=1 and uid='.$id)->order('id desc')->find();
			
			if($list[$key]['lasttopic']){
				$list[$key]['lasttopic']['create_time'] = getTime($list[$key]['lasttopic']['create_time']);
				$list[$key]['lasttopic']['content']=getBlogReplay($list[$key]['lasttopic']['content']);
			}else{
				$list[$key]['lasttopic']['from']="神器";
				$list[$key]['lasttopic']['create_time'] = "未出生时";
				$list[$key]['lasttopic']['content']="这位同学实在太懒啦！！什么都没留下~~";
			}
			$fol=M('Follow');
			$list[$key]['thisfollowerfans']=$fol->where('objuid='.$id)->count();
			$list[$key]['thisfollowerfollows']=$fol->where('uid='.$id)->count();
		}
		$this->assign('list',$list);
		$this->assign('page',$show);
			
		parent::showSiteInfo($title,$username,$username);

        $this->display();
        
	}
	
}
?>