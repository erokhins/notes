<?
function createNewUser($checkSum) {
	$checkSum = addslashes($checkSum);
	mysql_query("
	INSERT
	INTO `users`(`checkSum`)
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

function createNewValue($userId) {
	settype($userId, 'integer');
	
	mysql_query("
	INSERT
	INTO `values`(`userId`)
	VALUES ('$userId')  
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
		return array('userId' => $row['userId'], 'value' => $row['value'], 'name' => $row['name']);
	}
}

function getValues($userId) {
	settype($userId, 'integer');

	$t1 = mysql_query("
		SELECT * 
		FROM `values`
		WHERE `userId` = $userId 
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

function setValue($id, $userId, $value, $name) {
	settype($id, 'integer');
	settype($userId, 'integer');
	$value = addslashes($value);
	$name = addslashes($name);
	$q = "
		UPDATE `values`
		SET `value` = '$value', `name` = '$name'
		WHERE `id` = $id AND `userId` = $userId
	";
	echo $q;
	mysql_query($q);
}


function getCheck($id) {
	global $sil;
	return md5($id . $sil);
}

function refer($link) {
	echo "refer: $link";
	header("Location: $link");	
	die();
}
?>
