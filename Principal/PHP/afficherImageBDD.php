<?php


	$db = new PDO('sqlite:../Bases/'.$_GET['base']);
	$nomTable = $_GET['nomTable'];
	if($id = $_GET['id'] == 'NULL'){
		$id = 0;
	}
	else
		$id = $_GET['id'];


	$q = $db->query('SELECT image'. $nomTable .' from '. $nomTable . " WHERE id". $nomTable . " = ". $id);
	header("Content-Type: image/jpg");
	echo $q->fetchColumn();
	

?>