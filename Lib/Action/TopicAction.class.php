<?php
/**
 * @Date 2011.1.6
 * @File: TopicAction.class.php
 * @Author Leyteris
 */
class TopicAction extends CommonAction{
	
	/**
	 * 
	 * index入口控制器
	 */
	public function index(){
		
		parent::islogin();
		
		import("ORG.Util.Page");
		
		$tid=checkId32($_REQUEST['tid']);
		
		if(!$tid){
			$site=F('site');
			$this->error("<a href='".$site['domain']."'>Error:404，点击访问首页</a>");
			exit;
		}
		$nowtopic=D('Topic');
		$trs=$nowtopic->getInfo($tid);
		if($trs){
			
			$transcount=$nowtopic->getCount('rootid='.$trs['id'].' and type="transmit"');
			$commcount=$nowtopic->getCount('rootid='.$trs['id'].' and type="comment"');
			
			$user=D('User');
			$urs=$user->getInfo($trs['uid']);
			
			if($trs['imgid'] != 0){
				$trsimg = M('Image');
				$trs['topicpic'] = $trsimg->find($trs['imgid']);
			}
			$trs['create_time']=getTime($trs['create_time']);

			$this->assign('commcount',$commcount);
			$this->assign('transcount',$transcount);
			$this->assign('urs',$urs);
			$this->assign('trs',$trs);
			
			$tp=M('Topic')->getTableName();
			$user=M('User')->getTableName();

			$Model = new Model();
			
			$where="select t.id,t.uid,u.nickname,u.avatar,t.imgid,t.type,t.rootid, u.homepage,t.create_time ,t.content,t.from from ".$user." u,".$tp." t where t.uid=u.id and t.rootid=".$tid." and (t.type='transmit' or t.type='comment') ";

			$count=$transcount+$commcount;
			
			$this->assign('count',$count);
			
			$page=new Page($count,10);
			
			$where .=" order by id desc limit ".$page->firstRow.",".$page->listRows;

			$show=$page->show();
			
			$list=$Model->query($where); 
  
			foreach($list as $key=>$topic){
				
				$list[$key]['nohtmlcontent'] = filterHtmlCode($list[$key]['content']);
				$list[$key]['content']=getBlogReplay($list[$key]['content']);
				$list[$key]['topiccreate_time'] = getTime($list[$key]['create_time']);//strtotime  String =>int
			
				if($topic['imgid'] != 0){
					$img = M('Image');
					$list[$key]['topicpic'] = $img->find($topic['imgid']);
				}
			
			}
			
			$this->assign('list',$list);
			$this->assign('page',$show);
			
			parent::showSiteInfo("浏览转发评论");
			
			$this->display();
		}else{
			$site=F('site');
			$this->error("<a href='".$site['domain']."'>Error:404，点击访问首页</a>");
			exit();
		}	
		
	}
}
?>