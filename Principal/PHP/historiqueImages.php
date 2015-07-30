<?php

/* Récupérer les id des images où au moins un des champs est nul */

/* Créer ou charge la base de données choisie */

$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);

/* Nom de la table */

$reqTable = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
$r = $reqTable->fetch();
$nomTable = $r[0];

/* Noms des champs */

$nomChamps = $db->query("PRAGMA table_info(".$nomTable.")");		
while($n = $nomChamps->fetch(PDO::FETCH_BOTH)){
	$lesChamps[] = $n[1];
} 

/* Requête - IDs dont la valeur d'un champ est nulle */

foreach($lesChamps as $unChamp){
	$reqID = $db->query("SELECT DISTINCT id" . $nomTable . " FROM ". $nomTable . " WHERE ". $unChamp. " IS NULL");
	while($n = $reqID->fetch(PDO::FETCH_BOTH)){
		$tabID.= $n[0] . ",";
	}
}
echo $tabID;


?>