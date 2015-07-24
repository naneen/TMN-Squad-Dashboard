<?php
    include 'connectDB.php';
    include 'support-function.php';

    $teams = getTeam();
    $numberOfTeam = $teams->num_rows;
    $columnLarge = 12/computeColumnSize($numberOfTeam);
    $columnSmall = computeColumnSmall($columnLarge);

    $imgPath = "images/"; 
    
    while($row = $teams->fetch_assoc()) {
        echo    '<div class="col-lg-'.$columnLarge.' col-sm-'.$columnSmall.' text-left">'.
                    '<div id="'.$row["SQUAD_ID"].'" class="team-div" onClick="sendTeamId('.$row["SQUAD_ID"].')">'.
                        '<h1>'.$row["SQUAD_NAME"].'</h1>'.
                        '<img class="img-circle img-responsive img-center" src="'.$imgPath.$row["LEAD_IMG"].'" alt="">'.
                    '</div>'.   
                '</div>';
    }

    # close database
    include 'database-close.php'
?>