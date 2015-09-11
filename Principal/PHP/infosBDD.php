<?php 

/* Affiche les éléments de la base de données un par un.
C'est à dire :
- L'image d'un élément 
- Les champs pour cette image et leur valeur */


/* Créer ou charge la base de données choisie */

$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);


/* Nom de la table */

$reqTable = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
$r = $reqTable->fetch();
$nomTable = $r[0];

/* Le nom de tous les champs */

$nomChamps = $db->query("PRAGMA table_info(".$nomTable.")");

while($n = $nomChamps->fetch(PDO::FETCH_BOTH)){
	$lesChamps[] = $n[1];
}

/* Si l'ID en cours est différent de -1  */

if($_POST['idEnCours'] != -1){
	$idEnCours =  $_POST['idEnCours'];
}

/* Si l'ID en cours est -1, (on ouvre la base pour la "première fois") on passe l'ID en cours à 0 */

else{
	$idEnCours = 0;
}

foreach($lesChamps as $unChamp){

	/* Si le champ correspond à imageNomTable
	On créé une balise image. 
	Dans cette balise on appelle le fichier afficherImageBDD avec les paramètres nécessaires :
	le nom de la table et l'id de l'image que l'on doit afficher dans cette table
	 */ 

	if($unChamp == "image".$nomTable){
		$img = "<img src='afficherImageBDD.php?selectbase=". $_POST['selectbase']. "&nomTable=". $nomTable . "&id=". $idEnCours."'/>";
	}

	/* Si le nom du champ ne correspond ni à l'IdNomTable, ni aux noms des champs contenant les miniatures d'images.
	  On affiche le nom du champ et les champs éditables qui contiendront les valeurs des champs.
	  */

	if($unChamp != "id". $nomTable && $unChamp != "image". $nomTable && $unChamp != "imageMin". $nomTable){

		/* Le nom du champ dans une balise label */

		$retourTab.= "<tr>";
		$retourTab.= "<td>";
		$retourTab.= "<label for='" . $unChamp . "'>" . $unChamp . "</label>";
		$retourTab.= "</td>";

		/*  Récupère la valeur du champ traité dans la boucle */

		$reqVal = $db->query("SELECT ". $unChamp ." FROM ". $nomTable . " WHERE id". $nomTable . " = ". $idEnCours . "");	
		$r = $reqVal->fetch();

		/*  Champ éditable pour la valeur du champ */

		$retourTab.= "<td>";
		$retourTab.= "<input class='inputBDD' type='text' id='" . $unChamp . "'' value='". $r[0]  . "'/>";
		$retourTab.= "</td>";


		/*  Checkbox */


		$retourTab.= "<td>";
		$retourTab.= "<input type='checkbox' name='". $unChamp ."' id='checkbox" . $unChamp . "'/>";
		$retourTab.= "</td>";

		$retourTab.= "</tr>";

	}
}

/* On retourne les variables
- $retourTab qui contient les éléments à afficher
- $img l'image de l'élément à afficher
- $idEnCours permet de mettre l'ID à jour.

Elles seront traitées dans la fonction success de la requête ajax */

echo $retourTab .",". $img .",". $idEnCours;


?>