<?php 

		$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);
		$champs = $db->query("PRAGMA table_info(chatons)");

		if($req = $db->query("SELECT * FROM chatons")){
		
			$colcount = $req->columnCount();
			while ($r = $req->fetch(PDO::FETCH_BOTH)){
				for ($i = 0; $i <= $colcount ; $i++) {
					print_r($r[$i]);
					print("<br/>");
				}
			}
			while ($r = $champs->fetch(PDO::FETCH_BOTH)){
					print_r($r[1]);
					print("<br/>");
			}
		}
?>