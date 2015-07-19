<?php
namespace core\util;
class PropertiesConfigTest extends \PHPUnit_Framework_TestCase {
	protected $object;
	protected function setUp() {
		$this->object = new PropertiesConfig;
	}
	protected function tearDown() {
	}
	public function testGet() {
		$this->assertEquals("localhost", PropertiesConfig::get("db.host"));
		$this->assertEquals("3306", PropertiesConfig::get("db.port"));
	}
	public function testSet() {
		$msg = "My Message.";
		PropertiesConfig::set("test.msg", $msg);
		$this->assertEquals($msg, PropertiesConfig::get("test.msg"));
	}
	public function testLoad() {
		$this->assertTrue(PropertiesConfig::load());
	}
	public function testStore() {
		$msg = "My Message.";
		PropertiesConfig::set("test.msg", $msg);
		$this->assertTrue(PropertiesConfig::store());
		PropertiesConfig::load();
		$this->assertEquals($msg, PropertiesConfig::get("test.msg"));
	}
}
