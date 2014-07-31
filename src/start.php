<?php

// requerimos whatsbot
require('class/iWhatsBot.php');

StdIO::Show('---> WhatsBot Remake by Alexander171294 <--');
StdIO::ShowMessage('[I]niciar bot');
StdIO::ShowMessage('[R]egistrar Whatsapp');
StdIO::ShowMessage('[S]etear numero de telefono');
StdIO::ShowMessage('[H]elp');
StdIO::ShowQuestion('Por favor seleccione una opcion');
$option = StdIO::InputLine();