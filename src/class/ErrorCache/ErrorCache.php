<?php

// Sistema de Logueo de mensajes
static Class ErrorCache implements iErrorCache
{
	static private $ErrorInformer = '[!!!]';
	static private $Informer = '[*]';
	static private $Question = '[?]';

	static public function showError($message)
	{
		echo self::$ErrorInformer.' '.$message."\n";
	}

	static public function showMessage($message)
	{
		echo self::$Informer.' '.$message."\n";
	}

	static public function showQuestion($message)
	{
		echo self::$Question.' '.$message."\n";
	}
}