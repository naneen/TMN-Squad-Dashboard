<?php namespace core\dao;
class BuildCargoDao {
	public $con;
	
	function __construct() {
		$con = null;
		require(dirname(dirname(__FILE__)).'/util/dbconnect.php');
		$this->con = &$con;
	}
	
	function __destruct() {
		mysqli_close($this->con);
	}
	
	public function getMaxIdBuildSequence() {
		$sql = " SELECT MAX(idbuildsequence) AS max_build FROM qualitydashboard.buildcargo ";
		$result = mysqli_query($this->con, $sql);
		$row = mysqli_fetch_array($result);
		$build = (string) $row['max_build'];
		return $build;
	}
        public function getMaxWeekofbuildsequence(){
                $sql = "SELECT DISTINCT (WEEK(a.timestamp) + 1) AS weekbyb FROM qualitydashboard.buildcargo a ";
                $sql .= "WHERE a.idbuildsequence = (SELECT MAX(b.idbuildsequence)FROM qualitydashboard.buildcargo b) ";
                $result = mysqli_query($this->con, $sql);
		$row = mysqli_fetch_array($result);
		$week = (int) $row['weekbyb'];
		return $week;
        }
        public function getBuildbyweek($year,$week){
                $sql = "SELECT BUILD.idbuildsequence AS idbuild,BUILD.deploy_fail AS deployre, TEST.test_fail AS testre ";
                $sql .="FROM ( ";
                $sql .="SELECT bc.idbuildsequence, DATE(bc.timestamp) AS build_date, (WEEK(bc.timestamp) + 1) build_week, ";
                $sql .="COUNT(CASE WHEN dr.DeploymentResult = 1 THEN 1 END) AS deploy_fail ";
                $sql .="FROM qualitydashboard.buildcargo bc ";
                $sql .="LEFT OUTER JOIN qualitydashboard.buildresult br ON bc.idBuildresult = br.idBuildResult ";
                $sql .="LEFT OUTER JOIN qualitydashboard.deploymentresult dr ";
                $sql .="ON br.idBuildresult = dr.idBuildResult ";
                $sql .="AND dr.idDeploymentResult = ( ";
                $sql .="SELECT MAX(idDeploymentResult) FROM qualitydashboard.deploymentresult ";
                $sql .="WHERE idBuildResult = dr.idBuildResult ) ";
                $sql .="WHERE (WEEK(bc.timestamp) + 1) = ".$week." ";
                $sql .="AND (YEAR(bc.timestamp)) = ".$year." ";
                $sql .="GROUP BY bc.idbuildsequence, DATE(bc.timestamp), WEEK(bc.timestamp) ";
                $sql .="ORDER BY bc.idbuildsequence DESC ) BUILD ";
                $sql .="LEFT OUTER JOIN ( ";
                $sql .="SELECT tr.idbuildsequence, COUNT(CASE WHEN tr.testresult = 1 THEN 1 END) AS test_fail ";
                $sql .=", (WEEK(tr.systemtestdate) + 1) AS build_week ";
                $sql .="FROM qualitydashboard.systemtestresult tr ";
                $sql .="WHERE (WEEK(tr.systemtestdate) + 1) = ".$week." ";
                $sql .="AND (YEAR(tr.systemtestdate)) = ".$year." ";
                $sql .="AND tr.idsystemtestResult = ( ";
                $sql .="SELECT MAX(idsystemtestResult) ";
                $sql .="FROM qualitydashboard.systemtestresult ";
                $sql .="WHERE idbuildsequence = tr.idbuildsequence ";
                $sql .="AND idProjectParent = tr.idProjectParent ) ";
                $sql .="GROUP BY tr.idbuildsequence, WEEK(tr.systemtestdate) ";
                $sql .="ORDER BY tr.idbuildsequence DESC ) TEST ";
                $sql .="ON TEST.idbuildsequence = BUILD.idbuildsequence ";
                $result = mysqli_query($this->con, $sql);
                $rowIndex = 0;
                $models = array();
                while ($row = mysqli_fetch_array($result)){
                    $models[$rowIndex++] = array($row['idbuild'],$row['deployre'],$row['testre']);
                }
                return $models;
        }
}