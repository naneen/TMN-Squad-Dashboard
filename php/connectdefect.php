<?php
	include 'connectDB.php';
	$query = "SELECT * FROM
				(SELECT *
				FROM TEST_DEFECT
				WHERE SQUAD_ID = ".$_GET['SQUAD_ID']."
				ORDER BY SPRINT_NO DESC
				LIMIT 0,6 ) as t1
				ORDER BY SPRINT_NO";

	$result = $con->query($query) ;

	$userJson1 = array();
	$userJson2 = array();
	$ans = array();
    while($row = $result->fetch_assoc()) {
	    array_push($userJson1, (int)$row["SPRINT_NO"]);
    	array_push($userJson2, (int)$row["DEFECT_NO"]);
    }
    $ans['SPRINT_NO'] = $userJson1;
    $ans['DEFECT_NO'] = $userJson2;
    echo json_encode($ans);
?>