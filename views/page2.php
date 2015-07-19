<!DOCTYPE html>
<html>
<head>
    <script src="../assets/js/jquery/jquery.min.map"></script>
    <script src="../assets/js/highcharts/highcharts.js"></script>
    <script src="../assets/js/highcharts/modules/exporting.js"></script>
    <script src="../assets/js/highcharts/themes/dark-unica-edit.js"></script>
    <script src="../views/TMNSquadDashboard/js/time.js"></script>
    <script src="../views/TMNSquadDashboard/js/volocityChart.js"></script>

    <script type="text/javascript">
        function autoRefresh(){
            $.ajax({
                success: function() {
                    if(getCorrectTime() == "00:00:00"){

                    }
                    volocityChart(<?php echo $_POST['SQUAD_ID']?>);
              }
            });
        }
        setInterval(autoRefresh,1000);

        window.onload =  function(){
            volocityChart();
            autoRefresh();
        }
    </script>

</head>
<body>

    <div id="volocity"></div>

</body>
</html>



