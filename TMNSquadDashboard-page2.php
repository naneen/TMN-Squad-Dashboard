<!DOCTYPE html>
<html>
<head>
    <script src="js/jquery.min.map"></script>
    <script src="js/highcharts.js"></script>
    <script src="js/exporting.js"></script>
    <script src="js/dark-unica.js"></script>
    <script src="js/time.js"></script>
    <script src="js/volocityChart.js"></script>
    <script src="js/retro.js"></script>
    <script src="js/DeployChart.js"></script>
    <script src="js/CoverageChart.js"></script>
    <?php include 'php/defectchart.php'; ?>
    <?php include 'php/QuerySquadName.php'; ?>

    <script type="text/javascript">
        $SQUAD_ID = <?php echo $_POST['SQUAD_ID']?>;
        function autoRefresh(){
            $.ajax({
                success: function() {
                    if(getCorrectTime() == "00:00:00"){
                        $("#year").html(getYear());
                        DeployChart($SQUAD_ID);
                        defectChart($SQUAD_ID);
                    }
                    volocityChart($SQUAD_ID);
                    CoverageChart($SQUAD_ID);
                    retrospective($SQUAD_ID);
              }
            });
        }
        setInterval(autoRefresh,1000);

        window.onload =  function(){
            $("#year").html(getYear());
            retrospective($SQUAD_ID);
            volocityChart($SQUAD_ID);
            DeployChart($SQUAD_ID);
            CoverageChart($SQUAD_ID);
            defectChart($SQUAD_ID);
            autoRefresh();
        }
    </script>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/SprintDashboard.css">
</head>
<body>
    <nav class="navbar navbar-default">
            <div class="container-fluid">
                <a class="navbar-brand" href="javascript:history.back()">Sprint Dashboard : Team <?php echo $squad_name?> (<span id = "year"></span>)</a>
            </div>
        </nav>

        <div id="allContents">
            <div id="" class="well top">
              <div id="volocity"></div>
            </div>

            <div id="" class="well top">

                <div id="defect"></div>

            </div>

            <div id="" class="well top">
              <div id="Deploy"></div>
            </div>

            <!-- ------------------------- -->

            <div id="" class="well bottom">
              <div id="coverage"></div>
            </div>

            <div id="" class="well bottom">
              Look, I'm in a well!
            </div>

            <!-- ------------ retro ------------ -->
            <div id="retro" class="well bottom">
                <p class="text-warning">Retrospective</p>
                <div id="positive" class="feeling">
                    <p>Positive</p>
                </div>
                <div id="neutral" class="feeling">
                    <p>Neutral</p>
                </div>
                <div id="stressful" class="feeling">
                    <p>Stressful</p>
                </div>

                <div id="retroCard"></div>
            </div>
        </div>

</body>
</html>



