<?php 

	$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);

	$reqTable = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
	$r = $reqTable->fetch();
	$nomTable = $r[0];

	$reqTable = $db->query("SELECT * FROM " .$nomTable. " WHERE id". $nomTable . " = " . $_POST['idEnCours']);
	while($r = $reqTable->fetch()){
			echo $r[0];
	}





?>

