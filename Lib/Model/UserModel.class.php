<?php
/**
 * @Date 2010.12.12
 * @File: UserModel.class.php
 * @Author Leyteris
 */
class UserModel extends Model {
	
	//protected $trueTableName = 'fl_user';  

	private $ormObj;
	
	/**
	 * 
	 * 构造函数
	 */
	function __construct(){
		
		parent::__construct();
		$this->ormObj=M('User');
		
	}
	
	/**
	 * 
	 * 取得本昵称
	 */
	function getThisNickname(){
		
		$rs=$this->ormObj->where("userid='".getUserID()."'")->find();
		return  $rs['nickname'];
		
	}
	/**
	 * 
	 * 按照域取得单个行结果
	 * @param int $id
	 * @param string $field
	 */
	public function getInfo($id,$field="*"){
		
		return  $this->ormObj->field($field)->find($id);
		
	}
	
	/**
	 * 
	 * 按照where取得单个行结果
	 * @param string $where
	 */
	public function getInfoByWhere($where){
		
		return $this->ormObj->where($where)->find();
		
	}
	
	/**
	 * 
	 * 对单行数据进行更新
	 * @param mix $data
	 * @param int $id
	 */
	public function updateInfo($data,$id){
		
		if($this->ormObj->where('id='.$id)->save($data)){
			return true;
		}else{
			return false;
		}
		
	}
	
	
	/**
	 * 
	 * 保存单行数据
	 * @param mix $data
	 * @param int $id
	 */
	public function saveInfo($data,$id){
		
		return $this->ormObj->where('id='.$id)->save($data);
		
	}
	
	/**
	 * 
	 * 检查自动登录
	 * @param int $uid
	 * @param string $pwd
	 */
	public function checkAutoLogin($uid,$pwd){
		
		$rs=false;
		
		$rs=$this->ormObj->where("userid='".$uid."'")->find();
		if($rs){
			if($rs['password']==$pwd){
				Session::set(C('USER_AUTH_KEY'),$uid);
			}
		}
		
	}
	
}
?>