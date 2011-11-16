<?php
/**
 * @Date 2011.2.15
 * @File: TagviewModel.class.php
 * @Author Leyteris
 */
class TagviewModel extends ViewModel {
	
    public $viewFields = array(
       'Tag' => array('id','tagname','COUNT(Topic.id)'=>'count'),
       'Topic'  =>  array('id'=>'topic_id','create_time','imgid','type','uid','rootid','from'=>'topic_from','content','status','_on'=>'Tag.id=Topic.tagid'),
       'User'  =>  array('userid','nickname','homepage','avatar','_on'=>'Topic.uid=User.id')
    );
    
}
?>