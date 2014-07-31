<?php

function generateIdentity($number, $salt)
{
	return strtolower(sha1(strrev($number.$salt),true));
}