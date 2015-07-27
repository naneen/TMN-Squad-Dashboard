<?php
	include 'connectDB.php';

    $sql1 = "SELECT SPRINT_NO
            FROM TEST_RETRO_FEELING
            WHERE SQUAD_ID = ".$_GET['SQUAD_ID']."
            ORDER BY SPRINT_NO DESC
            LIMIT 0,1";
    $result1 = $con->query($sql1);
    $row = $result1->fetch_assoc();
    $SPRINT_NO_FEEL = (int)$row['SPRINT_NO'];

    $sql2 = "SELECT DISTINCT SPRINT_NO
        FROM TEST_RETRO_CARD as t1
        WHERE t1.SQUAD_ID = ".$_GET['SQUAD_ID']." AND t1.SPRINT_NO >= all(
        SELECT t2.SPRINT_NO
        FROM TEST_RETRO_CARD as t2
        WHERE t2.SQUAD_ID = ".$_GET['SQUAD_ID'].")";
    $result2 = $con->query($sql2);
    $row = $result2->fetch_assoc();
    $SPRINT_NO_CARD = (int)$row['SPRINT_NO'];

    if($SPRINT_NO_FEEL <= $SPRINT_NO_CARD){
        $SPRINT_NO = $SPRINT_NO_CARD;
    }
    else{
        $SPRINT_NO = $SPRINT_NO_FEEL;
    }


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

    // $sql5 = "SELECT COUNT(*) as COUNT
    //     FROM TEST_RETRO_CARD
    //     WHERE SQUAD_ID = ".$_GET['SQUAD_ID']." AND SPRINT_NO = ".$SPRINT_NO;
    // $result = $con->query($sql);
    // $row = $result->fetch_assoc();
    // $retorJson['COUNT'] = $row['COUNT'];

    echo json_encode($retorJson);
?>