<?php

require('WhatsBot.php');

interface iWhatsBot
{
	public function onGetMessage($Number, $From, $MsgID, $Type, $Time, $Name, $Message);
	public function onGetGroupMessage($Number, $From, $Author, $MsgID, $Type, $Time, $Name, $Message);
	public function onConnect();
}