<?php

/* Permet de créer un fichier SQLite */

/* Créé ou charge la base de données choisie */

$db = new PDO('sqlite:../Bases/'. $_POST['newBDD'].'.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/* Par défaut création d'un champ idNomTable, imageTable et imageMiniatureTable.
Image affichée au centre 
Image miniature affichée dans la vue d'ensemble */

$db->exec("CREATE TABLE IF NOT EXISTS ". $_POST['newTable']."(
	id" . $_POST['newTable']." INTEGER PRIMARY KEY AUTOINCREMENT,
	image" . $_POST['newTable']. " BLOB,
	imageMin" . $_POST['newTable']. " BLOB)");


?>