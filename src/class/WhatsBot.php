<?php

// requerimientos
require('class/AbstractWhatsBot.php');
require('class/StdIO/iStdIO.php');

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
		StdIO::ShowMessage('Connected and hello world :)');
	}

	public function onLogin()
	{
		StdIO::ShowMessage('logged');
	}

	public function onStart(&$cancel)
	{
		// cancelar?
		// $cancel = true;
		StdIO::ShowMessage('started');
	}

	public function onError($errorMessage)
	{
		StdIO::ShowError($errorMessage);
	}

	public function onCodeSend()
	{
		StdIO::ShowMessage('Codigo enviado el celular');
	}

	public function onCodeRegister()
	{
		StdIO::ShowMessage('Codigo registrado correctamente');
	}

}

?>