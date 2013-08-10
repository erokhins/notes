<?php
include "sql/sqlConnect.php";
include "sql/sql.php";
include "lib.php";

if (isset($_POST['url'])) {
	$_GET['url'] = $_POST['url'];
}
include "init.php";

if (isset($_POST['new_message'])) {
	addMessage($folderId, $_POST['new_message']);
	echo "$folderId <br>";
	print_r($_POST);
}

refer($rootFolder.$folder);
