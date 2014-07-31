<?php

// requerimientos
require('api/whatsprot.class.php');
require('class/Caller/iCaller.php');

abstract class aWhatsBot
{
	private $number = 0;
	private $identity = '';
	private $nickname = '';

	protected $object = null;
	protected $password = '';

	// constructor del objeto
	public function __construct($number, $identity, $password, $nickname = 'WhatsBot', $devmode = false)
	{
		// guardamos los datos
		$this->number = $number;
		$this->identity = $identity;
		$this->password = $password;
		$this->nickname = $nickname;
		// instanciamos el protocolo de whatsapp
		$this->object = new WhatsProt($number, $identity, $nickname, $devmode);
		// seteamos nuestra instancia en la clase caller para recivir las llamadas a estaticas
		Caller::SetInstance($this);
		// bindeamos los eventos
		$this->object->eventManager()->bind('onGetMessage', 'Caller::onGetMessage');
		$this->object->eventManager()->bind('onGetGroupMessage', 'Caller::onGetGroupMessage');
	}

	// conector
	public function connect()
	{
		// realizamos la conexion
		$this->object->connect();
		$this->onConnect();
	}

	// logueo con password
	public function loguinPassowd()
	{
		// logueamos con password
		$this->object->loginWithPassword($this->password);
		$this->onLoguin();
	}

	// iniciamos el bucle controlador
	public function Start()
	{
			$cancel = false;
			$this->onStart($cancel);
			while(!$cancel)
			{
				$this->object->pollMessages();
				usleep(100);
			}
	}

	// funciones reescribibles
	// funcion receptora de mensajes
	abstract public function onGetMessage($Number, $From, $MsgID, $Type, $Time, $Name, $Message);
	// funcion receptora de mensajes en grupos
	abstract public function onGetGroupMessage($Number, $From, $Author, $MsgID, $Type, $Time, $Name, $Message);
	// funcion receptora del evento connect
	abstract public function onConnect();
	// funcion receptora del evento loguin
	abstract public function onLoguin();
	// funcion receptora del evento start
	abstract public function onStart(&$cancel);
	// funcion receptora del evento start
	abstract public function onError($errorMessage);
}