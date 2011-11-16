<?php
/**
 * @Date 2011.3.1
 * @File: HotUserviewModel.class.php
 * @Author Leyteris
 */
class HotuserviewModel extends ViewModel {
	
    public $viewFields = array(
		'User'  =>  array('id','nickname','homepage','avatar','COUNT(Follow.id)'=>'count'),
       	'Follow' => array('_on'=>'User.id=Follow.objuid')
    );
    
}
?>