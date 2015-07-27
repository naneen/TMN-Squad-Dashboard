<?php
	include 'connectDB.php';
    if ($con->connect_error) {
         die("Connection failed: " . $con->connect_error);
    };
	$sql = "SELECT *
            FROM TEST_RETRO_FEELING
            WHERE SQUAD_ID = ".$_GET['SQUAD_ID']."
            ORDER BY SPRINT_NO DESC
            LIMIT 0,1";

	$feels = $con->query($sql);
	$retorJson = array();

	$row = $feels->fetch_assoc();
    $sprintNO = (int)$row["SPRINT_NO"];
    $retorJson['POSITIVE'] = (int)$row["POSITIVE"];
    $retorJson['NEUTRAL'] = (int)$row["NEUTRAL"];
    $retorJson['STRESSFUL'] = (int)$row["STRESSFUL"];

     $sql2 = "SELECT *
            FROM TEST_RETRO_CARD
            WHERE SQUAD_ID = ".$_GET['SQUAD_ID']." AND SPRINT_NO = ".$sprintNO."
            ORDER BY SPRINT_NO
            LIMIT ".($_GET['pageRetro']*4).",4";

	$cards = $con->query($sql2);

	$contents = array();
	$actions = array();
	$owner = array();

	while($row = $cards->fetch_assoc()) {
	    array_push($contents, $row["PANEL_CONTENT"]);
    	array_push($actions, $row["ACTION_ITEM"]);
    	array_push($owner, $row["OWNER"]);
    }

    $retorJson['PANEL_CONTENT'] = $contents;
    $retorJson['ACTION_ITEM'] = $actions;
    $retorJson['OWNER'] = $owner;

     $sql3 = "SELECT count(*) as COUNT
             FROM TEST_RETRO_CARD
             WHERE SQUAD_ID = ".$_GET['SQUAD_ID']." AND SPRINT_NO = ".$sprintNO;

    $counts = $con->query($sql3);
    $row = $counts->fetch_assoc();
    $retorJson['COUNT'] = (int)$row['COUNT'];
    echo json_encode($retorJson);
?>