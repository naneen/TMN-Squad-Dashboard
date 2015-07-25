<!DOCTYPE html>
<html>
    <head>
        <script src="js/jquery.min.map"></script>
        <script src="js/highcharts.js"></script>
        <script src="js/exporting.js"></script>
        <script src="js/dark-unica.js"></script>
        <script src="js/time.js"></script>
        <script src="js/valocityChart.js"></script>
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
                            defectChart();
                        }
                        valocityChart($SQUAD_ID);
                        CoverageChart($SQUAD_ID);
                        retrospective($SQUAD_ID);
                  }
                });
            }
            setInterval(autoRefresh,1000);

            window.onload =  function(){
                $("#year").html(getYear());
                retrospective($SQUAD_ID);
                valocityChart($SQUAD_ID);
                DeployChart($SQUAD_ID);
                CoverageChart($SQUAD_ID);
                defectChart();
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

            <div id="leftContent">
                <div id="" class="well">
                  <div id="valocity"></div>
                </div>

                <div id="" class="well">
                    <div id="defect"></div>
                </div>

                <div id="" class="well">
                  <div id="coverage"></div>
                </div>

                <div id="" class="well">
                  <div id="Deploy"></div>
                </div>
            </div>

            <div id="rightContent">
                <div id="retro" class="well">
                    <p class="text">Retrospective</p>
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
        </div>
    </body>
</html>



