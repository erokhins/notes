<?php

function normalize($str) {
	if ($str[strlen($str) - 1] != '/') {
		return $str.'/';
	} else {
		return $str;
	}
}

function getUserName($str) {
	$first = strpos($str, '/');
	return substr($str, 0, $first);
}

function refer($link) {
	echo "refer: <a href = '$link'>$link</a><br>";
	header("Location: $link");	
	die();
}

function getParentFolder($folder) {
	$ar = explode('/', $folder);
	$pos = strlen($folder) - strlen($ar[sizeof($ar)-2]) - 1;
	return substr($folder, 0, $pos);
}
