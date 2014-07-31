<?php

// requerimos whatsbot
require('class/iWhatsBot.php');

ErrorCache::Show('---> WhatsBot Remake by Alexander171294 <--');
ErrorCache::ShowMessage('[I]niciar bot');
ErrorCache::ShowMessage('[R]egistrar Whatsapp');
ErrorCache::ShowMessage('[S]etear numero de telefono');
ErrorCache::ShowMessage('[H]elp');
ErrorCache::ShowQuestion('Por favor seleccione una opcion');
$option = ErrorCache::InputLine();