<?php

function get_pw($number, $identity, $cc='AR')
{
	return file_get_contents('https://v.whatsapp.net/v2/exist?cc=54&in='.$number.'&id='.$identity);
}