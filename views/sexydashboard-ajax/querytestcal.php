<?php
include 'dbconnect.php';

if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
	$query = "SELECT ProjectParentName, qualitydashboard.projectparent.idProjectParent ,(testpass+testfail) as totaltest, systemtestdate
FROM qualitydashboard.systemtestresult, qualitydashboard.projectparent
WHERE qualitydashboard.projectparent.idProjectParent = qualitydashboard.systemtestresult.idProjectParent
AND idsystemtestResult = (
	SELECT MAX(idsystemtestResult)
	FROM qualitydashboard.systemtestresult
	WHERE qualitydashboard.systemtestresult.idProjectParent = qualitydashboard.projectparent.idProjectParent
	GROUP BY idProjectParent
)
ORDER BY totaltest DESC, ProjectParentName";
	$queryresult = mysqli_query($con,$query);
	
	$result = array();
	$result["type"] = "pie";
	$result["name"] = "Total Test";
	$dataresult = array();
	
	$resultindex = 0;
	
	while($row = mysqli_fetch_assoc($queryresult))
	{
		$dataresult[$resultindex] =  array($row['ProjectParentName'],intval($row['totaltest']));
		//echo $row['ProjectParentName'] . " - " . $row['totaltest'] . "<br>";
		$resultindex++;
	}
	$result["data"] = $dataresult;
	
	print $_GET['callback']. '('.json_encode($dataresult).')';
}
?>