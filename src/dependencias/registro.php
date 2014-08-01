<?php

function generateIdentity($number, $salt)
{
	return strrev($number.$salt);
}