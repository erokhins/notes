<?php
include "sql/sqlConnect.php";
include "sql/sql.php";
include "lib.php";

$login = -1;
$folder = -1;
$folderId = -1;

if (!isset($_GET['url'])) {
	include "templ/login_html.php";
} else {
	include "init.php";
	if (isset($_GET['rm'])) {
		removeFolder($folder);
		refer($rootFolder.getParentFolder($folder));
	}
	
	include "templ/messages_html.php";
	echo $login."<br>";
	echo $folder."<br>";
	echo $folderId;
}
