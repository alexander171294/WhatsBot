<?php

// requerimientos
require('class/AbstractWhatsBot.php');
require('class/StdIO/iStdIO.php');

class WhatsBot extends aWhatsBot implements iWhatsBot
{

	private $mibot = null;
	private $no_errors = true;

	public function set_mibot(aMiBot $mibot)
	{
		$this->mibot = $mibot;
	}

	// EVENTS //

	public function onGetMessage($Number, $From, $MsgID, $Type, $Time, $Name, $Message)
	{
		// quitamos la basura del from
		$From = str_replace('@s.whatsapp.net', '', $From);
		$this->mibot->onGetMessage($Number, $Form, $MsgID, $Type, $Time, $Name, $Message);
	}
	
	public function onGetGroupMessage($Number, $From, $Author, $MsgID, $Type, $Time, $Name, $Message)
	{
		$this->mibot->onGetGroupMessage($Number, $From, $Author, $MsgID, $Type, $Time, $Name, $Message);
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
		$cancel = $this->no_errors;
		$this->mibot->onStart($cancel);
		if($cancel == false)
			StdIO::ShowMessage('Started');
		if($cancel == true)
			StdIO::ShowError('Aborted');
	}

	public function onError($errorMessage)
	{
		$this->no_errors = true;
		$this->mibot->onError($errorMessage);
		StdIO::ShowError($errorMessage);
	}

	public function onCodeSend()
	{
		StdIO::ShowMessage('Codigo enviado al celular');
	}

	public function onCodeRegister()
	{
		StdIO::ShowMessage('Codigo registrado correctamente');
	}

	public function onSendMessage($target, $message)
	{
		$this->object->sendMessage($target, $message);
	}

}

?>