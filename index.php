<?php
include "sql/sqlConnect.php";
include "sql/sql.php";
include "lib.php";

$rootFolder = "/";
$user = -1;
$folder = -1;

include "init.php";

if (!isset($_GET['url'])) {
	$_GET['url'] = 'aa';
}

echo "<pre>";
	$m = getSubFolders(normalize($_GET['url']));

echo "</pre>";




//echo getSubFolder("aa/", "aa/b/sfg/")."<br>";
echo getIdForFolder(normalize($_GET['url']));

if (isRightUser("sms2", "1%%^&234")) {
	echo "right";
} else {
	echo "bad";
}

//echo getIdForFolder($_GET['url']);
?>

<html>
	<body>
		<a href ="..">..</a>
	</body>
</html>
