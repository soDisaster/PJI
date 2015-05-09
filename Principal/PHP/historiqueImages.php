<?php

$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);

$reqTable = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
$r = $reqTable->fetch();
$nomTable = $r[0];

$nomChamps = $db->query("PRAGMA table_info(".$nomTable.")");
		

while($n = $nomChamps->fetch(PDO::FETCH_BOTH)){
	$lesChamps[] = $n[1];
} 

foreach($lesChamps as $unChamp){
	$reqID = $db->query("SELECT DISTINCT id" . $nomTable . " FROM ". $nomTable . " WHERE ". $unChamp. " IS NULL");
	while($n = $reqID->fetch(PDO::FETCH_BOTH)){
		$tabID.= $n[0] . ",";
	}
}
echo $tabID;


?>