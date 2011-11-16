<?php
/**
 * @Date 2011.4.19
 * @File: SystemAction.class.php
 * @Author Leyteris
 */
class SystemAction extends CommonAction{
	
	/**
	 * 
	 * 初始化
	 */
	function _initialize(){
		
		parent::_initialize();
		header("Content-Type:text/html; charset=utf-8");
		parent::checkRight(SYSRIGHT);
		
    }
	/**
	 * 
	 * 入口
	 */
	public function index() {
		
		$site = M("Site");
        $r = $site->where('id=1')->find();

        if($r) {
            $this->assign('r',$r);
        }else{
            $this->error("错误参数");
        }
        
		parent::showSiteInfo("系统设置");
        $this->display();
        
	}
	
	/**
	 * 
	 * 对提交进行保存
	 */
   	public function doEdit() {
   		
   		parent::checkRight(EDITRIGHT);
		$site = M("site");

		if ($vo = $site->create()) {
			if ($site->save()) {
				$this->assign("jumpUrl",getFlcmsPath()."index/index"); 
				$this->success("修改成功");
			}else {
				$this->error("修改失败");
			}
		}else {
			$this->error($site->getError());
		}
		
	}

}
?>