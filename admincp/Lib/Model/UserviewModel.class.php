<?php
/**
 * @Date 2011.2.18
 * @File: UserviewModel.class.php
 * @Author Leyteris
 */
class UserviewModel extends ViewModel {
	
    public $viewFields = array(
		'User'  =>  array('id','userid','nickname','homepage','avatar','address','create_time','COUNT(Topic.id)'=>'count','_type'=>'LEFT'),
       	'Topic'  =>  array('from'=>'topic_from','content','create_time'=>'topic_create_time','status','_on'=>'User.id=Topic.uid')
    );
    
}
?>