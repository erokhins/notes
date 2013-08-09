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
	echo "refer: $link<br>";
	//header("Location: $link");	
	//die();
}

function getParentFolder($folder) {
	$pos = str_split($folder, '/');
	print_r($pos);
}
