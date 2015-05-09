<?php


		$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);

		$reqTable = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
		$r = $reqTable->fetch();
		$nomTable = $r[0];

		$reqHistorique = $db->query("SELECT id". $nomTable . " FROM " .$nomTable);
		while($r = $reqHistorique->fetch(PDO::FETCH_BOTH)){
			echo "<img id='miniature" . $r[0] . "' class='miniatures' src='afficherImageMiniature.php?selectbase=". $_POST['selectbase']. "&nomTable=". $nomTable . "&id=". $r[0] ."'/>";
		}

?>