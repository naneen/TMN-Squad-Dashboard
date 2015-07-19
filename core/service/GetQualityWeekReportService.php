<?php
require(dirname(dirname(__FILE__)).'/util/autoload.php');
use core\dao\ReportDao as ReportDao;
use core\util\PropertiesConfig as PropertiesConfig;

$week = PropertiesConfig::get("report.qualityweek.week");
$reportDao = new ReportDao();
$models = $reportDao->getQualityWeekReport($week);

$result2 = array();
$rowIndex = 0;
$obj1 = new stdClass();
$obj2 = new stdClass();
$obj1->name = "total";
$obj1->color = "#B93232";
$obj2->name = "pass";
$obj2->color = "#1F7513";
$data = array();
$data2 = array();
    foreach ($models as $model) {
            $data2[$rowIndex] = 
                    /*"startdate" => $model->getStartDate(),
                    "enddate" => $model->getEndDate(),*/
                    //"total" => $model->getCountBuild(),
                    $model->getCountPass();
            $data[$rowIndex] = 
                    /*"startdate" => $model->getStartDate(),
                    "enddate" => $model->getEndDate(),*/
                    $model->getCountBuild()-$model->getCountPass();
                    //"pass" => $model->getCountPass()
            
            $result2[$rowIndex]= $model->getBuildWeek();
            $rowIndex++;
    }
$obj1->data = $data;
$obj2->data = $data2;
$result = array($obj1,$obj2);
$result3 = array('series' => $result, 'categories' => $result2);
$callback = "";
if(array_key_exists('callback', $_GET) == TRUE) {
	$callback = $_GET['callback'];
}
print $callback.'('.json_encode($result3).')';