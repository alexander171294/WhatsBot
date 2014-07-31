<?php

require('WhatsBot.php');

interface iWhatsBot
{
	// constructor de la clase
	public function __construct($number, $identity, $password, $nickname = 'WhatsBot', $devmode = false);

	// funcion para conectarse
	public function connect();

	// funciona para iniciar el bucle infinito :)
	public function Start();

	// funciones receptoras de eventos
	public function onGetMessage($Number, $From, $MsgID, $Type, $Time, $Name, $Message);
	public function onGetGroupMessage($Number, $From, $Author, $MsgID, $Type, $Time, $Name, $Message);
	public function onConnect();
	public function onLoguin();
	public function onStart(&$cancel);
	public function onError($errorMessage);
}