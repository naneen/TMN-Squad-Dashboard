<?php
	include 'connectDB.php';
    include 'QuerySprintRetro.php';

    $sql3 = "SELECT COUNT(*) as COUNT
        FROM TEST_RETRO_CARD
        WHERE SQUAD_ID = ".$_GET['SQUAD_ID']." AND SPRINT_NO = ".$SPRINT_NO;
    $result = $con->query($sql3);
    $row = $result->fetch_assoc();
    echo (int)$row['COUNT'];
?>

