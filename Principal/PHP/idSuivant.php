<?php 

/* Permet de passer à l'élement suivant de la base de données */ 

$retourTab;

$tmp = explode($_POST['selectbase'], ".");

/* Créer ou charge la base de données choisie */

$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);

/* Nom de la table */ 

$reqTable = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
$r = $reqTable->fetch();
$nomTable = $r[0];

/* Le nom des champs */

$nomChamps = $db->query("PRAGMA table_info(".$nomTable.")");

$cleChamp = 0;
while($n = $nomChamps->fetch(PDO::FETCH_BOTH)){
	$lesChamps[$cleChamp] = $n[1];
	$cleChamp += 1;
}

/* On passe à l'ID suivant */

$id = $_POST['idEnCours'] + 1;

$dernierIdTmp = $db->query("SELECT ". $lesChamps[0] ." FROM ". $nomTable);
while($d = $dernierIdTmp->fetch(PDO::FETCH_BOTH)){
	$dernierId = $d[0];
}
if($id > $dernierId)
	$id = 0;

/* Pour chaque champ de la table */ 

foreach($lesChamps as $unChamp){

	if($unChamp != "image".$nomTable && $unChamp != "imageMin".$nomTable){

		if($unChamp == "id".$nomTable){
			$reqVal = $db->query("SELECT ". $unChamp ." FROM ". $nomTable . " WHERE ". $lesChamps[0]." = ". $id ."");
			$r = $reqVal->fetch();
			$idEnCours = $r[0];
		}
		else{

			$retourTab.= "<tr>";

			/* Le nom du champ dans une balise label */

			$retourTab.= "<td><label for='" . $unChamp . "'>" . $unChamp . "</label></td>";

			/*  Récupère la valeur du champ traité dans la boucle */


			$reqVal = $db->query("SELECT ". $unChamp ." FROM ". $nomTable . " WHERE ". $lesChamps[0]. " = ". $id . "");		
			$r = $reqVal->fetch();

			/*  Champ éditable pour la valeur du champ */

			$retourTab.= "<td><input class='inputBDD' type='text' id='" . $unChamp . "'' value='". $r[0]  . "'/></td>";

			/*  Checkbox */

			$retourTab.= "<td><input name='" . $unChamp . "' type='checkbox' id='checkbox" . $unChamp . "'/></td>";
			$retourTab.= "</tr>";
		}

	}

	/* Si le champ correspond à imageNomTable
	On créé une balise image. 
	Dans cette balise on appelle le fichier afficherImageBDD avec les paramètres nécessaires :
	le nom de la table et l'id de l'image que l'on doit afficher dans cette table
	 */ 

	if($unChamp == "image".$nomTable){
		
		$img = "<img src='afficherImageBDD.php?selectbase=". $_POST['selectbase']. "&nomTable=". $nomTable . "&id=". $id ."'/>";
	}



}

/* On retourne les variables
- $retourTab qui contient les éléments à afficher
- $img l'image de l'élément à afficher
- $idEnCours permet de mettre l'ID à jour.

Elles seront traitées dans la fonction success de la requête ajax */


echo $retourTab .",". $img .",". $idEnCours;
?>