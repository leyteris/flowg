<?php
/**
 * @Date 2011.4.13
 * @File: TagAction.class.php
 * @Author Leyteris
 */
class TagAction extends CommonAction{
	
	/**
	 * 
	 * 初始化
	 */
	function _initialize(){
		
		parent::_initialize();
		header("Content-Type:text/html; charset=utf-8");
		parent::checkRight(TAGRIGHT);
		
    }
    
	/**
	 * 
	 * 入口
	 */
	public function index() {

    	$model = D("Tagview");
    	$tag = M("Tag");
        $count = $tag->count();

        $listRows = 10;
        import("ORG.Util.Page");
        $p = new Page($count, $listRows);
        $list =  $model->field('id,userid,tagname,count,create_time')
        		->group('Tag.id')
        		->order("id desc")
        		->limit($p->firstRow.','.$p->listRows)
        		->select();
        		
        foreach ($list as $key=>$val){
        	$list[$key]['time'] = getTime($val['create_time']);
        }
        $page = $p->show();
        $this->assign("list", $list);
        $this->assign("page", $page);
		parent::showSiteInfo("话题列表");
		
        $this->display();
        
	}
	
	/**
	 * 
	 * 删除
	 */
    public function delete() {
    	
    	parent::checkRight(DELRIGHT);
        $tp = M("Tag");
        $id = $_REQUEST['id'];
        if (isset($id)) {
            $condition[$tp->getPk()] = $id;
            if ($tp->where($condition)->delete()) {
                $this->assign("jumpUrl",getFlcmsPath()."tag/index"); 
				$this->success("删除成功");
            }else {
                $this->error($tp->getError());
            }
        }
        
    }

}
?>