<?php
/**
 * @Date 2011.2.18
 * @File: TopicviewModel.class.php
 * @Author Leyteris
 */
class TopicviewModel extends ViewModel {
	
    public $viewFields = array(
		'User'  =>  array('nickname','homepage','avatar','address','COUNT(Topic.id)'=>'own_count'),
       	'Topic'  =>  array('id','rootid','create_time','from'=>'topic_from','content','type','imgid','status','_on'=>'User.id=Topic.uid')
    );
    
}
?>