<?php
function getIdForFolder($folder) {
	$folder = addslashes($folder);
	mysql_query("
		INSERT INTO `folders`(`folder`)
		SELECT * FROM (SELECT '$folder') AS tmp
		WHERE NOT EXISTS (
			SELECT id FROM `folders` WHERE `folder` = '$folder'
		) LIMIT 1;
	");
	$t1 = mysql_query("
		SELECT id FROM `folders` WHERE `folder` = '$folder'
	");
	echo mysql_error();
	$row = mysql_fetch_assoc($t1);
	if($row === false){
		return -1;
	}else{
		return $row['id'];
	}
}

function isRightUser($login, $password) {
	$login = addslashes($login);
	$md5 = md5($password."silil");
	$t1 = mysql_query("
		SELECT * FROM `users` 
		WHERE `login` = '$login'
	");
	$row = mysql_fetch_assoc($t1);

	if($row === false){
		mysql_query("
			INSERT 
			INTO `users`(`login`, `password`)
			VALUES ('$login', '$md5')
		");
		return true;
	}else{
		return $row['password'] == $md5;
	}
}

function getSubFolder($baseFolder, $folder) {
	$baseLen = strlen($baseFolder);
	$end = strpos($folder, "/", $baseLen);
	return substr($folder, $baseLen, $end - $baseLen);
	
}

function getSubFolders($folder) {
	$safeFolder = addslashes($folder);
	$t1 = mysql_query("
		SELECT `folder` 
		FROM `folders`
		WHERE `folder` LIKE '$safeFolder%'
	");
	$row = mysql_fetch_assoc($t1);
	$m = array();
	$s = 0;
	while ($row !== false) {
		$subFolder = $row['folder'];
		if ($subFolder != $folder) {
			$m[$s] = getSubFolder($folder, $subFolder);
			$s++;
		}
		$row = mysql_fetch_assoc($t1);
	}
	sort($m);
	return array_values(array_unique($m));
}

function removeFolder($folder) {
	$safeFolder = addslashes($folder);
	$t1 = mysql_query("
		DELETE FROM `folders`
		WHERE `folder` LIKE '$safeFolder%'
	");
}

function getAllMessages($folderId) {
	settype($folderId, 'integer');
	$t1 = mysql_query("
		SELECT * 
		FROM `messages`
		WHERE `folderId` = $folderId
		ORDER BY `id`
	");
	$row = mysql_fetch_assoc($t1);
	$m = array();
	$s = 0;
	while ($row !== false) {
		$m[$s] = $row;
		$s++;
		$row = mysql_fetch_assoc($t1);		
	}
	return $m;
}

function addMessage($folderId, $message) {
	settype($folderId, 'integer');
	$message = addslashes($message);
	$q = mysql_query("
		INSERT
		INTO `messages`(`folderId`, `message`)
		VALUES ($folderId, '$message')
	");
	echo mysql_error($q);
}

function removeMessage($folderId, $messageId) {
	settype($folderId, 'integer');
	settype($messageId, 'integer');
	mysql_query("
		DELETE FROM `messages`
		WHERE `id` = $messageId AND `folderId` = $folderId
	");
}

function createNewlogin($checkSum) {
	$checkSum = addslashes($checkSum);
	mysql_query("
	INSERT
	INTO `logins`(`checkSum`)
	VALUES ('$checkSum')  
	");
	
	$t1 = mysql_query("
		SELECT LAST_INSERT_ID() as k;
	");
	$row = mysql_fetch_assoc($t1);

	if($row === false){
		return -1;
	}else{
		return $row['k'];
	}
}

function createNewValue($loginId) {
	settype($loginId, 'integer');
	
	mysql_query("
	INSERT
	INTO `values`(`loginId`)
	VALUES ('$loginId')  
	");
	
	$t1 = mysql_query("
		SELECT LAST_INSERT_ID() as k;
	");
	$row = mysql_fetch_assoc($t1);
	return $row['k'];
}

function getValue($id) {
	settype($id, 'integer');

	$t1 = mysql_query("
		SELECT * 
		FROM `values`
		WHERE `id` = $id  
	");	
	$row = mysql_fetch_assoc($t1);
	if ($row === false) {
		return -1;
	} else {
		return array('loginId' => $row['loginId'], 'value' => $row['value'], 'name' => $row['name']);
	}
}

function getValues($loginId) {
	settype($loginId, 'integer');

	$t1 = mysql_query("
		SELECT * 
		FROM `values`
		WHERE `loginId` = $loginId 
		ORDER BY `id` 
	");	
	$row = mysql_fetch_assoc($t1);
	$m = array();
	$s = 0;
	while ($row !== false) {
		$m[$s] = $row;
		$row = mysql_fetch_assoc($t1);
		$s++;
	}
	return $m;
}

function setValue($id, $loginId, $value, $name) {
	settype($id, 'integer');
	settype($loginId, 'integer');
	$value = addslashes($value);
	$name = addslashes($name);
	$q = "
		UPDATE `values`
		SET `value` = '$value', `name` = '$name'
		WHERE `id` = $id AND `loginId` = $loginId
	";
	echo $q;
	mysql_query($q);
}



