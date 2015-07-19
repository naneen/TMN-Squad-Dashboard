<?php namespace core\dao;
class SystemTestResultDaoTest extends \PHPUnit_Framework_TestCase {
	protected $object;
	protected $build;
	protected function setUp() {
		$this->object = new SystemTestResultDao;
		$this->build = 237;
	}
	protected function tearDown() {
		unset($this->object);
	}
	public function testGetCountTestResult() {
		$cnt = $this->object->getCountTestResult($this->build, 1);
		$this->assertEquals(0, $cnt);
	}
}
