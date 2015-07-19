<?php
$folder =  basename(dirname(__FILE__));
$prefix = "http://$_SERVER[HTTP_HOST]";
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap/theme/bootstrap-theme.min.css">
	<script type="text/javascript" src="assets/js/jquery/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript">
            var prefix = "<?php echo $prefix; ?>"+'/';
            var folder = "<?php echo $folder;?>";
            $(function(){
                var found = false;
                $('#uldropdown > li').each(function() {
                    if ($(this).text() == prefix) {
                        found = true;
                    }
                });
                if (!found) {
                    $('#uldropdown').append("<li><a href=#>"+prefix+"</a></li>");
                }
                $('#btndropdown').html(prefix+" <span class=\"caret\"></span>");
                $('#uldropdown > li').click(function(e){
                    prefix = $(this).text();
                    $('#btndropdown').empty();
                    $('#btndropdown').html(prefix+" <span class=\"caret\"></span>");
                });
            });
            function redirect(url){
                window.location = prefix+'/'+url ;
            }
        </script>
</head>
<body>
	<div class="container-fluid header-form">
            <h3 class="page-header sm-header">
                    Dashboard
            </h3>
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
                                            <div class="btn-group">
                                                <button id="btndropdown" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                </button>
                                                <ul id="uldropdown" class="dropdown-menu" role="menu">
                                                    <!--li><a href=#>http://truemoneydev.dyndns.org/</a></li><li><a href=#>http://tmndev.dyndns.org/</a></li-->
                                                    <li><a href=#>http://truemoneydev.true.th/</a></li>
                                                </ul>
                                              </div>
                                            <a href="views/setting.php">
                                                <span style="float: right"class="glyphicon glyphicon-cog" ></span>
                                            </a>
                                        </div>
					<div class="panel-body">
						<ul class="nav nav-pills nav-stacked">
                            <li><a href="#" onClick="redirect(folder+'/views/page1.php');">TMN Squad Dashboard</a></li>
							<li><a href="#" onClick="redirect(folder+'/views/sexydashboard.php');">Sexy Dashboard</a></li>
							<li><a href="#" onClick="redirect(folder+'/views/testanalystdashboard.php');">Test Analyst Dashboard</a></li>
							<li><a href="#" onClick="redirect(folder+'/views/qualityreport.php');">Quality Report</a></li>
                            <li><a href="#" onClick="redirect('releaseddashboard');">Released Dashboard</a></li>
                            <li><a href="#" onClick="redirect('QualityDashboard/coveragereport/lineofcodedashboard.php');">Code un-coverage Dashboard</a></li>
                            <li><a href="#" onClick="redirect('QualityDashboard/coveragereport/coveragedashboard.php');">Code coverage Dashboard</a></li>
                            <li><a href="#" onClick="redirect('QualityDashboard/home.php');">Build history Dashboard</a></li>
                            <li><a href="#" onClick="redirect('gitlab');">Gitlab</a></li>
                            <li><a href="#" onClick="redirect('share');">Alfresco</a></li>
                            <li><a href="#" onClick="redirect('/');">Jenkins Master</a></li>
                            <li><a href="#" onClick="redirect('nexus');">NEXUS server</a></li>
                            <li><a href="#" onClick="redirect('zabbix');">ZABBIX server</a></li>
                            <li><a href="http://ebiz-mrbs.ebusiness.th">Meeting room Booking</a></li> 
                            <li><a href="https://10.4.68.178/tmnua/">UA request form</a></li> 
                            <li><a href="https://10.4.68.178/tmnur/">UR request form</a></li> 
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>