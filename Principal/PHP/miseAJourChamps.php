<?php 


$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);
$req = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
$r = $req->fetch();
$nomTable = $r[0];
if($_POST['valeurChamp'] != ""){
	$db->query("UPDATE ".$nomTable. " SET " . $_POST['nomChamp']. " = '" . $_POST['valeurChamp'] . "' WHERE id" .$nomTable. " = ".  $_POST['idEnCours']);
}
else{
	$db->query("UPDATE ".$nomTable. " SET " . $_POST['nomChamp']. " = NULL WHERE id" .$nomTable. " = ".  $_POST['idEnCours']);
}

$nomChamps = $db->query("PRAGMA table_info(".$nomTable.")");
while($n = $nomChamps->fetch(PDO::FETCH_BOTH)){
	$lesChamps[] = $n[1];
}

$tmp = "ok";
foreach ($lesChamps as $unChamp) {
	
	$req = $db->query("SELECT ". $unChamp . " FROM ". $nomTable . " WHERE id".$nomTable. " = " . $_POST['idEnCours'] . " AND " . $unChamp . " IS NULL");
	if($req->fetch() != ""){
		$tmp = "non";
	}
}

echo $tmp;


?>