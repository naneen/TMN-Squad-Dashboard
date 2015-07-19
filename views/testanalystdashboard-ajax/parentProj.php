<?php
include 'dbconnect.php';

if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
	$sql = "SELECT idProjectParent, ProjectParentName FROM qualitydashboard.projectparent ORDER BY idProjectParent";
	$result = mysqli_query($con, $sql);
	
	$datas = array();
	$rowIndex = 0;
	while ($row = mysqli_fetch_array($result)) {
		$datas[$rowIndex++] = array("id"=>$row["idProjectParent"], "name"=>$row["ProjectParentName"]);
	}
	print $_GET['callback']. '('.json_encode($datas).')';
}
?>
