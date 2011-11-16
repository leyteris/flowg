<?php
/**
 * @Date 2011.4.17
 * @File: LabAction.class.php
 * @Author Leyteris
 */

class LabAction extends CommonAction{
		
	/**
	 * 
	 * index入口控制器
	 */
	public function index(){
		
		parent::islogin();
		parent::showSiteInfo("Lab前端实验室");
        $this->display();
        
	}
	
	/**
	 * 
	 * map position控制器
	 */
	public function map(){
		
		parent::islogin();
		$model = D("Topicview");
		
        $list =  $model->field('id,tid,imgid,avatar,address,create_time,topic_from,content,nickname,rootid,homepage')
        	->where("Topic.status=1 and Topic.type='first'")
        	->order("id desc")
			->find();

		//dump($list);
		$this->assign('addrList',$list);
		parent::showSiteInfo("Lab前端实验室 - Map Position");
        $this->display();
        
	}
	
	/**
	 * 
	 * wall控制器
	 */
	public function wall(){
		
		parent::islogin();
		$model = D("Topicview");
		
        $list =  $model->field('id,tid,imgid,avatar,address,create_time,topic_from,content,nickname,rootid,homepage')
        	->where("Topic.status=1 and Topic.type='first'")
        	->order("id desc")
			->limit("0,10")
			->select();

	    foreach ($list as $key=>$val){
        	$list[$key]['from'] = $val['topic_from'];
        	$list[$key]['time'] = getTime($val['create_time']);
        	$list[$key]['content']=getBlogReplay($list[$key]['content']);
        }
		//dump($list);
		$this->assign('topicList',$list);
		parent::showSiteInfo("Lab前端实验室 - Photo Wall");
        $this->display();
        
	}
	
	public function chromeplugin(){
		
		parent::islogin();
		parent::showSiteInfo("Lab前端实验室 - Chrome Plugin");
        $this->display();
        
	}
}
?>