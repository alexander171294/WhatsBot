<?php

require('StdIO.php');

interface iStdIO
{
	static public function show($message);
	static public function showError($message);
	static public function showMessage($message);
	static public function showQuestion($message);
	static public function InputLine();
}