<?php 

		


		$tmp = explode($_POST['selectbase'], ".");
		$nomBase = $tmp[0];
		
		$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);

		$reqTable = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
		$r = $reqTable->fetch();
		$nomTable = $r[0];
		

		$nomChamps = $db->query("PRAGMA table_info(".$nomTable.")");
	
		$cleChamp = 0;
		while($n = $nomChamps->fetch(PDO::FETCH_BOTH)){
			$lesChamps[$cleChamp] = $n[1];
			$cleChamp += 1;
		}

		foreach($lesChamps as $unChamp){

			if($unChamp != "image".$nomTable){
				if($unChamp == "id".$nomTable){
					$reqVal = $db->query("SELECT ". $unChamp ." FROM ". $nomTable . " WHERE ". $lesChamps[0]. " = 0 ");
					$r = $reqVal->fetch();
					$idEnCours = $r[0];
				}
				else{
				    $retourTab.= "<p>";
				    $retourTab.= "<label for='" . $unChamp . "'>" . $unChamp . "</label>";
					$reqVal = $db->query("SELECT ". $unChamp ." FROM ". $nomTable . " WHERE ". $lesChamps[0]. " = 0 ");
					$r = $reqVal->fetch();
					if($r[0] == ""){
					$retourTab.= "<input id='" . $unChamp . "' value=''/>";
				    }
				    else{
				    	$retourTab.= "<input  id='" . $unChamp . "'' value='". $r[0]  . "'/>";
				    }
				    $retourTab.= "</p>";
				}
			}
			

		}

			

		echo $retourTab . "," . $idEnCours;
?>