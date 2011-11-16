<?php
/**
 * @Date: 2010-12-12
 * @File: IndexAction.class.php
 * @Author: Leyteris
 */
class IndexAction extends CommonAction{

	/**
	 * 
	 * 入口控制器
	 */
 	public function index(){
 		
		parent::showSiteInfo();
		$length=20;
		$this->getTopLen($length);
        $this->display();
    }
    
    /**
     * 
     * 我的微博
     */
	public function myhome(){
		
		$id=getUserID();
		$top=M("Topic");
		$tanscom=M("Topic");
		
		$length=20;

		import("ORG.Util.Page");
			
		$where = "uid=".$id." and status=1 and (type='first' or type='transmit')";
		
		$count=$top->where($where)
				->count();
		$page=new Page($count,$length);
		$show=$page->show();

		$list=$top->where($where)
			->order('id desc')
			->limit($page->firstRow.','.$page->listRows)
			->select();
			
		foreach($list as $key=>$topic){

			$id=$topic['id'];
			$list[$key]['count']=$tanscom->where("status=1 and rootid=".$id." and (type='comment' or type='transmit')")
									->count();
			$list[$key]['nohtmlcontent'] = filterHtmlCode($list[$key]['content']);
			$list[$key]['content']=getBlogReplay($list[$key]['content']);
			$list[$key]['topiccreate_time'] = getTime($list[$key]['create_time']);//strtotime  String =>int
			
			//截取转发原微博
			if($topic['rootid'] != 0){
				
				$transtopic=D('Topic');
				$transtanscom=M('Topic');
				$transuser = D('User');
				
				$list[$key]['transtopic'] = $transtopic->getInfo($topic['rootid']);
				
				$transtopicuid = $list[$key]['transtopic']['uid'];
				$transvolist = $transuser->getInfo($transtopicuid,"nickname,homepage");
				$list[$key]['transtopic']['nickname']=$transvolist['nickname'];
				$list[$key]['transtopic']['homepage']=$transvolist['homepage'];
				$list[$key]['transtopic']['content']=getBlogReplay($list[$key]['transtopic']['content']);
				$list[$key]['transtopic']['topiccreate_time'] = getTime($list[$key]['transtopic']['create_time']);
				if($topic['type'] != 'dialog'){
					$list[$key]['transtopic']['count']=$transtanscom->where("status=1 and  rootid=".$topic['rootid']." and (type='comment' or type='transmit')")->count();
				}
			}
			
			if($topic['imgid'] != 0){
				$img = M('Image');
				$list[$key]['topicpic'] = $img->find($topic['imgid']);
			}
		}
		
		$this->assign('list',$list);
		$this->assign('page',$show);
		
		parent::showSiteInfo("我的微博");
		
		$this->display();

	}
    
	/**
	 * 
	 * 取得最近的length条记录
	 * @param int $length
	 */
	private function getTopLen($length = 20){
		
		import("ORG.Util.Page");
		$top=M('Topic');
		$tanscom=M('Topic');
		
		$id=getUserID();
		$tguserid='';
		$fol=M('Follow');
		$follist=$fol->where('uid='.$id)
						->select();
		for($i=0;$i<count($follist);$i++){
			$tguserid.=$follist[$i]['objuid'].',';
		}
		$tguserid.=$id;

		$where=" instr('".$tguserid."',uid) and status=1 and (type='first' or type='transmit' or type='dialog')";
		
		$count=$top->where($where)
					->count();
					
		$page=new Page($count,$length);
		$show=$page->show();

		$list=$top->where($where)
			->order('id desc')
			->limit($page->firstRow.','.$page->listRows)
			->select();
			
		foreach($list as $key=>$topic){
			
			$user = D('User');
			
			$id=$topic['id'];
			$list[$key]['count']=$tanscom->where("status=1 and rootid=".$topic['id']." and (type='comment' or type='transmit')")->count();
			
			$volist = $user->getInfo($topic['uid'],"nickname,homepage,avatar");
			$list[$key]['avatar']=$volist['avatar'];
			$list[$key]['nickname']=$volist['nickname'];
			$list[$key]['homepage']=$volist['homepage'];
			$list[$key]['nohtmlcontent'] = filterHtmlCode($list[$key]['content']);
			$list[$key]['content']=getBlogReplay($list[$key]['content']);
			$list[$key]['topiccreate_time'] = getTime($list[$key]['create_time']);//strtotime  String =>int
			
			if($topic['rootid'] != 0){
				
				$transtopic=D('Topic');
				$transtanscom=M('Topic');
				$transuser = D('User');
				
				$list[$key]['transtopic'] = $transtopic->getInfo($topic['rootid']);
				
				$transtopicuid = $list[$key]['transtopic']['uid'];
				$transvolist = $transuser->getInfo($transtopicuid,"nickname,homepage");
				$list[$key]['transtopic']['nickname']=$transvolist['nickname'];
				$list[$key]['transtopic']['homepage']=$transvolist['homepage'];
				$list[$key]['transtopic']['content']=getBlogReplay($list[$key]['transtopic']['content']);
				$list[$key]['transtopic']['topiccreate_time'] = getTime($list[$key]['transtopic']['create_time']);
				if($topic['type'] != 'dialog'){
					$list[$key]['transtopic']['count']=$transtanscom->where("status=1 and rootid=".$topic['rootid']." and (type='comment' or type='transmit')")->count();
				}
			}
			
			if($topic['imgid'] != 0){
				$img = M('Image');
				$list[$key]['topicpic'] = $img->find($topic['imgid']);
			}
		}
		
		parent::showSiteInfo("我的主页");
		
		$this->assign('list',$list);
		$this->assign('page',$show);
	}
	
	/**
	 * 
	 * 显示日志页面
	 */
	public function log(){
		parent::showSiteInfo('开发日志');
		$this->display();
	}
	
	/**
	 * 
	 * 显示日志页面
	 */
	public function api(){
		parent::showSiteInfo('api接口');
		$this->display();
	}
	
	/**
	 * 
	 * 刷新缓存
	 */
	public function flush(){
		$s=M('site');
		$rs=$s->find();
		F('site',$rs);
		if ($rs) {
        	$this->assign("jumpUrl",getFlowgPath()."index/index"); 
			$this->success("刷新缓存成功");
        }else {
        	$this->error("刷新缓存失败");
        }
	}
}
?>