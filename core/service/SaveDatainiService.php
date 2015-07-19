<?php
require(dirname(dirname(__FILE__)).'/util/autoload.php');
use core\util\PropertiesConfig as PropertiesConfig;

PropertiesConfig::set("chart.limitgauge", $_GET['sexy']);
PropertiesConfig::set("chart.testanalystday",$_GET['test']);
PropertiesConfig::set("report.qualityweek.week", $_GET['report']);
PropertiesConfig::store();
$callback = "";
if(array_key_exists('callback', $_GET) == TRUE) {
	$callback = $_GET['callback'];
}
print $callback.'('.json_encode("Success").')';