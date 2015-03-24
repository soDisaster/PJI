<?php


	$db = new PDO('sqlite:../Bases/'.$_POST['BDDchoisie']);
	$req = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
	while ($r = $req->fetch()){
		$table = ($r[0]);
	}
				
	$db->query('ALTER TABLE '.$table. ' ADD COLUMN ' . $_POST['nomchamp']. ' ' . $_POST['typechamp']);

?>