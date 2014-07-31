<?php

// cargamos la configuracion
$config = get_object_vars(json_decode(file_get_contents('config.json')));

// seteamos configuracion base
$config = array(
				'Number' => $config['Number'],
				'Identity' => '',
				'Password' => '',
				'Nickname' => 'WhatsBot',
				'DevMode' => false);

// creamos la instancia
$bot = new WhatsBot($config['Number'], $config['Identity'], $config['Password'], $config['Nickname'], $config['DevMode']);

// enviamos codigo al celular
$bot->codeRequest('AR');

// solicitamos que ingrese el code
StdIO::ShowQuestion('Ingrese el codigo enviado al celular');
$line = StdIO::InputLine();

// password
$obj = $bot->codeRegister($line);
$config['Password'] = $obj->pw;

// generamos el identity
$config['Identity'] =  generateIdentity($config['Number'],$config['Password']);

StdIO::ShowMessage('Guardando configuracion');
file_put_contents('config.json', json_encode($config));