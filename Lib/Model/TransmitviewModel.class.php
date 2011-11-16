<?php
/**
 * @Date 2011.2.15
 * @File: TransmitviewModel.class.php
 * @Author Leyteris
 */
class TransmitviewModel extends ViewModel {
	
    public $viewFields = array(
       'topic'=>array('id'=>'root_id','content'=>'root_content','_as'=>'root_topic'),
       'Topic'  =>  array('id'=>'topic_id','create_time','from'=>'topic_from','content','status','_on'=>'root_topic.id=topic.rootid')
       //'User'  =>  array('nickname','homepage','avatar','_on'=>'Topic.uid=User.id')
    );
    
}
?>