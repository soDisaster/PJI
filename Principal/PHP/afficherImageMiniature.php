<?php

/* Permet d'afficher les miniatures de l'image */

/* Créer ou charge la base de données choisie */

$db = new PDO('sqlite:../Bases/'.$_GET['selectbase']);
$nomTable = $_GET['nomTable'];
$id = $_GET['id'];

/* Requetes - Selectionne images miniatures  */

$q = $db->query('SELECT imageMin'. $nomTable .' from '. $nomTable . " WHERE id". $nomTable . " = ". $id);
header("Content-Type: image/jpg");

/* Affiche la miniature */ 
echo $q->fetchColumn();


?>