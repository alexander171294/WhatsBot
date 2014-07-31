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
		try
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
		} catch (exception $obj)
		{
			$this->onError($obj->getMessage());
		}
	}

	// conector
	public function connect()
	{
		try
		{
			// realizamos la conexion
			$this->object->connect();
			$this->onConnect();
		} catch (exception $obj)
		{
			$this->onError($obj->getMessage());
		}
	}

	// logueo con password
	public function loginPassowd()
	{
		try
		{
			// logueamos con password
			$this->object->loginWithPassword($this->password);
			$this->onLogin();
		} catch (exception $obj)
		{
			$this->onError($obj->getMessage());
		}
	}

	// iniciamos el bucle controlador
	public function Start()
	{
		try
		{	
			$cancel = false;
			$this->onStart($cancel);
			while(!$cancel)
			{
				$this->object->pollMessages();
				usleep(100);
			}
		} catch (exception $obj)
		{
			$this->onError($obj->getMessage());
		}
	}

	public function codeRequest()
	{
		try
		{
			$this->object->codeRequest('sms');
			$this->onCodeSend();
		} catch (exception $obj)
		{
			$this->onError($obj->getMessage());
		}		
	}

	public function codeRegister($code)
	{
		try
		{
			$this->object->codeRegister($code);
			$this->onCodeRegister();
		} catch (exception $obj)
		{
			$this->onError($obj->getMessage());
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
	// funcion receptora del evento loguin
	abstract public function onCodeSend();
	// funcion receptora del evento loguin
	abstract public function onCodeRegister();
}