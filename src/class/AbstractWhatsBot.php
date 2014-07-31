<?php

// requerimientos
require('api/whatsprot.class.php');
require('api/class/Caller/iCaller.php');

abstract class aWhatsBot
{
	private $number = 0;
	private $identity = '';
	private $nickname = '';

	protected $object = null;

	public function __construct($number, $identity, $password, $nickname = 'WhatsBot', $devmode = false)
	{
		// instanciamos el protocolo de whatsapp
		$this->object = new WhatsProt($number, $identity, $nickname, $devmode);
		// realizamos la conexion
		$this->object->connect();
		// logueamos con password
		$this->object->loginWithPassword($password);
		// seteamos nuestra instancia en la clase caller para recivir las llamadas a estaticas
		Caller::SetInstance($this);
		// bindeamos los eventos
		$this->object->eventManager()->bind('onGetMessage', 'Caller::onGetMessage');
		$this->object->eventManager()->bind('onGetGroupMessage', 'Caller::onGetGroupMessage');
		$this->onConnect();
	}

	public function Start()
	{
		try
		{
			while(true)
			{
				$this->object->pollMessages();
				usleep(100);
			}
		}
		catch(Exception $E)
		{
			return $E;
		}
	}

	// funciones reescribibles
	public function onGetMessage($Number, $From, $MsgID, $Type, $Time, $Name, $Message);
	public function onGetGroupMessage($Number, $From, $Author, $MsgID, $Type, $Time, $Name, $Message);
	public function onConnect();
}