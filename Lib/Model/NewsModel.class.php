<?php
/**
 * @Date 2010.12.12
 * @File: NewsModel.class.php
 * @Author Leyteris
 */
class NewsModel extends Model {
	
	private $ormObj;
	
	function  __construct(){
		
		parent::__construct();
		$this->ormObj=M('News');
		
	}
	
	/**
	 * 
	 * 取得结果集
	 * @param int $limit
	 */
	public function getList($limit=6){
		
		if($limit){
			return $this->ormObj->limit($limit)->order('id desc')->select();
		}else{
			return $this->ormObj->order('id desc')->select();
		}
			
	}
}
?>