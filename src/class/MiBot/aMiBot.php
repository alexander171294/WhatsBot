<?php

Abstract Class aMiBot
{

	// funcion ejecutada al recibir un mensaje
	abstract public function onGetMessage($Number, $From, $MsgID, $Type, $Time, $Name, $Message);
	// funcion ejecutada al recibir un mensaje de grupo
	abstract public function onGetGroupMessage($Number, $From, $Author, $MsgID, $Type, $Time, $Name, $Message);
	// funcion ejecutada al ocurrir un error
	abstract public function onError($errorMessage);
	// funcion ejecutada al iniciar (es cancelable)
	abstract public function onStart(&$cancel);
	// funcion diseñada para enviar mensajes a un lugar.
	public function send_message($target, $message)
	{
		Caller::onSendMessage($target, $message);
	}

}