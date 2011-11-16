<?php
/**
 * @Date 2011.4.12
 * @File: StyleviewModel.class.php
 * @Author Leyteris
 */
class StyleviewModel extends ViewModel {
    public $viewFields = array(
       'Style'=>array('id','title','path','create_time','uid'),
       'User'  =>  array('userid', '_on'=>'Style.uid=User.id')
    );
}
?>
