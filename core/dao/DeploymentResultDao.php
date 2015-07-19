<?php namespace core\dao;
class DeploymentResultDao {
	public $con;
	
	function __construct() {
		$con = null;
		require(dirname(dirname(__FILE__)).'/util/dbconnect.php');
		$this->con = &$con;
	}
	
	public function __destruct() {
		mysqli_close($this->con);
	}
	
	public function getCountDeploymentResult($build, $deploymentResult) {
                $value = null;
		if (!is_null($deploymentResult)) {
                    $sql = " SELECT COUNT(CASE WHEN a.DeploymentResult = " . $deploymentResult . " THEN 1 END) AS totalresult ";
		} else {
                    $sql = " SELECT COUNT(1) AS totalresult ";
                }
		$sql .= " FROM qualitydashboard.buildcargo, qualitydashboard.buildresult, qualitydashboard.deploymentresult a ";
		$sql .= " WHERE buildcargo.idBuildresult = buildresult.idBuildResult ";
		$sql .= " AND buildresult.idBuildresult = a.idBuildResult ";
		$sql .= " AND buildcargo.idbuildsequence = " . $build;
		$sql .= " AND idDeploymentResult = ( ";
		$sql .= " 	SELECT MAX(idDeploymentResult) FROM qualitydashboard.deploymentresult ";
		$sql .= " 	WHERE idBuildResult = a.idBuildResult ";
		$sql .= " )";
		$sql .= " GROUP BY buildcargo.idbuildsequence ";
		$result = mysqli_query($this->con, $sql);
		$row = mysqli_fetch_array($result);
                if (!is_null($row)) {
                    $value = (string) $row['totalresult'];
                }
		return $value;
	}
        public function getDeploybyBuild($build,$order){
            $sql ="SELECT d.ProjectName,c.DeploymentResult,b.BuildVersion,b.BuildNumber FROM qualitydashboard.buildcargo a,qualitydashboard.buildresult b, ";
            $sql .="qualitydashboard.deploymentresult c,qualitydashboard.projectindex d ";
            $sql .="WHERE a.idBuildResult = b.idBuildResult AND a.idBuildResult = c.idBuildResult ";
            $sql .="AND b.idProjectIndex = d.idProjectIndex  ";
            $sql .="AND a.idbuildsequence = ".$build." ";
            $sql .="AND c.idDeploymentResult = (SELECT MAX(e.idDeploymentResult) FROM deploymentresult e WHERE e.idBuildResult=c.idBuildResult) ";
            if($order=="name"){
                $sql .= "ORDER BY d.ProjectName ";
            }else {
                $sql .= "ORDER BY CASE c.DeploymentResult WHEN 1 THEN 0	WHEN 2 THEN 1	WHEN 0 THEN 2 END ";
            }
            $result = mysqli_query($this->con, $sql);
            $models = array();
            $rowIndex = 0;
            while($row = mysqli_fetch_array($result)){
                $models[$rowIndex++] = array((string)$row['ProjectName'].'-'.$row['BuildVersion'].'-'.$row['BuildNumber'],$row['DeploymentResult']);
            }
            return($models);
        }
}
