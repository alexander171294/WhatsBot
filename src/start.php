<?php

$exit = false;
// requerimos whatsbot
require('class/MiBot/aMiBot.php');
require('class/iWhatsBot.php');
require('dependencias/registro.php');

while(!$exit)
{
	StdIO::Show(']-------------------(*)-------------------[');
	StdIO::Show('---> WhatsBot Remake by Alexander171294 <--');
	StdIO::ShowMessage('[I]niciar bot');
	StdIO::ShowMessage('[R]egistrar Whatsapp');
	StdIO::ShowMessage('[S]etear numero de telefono');
	StdIO::ShowMessage('[H]elp');
	StdIO::ShowMessage('[E]xit');
	StdIO::ShowQuestion('Por favor seleccione una opcion');
	$option = StdIO::InputLine();

	if(strtolower($option)=='i')
		include('bot.php');
	if(strtolower($option)=='r')
		include('register.php');
	if(strtolower($option)=='s')
		include('setter.php');
	if(strtolower($option)=='h')
		include('help.php');
	if(strtolower($option)=='e')
		$exit = true;
}