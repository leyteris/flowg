<?php
/**
 * @Date 2011.3.2
 * @File: TopickongviewModel.class.php
 * @Author Leyteris
 */
class TopickongviewModel extends ViewModel {
	
    public $viewFields = array(
    	'Follow' => array('uid','objuid'),
		'User'  =>  array('nickname','homepage','avatar','address','_on'=>'User.id=Follow.objuid'),
       	'Topic'  =>  array('id','rootid','create_time','from'=>'topic_from','content','type','imgid','status','_on'=>'Topic.uid=Follow.objuid')
    );
    
}
?>