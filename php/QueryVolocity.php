<?php
	include 'connectDB.php';
	$sql = "SELECT *
			FROM (
				SELECT *
				FROM TEST_VOLOCITY
				WHERE SQUAD_ID = ".$_GET['SQUAD_ID']."
				ORDER BY SPRINT_NO DESC
				LIMIT 0,6
				) as TEST_VOLOCITY1
			order by SPRINT_NO;";
	$result = $con->query($sql);
	$userJson1 = array();
	$userJson2 = array();
	$userJson3 = array();
	$userJson4 = array();
	$ans = array();
    while($row = $result->fetch_assoc()) {
	    array_push($userJson1, (int)$row["SPRINT_NO"]);
    	array_push($userJson2, (int)$row["POINT_COMMIT"]);
    	array_push($userJson3, (int)$row["POINT_COMPLETE"]);
    }
    $ans['SPRINT_NO'] = $userJson1;
    $ans['POINT_COMMIT'] = $userJson2;
    $ans['POINT_COMPLETE'] = $userJson3;
    echo json_encode($ans);
?>