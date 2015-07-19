<?php
require('../core/util/dbconnect.php');
$dns = "tmndev.dyndns.org";
?>

<font size="+1"><a href="http://<?php echo $dns;?>/qualityreport/menu.php">Link to Dashboard Portal dashboard</a></font>
<br />
<font size="+1"><a href="http://<?php echo $dns;?>/qualityreport/views/qualityreport.php">Link to Quality report dashboard</a></font>
<br />
<font size="+1"><a href="http://<?php echo $dns;?>/QualityDashboard/coveragereport/coveragedashboard.php">Link to Code coverage dashboard</a></font>
<br />
<font size="+1"><a href="http://<?php echo $dns;?>/QualityDashboard/coveragereport/lineofcodedashboard.php">Link to Code un-coverage dashboard</a></font>
<br /><br />

<b><font size="+2">Deployment result</font></b>
<br>
<table border="1">
<?php
if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
?>
	<tr>
<?php
	$projectDependency = "SELECT qualitydashboard.buildresult.idBuildresult as idBuildresult,qualitydashboard.projectindex.ProjectName as ProjectName
			FROM qualitydashboard.buildcargo,qualitydashboard.buildresult,qualitydashboard.projectindex
			where buildcargo.idBuildresult=buildresult.idBuildresult
			and projectindex.idProjectIndex = buildresult.idProjectIndex
			and idbuildsequence=(select max(idbuildsequence) from qualitydashboard.buildcargo group by idbuildsequence order by idbuildsequence desc limit 1)";
			
	$result = mysqli_query($con,$projectDependency);
	while($row = mysqli_fetch_array($result))
	{
		$latestdeployresult = "SELECT * FROM qualitydashboard.deploymentresult where idBuildResult=" .  $row['idBuildresult'] . " order by idDeploymentResult desc limit 1";
		$resultlatestdeployresult = mysqli_query($con,$latestdeployresult);
		$rowlatestdeployresult = mysqli_fetch_array($resultlatestdeployresult);
		
		$color="";
		$displaylatestsystemtestresult="warning";
		if($rowlatestdeployresult[0] >= 1)
		{
			if($rowlatestdeployresult['DeploymentResult'] == 0)
			{
				$displaylatestsystemtestresult = "PASSED";
				$color="#006600";
			}
			else if($rowlatestdeployresult['DeploymentResult'] == 1)
			{
				$displaylatestsystemtestresult = "FAILED";
				$color="#FF0000";
			}
		}
		else
		{
			$displaylatestsystemtestresult = "SKIP";
			$color="#FFCC00";
		}
?>
          <td title="<?php echo $row['ProjectParentName'];?>"><center><b><?php echo $row['ProjectName'];?></center></td>
          <td><center><b><font color="<?php echo $color;?>"><?php echo $displaylatestsystemtestresult;?></font></b></center></td>
	</tr>
<?php
	}
}
?>
</table>
<br><br>
<b><font size="+2">Test result</font></b>
<br>
<table border="1">
<?php
if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
?>
	<tr>
<?php
	$projectDependency = "SELECT * FROM qualitydashboard.projectparent";
	$result = mysqli_query($con,$projectDependency);
	while($row = mysqli_fetch_array($result))
	{
                $condition = 0;
		$latestsystemtestresult = "SELECT * FROM qualitydashboard.systemtestresult 
		where idbuildsequence = (select max(idbuildsequence) from qualitydashboard.buildcargo) AND idProjectParent=" . $row['idProjectParent'] . " order by 
		idsystemtestResult desc limit 1";
		/*$latestsystemtestresult = "SELECT * FROM qualitydashboard.systemtestresult 
		where idbuildsequence = (SELECT MAX(idbuildsequence) FROM qualitydashboard.systemtestresult) AND idProjectParent=" . $row['idProjectParent'] . " order by 
		idsystemtestResult desc limit 1";*/
		$resultlatestsystemtestresult = mysqli_query($con,$latestsystemtestresult);
		$rowlatestsystemtestresult = mysqli_fetch_array($resultlatestsystemtestresult);
		$color="#FFFF00";
		$displaylatestsystemtestresult="WARNING";
		if($rowlatestsystemtestresult['testresult'] == null)
		{
			$displaylatestsystemtestresult = "NO TEST RESULT";
			$color="#FF0000";
                        $condition = 1;
		}
		else if($rowlatestsystemtestresult['testresult'] == 1)
		{
			$displaylatestsystemtestresult = "FAILED";
			$color="#FF0000";
		}
                else if($rowlatestsystemtestresult['testresult'] == 0)
		{
			$displaylatestsystemtestresult = "PASS";
			$color="#006600";
		}
?>
          <td title="<?php echo $row['ProjectParentName'].$rowlatestsystemtestresult['idbuildsequence'];?>"><center><b><?php echo $row['ProjectParentName'];?></center></td>
          <td><center><b><font color="<?php echo $color;?>"><?php echo $displaylatestsystemtestresult;?></font></b></center></td>
          <?php if($condition==0){ ?>
            <td><a href="http://<?php echo $dns;?>/qualityreport/views/filterfailurefrome2e.php?directory=<?php echo $rowlatestsystemtestresult['testfulldetail'];?>"> test result</a></td>
            <!--td><a href="http://<?php echo $dns;?>/AlphaDashboard/filterfailurefrome2e.php?directory=<?php echo $rowlatestsystemtestresult['testfulldetail'];?>"> test result</a></td-->
          <?php }else{ ?>
            <td></td>
          <?php } ?>
	</tr>
<?php
	}
}
?>
</table>
<?php
mysqli_free_result($result);
mysqli_close($con);
?>
