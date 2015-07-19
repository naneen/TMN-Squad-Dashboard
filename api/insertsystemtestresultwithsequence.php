<?php
require(dirname(dirname(__FILE__)).'/core/util/dbconnect.php');
if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
	//$e2egroupname = str_replace("%20"," ",$_GET[groupname]);
	$e2egroupname = $_GET[groupname];
	$systemintregration = $_GET[result];
	$systemintregrationdetail = $_GET[detail];
	$systemintregrationfulldetail = $_GET[fulldetail];
	
	/*
	echo $e2egroupname;
	echo $systemintregration;
	echo $systemintregrationdetail;
	echo $systemintregrationfulldetail;
	*/
	
	$maxbuildresult = "SELECT max(idbuildsequence) as sequence FROM qualitydashboard.buildcargo";
	$resultmaxbuildresult = mysqli_query($con,$maxbuildresult);
	$rowmaxbuildresult = mysqli_fetch_array($resultmaxbuildresult);
	

	$selectparentid = "SELECT * FROM qualitydashboard.projectparent where ProjectParentName= '" . $e2egroupname . "'";
	$resultselectparentid = mysqli_query($con,$selectparentid);
	$rowselectparentid = mysqli_fetch_array($resultselectparentid);
	
	list($pass, $fail) = split('-', $systemintregrationdetail);
	list($strpass,$totalpass) = split('_', $pass);
	list($strfail,$totalfail) = split('_', $fail);
	$addtestresult = "INSERT INTO `qualitydashboard`.`systemtestresult`(`idProjectParent`,`testresult`,`testdetail`,`idbuildsequence`,`systemtestdate`,`testpass`,`testfail`,`testfulldetail`)
		VALUES(". $rowselectparentid['idProjectParent'] ."," . $systemintregration . ",'" . $systemintregrationdetail . "'," . $rowmaxbuildresult['sequence'] . ",now(),".$totalpass.",".$totalfail.",'".$systemintregrationfulldetail."');";
		//echo $addtestresult;
	$resultaddtestresult = mysqli_query($con,$addtestresult);
	//echo $addtestresult;
}

mysqli_close($con);
?>