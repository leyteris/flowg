<?php
/**
 * @Date 2011.2.21
 * @File: MentionviewModel.class.php
 * @Author Leyteris
 */
class MentionviewModel extends ViewModel {
	
    public $viewFields = array(
       'Mention'=>array('id','tid','uid'),
       'Topic'  =>  array('id'=>'topic_id','create_time','from'=>'topic_from','content','status','_on'=>'Mention.tid=Topic.id'),
       'User'  =>  array('nickname','homepage','avatar','_on'=>'Topic.uid=User.id')
    );
    
}
?>