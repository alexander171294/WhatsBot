<?php

require('ErrorCache.php');

interface iErrorCache
{
	static public function showError($message);
	static public function showMessage($message);
	static public function showQuestion($message);
}