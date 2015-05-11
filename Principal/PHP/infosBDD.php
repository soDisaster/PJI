<?php 


$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);

$reqTable = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
$r = $reqTable->fetch();
$nomTable = $r[0];



$nomChamps = $db->query("PRAGMA table_info(".$nomTable.")");

while($n = $nomChamps->fetch(PDO::FETCH_BOTH)){
	$lesChamps[] = $n[1];
}

if($_POST['idEnCours'] != -1){
	$idEnCours =  $_POST['idEnCours'];
}
else{
	$idEnCours = 0;
}
foreach($lesChamps as $unChamp){

	if($unChamp == "image".$nomTable){

		$img = "<img src='afficherImageBDD.php?selectbase=". $_POST['selectbase']. "&nomTable=". $nomTable . "&id=". $idEnCours."'/>";
	}
	

	if($unChamp != "id". $nomTable && $unChamp != "image". $nomTable && $unChamp != "imageMin". $nomTable){


		$retourTab.= "<p>";
		$retourTab.= "<label for='" . $unChamp . "'>" . $unChamp . "</label>";
		$reqVal = $db->query("SELECT ". $unChamp ." FROM ". $nomTable . " WHERE id". $nomTable . " = ". $idEnCours . "");	
		$r = $reqVal->fetch();
		$retourTab.= "<input class='inputBDD' type='text' id='" . $unChamp . "'' value='". $r[0]  . "'/>";
		if(in_array($unChamp, $lesChampsChecks)){
			$retourTab.= "<input type='checkbox' name='". $unChamp ."' id='checkbox" . $unChamp . "' checked/>";
		}
		else{
			$retourTab.= "<input type='checkbox' name='". $unChamp ."' id='checkbox" . $unChamp . "'/>";
		}
		$retourTab.= "</p>";

	}
}

echo $retourTab .",". $img .",". $idEnCours;
?>