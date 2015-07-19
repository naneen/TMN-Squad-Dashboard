<?php namespace core\dao;
use core\model\QualityWeekReport as QualityWeekReport;

class ReportDao {
	public $con;
	
	function __construct() {
		$con = null;
		require(dirname(dirname(__FILE__)).'/util/dbconnect.php');
		$this->con = &$con;
	}
	
	function __destruct() {
		mysqli_close($this->con);
	}
	
	public function getQualityWeekReport($number_of_week) {
		$sql = " SELECT CONCAT(a.build_year, '-w', a.build_week) build_week ";
                $sql .= " , GREATEST(DATE_ADD(MAX(build_date), INTERVAL(1-DAYOFWEEK(MAX(build_date))) DAY), STR_TO_DATE(CONCAT('01','01',YEAR(MAX(build_date))), '%m%d%Y')) AS start_date ";
                $sql .= " , LEAST(DATE_ADD(MAX(build_date), INTERVAL(7-DAYOFWEEK(MAX(build_date))) DAY), STR_TO_DATE(CONCAT('12','31',YEAR(MAX(build_date))), '%m%d%Y')) AS end_date ";
                $sql .= " , COUNT(*) AS cnt_build, COUNT(CASE WHEN (a.deploy_fail + a.test_fail) = 0 THEN 1 END) AS cnt_pass ";
                $sql .= "  FROM ( ";
                $sql .= " SELECT BUILD.idbuildsequence, BUILD.build_date, BUILD.build_year, BUILD.build_week, BUILD.deploy_fail, TEST.test_fail ";
                $sql .= " FROM ( ";
                $sql .= " SELECT bc.idbuildsequence, DATE(bc.timestamp) AS build_date ";
                $sql .= " , YEAR(bc.timestamp) build_year ";
                $sql .= " , (WEEK(bc.timestamp) + 1) build_week ";
                $sql .= " , COUNT(CASE WHEN dr.DeploymentResult = 1 THEN 1 END) AS deploy_fail ";
                $sql .= " FROM qualitydashboard.buildcargo bc ";
                $sql .= " LEFT OUTER JOIN qualitydashboard.buildresult br ON bc.idBuildresult = br.idBuildResult ";
                $sql .= " LEFT OUTER JOIN qualitydashboard.deploymentresult dr ";
                $sql .= " ON br.idBuildresult = dr.idBuildResult ";
                $sql .= " AND dr.idDeploymentResult = ( ";
                $sql .= " SELECT MAX(idDeploymentResult) FROM qualitydashboard.deploymentresult ";
                $sql .= " WHERE idBuildResult = dr.idBuildResult ";
                $sql .= " ) ";
                $sql .= " WHERE ( ";
                $sql .= " ( WEEK(bc.timestamp) >= WEEK(CURDATE()) + 1 - ".$number_of_week." AND YEAR(bc.timestamp) = YEAR(CURDATE()) ) ";
                $sql .= " OR ";
                $sql .= " ( WEEK(bc.timestamp) > WEEK(STR_TO_DATE(CONCAT(12,31,YEAR(CURDATE())-1), '%m%d%Y')) - ".$number_of_week."  + WEEK(CURDATE()) + 1 AND YEAR(bc.timestamp) = YEAR(CURDATE())-1 AND ".$number_of_week."  > WEEK(CURDATE())+1 ) ";
                $sql .= " ) ";
                $sql .= " GROUP BY bc.idbuildsequence, DATE(bc.timestamp), WEEK(bc.timestamp), YEAR(bc.timestamp) ";
                $sql .= " ORDER BY bc.idbuildsequence DESC ";
                $sql .= " ) BUILD ";
                $sql .= " LEFT OUTER JOIN ( ";
                $sql .= " SELECT tr.idbuildsequence, COUNT(CASE WHEN tr.testresult = 1 THEN 1 END) AS test_fail ";
                $sql .= " , YEAR(tr.systemtestdate) AS build_year ";
                $sql .= " , (WEEK(tr.systemtestdate) + 1) AS build_week ";
                $sql .= " FROM qualitydashboard.systemtestresult tr ";
                $sql .= " WHERE ( ";
                $sql .= " ( WEEK(tr.systemtestdate) >= WEEK(CURDATE()) + 1 - ".$number_of_week."  AND YEAR(tr.systemtestdate) = YEAR(CURDATE()) ) ";
                $sql .= " OR ";
                $sql .= " ( WEEK(tr.systemtestdate) > WEEK(STR_TO_DATE(CONCAT(12,31,YEAR(CURDATE())-1), '%m%d%Y')) - ".$number_of_week."  + WEEK(CURDATE()) + 1 AND YEAR(tr.systemtestdate) = YEAR(CURDATE())-1 AND ".$number_of_week."  > WEEK(CURDATE())+1 ) ";
                $sql .= " ) ";
                $sql .= " AND tr.idsystemtestResult = ( ";
                $sql .= " SELECT MAX(idsystemtestResult) ";
                $sql .= " FROM qualitydashboard.systemtestresult ";
                $sql .= " WHERE idbuildsequence = tr.idbuildsequence ";
                $sql .= " AND idProjectParent = tr.idProjectParent ";
                $sql .= " ) ";
                $sql .= " GROUP BY tr.idbuildsequence, WEEK(tr.systemtestdate), YEAR(tr.systemtestdate) ";
                $sql .= " ORDER BY tr.idbuildsequence DESC ";
                $sql .= " ) TEST ";
                $sql .= " ON TEST.idbuildsequence = BUILD.idbuildsequence ";
                $sql .= "  ) a ";
                $sql .= "  GROUP BY a.build_year, a.build_week ";
                $sql .= "  ORDER BY a.build_year, a.build_week ";
                
		$result = mysqli_query($this->con, $sql);
		
		$models = array();
		$rowIndex = 0;
		while ($row = mysqli_fetch_array($result)) {
			$model = new QualityWeekReport();
			$model->setBuildWeek( $row["build_week"] );
			$model->setStartDate( strtotime($row["start_date"]) );
			$model->setEndDate( strtotime($row["end_date"]) );
			$model->setCountBuild( (int) $row["cnt_build"] );
			$model->setCountPass( (int) $row["cnt_pass"] );
			$models[$rowIndex++] = $model;
		}
		return $models;
	}
}