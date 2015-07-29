<?php
	include 'connectDB_103.php';

	$sql = "SELECT t4.ProjectName,t4.linecoverage as PERCENT FROM(
			SELECT t2.date,t2.idProjectIndex,t2.linecoverage,t3.ProjectName
			FROM TEST_PROJECT_MAP as t1,coveragereport as t2,projectindex as t3
			WHERE t1.idProjectIndex = t2.idProjectIndex AND t2.idProjectIndex = t3.idProjectIndex AND t1.SQUAD_ID = ".$_GET['SQUAD_ID']."
			ORDER BY t2.date DESC) as t4
			GROUP BY t4.idProjectIndex";
	$result = $con->query($sql);
	$userJson1 = array();
	$userJson2 = array();
	$ans = array();
    while($row = $result->fetch_assoc()) {
    	array_push($userJson1, $row["ProjectName"]);
	    array_push($userJson2, (int)$row["PERCENT"]);
    }
    $ans['ProjectName'] = $userJson1;
    $ans['PERCENT'] = $userJson2;
    echo json_encode($ans);
?>