<?php

/* Gère la vue d'ensemble 
Affichage des miniatures dans la vue d'ensemble. */

/* Créer ou charge la base de données choisie */

$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);

/* Nom de la table */

$reqTable = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
$r = $reqTable->fetch();
$nomTable = $r[0];

$reqHistorique = $db->query("SELECT id". $nomTable . " FROM " .$nomTable);
while($r = $reqHistorique->fetch(PDO::FETCH_BOTH)){
	/* Affichage des images miniatures dans les balises <img> 
	Lancement du fichier afficherImageMiniature.php  avec paramètres : table et id */
	echo "<img class='miniatures' id='miniature" . $r[0] . "' src='afficherImageMiniature.php?selectbase=". $_POST['selectbase']. "&nomTable=". $nomTable . "&id=". $r[0] ."'/>";
}

?>