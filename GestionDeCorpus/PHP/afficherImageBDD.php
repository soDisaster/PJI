<?php

/*
Permet d'afficher l'image d'un élément de la base.
L'affichage est géré dans un fichier séparé sinon l'image est interprétée et est affichée avec des caractères spéciaux.
*/

/* Créer ou charge la base de données choisie */

$db = new PDO('sqlite:../Bases/'.$_GET['selectbase']);

/* Nom de la table de cette base de données */

$nomTable = $_GET['nomTable'];

/* Identifiant en cours */

$id = $_GET['id'];

/* Requête permettant de sélectionner l'image voulue dans la base de données */

$q = $db->query('SELECT image'. $nomTable .' from '. $nomTable . " WHERE id". $nomTable . " = ". $id);

/* Précise que c'est une image */

header("Content-Type: image/jpg");

/* Affiche l'image */

echo $q->fetchColumn();

?>