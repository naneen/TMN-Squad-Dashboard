<?php
require (dirname(dirname(__FILE__)).'/util/autoload.php');
use core\dao\BuildCargoDao as Buildcargo;

$buildcargo = new Buildcargo();
$models = $buildcargo->getMaxWeekofbuildsequence();
$callback = "";
if(array_key_exists('callback', $_GET) == TRUE) {
	$callback = $_GET['callback'];
}
print $callback.'('.json_encode($models).')';