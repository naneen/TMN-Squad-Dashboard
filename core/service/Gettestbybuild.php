<?php
require (dirname(dirname(__FILE__)).'/util/autoload.php');
use core\dao\SystemTestResultDao as Systemre;

$systemresult = new Systemre();
$models = $systemresult->getTestbyBuild($_GET['build'],$_GET['order']);
$callback = "";
if(array_key_exists('callback', $_GET) == TRUE) {
	$callback = $_GET['callback'];
}
print $callback.'('.json_encode($models).')';
