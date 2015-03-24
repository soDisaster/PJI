<?php 


		$tmp = explode($_POST['selectbase'], ".");
		$nomBase = $tmp[0];

		$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);

		$reqTable = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
		while ($r = $reqTable->fetch()){
			$nomTable = ($r[0]);
		}

		$nomChamps = $db->query("PRAGMA table_info(".$nomTable.")");

		if($reqVal = $db->query("SELECT * FROM ". $nomTable)){
			
			$colcount = $reqVal->columnCount();


			while ($r = $reqVal->fetch(PDO::FETCH_BOTH)){
				for ($i = 0; $i <= $colcount ; $i++) {
					print_r($r[$i]);
					print("<br/>");
				}
			}
			while ($r = $nomChamps->fetch(PDO::FETCH_BOTH)){
					print_r($r[1]);
					print("<br/>");
			}
		}
?>