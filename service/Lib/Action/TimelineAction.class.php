<?php
/**
 * 
 * 获取下行数据集(timeline)接口
 * @author Leyteris
 *
 */
class TimelineAction extends AccountAction{

	/**
	 * 
	 * 取得当前用户及索关注用户的len条微博
	 * @param mix $source
	 * @param int $since_id
	 * @param int $len
	 */
	public function home_timeline($source,$since_id = 0,$len = 20){
		
		if(parent::verify_credentials($source)){
			
			$id = $_SESSION['USER_OBJ']['id'];
			
			$top=M("Topic");
			$fol=M('Follow');
			$user = M('User');
			$tguserid = '';
			$follist=$fol->where('uid='.$id)->select();
			for($i=0;$i<count($follist);$i++){
				$tguserid.=$follist[$i]['objuid'].',';
			}
			$tguserid.=$id;
			$where=" instr('".$tguserid."',uid) and status=1 and (type='first' or type='transmit')";
			$count=$top->where($where)->count();
			$list=$top->where($where)->order('id desc')->limit($since_id.','.$len)->select();
			foreach($list as $key=>$topic){

				//$list[$key]['count']=$tanscom->where('rootid='.$topic['id'])->count();
				$volist = $user->where('id='.$topic['uid'])->find();
				$list[$key]['avatar']=$volist['avatar'];
				$list[$key]['nickname']=$volist['nickname'];
				$list[$key]['homepage']=$volist['homepage'];
				//$list[$key]['content']=getBlogReplay($list[$key]['content']);
				$list[$key]['topic_create_time'] = getTime($list[$key]['create_time']);
						
			}
			return $list;
		}else{
			return 'F';
		}
	}

	/**
	 * 
	 * 取得当前用户len条微博
	 * @param mix $source
	 * @param int $since_id
	 * @param int $len
	 */
	public function selfuser_timeline($source,$since_id = 0,$len = 20){
		
		if(parent::verify_credentials($source)){
			
			$id = $_SESSION['USER_OBJ']['id'];
			
			$top=M("Topic");
			$fol=M('Follow');
			$user = M('User');
			
			$follist=$fol->where('uid='.$id)->select();
			for($i=0;$i<count($follist);$i++){
				$tguserid.=$follist[$i]['objuid'].',';
			}
			$tguserid.=$id;
			$where=" instr('".$tguserid."',uid) and status=1 and (type='first' or type='transmit')";
			$count=$top->where($where)
				->count();
			$list=$top->where($where)
				->order('id desc')
				->limit($since_id.','.$len)
				->select();
			/*
			foreach($list as $key=>$topic){

				//$list[$key]['count']=$tanscom->where('rootid='.$topic['id'])->count();
				$volist = $user->where('id='.$topic['uid'])->find();
				$list[$key]['avatar']=$volist['avatar'];
				$list[$key]['nickname']=$volist['nickname'];
				$list[$key]['homepage']=$volist['homepage'];
				//$list[$key]['content']=getBlogReplay($list[$key]['content']);
				//$list[$key]['topiccreate_time'] = getTime($list[$key]['create_time']);
						
			}
			*/
			if($list){
				
				return $list;
			}else{
				
				return 'F';
			}
		}else{
			
			return 'F';
		}

	}
	
	/**
	 * 
	 * 取得id用户len条微博
	 * @param mix $source
	 * @param int $id
	 * @param int $since_id
	 * @param int $len
	 */
	public function user_timeline($source,$id,$since_id = 0,$len = 20){
		
		if(parent::verify_credentials($source)){
			
			if($id){
				if(!checkId32($id)){

					return 'F';
				}
			}
			
			$top=M("Topic");
			$user = M('User');
			$urs = $user ->where("id=".$id)
					->find();
			if(!$urs){
				
				return 'F';
			}
			$list=$top->where("uid=".$id." and status=1 and (type='first' or type='transmit')")
				->order('id desc')
				->limit($since_id.','.$len)
				->select();
			if($list){
				
				return $list;
			}else{
				
				return 'F';
			}
		}else{
			
			return 'F';
		}
		
	}
	
	/**
	 * 
	 * 取得提到我的信息
	 * @param mix $source
	 * @param int $since_id
	 * @param int $len
	 */
	public function mentions_timeline($source,$since_id = 0,$len = 20){
		
		if(parent::verify_credentials($source)){
			
			$id = $_SESSION['USER_OBJ']['id'];
			$model = D("Mentionview");

	        $list =  $model->field('topic_id,uid,tid,avatar,create_time,topic_from,content,nickname,homepage')
	        	->where("Topic.status=1 and Mention.uid=".$id)
	        	->order("id desc")
	        	->limit($since_id.','.$len)
	        	->select();
	        /*foreach ($list as $key=>$val){
	        	$list[$key]['id'] = $val['topic_id'];
	        	$list[$key]['from'] = $val['topic_from'];
	        	$list[$key]['time'] = getTime($val['create_time']);
	        }*/
	        	
			if($list){
				
				return $list;
			}else{
				
				return 'F';
			}
		}else{
			
			return 'F';
		}
		
	}
}
?>