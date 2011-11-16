<?php
/**
 * @Date 2011.3.1
 * @File: HottopicviewModel.class.php
 * @Author Leyteris
 */
class HottopicviewModel extends ViewModel {
	
	public $viewFields = array(  
       'topic'=>array('id','content','rootid','type','from' => 'topic_from','create_time','imgid','_as'=>'root_topic','COUNT(Topic.id)'=>'count'),  
	   'User'  =>  array('nickname','homepage','avatar','_on'=>'root_topic.uid=User.id'),
       'Topic'  =>  array('_on'=>'root_topic.id=topic.rootid')  
    );  
    
}
?>