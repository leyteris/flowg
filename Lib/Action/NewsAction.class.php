<?php
/**
 * @Date 2011.1.4
 * @File: NewsAction.class.php
 * @Author Leyteris
 */
class NewsAction extends CommonAction{
	
	/**
	 * 
	 * 入口地址
	 */
	public function index(){
			
		parent::islogin();
	
		$u=D('Newsview');
	
		$list=$u->order('id desc')
			->limit("0,20")
			->select();
		foreach ($list as $k => $v){
			$list[$k]['time'] = getRealTime($v['create_time']);
			$v['content'] = cutText($v['content'],200);
		}
		$this->assign('list',$list);
		parent::showSiteInfo("公告");
        $this->display();
	}	
	
    /**
     * 
     * 显示页面
     */
	public function showNews(){
		
		$id=$_GET['id'];
		if(!isset($id)){
			$this->error("异常参数");
			exit;
		}
    	$model = D("Newsview");
        $list = $model->where("News.id=".$id)
        				->find();

        $list['time'] = getRealTime($list['create_time']);

        $this->assign("list", $list);
		parent::showSiteInfo("公告 - ".$list['title']);
        $this->display();
        
	}
}
?>