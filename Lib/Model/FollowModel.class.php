<?php
/**
 * @Date 2010.12.12
 * @File: FollowModel.class.php
 * @Author Leyteris
 */
class FollowModel extends Model {
	
	private $ormObj;
	
	function __construct(){
		
		parent::__construct();
		$this->ormObj=M('Follow');
		
	}
	
	public function getGZlist($limit=8){
		
		return $this->ormObj->field("*,count(id) as num")->limit($limit)->group('objuid')->order('num desc')->select();
	
	}
}
?>