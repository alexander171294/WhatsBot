<?php

function generateIdentity($number, $salt)
{
	return strtolower(urlencode(sha1(strrev($number.$salt),true)));
}