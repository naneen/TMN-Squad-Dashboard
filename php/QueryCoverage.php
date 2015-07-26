<?php
	include 'connectDB.php';
	$teamId = $_GET['SQUAD_ID'];


	$sql = "SELECT tp.project_name, tc.coverage
			FROM qualitydashboard2.TEST_COVERAGE tc, qualitydashboard2.TEST_SQUAD ts, qualitydashboard2.TEST_PROJECT tp
			WHERE ts.SQUAD_ID = tp.SQUAD_ID AND tc.project_id = tp.project_id AND ts.SQUAD_ID = '".$teamId."'
			ORDER BY tp.project_name;";
	$result = $con->query($sql);

	$out = array();
	$p_name = array();
	$p_coverage = array();
	$i = 0;
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$p_name[$i] = $row["project_name"];
			$p_coverage[$i] = floatval($row["coverage"]);
			$i++;
		}
		$out[0] = $p_name;
		$out[1] = $p_coverage;
	}
	else{$out[3] = "NO Coverage";}

	$sql = "SELECT ts.SQUAD_NAME FROM qualitydashboard2.TEST_SQUAD ts WHERE ts.SQUAD_ID = '".$teamId."';";
	$result = $con->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$out[2] =  $row["SQUAD_NAME"];
		}
	}

	echo json_encode($out);
	$con->close();
?>