<?php
/**
 * @Date 2011.1.4
 * @File: FavoriteAction.class.php
 * @Author Leyteris
 */

class FavoriteAction extends CommonAction{

	public function index(){
		
		parent::islogin();
		
		import("ORG.Util.Page");
		
		$length=20;
		$id=getUserID();
		
		$fav=M('Favorites')->getTableName();
		$user=M('User')->getTableName();
		$topic=M('Topic')->getTableName();
		
		$top=M("Topic");
		$tanscom=M("Topic");
		
		$Model = new Model();
		
		$where = "select t.id,t.rootid,t.type,u.nickname,u.avatar, u.homepage,t.imgid,t.create_time,f.id as fid,f.create_time favcreate_time,t.content,t.from from ".$fav." f,".$user." u,".$topic." t where f.uid=".$id." and f.tid=t.id and t.uid=u.id";
		
		$countwhere = "select count(*) as tp_count from ".$fav." f,".$user." u,".$topic." t where f.uid=".$id." and f.tid=t.id and t.uid=u.id";
		$count=$Model->query($countwhere);
		
		$page=new Page($count[0]['tp_count'],$length);
		$where .=" order by fid desc limit ".$page->firstRow.",".$page->listRows;
		$list=$Model->query($where); 
		
		$show=$page->show();
		foreach($list as $key=>$arr){

			$id=$arr['id'];
			$list[$key]['count']=$tanscom->where("(type='comment' or type='transmit') and status=1 and rootid=".$id)->count();
			$list[$key]['nohtmlcontent'] = filterHtmlCode($list[$key]['content']);
			$list[$key]['content']=getBlogReplay($list[$key]['content']);
			$list[$key]['topiccreate_time'] = getTime($list[$key]['create_time']);
			$list[$key]['favcreate_time'] = getTime($list[$key]['favcreate_time']);

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
					$list[$key]['transtopic']['count']=$transtanscom->where('status=1 and rootid='.$arr['rootid']." and (type='comment' or type='transmit')")->count();
				}

			}
			
			if($arr['imgid'] != 0){
				$img = M('Image');
				$list[$key]['topicpic'] = $img->find($arr['imgid']);
			}
		}
		
		$this->assign('list',$list);
		$this->assign('page',$show);
		
		parent::showSiteInfo("我的收藏");
		
		$this->display();
		
	}
}

?>