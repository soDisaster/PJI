<?php 

/* Mettre à jour les champs de la base de données
à chaque perte de focus des champ éditables représentant les valeurs des champs */


/* Créer ou charge la base de données choisie */

$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);

/* Nom de la table */

$req = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
$r = $req->fetch();
$nomTable = $r[0];

/* Si la nouvelle valeur n'est pas vide, on met à jour la valeur du champ avec la nouvelle valeur  */

if($_POST['valeurChamp'] != ""){
	$db->query("UPDATE ".$nomTable. " SET " . $_POST['nomChamp']. " = '" . $_POST['valeurChamp'] . "' WHERE id" .$nomTable. " = ".  $_POST['idEnCours']);
}

/* Si elle est vide, on met la valeur à nulle, cela évite d'avoir des valeurs vides et nulles */

else{
	$db->query("UPDATE ".$nomTable. " SET " . $_POST['nomChamp']. " = NULL WHERE id" .$nomTable. " = ".  $_POST['idEnCours']);
}

/* Récupère le nom des champs de la table */

$nomChamps = $db->query("PRAGMA table_info(".$nomTable.")");
while($n = $nomChamps->fetch(PDO::FETCH_BOTH)){
	$lesChamps[] = $n[1];
}

$tmp = "ok";

/* On vérifie pour chaque champ de cet élément si la valeur de ce champ est nulle.
Si une seule des valeurs est nulle, on passe la variable tmp à non.
Les bords de la miniature dans la vue d'ensemble seront rouges.
Sinon la valeur de chaque champ de l'élément est complète et il n'y a donc pas de bords autour de la miniature de l'élément */

foreach ($lesChamps as $unChamp) {
	
	$req = $db->query("SELECT ". $unChamp . " FROM ". $nomTable . " WHERE id".$nomTable. " = " . $_POST['idEnCours'] . " AND " . $unChamp . " IS NULL");
	if($req->fetch() != ""){
		$tmp = "non";
	}
}

/* On retourne la valeur de tmp qui sera traitée dans la fonction success de la requête ajax */

echo $tmp;


?>