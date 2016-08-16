<?php
class Environment {

	static $production = "prod";
	static $test = "test";
	
	static function getEnv() {
		return basename(ROOT);
	}
	
	static function isProduction() {
		return self::getEnv() === self::$production;
	}
	
	static function isTest() {
		return self::getEnv() === self::$test;
	}
	
	static function isDevelop() {
		return !self::isProduction() && !self::isTest();
	}
	
}