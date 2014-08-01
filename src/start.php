<?php

$exit = false;
// cargamos la configuracion
$cbot = get_object_vars(json_decode(file_get_contents('bot.json')));
// requerimos whatsbot
require('class/MiBot/aMiBot.php');
require('class/iWhatsBot.php');
require('dependencias/registro.php');
require('dependencias/checker.php');
require($cbot['BotMain']);

while(!$exit)
{
	StdIO::Show(']-------------------(*)-------------------[');
	StdIO::Show('---> WhatsBot Remake by Alexander171294 <--');
	StdIO::ShowMessage('[I]niciar bot');
	StdIO::ShowMessage('[S]etear numero de telefono');
	StdIO::ShowMessage('[R]egistrar Whatsapp');
	StdIO::ShowMessage('[C]heckear Whatsapp existente');
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
	if(strtolower($option)=='c')
		include('checker.php');
	if(strtolower($option)=='e')
		$exit = true;
}