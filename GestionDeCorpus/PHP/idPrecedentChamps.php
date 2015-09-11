<?php 

/* Chaque champ est associé à une checkbox. En cochant une ou plusieurs checkboxs et en utilisant
   ces flèches l'utilisateur passera à l'élément précédent dont l'un des champs cochés
   à une valeur nulle. */

/* Créer ou charge la base de données choisie */

$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);


/* Nom de la table */ 

$reqTable = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
$r = $reqTable->fetch();
$nomTable = $r[0];

/* On récupère les champs cochés par l'utilisateur */

$lesChampsChecksTmp = $_POST['tabCheckboxs'];
$lesChampsChecks = explode(",", $lesChampsChecksTmp);
$idEnCours = $_POST['idEnCours'];

$tabID = [];

/* Pour chaque champ coché :
On exécute une requête qui sélectionne les IDS où au moins une des valeurs des champs cochés est nulle.
Ainsi on stocke dans un tableau les IDs qui seront traités */

foreach($lesChampsChecks as $unChamp){
	$reqID = $db->query("SELECT DISTINCT id" . $nomTable . " FROM ". $nomTable . " WHERE ". $unChamp. " IS NULL");
	while($n = $reqID->fetch(PDO::FETCH_BOTH)){
		$tabID[] = $n[0];
	}
}


/* On trie le tableau d'ID */ 

asort($tabID);

/* ID min du tableau des champs checkés par l'utilisateur */ 

$min = min($tabID);

/* Si l'ID en cours est inférieur ou égal à l'id min des champs checkés par l'utilisateur
On passe à l'id max des champs checkés par l'utilisateur */ 

if($min >= $idEnCours){
	$idEnCours = max($tabID);
}

/* Sinon on passe à l'ID précédent du tableau des champs checkés */ 


else if($min < $idEnCours){
	foreach($tabID as $v){
		if($v < $idEnCours){
			$tmp = $v;
		}
	}
	$idEnCours = $tmp;
}


/* On récupère le nom des champs */

$nomChamps = $db->query("PRAGMA table_info(".$nomTable.")");

while($n = $nomChamps->fetch(PDO::FETCH_BOTH)){
	$lesChamps[] = $n[1];
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


	if($unChamp != "id". $nomTable && $unChamp != "image". $nomTable && $unChamp != "imageMin". $nomTable){


		$retourTab.= "<tr>";

		/* Le nom du champ dans une balise label */

		$retourTab.= "<td><label for='" . $unChamp . "'>" . $unChamp . "</label></td>";
		$reqVal = $db->query("SELECT ". $unChamp ." FROM ". $nomTable . " WHERE id". $nomTable . " = ". $idEnCours . "");	
		$r = $reqVal->fetch();

		/*  Champ éditable pour la valeur du champ */

		$retourTab.= "<td><input class='inputBDD' type='text' id='" . $unChamp . "'' value='". $r[0]  . "'/></td>";
		if(in_array($unChamp, $lesChampsChecks)){
			$retourTab.= "<td><input name='" . $unChamp . "' type='checkbox'  id='checkbox" . $unChamp . "' checked/></td>";
		}
		else{

			/*  Checkbox */

			$retourTab.= "<td><input name='" . $unChamp . "' type='checkbox' id='checkbox" . $unChamp . "'/></td>";
		}
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