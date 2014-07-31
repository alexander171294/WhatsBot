<?php

// requerimientos
require('class/AbstractWhatsBot.php');
require('class/ErrorCache/iErrorCache.php');

class WhatsBot extends aWhatsBot implements iWhatsBot
{
	public function onGetMessage($Number, $From, $MsgID, $Type, $Time, $Name, $Message)
	{
		// quitamos la basura del from
		$From = str_replace('@s.whatsapp.net', '', $From);
	}
	
	public function onGetGroupMessage($Number, $From, $Author, $MsgID, $Type, $Time, $Name, $Message)
	{
		
	}

	public function onConnect()
	{
		ErrorCache::ShowMessage('Connected and hello world :)');
	}

	public function onLoguin()
	{
		ErrorCache::ShowMessage('logged');
	}

	public function onStart(&$cancel)
	{
		// cancelar?
		// $cancel = true;
		ErrorCache::ShowMessage('started');
	}

	public function onError($errorMessage)
	{
		ErrorCache::ShowError($errorMessage);
	}

	public function onCodeRequest()
	{
		ErrorCache::ShowMessage('Codigo enviado el celular');
	}

	public function onCodeRegister()
	{
		ErrorCache::ShowMessage('Codigo registrado correctamente');
	}

}

?>