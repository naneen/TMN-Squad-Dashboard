<!DOCTYPE html>
<html>
<head>

    <script src="js/jquery.min.js"></script>
    <script src="js/highcharts.js"></script>
    <script src="js/exporting.js"></script>
    <?php include 'js/volocityChart.php';?>
    <?php include 'php/connectDB.php';?>

    <script type="text/javascript">
        window.onload =  function(){
            volocityChart();
        }
    </script>

</head>
<body>

    <div id="volocity"></div>

</body>
</html>



