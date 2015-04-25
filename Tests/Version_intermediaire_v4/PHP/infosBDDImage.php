<?php 


		$retourTab;

		$tmp = explode($_POST['selectbase'], ".");
		$nomBase = $tmp[0];
		
		$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);

		$reqTable = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
		$r = $reqTable->fetch();
		$nomTable = $r[0];
		

		$nomChamps = $db->query("PRAGMA table_info(".$nomTable.")");
	

		$q = $db->query("SELECT image" . $nomTable . " FROM ". $nomTable);
		//echo "<img src='afficherImageBDD.php?base=". $db. "&nomTable=". $nomTable . " alt='test'/>";
	
	
?>