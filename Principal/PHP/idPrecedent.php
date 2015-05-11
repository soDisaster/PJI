<?php 

		$retourTab;

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

		$id = $_POST['idEnCours'] - 1;
		$dernierIdTmp = $db->query("SELECT ". $lesChamps[0] ." FROM ". $nomTable);
		$d = $dernierIdTmp->fetch(PDO::FETCH_BOTH);
		$premierId = $d[0];
		while($d = $dernierIdTmp->fetch(PDO::FETCH_BOTH)){
			$dernierId = $d[0];
		}
		if($id < $premierId)
			$id = $dernierId;
		

		foreach($lesChamps as $unChamp){

			if($unChamp != "image".$nomTable && $unChamp != "imageMin".$nomTable){

				if($unChamp == "id".$nomTable){
					$reqVal = $db->query("SELECT ". $unChamp ." FROM ". $nomTable . " WHERE ". $lesChamps[0]. " = ". $id);
					$r = $reqVal->fetch();
					$idEnCours = $r[0];
			    }
			    else{
					$retourTab.= "<p> ";
					$retourTab.= "<label for='" . $unChamp . "'>" . $unChamp . "</label>";
					$reqVal = $db->query("SELECT ". $unChamp ." FROM ". $nomTable . " WHERE ". $lesChamps[0]. " = ". $id . "");		
					$r = $reqVal->fetch();
					$retourTab.= "<input class='inputBDD' type='text' id='" . $unChamp . "'' value='". $r[0]  . "'/>";
					$retourTab.= "<input name='" . $unChamp . "' type='checkbox' id='checkbox" . $unChamp . "'/>";
				 $retourTab.= "</p>";
				}

			}
			
			
			if($unChamp == "image".$nomTable){
				
				$img = "<img src='afficherImageBDD.php?selectbase=". $_POST['selectbase']. "&nomTable=". $nomTable . "&id=". $id ."'/>";
			}

			
		}
	

		echo $retourTab .",". $img .",". $idEnCours;
?>