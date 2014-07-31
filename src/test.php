<?php

require('class/iWhatsBot.php');

// cargar luego desde json
$config = array(
				'Number' => '2494309105',
				'Identity' => '',
				'Password' => '',
				'Nickname' => 'WhatsBot',
				'DevMode' => false);

// creamos la instancia
$bot = new WhatsBot($config['Number'], $config['Identity'], $config['Password'], $config['Nickname'], $config['DevMode']);

// conectamos 
$bot->connect();

// logueamos
$bot->loginPassowd();

// iniciamos el bucle
$bot->start();
