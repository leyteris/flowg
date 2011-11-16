<?php
/**
 * @Date 2011.3.2
 * @File: TopicfollowviewModel.class.php
 * @Author Leyteris
 */
class TopickongviewModel extends ViewModel {
	
    public $viewFields = array(
		'User'  =>  array('id','nickname','homepage','avatar','COUNT(Topic.id)'=>'count'),
       	'Topic'  =>  array('_on'=>'User.id=Topic.uid')
    );
    
}
?>