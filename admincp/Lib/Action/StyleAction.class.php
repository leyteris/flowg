<?php
/**
 * @Date 2011.4.13
 * @File: StyleAction.class.php
 * @Author Leyteris
 */
class StyleAction extends CommonAction{
	
	/**
	 * 
	 * 初始化
	 */
	function _initialize(){
		
		parent::_initialize();
		header("Content-Type:text/html; charset=utf-8");
		parent::checkRight(STYLERIGHT);
		
    }
	/**
	 * 
	 * 入口
	 */
	public function index() {

    	$model = D("Styleview");
        $count = $model->count();

        $listRows = 8;
        import("ORG.Util.Page");
        $p = new Page($count, $listRows);
        $list =  $model->order("id desc")
        		->limit($p->firstRow.','.$p->listRows)
        		->select();
	    foreach ($list as $key=>$val){
        	$list[$key]['time'] = getTime($val['create_time']);
        }
        $page = $p->show();
        $this->assign("list", $list);
        $this->assign("page", $page);
		parent::showSiteInfo("皮肤列表");
		
        $this->display();
        
	}
	
	/**
	 * 
	 * 显示添加皮肤界面
	 */
   	public function add() {

   		parent::checkRight(CRERIGHT);
   		parent::showSiteInfo("添加皮肤");
   		$this->assign('isedit',0);
		$this->display();
		
	}
	
	/**
	 * 
	 * 对提交的用户进行保存
	 */
   	public function doAdd() {
   		
   		parent::checkRight(CRERIGHT);
		$user = D("Style");
		
		if ($vo = $user->create()) {
			$list = $user->add();
			if ($list) {
				$this->assign("jumpUrl",getFlcmsPath()."style/index"); 
				$this->success("添加成功");
			}else {
				$this->error("操作失败");
			}
		}else {
			$this->error($user->getError());
		}
		
	}
	
    public function delete() {
    	
    	parent::checkRight(DELRIGHT);
        $tp = M("Style");
        $id = $_REQUEST['id'];
        if (isset($id)) {
            $condition[$tp->getPk()] = $id;
            if ($tp->where($condition)->delete()) {
                $this->assign("jumpUrl",getFlcmsPath()."style/index"); 
				$this->success("删除成功");
            }else {
                $this->error($tp->getError());
            }
        }
        
    }

}
?>