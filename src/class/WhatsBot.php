<?php
	class WhatsBot
	{
		protected static $Whatsapp = null;
		protected static $ToByPass = null;
		protected static $FromByPass = null;
		protected static $Admins = array();
		
		public static function SetInstance($W)
		{
			self::$Whatsapp = $W;
		}
		public static function W()
		{
			return self::$Whatsapp;
		}
		
		public function __construct($N, $I, $P, $U = 'WhatsBot', $D = false)
		{
			try
			{
				require_once('api/whatsprot.class.php');
				
				$this->Whatsapp = new WhatsProt($N, $I, $U, $D);
				
				$this->Whatsapp->connect();
				$this->Whatsapp->loginWithPassword($P);
				
				$this->Whatsapp->eventManager()->bind('onGetMessage', 'WhatsBot::onGetMessage');
				$this->Whatsapp->eventManager()->bind('onGetGroupMessage', 'WhatsBot::onGetGroupMessage');
				
				WhatsBot::setInstance($this->Whatsapp);
			}
			catch (Exception $E)
			{
				return $E; //(In index test if $E is instanceof Exception)
			}
		}
		
		public function SetAdmin($A = array())
		{
			$this->Admins = $A;
		}
		
		public function Start()
		{
			try
			{
				while(true)
				{
					$this->Whatsapp->pollMessages();
					usleep(100);
				}
			}
			catch(Exception $E)
			{
				return $E;
			}
		}
		
		static function onGetMessage($Number, $From, $MsgID, $Type, $Time, $Name, $Message)
		{
			$From = str_replace('@s.whatsapp.net', '', $From);
			WhatsBot::Parse($Number, $From, $MsgID, $Type, $Time, $Name, $Message);
		}
		static function onGetGroupMessage($Number, $From, $Author, $MsgID, $Type, $Time, $Name, $Message)
		{
			WhatsBot::Parse($Number, $From, $MsgID, $Type, $Time, $Name, $Message, $Author);
		}
		
		private function Parse($Number, $From, $MsgID, $Type, $Time, $Name, $Message, $Author = null)
		{
			if(WhatsBot::$ToByPass == null)
			{
				$Splited = explode(' ', $Message);
				
				if(strtolower($Splited[0]) == '!ibot')
				{
					if(isset($Splited[1]))
					{
						switch(strtolower($Splited[1]))
						{
							case 'bypass':
								if(in_array($From, WhatsBot::$Admins))
								{
									if(isset($Splited[2]))
									{
										WhatsBot::$FromByPass = $From;
										WhatsBot::W()->sendMessage($From, 'ByPass activado'); // Implementar que redireccione solo (o no) los mensajes de un o todos los usuarios
										WhatsBot::$ToByPass = $Splited[2];
									}
									else
									{
										WhatsBot::W()->sendMessage($From, 'Debes especificar el destino de la redireccion');
									}
								}
								else
								{
									WhatsBot::W()->sendMessage($From, 'No tienes los privilegios para ejecutar este comando');
								}
								break;
							default:
								WhatsBot::W()->sendMessage($From, 'Comando no reconocido');
								break;
						}
					}
					else
					{
						WhatsBot::W()->sendMessage($From, 'Ingresa un comando. Pon !ibot help para ver la lista de comandos disponibles');
					}
				}
				else
				{
					WhatsBot::W()->sendMessage($From, 'Ingresa un comando. Pon !ibot help para ver la lista de comandos disponibles');
				}
			}
			else
			{
				if($Message == '!ibot disable bypass')
				{
					WhatsBot::$FromByPass = null;
					WhatsBot::$ToByPass = null;
				}
				else
				{
					if(WhatsBot::$FromByPass == $From)
					{
						WhatsBot::W()->sendMessage(WhatsBot::$ToByPass, $Message);
					}
					else if(WhatsBot::$ToByPass == $From)
					{
						WhatsBot::W()->sendMessage(WhatsBot::$FromByPass, $Message);
					}
				}
			}
		}
	}
?>