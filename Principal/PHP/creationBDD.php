<?php


$db = new PDO('sqlite:../Bases/'. $_POST['newBDD'].'.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("CREATE TABLE IF NOT EXISTS ". $_POST['newTable']."(
	id" . $_POST['newTable']." INTEGER PRIMARY KEY AUTOINCREMENT,
	image" . $_POST['newTable']. " BLOB,
	imageMin" . $_POST['newTable']. " BLOB)");


?>