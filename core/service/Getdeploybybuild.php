<?php
require(dirname(dirname(__FILE__)).'/util/autoload.php');
use core\dao\DeploymentResultDao as Deployment;

$deploymentre = new Deployment();
$models = $deploymentre->getDeploybyBuild($_GET['build'],$_GET['order']);
$callback = "";
if(array_key_exists('callback', $_GET) == TRUE) {
	$callback = $_GET['callback'];
}
print $callback.'('.json_encode($models).')';
