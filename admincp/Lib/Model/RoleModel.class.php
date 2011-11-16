<?php
/**
 * @Date 2011.1.12
 * @File: RoleModel.class.php
 * @Author Leyteris
 */
class RoleModel extends Model {

    protected $_validate = array(
        array('name', 'require', '权限名称不能为空！'),
        array('delright', 'require', '删除权限不能为空！'),
        array('editright', 'require', '编辑权限不能为空！'),
        array('creright', 'require', '撰写权限不能为空！'),
        array('issuper', 'require', '是否为超级管理员权限不能为空！')
    );
}
?>