<?php
include 'dbconnect.php';

date_default_timezone_set('UTC');

if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
	$sql = " SELECT t.idProjectParent, p.ProjectParentName, t.systemtestdate, t.idBuildSequence, t.testresult, t.testpass, t.testfail ";
	$sql .= " FROM qualitydashboard.systemtestresult t, qualitydashboard.projectparent p ";
	$sql .= " WHERE t.idProjectParent = p.idProjectParent ";
	$sql .= " AND t.idProjectParent = " . $_GET['id'];
	$sql .= " AND t.systemtestdate >= DATE_ADD(NOW(), INTERVAL -" . $_GET['interval'] . " DAY) ";
	$sql .= " UNION ALL ";
	$sql .= " SELECT t.idProjectParent, p.ProjectParentName, t.systemtestdate, t.idBuildSequence, t.testresult, t.testpass, t.testfail ";
	$sql .= " FROM qualitydashboard.systemtestresult t, qualitydashboard.projectparent p ";
	$sql .= " WHERE t.idProjectParent = p.idProjectParent ";
	$sql .= " AND t.idProjectParent = " . $_GET['id'];
	$sql .= " AND t.systemtestdate = ( ";
	$sql .= " 	SELECT MAX(systemtestdate) ";
	$sql .= " 	FROM qualitydashboard.systemtestresult ";
	$sql .= " 	WHERE idProjectParent = t.idProjectParent ";
	$sql .= " 	AND systemtestdate < DATE_ADD(NOW(), INTERVAL -" . $_GET['interval'] . " DAY) ";
	$sql .= " ) ";
	$sql .= " ORDER BY systemtestdate ";
	
	$result = mysqli_query($con, $sql);
	
	$passData = array();
	$totalData = array();
	$rowIndex = 0;
	while ($row = mysqli_fetch_array($result)) {
		$passData[$rowIndex] = array(strtotime($row["systemtestdate"]) * 1000, (int)$row["testpass"]);
		$totalData[$rowIndex] = array(strtotime($row["systemtestdate"]) * 1000, (int)$row["testpass"] + (int)$row["testfail"]);
		$rowIndex++;
	}
	
	$passObj = array("name" => "pass", "color" => "#33FF33", data => $passData);
	$totalObj = array("name" => "total", "color" => "#FF3333", data => $totalData);
	$datas = array($totalObj, $passObj);
	
	print $_GET['callback']. '('.json_encode($datas).')';
}
?>
