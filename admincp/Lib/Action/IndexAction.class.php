<?php
/**
 * @Date 2011.4.13
 * @File: IndexAction.class.php
 * @Author Leyteris
 */
class IndexAction extends CommonAction{
	
	/**
	 * 
	 * 初始化
	 */
	public function index() {
		parent::showSiteInfo("文章列表");
        $this->display();
	}

}
?>