<?php
include 'dbconnect.php';

if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
	$query = "SELECT count(idbuildsequence) as rowspan,idbuildresult,idbuildsequence
	,DATE_FORMAT(timestamp,'%Y-%m-%d %H:%i') as date 
		FROM qualitydashboard.buildcargo 
		group by idbuildsequence
		order by idbuildsequence desc limit 1";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result);
	$build = $row['idbuildsequence'];
	//$build = "164";
	$overallresult = "
	SELECT COUNT(a.DeploymentResult) AS totalresult
	FROM qualitydashboard.buildcargo, qualitydashboard.buildresult, qualitydashboard.deploymentresult a
	WHERE buildcargo.idBuildresult = buildresult.idBuildResult
	AND buildresult.idBuildresult = a.idBuildResult
	AND buildcargo.idbuildsequence = ". $build ."
	AND a.DeploymentResult = 1
	AND idDeploymentResult = (
		SELECT MAX(idDeploymentResult) FROM qualitydashboard.deploymentresult
		WHERE idBuildResult = a.idBuildResult
	)";
	
	$resultoverallresult = mysqli_query($con,$overallresult);
	$rowoverallresult = mysqli_fetch_array($resultoverallresult);
	
	$systemtestresult="SELECT COUNT(testresult) AS testresult
	FROM qualitydashboard.systemtestresult a
	WHERE idbuildsequence = ". $build ."
	AND idsystemtestResult = (SELECT MAX(idsystemtestResult)
		FROM qualitydashboard.systemtestresult 
		WHERE idbuildsequence = a.idbuildsequence
		AND idProjectParent = a.idProjectParent)
	AND testresult = 1";
	$resultsystemtestresult = mysqli_query($con,$systemtestresult);
	$rowoverallsystemtestresult = mysqli_fetch_array($resultsystemtestresult);
	
	$color = "";
	if ($rowoverallresult['totalresult']==0 and $rowoverallsystemtestresult['testresult']==0)
	{		
		$color = "pass";
	}
	else
	{
		$color = "fail";

	}
	
	$result = array();
	$result["build"] = $build;
	$result["color"] = $color; // [pass,fail,warning]
	$result["details"] = array();
	print $_GET['callback']. '('.json_encode($result).')';
}
?>