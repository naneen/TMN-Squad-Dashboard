<?php
require(dirname(dirname(__FILE__)).'/core/util/dbconnect.php');
if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
	//$e2egroupname = str_replace("%20"," ",$_GET[groupname]);
	$deploymentresult = $_GET[deploymentresult];
	if($deploymentresult != 0)
	{
		$deploymentresult = 1;
	}
	$appname = $_GET[appname];
	
	//echo $deploymentresult . "<br>";
	//echo $appname . " = ";
	
	$maxbuildresult = "SELECT max(idBuildResult )as maxidBuildResult FROM qualitydashboard.buildresult,qualitydashboard.projectindex
where buildresult.idProjectIndex=projectindex.idProjectIndex
and ProjectName='" . $appname . "';";
	$resultmaxbuildresult = mysqli_query($con,$maxbuildresult);
	$rowmaxbuildresult = mysqli_fetch_array($resultmaxbuildresult);
	echo $maxbuildresult;
	//echo $rowmaxbuildresult['maxidBuildResult'] . "<br>";
	
	$addtestresult = "INSERT INTO `qualitydashboard`.`deploymentresult`(`DeploymentResult`,`idBuildResult`,`DeploymentDate`)
		VALUES(" . $deploymentresult . "," . $rowmaxbuildresult['maxidBuildResult'] . ",now());";
	echo $addtestresult;
	$resultaddtestresult = mysqli_query($con,$addtestresult);
	//echo $addtestresult;
	
}

mysqli_close($con);
?>