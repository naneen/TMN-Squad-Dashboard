<?php
function __autoload($class) {
	$class = dirname(dirname(dirname(__FILE__))) . '/' . str_replace('\\', '/', $class) . '.php';
	#echo "load-class::" . $class;
	#echo "<br/>";
	require_once($class);
}