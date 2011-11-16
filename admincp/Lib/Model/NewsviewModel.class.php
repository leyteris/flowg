<?php
/**
 * @Date 2011.4.12
 * @File: NewsviewModel.class.php
 * @Author Leyteris
 */
class NewsviewModel extends ViewModel {
    public $viewFields = array(
       'News'=>array('id','title','create_time','uid','content'),
       'User'  =>  array('userid', '_on'=>'News.uid=User.id')
    );
}
?>
