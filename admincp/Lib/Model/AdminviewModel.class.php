<?php
/**
 * @Date 2011.1.12
 * @File: AdminviewModel.class.php
 * @Author Leyteris
 */
class AdminviewModel extends ViewModel {
    public $viewFields = array(
       'User'  =>  array('id','userid','create_time'),
       'Role'  =>  array('id'=>'role_id','rolename','user_right','sys_right','tag_right','topic_right','news_right','style_right','del_right','edit_right','cre_right','issuper','_on'=>'user.roleid=role.id')
    );
}
?>
