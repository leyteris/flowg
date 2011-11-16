<?php
/**
 * @Date 2011.2.18
 * @File HallAction.class.php
 * @Author Leyteris
 */
class HallAction extends CommonAction{
		
	/**
	 * 
	 * index入口控制器
	 * 热门人物
	 */
	public function index(){
		
		parent::islogin();

		$u=D('Hotuserview');

		$list=$u->where("User.status=1")
			->order('Count desc')
			->group("User.id")
			->limit("0,20")
			->select();
			
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
		parent::showSiteInfo("风云堂 - 热门人物");
        $this->display();
        
	}
	
	/**
	 * 
	 * 热门微博
	 */
	public function hottopic(){

		parent::islogin();
		import("ORG.Util.Page");
		$model = D("Hottopicview");
		
        $count = $model->where("root_topic.status=1")
        	->group("root_topic.id")
        	->count();
        	
        $listRows = 20;
        $p = new Page($count, $listRows);
        
        $list =  $model->where("root_topic.status=1")
        	->order("Count desc")
        	->group("root_topic.id")
        	->limit($p->firstRow.','.$p->listRows)
       	 	->select();
       	 	
        foreach ($list as $key=>$val){

        	$list[$key]['from'] = $val['topic_from'];
        	$list[$key]['time'] = getTime($val['create_time']);
        	$list[$key]['nohtmlcontent'] = filterHtmlCode($list[$key]['content']);
        	$list[$key]['content']=getBlogReplay($list[$key]['content']);
        	if($val['imgid'] != 0){
				$img = M('Image');
				$list[$key]['topicpic'] = $img->find($val['imgid']);
			}
        }
        
        $page = $p->show();
        $this->assign("list", $list);
        $this->assign("page", $page);
		parent::showSiteInfo("风云堂 - 热门微博");
        $this->display();
		
	}
	
	/**
	 * 
	 * 微博控页面
	 */
	public function topickong(){
		
		parent::islogin();

		$u=D('Topickongview');
				
		$list=$u->where("Topic.status=1")
			->order('Count desc')
			->group("User.id")
			->limit("0,20")
			->select();
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
		}
		
		$this->assign('list',$list);
		parent::showSiteInfo("风云堂 - 纯微博控");
        $this->display();
        
	}
	
	/**
	 * 
	 * 热门话题
	 */
	public function hottag(){
			
		parent::islogin();
		$model = D("Tagview");
		
        $list =  $model->where("Topic.status=1")
        	->order("Count desc")
        	->group("Tag.id")
        	->limit("0,20")
        	->select();
        	
        foreach ($list as $key=>$val){

        	$list[$key]['from'] = $val['topic_from'];
        	$list[$key]['time'] = getTime($val['create_time']);
        	$list[$key]['content']=getBlogReplay($list[$key]['content']);
        	if($val['imgid'] != 0){
				$img = M('Image');
				$list[$key]['topicpic'] = $img->find($val['imgid']);
			}
        }
        
        $this->assign("list", $list);
		parent::showSiteInfo("风云堂 - 热门话题");
        $this->display();
		
	}

}
?>