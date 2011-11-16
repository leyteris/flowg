<?php
/**
 * @Date 2011.2.18
 * @File PiazzaAction.class.php
 * @Author Leyteris
 */
class PiazzaAction extends CommonAction{
		
	/**
	 * 
	 * index入口控制器
	 */
	public function index(){
		
		parent::islogin();
		import("ORG.Util.Page");
		$model = D("Topicview");
		$tanscom=M("Topic");
		
        $list =  $model->field('id,tid,imgid,avatar,create_time,topic_from,content,nickname,rootid,homepage')
        	->where("Topic.status=1 and Topic.type='first'")
        	->order("id desc")
        	->limit("0,20")
			->select();
			
        foreach ($list as $key=>$val){

        	$list[$key]['from'] = $val['topic_from'];
        	$list[$key]['time'] = getTime($val['create_time']);
        	$list[$key]['count'] = $tanscom->where("status=1 and rootid=".$val['id']." and (type='comment' or type='transmit')")
        								->count();
        	$list[$key]['nohtmlcontent'] = filterHtmlCode($list[$key]['content']);
        	$list[$key]['content']=getBlogReplay($list[$key]['content']);
        	if($val['imgid'] != 0){
				$img = M('Image');
				$list[$key]['topicpic'] = $img->find($val['imgid']);
			}
        }
        $this->assign("list", $list);
		parent::showSiteInfo("微博广场");
        $this->display();
        
	}
	
	/**
	 * 
	 * 微博新人页面
	 */
	public function newman(){
		
		parent::islogin();
		
		$where="status=1";
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
	
	
	public function stroll(){
		
		parent::islogin();
		import("ORG.Util.Page");
		$model = D("Topicview");
		$tanscom=M("Topic");
		
        $list =  $model->field('id,tid,imgid,avatar,create_time,topic_from,content,nickname,rootid,homepage')
        	->where("Topic.status=1 and Topic.type='first'")
        	->order("id desc")
        	->limit("0,20")
			->select();
			
        foreach ($list as $key=>$val){

        	$list[$key]['from'] = $val['topic_from'];
        	$list[$key]['time'] = getTime($val['create_time']);
        	$list[$key]['count'] = $tanscom->where("status=1 and rootid=".$val['id']." and (type='comment' or type='transmit')")
        								->count();
        	$list[$key]['nohtmlcontent'] = filterHtmlCode($list[$key]['content']);
        	$list[$key]['content']=getBlogReplay($list[$key]['content']);
        	if($val['imgid'] != 0){
				$img = M('Image');
				$list[$key]['topicpic'] = $img->find($val['imgid']);
			}
        }
        $this->assign("list", $list);
		parent::showSiteInfo("微博广场");
        $this->display();
		
	}
	
}
?>