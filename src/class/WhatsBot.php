<?php

// requerimientos
require_once('api/whatsprot.class.php');
require_once('api/class/Caller/iCaller.php');

	class WhatsBot
	{
		protected $Whatsapp = null;
		protected $ToByPass = null;
		protected $FromByPass = null;
		protected $Admins = array();
		
		
		public function __construct($N, $I, $P, $U = 'WhatsBot', $D = false)
		{
			try
			{
				
				$this->Whatsapp = new WhatsProt($N, $I, $U, $D);
				
				$this->Whatsapp->connect();
				$this->Whatsapp->loginWithPassword($P);

				// seteo nuestra instancia al llamador
				Caller::SetInstance($this);
				
				// bindeo al llamador
				$this->Whatsapp->eventManager()->bind('onGetMessage', 'Caller::onGetMessage');
				$this->Whatsapp->eventManager()->bind('onGetGroupMessage', 'Caller::onGetGroupMessage');

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
		
		public function onGetMessage($Number, $From, $MsgID, $Type, $Time, $Name, $Message)
		{
			$From = str_replace('@s.whatsapp.net', '', $From);
			WhatsBot->Parse($Number, $From, $MsgID, $Type, $Time, $Name, $Message);
		}
		public function onGetGroupMessage($Number, $From, $Author, $MsgID, $Type, $Time, $Name, $Message)
		{
			WhatsBot->Parse($Number, $From, $MsgID, $Type, $Time, $Name, $Message, $Author);
		}
		
		private function Parse($Number, $From, $MsgID, $Type, $Time, $Name, $Message, $Author = null)
		{
			if(WhatsBot->ToByPass == null)
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
										$this->FromByPass = $From;
										$this->sendMessage($From, 'ByPass activado'); // Implementar que redireccione solo (o no) los mensajes de un o todos los usuarios
										$this->$ToByPass = $Splited[2];
									}
									else
									{
										$this->sendMessage($From, 'Debes especificar el destino de la redireccion');
									}
								}
								else
								{
									$this->sendMessage($From, 'No tienes los privilegios para ejecutar este comando');
								}
								break;
							default:
								$this->sendMessage($From, 'Comando no reconocido');
								break;
						}
					}
					else
					{
						$this->sendMessage($From, 'Ingresa un comando. Pon !ibot help para ver la lista de comandos disponibles');
					}
				}
				else
				{
					$this->sendMessage($From, 'Ingresa un comando. Pon !ibot help para ver la lista de comandos disponibles');
				}
			}
			else
			{
				if($Message == '!ibot disable bypass')
				{
					$this->FromByPass = null;
					$this->ToByPass = null;
				}
				else
				{
					if($this->FromByPass == $From)
					{
						$this->sendMessage($this->$ToByPass, $Message);
					}
					else if($this->ToByPass == $From)
					{
						$this->sendMessage($this->$FromByPass, $Message);
					}
				}
			}
		}
	}
?>