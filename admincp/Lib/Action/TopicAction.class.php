<?php
/**
 * @Date 2011.4.13
 * @File: TopicAction.class.php
 * @Author Leyteris
 */
class TopicAction extends CommonAction{
	
	/**
	 * 
	 * 初始化
	 */
	function _initialize(){
		
		parent::_initialize();
		header("Content-Type:text/html; charset=utf-8");
		parent::checkRight(TOPICRIGHT);
		
    }
    
	/**
	 * 
	 * 入口
	 */
	public function index() {

    	$model = D("Topicview");
        $count = $model->where("Topic.status=1")->count();

        $listRows = 8;
        import("ORG.Util.Page");
        $p = new Page($count, $listRows);
        $list =  $model->field('id,userid,nickname,content,create_time')
        		->where("Topic.status=1")
        		->order("id desc")
        		->limit($p->firstRow.','.$p->listRows)
        		->select();
        		
        foreach ($list as $key=>$val){
        	$list[$key]['time'] = getTime($val['create_time']);
        }
        $page = $p->show();
        $this->assign("list", $list);
        $this->assign("page", $page);
		parent::showSiteInfo("微博列表");
		
        $this->display();
        
	}
	
	/**
	 * 
	 * 删除
	 */
    public function delete() {
    	
    	parent::checkRight(DELRIGHT);
        $tp = M("Topic");
        $id = $_REQUEST['id'];
        if (isset($id)) {
            $condition[$tp->getPk()] = $id;
            if ($tp->where($condition)->delete()) {
                $this->assign("jumpUrl",getFlcmsPath()."topic/index"); 
				$this->success("删除成功");
            }else {
                $this->error($tp->getError());
            }
        }
        
    }
    
	/**
	 * 
	 * 入口
	 */
	public function show() {

    	$model = D("Topicview");
        $count = $model->where("Topic.status=1")->count();

        $listRows = 8;
        import("ORG.Util.Page");
        $p = new Page($count, $listRows);
        $list =  $model->field('id,userid,nickname,content,create_time')
        		->where("Topic.status=1")
        		->order("id desc")
        		->limit($p->firstRow.','.$p->listRows)
        		->select();
        		
        foreach ($list as $key=>$val){
        	$list[$key]['time'] = getTime($val['create_time']);
        }
        $page = $p->show();
        $this->assign("list", $list);
        $this->assign("page", $page);
		parent::showSiteInfo("微博详细信息");
		
        $this->display();
        
	}

}
?>