<?php
/**
 * @Date 2011.4.12
 * @File: NewsAction.class.php
 * @Author Leyteris
 */
class NewsAction extends CommonAction {
	
	/**
	 * 
	 * 初始化
	 */
	function _initialize(){
		
		parent::_initialize();
		header("Content-Type:text/html; charset=utf-8");
		parent::checkRight(NEWSRIGHT);
		
    }
    
	/**
	 * 
	 * 入口
	 */
	public function index() {
		
    	$model = D("Newsview");
        $count = $model->count();

        $listRows = 8;
        import("ORG.Util.Page");
        $p = new Page($count, $listRows);
        $list =  $model->field('id,userid,title,create_time')->where("status=1")->order("id desc")->limit($p->firstRow.','.$p->listRows)->select();
        foreach ($list as $key=>$val){
        	$list[$key]['time'] = getTime($val['create_time']);
        }
        $page = $p->show();
        $this->assign("list", $list);
        $this->assign("page", $page);
		parent::showSiteInfo("公告列表");
        $this->display();
        
	}

	/**
	 * 
	 * 显示撰写文章界面
	 */
   	public function add() {
   		
   		parent::checkRight(CRERIGHT);
   		parent::showSiteInfo("发布公告");
   		$this->assign('isedit',0);
		$this->display();
		
	}
	
	/**
	 * 
	 * 对提交的文章进行保存
	 */
   	public function doAdd() {
   		
   		parent::checkRight(CRERIGHT);
		$News = D("News");

		if ($vo = $News->create()) {
			$list = $News->add();
			if ($list) {
				$this->assign("jumpUrl",getFlcmsPath()."news/index"); 
				$this->success("添加成功");
			}else {
				$this->error("操作失败");
			}
		}else {
			$this->error($News->getError());
		}
		
	}
	
	/**
	 * 
	 * 显示编辑页面
	 */
    public function edit() {

    	parent::checkRight(EDITRIGHT);
    	parent::showSiteInfo("编辑公告");
    	$News = D("News");
        $id = $_REQUEST['id'];
        $arti = $News->where('id='.$id)->find();

        if($arti) {
            $this->assign('arti',$arti);
            $this->assign('isedit',1);
            $this->display('add');
        }else{
            $this->error("错误参数");
        }
	}
	
	/**
	 * 
	 * 对提交的文章进行保存
	 */
   	public function doEdit() {

   		parent::checkRight(EDITRIGHT);
		$News = D("News");

		if ($vo = $News->create()){

			if ($News->save($vo)) {
				$this->assign("jumpUrl",getFlcmsPath()."news/index"); 
				$this->success("修改成功");
			}else {
				$this->error("修改失败");
			}
		}else {
			$this->error($News->getError());
		}

	}

    public function delete() {
    	
    	parent::checkRight(DELRIGHT);
        $arti =  M("News");
        $id = $_REQUEST['id'];
        if (isset($id)) {
            $condition[$arti->getPk()] = $id;
            if ($arti->where($condition)->delete()) {
            	$this->assign("jumpUrl",getFlcmsPath()."news/index"); 
				$this->success("公告删除成功！");
            }else {
                $this->error($arti->getError());
            }
        }
        
    }
}
?>