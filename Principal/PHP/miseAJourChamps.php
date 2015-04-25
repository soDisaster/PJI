<?php 


	$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);
	$req = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
	$r = $req->fetch();
	$nomTable = $r[0];
	$db->query("UPDATE ".$nomTable. " SET " . $_POST['nomChamp']. "='" . $_POST['valeurChamp'] . "' WHERE id" .$nomTable. " = ".  $_POST['idEnCours']);


?>