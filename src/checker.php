<?php

$mibot = new $cbot['ClassName']();

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

// seteamos la instancia del controlador del bot
$bot->set_mibot($mibot);

// creamos identify
$id = urlencode(sha1(generateIdentity($config['Number'], null),true));

$pw = get_pw($config['Number'],$id, 'US');

var_dump($pw);