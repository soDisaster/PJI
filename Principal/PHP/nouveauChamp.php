<?php

/* Création d'un nouveau champ dans la base de données */


/* Créer ou charge la base de données choisie */

$db = new PDO('sqlite:../Bases/'.$_POST['BDDchoisie']);


$req = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");

/* Nom de la table */

$r = $reqTable->fetch();
$table = $r[0];

/* Requête - Ajoute un champ à la base de données  */

$db->query('ALTER TABLE '.$table. ' ADD COLUMN ' . $_POST['nomchamp']. ' ' . $_POST['typechamp']);


?>