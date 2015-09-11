<?php

/* Création d'un nouveau champ dans la base de données */

/* Créer ou charge la base de données choisie */

$db = new PDO('sqlite:../Bases/'.$_POST['BDDchoisie']);

$req = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");

/* Nom de la table */

$r = $req->fetch();
$table = $r[0];

$idEnCours = $_POST['idEnCours'];

/* Requête - Ajoute un champ à la base de données  */

$db->query('ALTER TABLE '.$table. ' ADD COLUMN ' . $_POST['nomchamp']. ' ' . $_POST['typechamp']);


/* Requête - Ajoute une valeur par défaut aux IDs qui précède l'ID actuel  */

for ($i=0; $i < $idEnCours; $i++) { 
	if($_POST['typechamp'] == "INTEGER" OR $_POST['typechamp'] == "REAL")
		$db->query('UPDATE ' . $table . ' SET ' . $_POST['nomchamp'] . ' = ' . $_POST['valeurParDefaut'] . ' WHERE id' .$table. " = " . $i);
	else
		$db->query("UPDATE " . $table . " SET " . $_POST['nomchamp'] . " = '" . $_POST['valeurParDefaut'] . "' WHERE id" .$table. " = " . $i);
}

?>