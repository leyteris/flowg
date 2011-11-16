<?php
/**
 * @Date 2011.4.12
 * @File: NewsModel.class.php
 * @Author Leyteris
 */
class NewsModel extends Model {

    protected $_validate = array(
        array("title", "require", "标题必须！"),
        array('content', 'require', "内容必须！")
    );

    protected $_auto = array(
     	array('uid', 'getUID', 1, 'function'),
        array('create_time', 'time', 1, 'function')
    );
    
}
?>