<?php
/**
 * @Date 2011.4.12
 * @File: RoleAction.class.php
 * @Author Leyteris
 */
class RoleAction extends CommonAction {

	/**
	 * 
	 * 初始化
	 */
	function _initialize(){
		
		parent::_initialize();
		header("Content-Type:text/html; charset=utf-8");
		parent::checkRight(ISSUPER);
		
    }
	/**
	 * 
	 * 入口控制器
	 */
	public function index() {
		
    	$model = D("Role");
        $count = $model->count();

        $listRows = 8;
        import("ORG.Util.Page");
        $p = new Page($count, $listRows);
        $list =  $model->order("id desc")
        			->limit($p->firstRow.','.$p->listRows)
        			->select();
        $page = $p->show();
        $this->assign("list", $list);
        $this->assign("page", $page);
		parent::showSiteInfo("权限列表");
        $this->display();
		
	}
	/**
	 * 
	 * 显示添加权限界面
	 */
   	public function add() {

   		parent::checkRight(CRERIGHT);
   		parent::showSiteInfo("添加权限");
   		$this->assign('isedit',0);
		$this->display();
		
	}
	
	/**
	 * 
	 * 对提交的权限进行保存
	 */
   	public function doAdd() {
   		
   		parent::checkRight(CRERIGHT);
   		parent::showSiteInfo("增加权限级别");
		$role = D("Role");

		if ($vo = $role->create()) {
			$list = $role->add();
			if ($list) {
				$this->assign("jumpUrl",getFlcmsPath()."role/index"); 
				$this->success("添加成功");
			}else {
				$this->error("操作失败");
			}
		}else {
			$this->error($role->getError());
		}
		
	}
	
	/**
	 * 
	 * 显示编辑权限页面
	 */
    public function edit() {
    	
    	parent::checkRight(EDITRIGHT);
    	parent::showSiteInfo("编辑权限级别");
    	$role = D("Role");
    	
        $id = $_REQUEST['id'];
        $r = $role->where('id='.$id)->find();

        if($r) {
            $this->assign('r',$r);
            $this->assign('isedit',1);
            $this->display('add');
        }else{
            $this->error("错误参数");
        }
	}
	
	/**
	 * 
	 * 对提交进行保存
	 */
   	public function doEdit() {
   		
   		parent::checkRight(EDITRIGHT);
		$role = D("Role");

		if ($vo = $role->create()) {
			if ($role->save()) {
				$this->assign("jumpUrl",getFlcmsPath()."role/index"); 
				$this->success("修改成功");
			}else {
				$this->error("修改失败");
			}
		}else {
			$this->error($role->getError());
		}
		
	}

	/**
	 * 
	 * 删除该权限类别
	 */
    public function delete() {
    	
    	parent::checkRight(DELRIGHT);
        $role = M("Role");
        
        $id = $_REQUEST['id'];
        if (isset($id)) {
            $condition[$role->getPk()] = $id;
            if ($role->where($condition)->delete()) {
            	$this->assign("jumpUrl",getFlcmsPath()."role/index"); 
                $this->success("删除成功");
            }else {
                $this->error($role->getError());
            }
        }
        
    }
}
?>