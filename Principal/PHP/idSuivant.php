<?php 
		
		$retourTab;

		$tmp = explode($_POST['selectbase'], ".");
		
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
		
		$id = $_POST['idEnCours'] + 1;
		$dernierIdTmp = $db->query("SELECT ". $lesChamps[0] ." FROM ". $nomTable);
		while($d = $dernierIdTmp->fetch(PDO::FETCH_BOTH)){
			$dernierId = $d[0];
		}
		if($id > $dernierId)
			$id = 0;

		foreach($lesChamps as $unChamp){

			if($unChamp != "image".$nomTable){
				if($unChamp == "id".$nomTable){
					$reqVal = $db->query("SELECT ". $unChamp ." FROM ". $nomTable . " WHERE ". $lesChamps[0]." = ". $id ."");
					$r = $reqVal->fetch();
					$idEnCours = $r[0];
				}
				else{
					$retourTab.= "<p> ";
					$retourTab.= "<label for='" . $unChamp . "'>" . $unChamp . "</label>";
					$reqVal = $db->query("SELECT ". $unChamp ." FROM ". $nomTable . " WHERE ". $lesChamps[0]. " = ". $id ."");		
					$r = $reqVal->fetch();
					$retourTab.= "<input type='text' id='" . $unChamp . "'' value='". $r[0]  . "'/>";
					$retourTab.= "</p>";
				}	


			}
			
			if($unChamp == "image".$nomTable){
		
				$img = "<img src='afficherImageBDD.php?base=". $_POST['selectbase']. "&nomTable=". $nomTable . "&id=". $id ."'/>";
			}
			
		}
	

			

		echo $retourTab .",". $img .",". $idEnCours;
?>