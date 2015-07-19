<?php
require(dirname(dirname(__FILE__)).'/core/util/autoload.php');
use core\util\PropertiesConfig as PropertiesConfig;

$gauge = PropertiesConfig::get("chart.limitgauge");
$testanalyst = PropertiesConfig::get("chart.testanalystday");
$quality = PropertiesConfig::get("report.qualityweek.week");
$phpvar = 0;
if (is_null($gauge) || $gauge == '') {
        $gauge = 7;
}
if (is_null($testanalyst) || $testanalyst == '') {
        $testanalyst = 7;
}
if (is_null($quality) || $quality == '') {
        $quality = 20;
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dashboard</title>
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap/theme/bootstrap-theme.min.css">
	<script type="text/javascript" src="../assets/js/jquery/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript">
            
            $(function(){
                $('#divalert').hide();
               $('#btnsave').click(function(e){
                   var sexy = $('#sexy').val();
                   var test = $('#test').val();
                   var report = $('#report').val();
                   $.ajax({
					type: "get",
                                        url: "../core/service/SaveDatainiService.php",
					data: {sexy:sexy,test:test,report:report},
					success: function(obj) {
                                            $('#divalert').show();    
					},
					error: function (xhr, ajaxOptions, thrownError) {
						
					}
				});
               });
               $('#btnclose').click(function(e){
                   $('#divalert').hide();
               })
            });
        </script>
</head>
<body>
	<div class="container-fluid header-form">
            <h3 class="page-header sm-header">
                    Setting
            </h3>
            
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">Setting
                                            <a href="../menu.php">
                                                <span style="float: right"class="glyphicon glyphicon-home" ></span>
                                            </a>
                                        </div>
					<div class="panel-body">
                                            <form class="form-horizontal" role="form">
                                                <div class="form-group">
                                                  <label for="inputEmail3" class="col-sm-6 control-label">Sexy Dashboard:</label>
                                                  <div class="col-sm-6">
                                                    <select id="sexy" class="form-control ">
                                                            <?php
                                                                for ($i = 1; $i <= 15; $i++) {
                                                                    if($i!=$gauge){
                                                                        echo "<option value=".$i."> ".$i." Build </option>";
                                                                    }else {
                                                                        echo "<option value=".$i." selected> ".$i." Build </option>";
                                                                    }
                                                                }
                                                            ?>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label for="inputPassword3" class="col-sm-6 control-label">Test Analyst:</label>
                                                  <div class="col-sm-6">
                                                    <select id="test" class="form-control">
                                                        <?php
                                                                    for ($i = 1; $i <= 30; $i++) {
                                                                        if($i!=$testanalyst){
                                                                            echo "<option value=".$i."> ".$i." Days </option>";
                                                                        }else {
                                                                            echo "<option value=".$i." selected> ".$i." Days </option>";
                                                                        }
                                                                    }
                                                        ?>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label for="inputPassword3" class="col-sm-6 control-label">Quality Report:</label>
                                                  <div class="col-sm-6">
                                                    <select id="report" class="form-control">
                                                        <?php
                                                                    for ($i = 1; $i <= 30; $i++) {
                                                                        if($i!=$quality){
                                                                            echo "<option value=".$i."> ".$i." Weeks </option>";
                                                                        }else {
                                                                            echo "<option value=".$i." selected> ".$i." Weeks </option>";
                                                                        }
                                                                    }
                                                        ?>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <div class="col-sm-offset-6 col-sm-6">
                                                    <button id="btnsave" type="button" class="btn btn-default">
                                                        <span class="glyphicon glyphicon-floppy-disk" ></span>
                                                        <span  >Save</span>
                                                    </button>
                                                  </div>
                                                </div>
                                              </form>
                                            <div id="divalert" class="alert alert-success alert-dismissible" >
                                                <button id="btnclose"  type="button" class="close" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <strong>Saved!</strong>
                                          </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>