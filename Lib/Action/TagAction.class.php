<?php
/**
 * @Date 2011.2.15
 * @File: TagAction.class.php
 * @Author Leyteris
 */
class TagAction extends CommonAction{
	
	/**
	 * 
	 * 入口控制器
	 */
	public function index(){
		
		parent::islogin();
		
		$id=checkId32($_REQUEST['tagid']);
		
		if(!$id){
			$site=F('site');
			$this->error("<a href='".$site['domain']."'>Error:404，点击访问首页</a>");
			exit;
		}
		$nowtag=D('Tag');
		$tagrs=$nowtag->getInfo($id);

		if($tagrs){
			
			import("ORG.Util.Page");
			$length=20;

			$model = D("Tagview");
			$transtopic=D('Topic');
			$transtanscom=M('Topic');
			$transuser = D('User');
			
	        $count = $model->where("Tag.id=".$id)
	        		->count();
	
	        $listRows = 20;
	        import("ORG.Util.Page");
	        $p = new Page($count, $listRows);
	
	        $list =  $model->field('topic_id,uid,tagname,imgid,type,rootid,create_time,topic_from,content,nickname,avatar,homepage')
	        	->where("Topic.status=1 and Tag.id=".$id)
	        	->order("topic_id desc")
	        	->limit($p->firstRow.','.$p->listRows)
	        	->select();
	        	
	        foreach ($list as $key=>$val){
	        	
	        	$list[$key]['count']=$transtanscom->where("status=1 and rootid=".$val['topic_id']." and (type='comment' or type='transmit')")
										->count();
	        	$list[$key]['from'] = $val['topic_from'];
	        	$list[$key]['time'] = getTime($val['create_time']);
	        	$list[$key]['id'] = $val['topic_id'];
	        	$list[$key]['nohtmlcontent'] = filterHtmlCode($list[$key]['content']);
				$list[$key]['content']=getBlogReplay($list[$key]['content']);
				
				if($val['rootid'] != 0){

					$list[$key]['transtopic'] = $transtopic->getInfo($val['rootid']);
					
					$transtopicuid = $list[$key]['transtopic']['uid'];
					$transvolist = $transuser->getInfo($transtopicuid,"nickname,homepage");
					$list[$key]['transtopic']['nickname']=$transvolist['nickname'];
					$list[$key]['transtopic']['homepage']=$transvolist['homepage'];
					$list[$key]['transtopic']['content']=getBlogReplay($list[$key]['transtopic']['content']);
					$list[$key]['transtopic']['topiccreate_time'] = getTime($list[$key]['transtopic']['create_time']);
					if($val['type'] != 'dialog'){
						$list[$key]['transtopic']['count']=$transtanscom->where("status=1 and  rootid=".$val['rootid']." and (type='comment' or type='transmit')")->count();
					}
				}
				
				if($val['imgid'] != 0){
					$img = M('Image');
					$list[$key]['topicpic'] = $img->find($val['imgid']);
				}
				
	        }
	
	        $page = $p->show();
	        $this->assign("tagrs", $tagrs);
	        $this->assign("list", $list);
	        $this->assign("page", $page);
			parent::showSiteInfo("关于#".$tagrs['tagname']."#话题");
	        $this->display();
		}else{
			$site=F('site');
			$this->error("<a href='".$site['domain']."'>Error:404，点击访问首页</a>");
			exit();
			
		}
        
	}
}

?>