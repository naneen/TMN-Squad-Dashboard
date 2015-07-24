<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sprint-dashboard.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="js/jquery.min.map"></script>
    <script src="js/jquery-redirect.js"></script>

    <script>
        $oldResult = "";
        function sendTeamId(id) {
            $SQUAD_ID = id;
            $.redirect('TMNSquadDashboard-page2.php', {'SQUAD_ID': $SQUAD_ID});
        }
        function callGetTeamAjax() {
            $.ajax({url: "php/getTeam.php", success: function(result){
                if($oldResult != result){
                    $oldResult = result;
                    $(".container").html(result);
                }
            }});
        }
        setInterval(callGetTeamAjax, 1000);
        $( document ).ready(function() {
            // print team when document ready
            callGetTeamAjax();
        });
    </script>

</head>
<body>

    <div class="col-lg-12 dashboard-title">
        <h2 class="">Sprint Dashboard</h2>
    </div>
	<div class="container">
		<div class="row">

        <!-- print teams here -->

        </div>
    </div> <!-- /.container -->
    <div class="test"></div>


    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>