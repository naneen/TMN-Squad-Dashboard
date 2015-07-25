<?php
	include 'connectDB.php';
	$sql = "SELECT * FROM TEST_SQUAD WHERE SQUAD_ID = ".$_POST['SQUAD_ID'].";";
	$result = $con->query($sql);
    $row = $result->fetch_assoc();
    $squad_name = $row['SQUAD_NAME'];
?>