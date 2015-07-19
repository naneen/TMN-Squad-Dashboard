<?php
include 'dbconnect.php';

if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
	$sql = " SELECT COUNT(*) AS result ";
	$sql .= " FROM ( ";
	$sql .= "	SELECT BUILD.idbuildsequence ";
	$sql .= "	FROM ( ";
	$sql .= "		SELECT buildcargo.idbuildsequence ";
	$sql .= "			, COUNT(deploymentresult.DeploymentResult) AS totalresult ";
	$sql .= "		FROM qualitydashboard.buildcargo ";
	$sql .= "		LEFT OUTER JOIN qualitydashboard.buildresult ON buildcargo.idBuildresult = buildresult.idBuildResult ";
	$sql .= "		LEFT OUTER JOIN qualitydashboard.deploymentresult ";
	$sql .= "			ON deploymentresult.idBuildResult = buildresult.idBuildresult ";
	$sql .= "			AND deploymentresult.DeploymentResult = 1 ";
	$sql .= "			AND deploymentresult.idDeploymentResult = ( ";
	$sql .= "				SELECT MAX(x.idDeploymentResult) FROM qualitydashboard.deploymentresult x ";
	$sql .= "				WHERE x.idBuildResult = deploymentresult.idBuildResult ";
	$sql .= "			) ";
	$sql .= "		GROUP BY buildcargo.idbuildsequence ";
	$sql .= "		ORDER BY buildcargo.idbuildsequence DESC ";
	$sql .= "		LIMIT " . $_GET['lastbuild'];
	$sql .= "	) BUILD ";
	$sql .= "	LEFT OUTER JOIN qualitydashboard.systemtestresult ";
	$sql .= "		ON systemtestresult.idbuildsequence = BUILD.idbuildsequence ";
	$sql .= "		AND systemtestresult.idsystemtestResult = ( ";
	$sql .= "			SELECT MAX(idsystemtestResult) ";
	$sql .= "			FROM qualitydashboard.systemtestresult x ";
	$sql .= "			WHERE x.idbuildsequence = systemtestresult.idbuildsequence ";
	$sql .= "			AND x.idProjectParent = systemtestresult.idProjectParent ";
	$sql .= "		) ";
	$sql .= "	GROUP BY BUILD.idbuildsequence, BUILD.totalresult ";
	$sql .= "	HAVING BUILD.totalresult + COUNT(CASE WHEN systemtestresult.testresult = 1 THEN systemtestresult.testresult END) = 0 ";
	$sql .= "	ORDER BY BUILD.idbuildsequence DESC ";
	$sql .= ") A ";
	
	$resultSQL = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($resultSQL);
	$result = (int)$row['result'];
	
	print $_GET['callback']. '('.json_encode($result).')';
}
?>