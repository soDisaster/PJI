<?php


	$db = new PDO('sqlite:../Bases/'.$_POST['base']);
	$nomTable = $_POST['nomTable']

	header("content-type: image/bmp");


	$q = $dbh->query('SELECT img'. $nomTable .'  from image '. $nomTable);
	header("Content-Type: image/bmp");
	echo $q->fetchColumn();

?>