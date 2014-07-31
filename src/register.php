<?php

// requerimos whatsbot
require('class/iWhatsBot.php');

// cargamos la configuracion
$config = get_object_vars(json_decode(file_get_contents('config.json')));

// seteamos configuracion base
$config = array(
				'Identity' => '',
				'Password' => 'AFBOT4650',
				'Nickname' => 'WhatsBot',
				'DevMode' => false);

// creamos la instancia
$bot = new WhatsBot($config['Number'], $config['Identity'], $config['Password'], $config['Nickname'], $config['DevMode']);

// enviamos codigo al celular
$bot->codeRequest();

// solicitamos que ingrese el code
ErrorCache::ShowQuestion('Ingrese el codigo enviado al celular');
$line = trim(fgets(STDIN));

$bot->codeRegister($line);
$config['Identity'] = $line;

ErrorCache::ShowMessage('Guardando configuracion');
file_put_contents('config.json', json_encode($config));