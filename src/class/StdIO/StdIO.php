<?php

// Sistema de Logueo de mensajes
Class StdIO implements iStdIO
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

	static public function InputLine()
	{
		return trim(fgets(STDIN));
	}
}