<?php

$mibot = new $cbot['ClassName']();

// cargamos la configuracion
$config = get_object_vars(json_decode(file_get_contents('config.json')));

// creamos la instancia
$bot = new WhatsBot($config['Number'], $config['Identity'], $config['Password'], $config['Nickname'], $config['DevMode']);

// seteamos la instancia del controlador del bot
$bot->set_mibot($mibot);

// conectamos 
$bot->connect();

// logueamos
$bot->loginPasswd();

// iniciamos el bucle
$bot->start();
