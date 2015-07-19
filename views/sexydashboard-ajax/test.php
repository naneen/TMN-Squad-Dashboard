<?php
header('Access-Control-Allow-Origin: *');
?><?php
$dir = "/data/repo/test/systemtest/*.testresult";
//echo $dir . "<br>";
$resultindex = 0;
$result = array();
foreach (glob($dir) as $filename) {
	//echo $filename . "<br>";
	$filecontent = str_replace("\n","",file_get_contents($filename, true));
	//echo $filecontent . "<br>";
	$pieces = explode(",", $filecontent);
	//echo $pieces[0] . " | " . $pieces[1] . " | " . $pieces[2] . " | " . "<br>";
	if(count($pieces) > 2)
	{
		$result[$resultindex] = array("name" => $pieces[0] ,"status" => $pieces[1] ,"result" => $pieces[2]);
	}
	else
	{
		$result[$resultindex] = array("name" => $pieces[0] ,"status" => $pieces[1] ,"result" => "");
	}
	$resultindex++;
}

/* status : 0=pass, 1=fail, 2=warning, 3=processing */
/*
$result[0] = array("name" => "TEST-01","status" => "0","result" => "5/0/0");
$result[1] = array("name" => "TEST-02","status" => "1","result" => "4/0/0");
$result[2] = array("name" => "TEST-03","status" => "2","result" => "8/0/0");
$result[3] = array("name" => "TEST-03","status" => "3","result" => "8/0/0");
*/
usleep(200000);
print $_GET['callback']. '('.json_encode($result).')';
?>