<?php
	include 'connectDB.php';
	$sql = "SELECT COUNT(*) as COUNT
		FROM TEST_RETRO_CARD as t1
		WHERE t1.SQUAD_ID = ".$_POST['SQUAD_ID']." AND t1.SPRINT_NO >= all(
		SELECT t2.SPRINT_NO
		FROM TEST_RETRO_CARD as t2
		WHERE t2.SQUAD_ID = ".$_POST['SQUAD_ID'].")";
	$result = $con->query($sql);
	$row = $result->fetch_assoc();
    $count = (int)$row['COUNT'];
?>

