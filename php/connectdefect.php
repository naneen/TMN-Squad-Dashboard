<?php

	include 'connectDB.php';
	$query = "SELECT * FROM
				(SELECT *
				FROM TEST_DEFECT
				WHERE SQUAD_ID = ".$_POST['SQUAD_ID']."
				ORDER BY SPRINT_NO DESC
				LIMIT 0,6 ) as t1
				ORDER BY SPRINT_NO";

	$result = $con->query($query) ;
	$ans1 = "[";
	$ans2 = "[";
	$i = 0;
	while($row = $result->fetch_assoc()){
		if($i !=5){
	 	   $ans1 .= $row['SPRINT_NO'].",";
	 	   $ans2 .= $row['DEFECT_NO'].",";
	 	}
	 	else{
	 	   $ans1 .= $row['SPRINT_NO']."]";
	 	   $ans2 .= $row['DEFECT_NO']."]";
	 	}
	 	$i++;
    }
?>