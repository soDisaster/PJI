<?php


	//$db = $_POST['BDDchoisie']);
	$db = new PDO('sqlite:../Bases/'.$_POST['BDDchoisie']);
	$tmp = array();
	$tmp = explode(".", $_POST['BDDchoisie']);
	$nom = $tmp[0];
	$table = $db->query("SELECT * FROM sqlite_master WHERE type='table'");
	var_dump($table);
	//echo 'ALTER TABLE '.$table. ' ADD COLUMN ' . $_POST['nomchamp']. ' ' . $_POST['typechamp'];

?>