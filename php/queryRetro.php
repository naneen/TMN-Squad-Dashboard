<?php
	include 'connectDB.php';
    include 'QuerySprintRetro.php';

	$sql3 = "SELECT *
            FROM TEST_RETRO_FEELING
            WHERE SQUAD_ID = ".$_GET['SQUAD_ID']." AND SPRINT_NO = ".$SPRINT_NO;

	$feels = $con->query($sql3);
	$retorJson = array();

	$row = $feels->fetch_assoc();
    $retorJson['POSITIVE'] = (int)$row["POSITIVE"];
    $retorJson['NEUTRAL'] = (int)$row["NEUTRAL"];
    $retorJson['STRESSFUL'] = (int)$row["STRESSFUL"];

    $sql4 = "SELECT *
        FROM TEST_RETRO_CARD as t1
        WHERE t1.SQUAD_ID = ".$_GET['SQUAD_ID']." AND SPRINT_NO = ".$SPRINT_NO."
        LIMIT ".($_GET['pageRetro']*4).",4";
	$cards = $con->query($sql4);

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

    echo json_encode($retorJson);
?>