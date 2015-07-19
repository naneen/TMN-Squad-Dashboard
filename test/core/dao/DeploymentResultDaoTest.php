<?php  namespace core\dao;
class DeploymentResultDaoTest extends \PHPUnit_Framework_TestCase {
	protected $object;
	protected $build;
	protected function setUp() {
		$this->object = new DeploymentResultDao;
		$this->build = 237;
	}
	protected function tearDown() {
		unset($this->object);
	}
	public function testGetCountDeploymentResult() {
		$cnt = $this->object->getCountDeploymentResult($this->build, 1);
		$this->assertEquals(0, $cnt);
	}
}
