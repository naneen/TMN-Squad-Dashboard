<?php
require_once dirname(dirname(dirname(__FILE__))).'/core/util/PropertiesConfig.php';
use core\util\PropertiesConfig as PropertiesConfig;

$con = mysqli_connect(
			PropertiesConfig::get("db.host").":".PropertiesConfig::get("db.port"),
			PropertiesConfig::get("db.user"),
			PropertiesConfig::get("db.password"),
			PropertiesConfig::get("db.name")
		);
if (mysqli_connect_errno($con)) {
	throw new Exception('Failed to connect to MySQL: ' . mysqli_connect_error());
}