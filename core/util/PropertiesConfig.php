<?php namespace core\util;
class PropertiesConfig {
	private static $INI_PATH;
	private static $properties;
	public static function get($key) {
		if (is_null(self::$properties)) {
			self::load();
		}
		return self::$properties[$key];
	}
	public static function set($key, $value){
		if (is_null(self::$properties)) {
			self::load();
		}
		self::$properties[$key] = $value;
		return true;
	}
	public static function load() {
		self::$INI_PATH = dirname(dirname(__FILE__))."/conf/application.ini";
		self::$properties = parse_ini_file(self::$INI_PATH);
		return true;
	}
	public static function store() {
                self::$INI_PATH = dirname(dirname(__FILE__))."/conf/application.ini";
		$res = array();
		foreach(self::$properties as $key => $val) {
			/*if (is_array($val)) {
				$res[] = "[$key]";
				foreach($val as $skey => $sval) $res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
			} else {*/
				$res[] = "$key = ".(is_numeric($val) ? $val : '"'.$val.'"');
			/*}*/
		}
		self::safefilerewrite(self::$INI_PATH, implode("\r\n", $res));
		return true;
	}
	private static function safefilerewrite($fileName, $dataToSave) {
		if ($fp = fopen($fileName, 'w')) {
			$startTime = microtime();
			do {
				$canWrite = flock($fp, LOCK_EX);
				// If lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
				if(!$canWrite) {
					usleep(round(rand(0, 100)*1000));
				}
			} while ((!$canWrite)and((microtime()-$startTime) < 1000));
			
			if ($canWrite) {
				fwrite($fp, $dataToSave);
				flock($fp, LOCK_UN);
			}
			fclose($fp);
		}
	}
}


