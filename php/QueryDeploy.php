<?php
include 'connectDB.php';
$projName = array();// Keep Name Project
$date = array();// Keep Date Project
$dateLoop=array();// Date for loop
$data=array();// Keep data each Project
$dataStart=array();// Keep all date deploy Project
$dataEnd=array();// Keep all date end deploy Project
$hrs=array();// Keep num hrs deploy each Project
$start=array();// Keep date deploy each Project
$end=array();// Keep date end deploy each Project
$sort=array();// Keep query data for check 
$ans = array();// Keep All Data



	$sql1 = "SELECT DATE_FORMAT(a.DeploymentDate, '%d %M') AS dateformat,date(a.DeploymentDate) AS dateloop
			from TEST_DEPLOYMENT a , buildresult b , mapindexparent c ,
			projectindex d,TEST_PROJECT_PARENT e where a.DeploymentDate > SYSDATE() - INTERVAL 8 DAY 
			and a.DeploymentDate < SYSDATE() and a.EndDeploymentDate < SYSDATE() 
			and a.idBuildResult= b.idBuildResult
			and b.idProjectIndex=d.idProjectIndex
			and d.idProjectIndex=c.idProjectIndex
			and c.idProjectParent=e.idProjectParent 
			and e.SQUAD_ID=".$_GET['SQUAD_ID']." 
			GROUP BY date(a.DeploymentDate),date(a.EndDeploymentDate);";
	$result1 = $con->query($sql1);
	while($row = $result1->fetch_assoc()) {
    	array_push($date, $row["dateformat"]);
    	array_push($dateLoop, $row["dateloop"]);
   	}
    $ans['date'] = $date;

	$sql = "SELECT  d.ProjectName
			from TEST_DEPLOYMENT a , buildresult b , 
			mapindexparent c ,projectindex d,TEST_PROJECT_PARENT e 
			where a.DeploymentDate > SYSDATE() - INTERVAL 8 DAY and a.DeploymentDate < SYSDATE() 
			and a.EndDeploymentDate < SYSDATE() 
			and a.idBuildResult= b.idBuildResult
			and b.idProjectIndex=d.idProjectIndex
			and d.idProjectIndex=c.idProjectIndex
			and c.idProjectParent=e.idProjectParent 
			and e.SQUAD_ID=".$_GET['SQUAD_ID']." 
			GROUP BY d.ProjectName ORDER BY d.ProjectName;";
	$result = $con->query($sql);
	while($row = $result->fetch_assoc()) {
    	array_push($projName,$row["ProjectName"]);
    	
    }
	$ans['name']=$projName;

$index=0;
$i=0;
$j=0;
$k=0;
$countDate=count($dateLoop)-1;
$countProj=count($projName)-1;

    $sql2 = "SELECT date(a.DeploymentDate) as date,time(a.DeploymentDate) as time1 ,time(a.EndDeploymentDate) as time2,
    			TimeDiff(a.EndDeploymentDate,a.DeploymentDate) as timediff , d.ProjectName
				from TEST_DEPLOYMENT a , buildresult b , mapindexparent c ,projectindex d,TEST_PROJECT_PARENT e where date(a.DeploymentDate) > SYSDATE() - INTERVAL 8 DAY 
				and a.DeploymentDate < SYSDATE() and a.EndDeploymentDate < SYSDATE() 
				and e.SQUAD_ID=".$_GET['SQUAD_ID']."
				and a.idBuildResult= b.idBuildResult
				and b.idProjectIndex=d.idProjectIndex
				and d.idProjectIndex=c.idProjectIndex
				and c.idProjectParent=e.idProjectParent GROUP BY a.idBuildResult ORDER BY d.ProjectName,date(a.DeploymentDate);";
	$result2 = $con->query($sql2);
	while($row = $result2->fetch_assoc()) {
		$sort[0]=$row["time1"];
		$sort[1]=$row["time2"];
		$sort[2]=(int)$row["timediff"];
		$sort[3]=$row["ProjectName"];
		$sort[4]=$row["date"];
		if($sort[3]==$projName[$i]&&$sort[4]==$dateLoop[0]){
			$hrs[$index]=$sort[2];
			$start[$index]=$sort[0];
			$end[$index]=$sort[1];
			$index++;
			$k++;
			if($i==$countProj&&$sort[4]==$dateLoop[$countDate]){
				$data[$j]=$hrs;
   				$dataStart[$j]=$start;
   				$dataEnd[$j]=$end;
			}	
   		}
   		else if($sort[3]==$projName[$i]&&$sort[4]!=$dateLoop[0]){
   			$hrs[$index]=$sort[2];
			$start[$index]=$sort[0];
			$end[$index]=$sort[1];
			$index++;
			$k++;
			if($i==$countProj&&$sort[4]==$dateLoop[$countDate]){
				$data[$j]=$hrs;
   				$dataStart[$j]=$start;
   				$dataEnd[$j]=$end;
			}
   		}
   		else if($sort[3]!=$projName[$i]&&$sort[4]==$dateLoop[0]){
   			while ($k<count($dateLoop)){
   				$hrs[$index]="";
				$start[$index]="";
				$end[$index]="";
				$index++;
				$k++;
			} 
			$data[$j]=$hrs;
   			$dataStart[$j]=$start;
   			$dataEnd[$j]=$end;
   			$j++;
			$index=0;
			$k=0;
			$hrs[$index]=$sort[2];
			$start[$index]=$sort[0];
			$end[$index]=$sort[1];
			$index++;
			$k++;
			$i++;
			if($i==$countProj&&$sort[4]==$dateLoop[$countDate]){
				$data[$j]=$hrs;
   				$dataStart[$j]=$start;
   				$dataEnd[$j]=$end;
			}
   		}	
    }
 	$ans['data']=$data;
 	$ans['start']=$dataStart;
 	$ans['end']=$dataEnd;
	echo json_encode($ans);
?>