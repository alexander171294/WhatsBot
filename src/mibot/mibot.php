<?php

// BOT DE EJEMPLO
// puede tener cualquier nombre pero debe extender aMiBot
Class MiBot extends aMiBot
{

	// funcion que se ejecuta al recibir un mensaje
	public function onGetMessage($Number, $From, $MsgID, $Type, $Time, $Name, $Message)
	{
		// recibi un mensaje
		if($Message == 'Hola')
			// respondemos al lugar de donde biene el mensaje
			$this->send_message($From, 'Hola, como andas?');
	}

	public function onGetGroupMessage($Number, $From, $Author, $MsgID, $Type, $Time, $Name, $Message)
	{
		// recibi un mensaje de un grupo
		if($Message == 'Hola')
			// respondemos al lugar de donde biene el mensaje
			$this->send_message($From, 'Hola, como anda la gente de este grupo?');
	}

	// esto se ejecuta al iniciar y podemos cancelar dandole de valor a $cancel = true
	public function onStart(&$cancel){}
	// esto se ejecuta cuando ocurre un error.
	public function onError($errorMessage){}

}