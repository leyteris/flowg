<?php
/**
 * @Date 2011.2.18
 * @File: UserviewModel.class.php
 * @Author Leyteris
 */
class UserviewModel extends ViewModel {
	
    public $viewFields = array(
		'User'  =>  array('nickname','homepage','avatar','address','COUNT(Topic.id)'=>'count'),
       	'Topic'  =>  array('id'=>'topic_id','create_time','from'=>'topic_from','content','status','_on'=>'User.id=Topic.uid')
    );
    
}
?>