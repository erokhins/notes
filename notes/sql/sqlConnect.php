<?php
//Только открытие базы данных(чтобы файл хранился на серваке и не мешал)

$rootFolder = "/notes/";
$sil = "sdgsdgs";
$sqlsmv = mysql_connect( "localhost", "root","239239239");
mysql_select_db('notes');

mysql_query("SET NAMES utf8");

