<?php

StdIO::showQuestion('Ingrese numero Telefonico');
StdIO::showMessage('ej: 5491100000000');
$out['Number'] = StdIO::InputLine();
file_put_contents('config.json', json_encode($out));
StdIO::showMessage('Configuracion guardada con exito');