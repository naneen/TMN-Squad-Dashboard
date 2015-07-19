<?php
require(dirname(dirname(__FILE__)).'/core/util/dbconnect.php');
if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
	$resultwithoutwar =$_GET[artifactname];
	
	$ext_war = ".war";
	$ext_ear = ".ear";
	$ext_jar = ".jar";
	$ext_zip = ".zip";
	$ext_tar = ".tar";
	$ext_rpm = ".rpm";
	
	
	$patterns = array();
	$patterns[0] = "/[0-9a-zA-Z]*-/";
	$patterns[1] = "/";
	$extmaster = "";
	if(strpos($resultwithoutwar,$ext_war) !== false)
	{
		$patterns[1] = "/-[0-9]*.war/";
		$extmaster = $ext_war;
	}else if(strpos($resultwithoutwar,$ext_ear) !== false)
	{
		$patterns[1] = "/-[0-9]*.ear/";
		$extmaster = $ext_ear;
	}else if(strpos($resultwithoutwar,$ext_jar) !== false)
	{
		$patterns[1] = "/-[0-9]*.jar/";
		$extmaster = $ext_jar;
	}else if(strpos($resultwithoutwar,$ext_zip) !== false)
	{
		$patterns[1] = "/-[0-9]*.zip/";
		$extmaster = $ext_zip;
	}
	else if(strpos($resultwithoutwar,$ext_tar) !== false)
	{
		$patterns[1] = "/-[0-9]*.tar/";
		$extmaster = $ext_tar;
	}
	else if(strpos($resultwithoutwar,$ext_rpm) !== false)
	{
		$patterns[1] = "/-[0-9]*.rpm/";
		$extmaster = $ext_rpm;
		$resultwithoutwar = str_replace(".x86_64","",$resultwithoutwar);
		$resultwithoutwar = str_replace(".noarch","",$resultwithoutwar);
	}
	
	$version = preg_replace($patterns[1],"",$resultwithoutwar);
	$projectversion = preg_replace($patterns[0],"",$version);	
	list($projectname,$buildnumber) = split("-".$projectversion."-", str_replace($extmaster,"",$_GET[artifactname]));
	
	echo $projectname;
	echo $buildnumber;
	
	$sequencenumber = $_GET[sequencenumber];
	
	$projectindexCheckExistData = "SELECT count(*) as result FROM qualitydashboard.projectindex where ProjectName='" . $projectname . "'";
	$result = mysqli_query($con,$projectindexCheckExistData);
	$row = mysqli_fetch_array($result);

	if($row['result'] == 0)
	{
		$projectindexInsertcommand = "INSERT INTO `qualitydashboard`.`projectindex`(`ProjectName`,`ProjectCreatedDate`)
		VALUES('" . $projectname . "',now())";
		$result = mysqli_query($con,$projectindexInsertcommand);
	}

	$buildresult = 0;

	$projectindexCheckExistData = "SELECT idProjectIndex FROM qualitydashboard.projectindex where ProjectName='" . $projectname . "'";
	$result = mysqli_query($con,$projectindexCheckExistData);
	$row = mysqli_fetch_array($result);
	
	$buildresultIndertcommand = "INSERT INTO `qualitydashboard`.`buildresult`
	(`idProjectIndex`,`BuildNumber`,`BuildVersion`,`BuildResult`,`BuildDateTime`)
	VALUES(" . $row['idProjectIndex'] .",'" . $buildnumber . "','" . $projectversion . "'," . $buildresult . ",now())";

	$idProjectIndex =  $row['idProjectIndex'];
	$result = mysqli_query($con,$buildresultIndertcommand);
	$insertCargoSequenceNumber = "SELECT idBuildResult FROM qualitydashboard.buildresult where idProjectIndex=" . $idProjectIndex . " order by idBuildResult desc limit 1";
	$result = mysqli_query($con,$insertCargoSequenceNumber);
	$row = mysqli_fetch_array($result);
	$idBuildResult = $row['idBuildResult'];
	
	$insertCargoSequence = "INSERT INTO `qualitydashboard`.`buildcargo`(`idbuildsequence`,`idBuildresult`,`timestamp`,`idProjectIndex`) VALUES(" . $sequencenumber . "," . $idBuildResult . ",now(),". $idProjectIndex.")";
	$result = mysqli_query($con,$insertCargoSequence);
	
}

mysqli_close($con);
?>