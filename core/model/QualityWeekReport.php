<?php namespace core\model;
class QualityWeekReport {
	private $buildWeek;
	private $startDate;
	private $endDate;
	private $countBuild;
	private $countPass;
	
	public function getBuildWeek() {
		return $this->buildWeek;
	}
	public function setBuildWeek($buildWeek) {
		$this->buildWeek = $buildWeek;
	}
	public function getStartDate() {
		return $this->startDate;
	}
	public function setStartDate($startDate) {
		$this->startDate = $startDate;
	}
	public function getEndDate() {
		return $this->endDate;
	}
	public function setEndDate($endDate) {
		$this->endDate = $endDate;
	}
	public function getCountBuild() {
		return $this->countBuild;
	}
	public function setCountBuild($countBuild) {
		$this->countBuild = $countBuild;
	}
	public function getCountPass() {
		return $this->countPass;
	}
	public function setCountPass($countPass) {
		$this->countPass = $countPass;
	}
}
