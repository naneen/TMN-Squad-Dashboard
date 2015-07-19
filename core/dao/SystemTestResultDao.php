<?php namespace core\dao;
class SystemTestResultDao {
	public $con;
	
	function __construct() {
		$con = null;
		require(dirname(dirname(__FILE__)).'/util/dbconnect.php');
		$this->con = &$con;
	}
	
	function __destruct() {
		mysqli_close($this->con);
	}
	
	public function getCountTestResult($build, $testResult) {
                $value = null;
		if (!is_null($testResult)) {
                    $sql = " SELECT COUNT(CASE WHEN a.testresult = " . $testResult . " THEN 1 END) AS testresult ";
		} else {
                    $sql = " SELECT COUNT(1) AS testresult ";
                }
		$sql .= " FROM qualitydashboard.systemtestresult a ";
		$sql .= " WHERE idbuildsequence = " . $build;
		$sql .= " AND idsystemtestResult = ( ";
		$sql .= " 	SELECT MAX(idsystemtestResult) FROM qualitydashboard.systemtestresult ";
		$sql .= " 	WHERE idbuildsequence = a.idbuildsequence ";
		$sql .= " 	AND idProjectParent = a.idProjectParent ";
		$sql .= " )";
		$sql .= " GROUP BY idbuildsequence ";
		$result = mysqli_query($this->con, $sql);
                $row = mysqli_fetch_array($result);
                if (!is_null($row)) {
                    $value = (string) $row['testresult'];
                }
		return $value;
	}
        public function getTestbyBuild($build,$order){
                $sql = "SELECT b.ProjectParentName,c.testresult,c.testpass,c.testfail,c.testfulldetail,b.idgrouplead FROM qualitydashboard.projectparent b,qualitydashboard.systemtestresult c ";
		$sql .= "WHERE c.idProjectParent = b.idProjectParent ";
                $sql .= "AND c.idbuildsequence = ".$build." ";
                $sql .= "AND c.idsystemtestResult = (SELECT MAX(f.idsystemtestResult) FROM systemtestresult f ";
                $sql .= "WHERE f.idbuildsequence = c.idbuildsequence AND f.idProjectParent = c.idProjectParent) ";
                if($order=="name"){
                    $sql .= "ORDER BY b.ProjectParentName ";
                }else {
                    $sql .= "ORDER BY  CASE c.testresult WHEN 1 THEN 0 WHEN 2 THEN 1	WHEN 0 THEN 2 END";
                }
                $result = mysqli_query($this->con, $sql);
                $rowIndex = 0;
                $models = array();
                while($row = mysqli_fetch_array($result)){
                    $models[$rowIndex++] = array($row['ProjectParentName'],$row['testresult'],(int)$row['testpass'],(int)$row['testfail'],$row['testfulldetail'],$row['idgrouplead']);
                }
                return($models);
        }
        public function getGroupfilepath($idgrouplead){
                $sql = "SELECT groupleadfilepath FROM grouplead WHERE idgrouplead = ".$idgrouplead." ";
                $result = mysqli_query($this->con, $sql);
                $row = mysqli_fetch_array($result);
                return $row['groupleadfilepath'];
        }
}