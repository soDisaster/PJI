<?php


	$db = new PDO('sqlite:../Bases/'.$_POST['BDDchoisie']);
	$req = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
	while ($r = $req->fetch()){
		$table = ($r[0]);
	}
				
	$db->query('ALTER TABLE '.$table. ' ADD COLUMN ' . $_POST['nomchamp']. ' ' . $_POST['typechamp']);

	$retourTab = "<label for='checkbox" . $_POST['nomchamp'] . "'>" . $_POST['nomchamp'] . "</label>";				
	$retourTab.= "<input  id='" . $_POST['nomchamp'] . "' value=''/>";		    	
	$retourTab.= "<input  type='checkbox' name='". $_POST['nomchamp'] ."' id='checkbox" . $_POST['nomchamp'] . "'/>";
	$retourTab.= "</br>";
	echo $retourTab;
				   

?>