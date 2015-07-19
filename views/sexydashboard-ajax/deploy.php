<?php
header('Access-Control-Allow-Origin: *');
?><?php
$dir = "/data/repo/ci/*/*.deployresult";

$resultindex = 0;
$result = array();

foreach (glob($dir) as $filefulldir) {
	$info = new SplFileInfo($filefulldir);
	$filename = $info->getFilename();
	$componentname = "";
	//echo $filename . "<br>";
	$ext_war = ".war";
	$ext_ear = ".ear";
	$ext_zip = ".zip";
	$ext_jar = ".jar";
	
	if(strpos($filename,$ext_war) !== false)
	{
		$componentname = preg_replace("/-[0-9]*.war.deployresult/","",$filename);
	}else if(strpos($filename,$ext_ear) !== false)
	{
		$componentname = preg_replace("/-[0-9]*.ear.deployresult/","",$filename);
	}else if(strpos($filename,$ext_zip) !== false)
	{
		$componentname = preg_replace("/-[0-9]*.zip.deployresult/","",$filename);
	}else if(strpos($filename,$ext_jar) !== false)
	{
		$componentname = preg_replace("/-[0-9]*.jar.deployresult/","",$filename);
	}
	
	$filecontent = str_replace("\n","",file_get_contents($filefulldir, true));
	$result[$resultindex] = array("name" => $componentname,"status" => $filecontent);
	$resultindex++;
}
/*
$result[0] = array("name" => "TEST-01","status" => "0");
$result[1] = array("name" => "TEST-02","status" => "1");
$result[2] = array("name" => "TEST-03","status" => "2");
$result[3] = array("name" => "TEST-04","status" => "3");
*/
usleep(200000);
print $_GET['callback']. '('.json_encode($result).')';
?>