<?php
/**
 * @Date 2010.12.12
 * @File: EmptyAction.class.php
 * @Author Leyteris
 */
class EmptyAction extends CommonAction{
	
	/**
	 * 
	 * 截取模型名
	 */
	public function index(){
		$action=MODULE_NAME;
		$this->homepage($action);
	}
	
	/**
	 * 
	 * 显示个人页面
	 * @param string $home
	 */
	private function homepage($home){
		
		$home=H(filterSpecial($home));
		$u=M('User');
		$data=array();
		$data['homepage']=$home;
		$rs=$u->where($data)
			->find();
			
		if($rs){	
			$id=$rs['id'];
			
			//Follow相关
			$fol=M('Follow');
			$fans=$fol->where('objuid='.$id)->count();
			$follows=$fol->where('uid='.$id)->count();
			$this->assign('fans',$fans);
			$this->assign('follows',$follows);
			
			$tp=M("Topic");
			$tanscom=M("Topic");
			
			import("ORG.Util.Page");
			
			$where = "uid=".$id." and status=1 and (type='first' or type='transmit' or type='dialog')";
			
			$count=$tp->where($where)
				->count();
				
			$topiccount=$count;
			$page=new Page($count,20);
			$show=$page->show();
			$list=$tp->where($where)
				->order('id desc')
				->limit($page->firstRow.','.$page->listRows)
				->select();
			
			foreach($list as $key=>$arr){
				
				$list[$key]['count']=$tanscom->where("status=1 and rootid=".$arr['id']." and (type='comment' or type='transmit')")
										->count();
										
				$list[$key]['nohtmlcontent'] = filterHtmlCode($list[$key]['content']);
				$list[$key]['content']=getBlogReplay($list[$key]['content']);
				$list[$key]['topiccreate_time'] = getTime($list[$key]['create_time']);
				
				if($arr['rootid'] != 0){
					
					$transtopic=D('Topic');
					$transtanscom=M('Topic');
					$transuser = D('User');
					
					$list[$key]['transtopic'] = $transtopic->getInfo($arr['rootid']);
					
					$transtopicuid = $list[$key]['transtopic']['uid'];
					$transvolist = $transuser->getInfo($transtopicuid,"nickname,homepage");
					$list[$key]['transtopic']['nickname']=$transvolist['nickname'];
					$list[$key]['transtopic']['homepage']=$transvolist['homepage'];
					$list[$key]['transtopic']['content']=getBlogReplay($list[$key]['transtopic']['content']);
					$list[$key]['transtopic']['topiccreate_time'] = getTime($list[$key]['transtopic']['create_time']);
					if($arr['type'] != 'dialog'){
						$list[$key]['transtopic']['count']=$transtanscom->where("status=1 and  rootid=".$arr['rootid']." and (type='comment' or type='transmit')")->count();
					}
				}
				
				if($arr['imgid'] != 0){
					$img = M('Image');
					$list[$key]['topicpic'] = $img->find($arr['imgid']);
				}
			
			}
			
			$this->assign('list',$list);
			$this->assign('page',$show);
			
			$this->assign('topiccount',$topiccount);
			$this->assign('rs',$rs);
			if($rs['styleid']){
				$st = M('Style');
				$strs=$st->where('id='.$rs['styleid'])->find();
				if($strs){
					$this->assign('stylers',$strs);
				}
			}
			
			parent::showSiteInfo($rs['userid']."的主页",$rs['userid'],$rs['userid']);
			
			$this->display('Index:homepage');	
		}else{
			$site=F('site');
			$this->error("<a href='".$site['domain']."'>Error:404，点击访问首页</a>");
		}

	}

}
?>