<?php

require('WhatsBot.php');

interface iWhatsBot
{
	// constructor de la clase
	public function __construct($number, $identity, $password, $nickname = 'WhatsBot', $devmode = false);

	// funcion para conectarse
	public function connect();

	// loginPassword
	public function loginPasswd();

	// funciona para iniciar el bucle infinito :)
	public function Start();

	// request code
	public function codeRequest($cc);

	// registrar el codigo recibido
	public function codeRegister($code);

	// funciones receptoras de eventos
	public function onGetMessage($Number, $From, $MsgID, $Type, $Time, $Name, $Message);
	public function onGetGroupMessage($Number, $From, $Author, $MsgID, $Type, $Time, $Name, $Message);
	public function onConnect();
	public function onLogin();
	public function onStart(&$cancel);
	public function onError($errorMessage);
	// evento de respuesta de codeRequest();
	public function onCodeSend();
	// evento de respuesta de codeRegister();
	public function onCodeRegister();
}