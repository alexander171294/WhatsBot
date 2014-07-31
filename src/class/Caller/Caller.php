<?php

/**
  * Static Class Caller
  */

class Caller implements iCaller
{
	private static $instance;	

	public static function SetInstance($obj)
	{
		self::$instance = $obj;
	}

	public static function __callStatic($name, $args)
	{
		call_user_func(array(self::$instance, $name), $args); 
	}
}