<?php
/**
 * @Date 2011.2.14
 * @File: MentionAction.class.php
 * @Author Leyteris
 */

class MentionAction extends CommonAction{
		
	/**
	 * 
	 * index入口控制器
	 */
	public function index(){
		
		parent::islogin();
		import("ORG.Util.Page");
		$id=getUserID();
		$model = D("Mentionview");
        $count = $model->where("uid=".$id)->count();
        $listRows = 20;
        $p = new Page($count, $listRows);
        $list =  $model->field('topic_id,uid,type,tid,avatar,create_time,rootid,topic_from,content,nickname,homepage,rootid,imgid')->where("Topic.status=1 and Mention.uid=".$id)->order("id desc")->limit($p->firstRow.','.$p->listRows)->select();
        foreach ($list as $key=>$val){
        	$list[$key]['nohtmlcontent'] = filterHtmlCode($list[$key]['content']);
        	$list[$key]['content']=getBlogReplay($list[$key]['content']);
        	$list[$key]['id'] = $val['topic_id'];
        	$list[$key]['from'] = $val['topic_from'];
        	$list[$key]['time'] = getTime($val['create_time']);
        	//截取转发原微博
			if($val['rootid'] != 0){
				
				$transtopic=D('Topic');
				$transtanscom=M('Topic');
				$transuser = D('User');
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
        $this->assign("list", $list);
        $this->assign("page", $page);
		parent::showSiteInfo("提到我的");
        $this->display();
        
	}
}
?>