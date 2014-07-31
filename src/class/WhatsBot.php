<?php

// requerimientos
require('AbstractWhatsBot.php');

class WhatsBot extends aWhatsBot implements iWhatsBot
{
	public function onGetMessage($Number, $From, $MsgID, $Type, $Time, $Name, $Message)
	{
		// quitamos la basura del from
		$From = str_replace('@s.whatsapp.net', '', $From);
	}
	
	public function onGetGroupMessage($Number, $From, $Author, $MsgID, $Type, $Time, $Name, $Message)
	{
		
	}

	public function onConnect()
	{
		echo 'Connected and hello world :)'
	}
}

?>