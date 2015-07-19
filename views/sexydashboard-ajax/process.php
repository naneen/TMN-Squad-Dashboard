<?php
		ob_start();
		  error_reporting(E_ERROR);
	      preg_match('/^[0-9]+$/', $_GET['select'],$test);
	      $myFile = "data.txt";
		  $fh = fopen($myFile, 'w');
		  fwrite($fh, $test[0]);
		  fclose($fh);
		  header('refresh:3; url=http://localhost/sexydashboard/dashboard.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h1>Config Success(Page will automatically redirect in 3 seconds)</h1>
</body>
</html>