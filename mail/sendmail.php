<?php
require('../core/util/dbconnect.php');

if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{

	$latestplatformnumber = "select max(idbuildsequence) as build from qualitydashboard.buildcargo";
	$resultlatestplatformnumber = mysqli_query($con,$latestplatformnumber);
	$rowlatestplatformnumber = mysqli_fetch_array($resultlatestplatformnumber);
	$buildnumber = $rowlatestplatformnumber['build'];
	//echo $latestplatformnumber;
	//include '../views/sexydashboard-ajax/build.php';
	$subject = '[CI Alpha] #'.$buildnumber.' Deployment and Test notification';
	//echo $subject;
	$file = file_get_contents('content.html', true);
	$message = $file;
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	$headers .= 'To: tmn-design&development@truecorp.co.th' . "\r\n";
	//$headers .= 'To: phuwadon_pot@truecorp.co.th' . "\r\n";
	$headers .= 'Reply-To: tmn-design&development@truecorp.co.th' . "\r\n";
	
	mail($to, $subject, $message, $headers);
}
?>
