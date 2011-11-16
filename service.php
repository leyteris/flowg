<?php
/*
 * @date: 2011-2-15
 * @file: service.php
 * @author: Leyteris
 */
define( 'THINK_PATH' ,  './Core' );
define('APP_PATH','service');
define('APP_NAME','service');
define('THINK_MODE','PHPRPC'); 
require(THINK_PATH."/ThinkPHP.php");
App::run();
?>
