<?php
/**
 * @Date 2010.12.12
 * @File: TopicModel.class.php
 * @Author Leyteris
 */
class TopicModel extends Model {
	
	//protected $trueTableName = 'fl_topic';  
	private $ormObj;
	
	/**
	 * 
	 * 构造函数
	 */
	function __construct(){
		
		parent::__construct();
		$this->ormObj=M('Topic');
	}
	
	/**
	 * 
	 * 取得数量
	 * @param string $where
	 */
	public function getCount($where=""){
		
		if($where){
			return $this->ormObj->where($where)->count();
		}else{
			return $this->ormObj->count();
		}
		
	}
	
	/**
	 * 
	 * 得到数据库返回结果结果集
	 * @param string $where
	 * @param int $limit
	 * @param string $order
	 */
	public function getList($where="",$limit=8,$order="id desc"){
		
		$list=array();
		
		if($where){
			$list=$this->ormObj->where($where)->limit($limit)->order($order)->select();
		}else{
			$list=$this->ormObj->limit($limit)->order($order)->select();
		}
		
		return $list;
	}
	
	/**
	 * 
	 * 查询对应id的结果
	 * @param int $id
	 */
	public function getInfo($id){
		
		return $this->ormObj->find($id);
		
	}
	
	
	/**
	 * 
	 * 取得热门微博
	 * @param int $limit
	 */
	public function getHotTopic($limit=8){
		
		$mc=M('comment');
		$rs=FALSE;
		
		if($limit){
			$rs=$mc->field('id,rootid,count(id) as count')->limit($limit)->order('count desc')->group('pid')->select();
		}else{
			$rs=$mc->field('id,rootid,count(id) as count')->order('count desc')->group('pid')->select();
		}
		if($rs){
			for($i=0;$i<count($rs);$i++){
				$info=$this->getInfo($rs[$i]['pid']);
				$rs[$i]['title']=strip_tags($info['title']);
				$rs[$i]['tid']=$info['id'];
			}
		}
		if($rs){
			return list_sort_by($rs,"count","desc");
		}
	}
	
	
	
    public function getNewReplayTopic($limit=8){
    	
		$mc=M('comment');
		$rs=FALSE;
		
		if($limit){
			$rs=$mc->field('id,pid,count(id) as count')->limit($limit)->order('time desc,count desc')->group('pid')->select();
		}else{
			$rs=$mc->field('id,pid,count(id) as count')->order('time desc,count desc')->group('pid')->select();
		}
		if($rs){
			for($i=0;$i<count($rs);$i++){
				$info=$this->getInfo($rs[$i]['pid']);
				$rs[$i]['title']=strip_tags($info['title']);
				$rs[$i]['tid']=$info['id'];
			}
		}
		
		return $rs;
		
	}

	public function getHotUser($limit=8){
		
		if($limit)
			return $this->ormObj->field('id,uid,count(id) as num')->group('userid')->limit($limit)->order('num desc')->select();
		else
			return $this->ormObj->field('id,uid,count(id) as num')->order('num desc')->group('userid')->select();
			
	}
	
	/**
	 * 
	 * 转发微博
	 * @param String $content
	 * @param int $rootid
	 * @param int $uid
	 */
    public function transmitTopic($content,$rootid,$uid){
    	
    	$info=$this->getInfo($rootid);
        $data['uid']=$uid;
        $data['content']=$content;
        $data['rootid']=$rootid;
        $data['tagid']=$info['tagid']; //定义话题为同一话题
        $data['status']=1;
        $data['create_time']=time();
        $data['type']="transmit";
        $ok=$this->ormObj->add($data);
    	if($ok){
			return $ok;
		}else{
			return false;
		}
        
    }
    
    /**
     * 
     * 增加评论
     * @param String $content
     * @param int $rootid
     * @param int $uid
     */
    public function addComment($content,$rootid,$uid){
    	
        $data['uid']=$uid;
        $data['content']=$content;
        $data['rootid']=$rootid;
        $data['status']=1;
        $data['create_time']=time();
        $data['type']="comment";
        $ok=$this->ormObj->add($data);
    	if($ok){
			return $ok;
		}else{
			return false;
		}
        
    }
    
    /**
     * 
     * 增加评论
     * @param String $content
     * @param int $rootid
     * @param int $uid
     */
    public function addAtta($content,$rootid,$uid){
    	
        $data['uid']=$uid;
        $data['content']=$content;
        $data['rootid']=$rootid;
        $data['status']=1;
        $data['create_time']=time();
        $data['type']="dialog";
        $ok=$this->ormObj->add($data);
    	if($ok){
			return $ok;
		}else{
			return false;
		}
        
    }
    
    /**
     * 
     * 删除单行微博
     * @param int $id
     */
    public function deleteTopic($id){
    	
        return $this->ormObj->delete($id);
        
    }
    
    /**
     * 
     * 关联删除
     * @param int $rootid
     */
    public function deleteTopicByRootid($rootid){
    	
        return $this->ormObj->where('rootid='.$rootid)->delete();
        
    }
    


    public function getHotTransmitTopic($limit=10){
    	
    	return $this->ormObj->limit($limit)->where('rootid=0')->order('trans_count desc,time desc')->select();
    	
    }

}
?>
