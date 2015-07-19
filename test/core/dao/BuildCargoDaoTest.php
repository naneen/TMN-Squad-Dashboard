<?php namespace core\dao;
class BuildCargoDaoTest extends \PHPUnit_Framework_TestCase {
	protected $object;
	protected function setUp() {
		$this->object = new BuildCargoDao;
	}
	protected function tearDown() {
		unset($this->object);
	}
	public function testGetMaxIdBuildSequence() {
		$max = $this->object->getMaxIdBuildSequence();
		$this->assertNotEmpty($max);
		$this->assertNotEquals(0, $max);
	}
}
