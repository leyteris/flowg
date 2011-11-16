<?php
/**
 * @Date 2011.1.12
 * @File: UserModel.class.php
 * @Author Leyteris
 */
class UserModel extends Model {

    protected $_validate = array(
        array('name', 'require', '标题必须！'),
        array('name', '',' 帐号名称已经存在！ ',0,'unique',1),
        array('rid','require',"权限必须！"),
        array('password','require',"密码必须！"),
        array('repassword','require', "请重新输入一次密码！"),
        array('repassword','password','确认密码不正确 ',0,'confirm')  

    );

    protected $_auto = array(
        array('status', 1),
        array('password','md5',3,'function'),
        array('create_time', 'time', 1, 'function')
    );
    
}
?>