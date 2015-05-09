<?php


	$db = new PDO('sqlite:../Bases/'.$_GET['selectbase']);
	$nomTable = $_GET['nomTable'];
	$id = $_GET['id'];

	$q = $db->query('SELECT imageMin'. $nomTable .' from '. $nomTable . " WHERE id". $nomTable . " = ". $id);
	header("Content-Type: image/jpg");
	echo $q->fetchColumn();


?>