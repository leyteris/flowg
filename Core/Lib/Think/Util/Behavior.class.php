<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2010 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id: Behavior.class.php,v 1.1 2010/12/12 03:12:18 leyteris Exp $

/**
 +------------------------------------------------------------------------------
 * 行为抽象类
 +------------------------------------------------------------------------------
 * @category   Think
 * @package  Think
 * @subpackage  Util
 * @author liu21st <liu21st@gmail.com>
 * @version  $Id: Behavior.class.php,v 1.1 2010/12/12 03:12:18 leyteris Exp $
 +------------------------------------------------------------------------------
 */
abstract class Behavior extends Think {
    // 执行行为的接口方法
    abstract public function run();
}
?>