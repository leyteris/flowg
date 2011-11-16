<?php
/**
 * @Date 2011.4.21
 * @File: SearchAction.class.php
 * @Author Leyteris
 */

class SearchAction extends CommonAction{
	
	/**
	 * 
	 * 入口函数
	 */
	public function index(){
		
		$searchTxt = trim(filterSpecial(H($_REQUEST['searchTxt'])));
		
		$u = M("User");
		
		$ulist = $u->where("nickname like '%".$searchTxt."%'")
					->limit("0,3")
					->select();
					
		$t = D("Topicview");
		$tanscom=M("Topic");
		
		$tlist = $t->where("Topic.content like '%".$searchTxt."%'")
					->group("Topic.id")
					->limit("0,15")
					->select();
					
	   	foreach ($tlist as $key=>$val){

        	$tlist[$key]['from'] = $val['topic_from'];
        	$tlist[$key]['time'] = getTime($val['create_time']);
        	$tlist[$key]['count'] = $tanscom->where("status=1 and rootid=".$val['id']." and (type='comment' or type='transmit')")
        								->count();
        	$tlist[$key]['nohtmlcontent'] = filterHtmlCode($tlist[$key]['content']);
        	$tlist[$key]['content']=getBlogReplay($tlist[$key]['content']);
        	if($val['imgid'] != 0){
				$img = M('Image');
				$tlist[$key]['topicpic'] = $img->find($val['imgid']);
			}
        }
		$this->assign('ulist',$ulist);
		$this->assign('tlist',$tlist);
		$this->display();
	}
}
?>