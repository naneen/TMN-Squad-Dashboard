<?php
require(dirname(dirname(__FILE__)).'/util/autoload.php');
use core\dao\BuildCargoDao as BuildCargoDao;
use core\dao\DeploymentResultDao as DeploymentResultDao;
use core\dao\SystemTestResultDao as SystemTestResultDao;

$buildDao = new BuildCargoDao();
$deployDao = new DeploymentResultDao();
$testDao = new SystemTestResultDao();

$build = $buildDao->getMaxIdBuildSequence();
$deploy = $deployDao->getCountDeploymentResult($build, 1);
$test = $testDao->getCountTestResult($build, 1);
$color = "";
if ($deploy==0 and $test==0 and !is_null($deploy) and !is_null($test)) {
	$color = "pass";
} else {
	$color = "fail";
}

$result = array();
$result["build"] = $build;
$result["color"] = $color; // [pass,fail,warning]
$result["details"] = array();

$callback = "";
if(array_key_exists('callback', $_GET) == TRUE) {
	$callback = $_GET['callback'];
}
print $callback.'('.json_encode($result).')';