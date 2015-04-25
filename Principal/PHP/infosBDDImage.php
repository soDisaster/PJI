<?php 

		
		$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);

		$reqTable = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
		$r = $reqTable->fetch();
		$nomTable = $r[0];
		echo "<img src='afficherImageBDD.php?base=". $_POST['selectbase']. "&nomTable=". $nomTable ."&id=0'/>";
		//echo ("<img src='http://didoune.fr/blog/wp-content/uploads/2009/07/herissoneau1.jpg'/>");
		
?>