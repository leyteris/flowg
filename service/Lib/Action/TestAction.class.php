<?php
/**
 * 
 * 测试用 接口
 * @author Leyteris
 *
 */
class TestAction extends Action{
	
	/**
	 * 
	 * 测试欢迎
	 * @param unknown_type $name
	 */
	function hello($name) {  
    	return 'Hello ' . $name;  
	} 
	
	/**
	 * 
	 * 测试用
	 * @param $content
	 */
	function test($content){
		
	}
}
?>