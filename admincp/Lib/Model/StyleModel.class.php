<?php
/**
 * @Date 2011.1.12
 * @File: StyleModel.class.php
 * @Author Leyteris
 */
class StyleModel extends Model {

    protected $_validate = array(
        array('name', 'require', '标题必须！'),
        array('name', '',' 标题名称已经存在！ ',0,'unique',1),
        array('path','require',"路径必须！"),
    );

    protected $_auto = array(
     	array('uid', 'getUID', 1, 'function'),
        array('create_time', 'time', 1, 'function')
    );
    
}
?>