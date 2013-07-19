<?php

if (isset($_POST['login']) && isset($_POST['password'])) { // login user or create, if nesesary 
	if (isRightUser($_POST['login'], $_POST['password'])) {
		setcookie("notes_login", $_POST['login'], time() + 60*60*24*300);
		setcookie("notes_hash", md5($_POST['login']."ttiiit"), time() + 60*60*24*300);
		$login = $_POST['login'];
		refer($rootFolder.'/'.$login);
	} else {
		refer($rootFolder."?error");
	}
} 

if (isset($_COOKIE['notes_login']) && isset($_COOKIE['notes_hash'])) {
	if (md5($_POST['login']."ttiiit") == $_COOKIE['notes_hash']) {
		$login = $_COOKIE['notes_login'];
		if (!isset($_GET['url'])) {
			refer($rootFolder.'/'.$login);
		} else {
			$folder = normalize($_GET['url']);
			if (getUserName($folder) !== $login) {
				refer($rootFolder);
			}
		}
	} else {
		refer($rootFolder);
	}
} else {
	refer($rootFolder);		
}
