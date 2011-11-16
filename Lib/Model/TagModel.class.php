<?php
/**
 * @Date 2010.12.12
 * @File: TagModel.class.php
 * @Author Leyteris
 */
class TagModel extends Model {
	
	private $ormObj;

	function __construct(){
		parent::__construct();
		$this->ormObj=M('Tag');
	}

	public function getInfo($id){
		
		return  $this->ormObj->find($id);
		
	}

	public function delTag($id){
		
		return $this->ormObj->delete($id);
		
	}

    public function checkTag($data){
    	
		return $this->ormObj->where($data)->find();
		
	}

    public function isMyTag($id,$user){
    	
         $rs=$this->checkTag(array('id'=>$id,'create_user'=>$user));
         if(!$rs)
             return FALSE;
         else
             return true;
    }

}
?>