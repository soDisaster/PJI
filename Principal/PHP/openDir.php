<?php


$rp = "../ImagesBDD";
$rep = opendir($rp);
while ($sous_fichier = readdir($rep)){ 
	if (strpos($sous_fichier,".png")|| strpos($sous_fichier,".jpg") || strpos($sous_fichier,".bmp")){	
		
		$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);

		$req = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
		while ($r = $req->fetch()){
			$table = ($r[0]);
		}


 
		$db->query('ALTER TABLE '.$table. ' ADD COLUMN image'. $table .' BLOB');
		/*dernierID = -1;
		$dernier = $db->query("SELECT id". $table." FROM ". $table. " WHERE id". $table. " > (SELECT id". $table." FROM ". $table.")");
		if($dernier != NULL){
			while ($s = $dernier->fetch()){
				$dernierID = ($s[0]);
			}
		}*/
		$tmp = explode(".", $sous_fichier);
		$type = $tmp[1];
		echo $type;
		header("Content-Type: image/jpg");
		$stmt = $db->prepare("INSERT INTO Guillaume (idGuillaume, imageGuillaume) VALUES (1, ?)");
		$stmt->bindParam(1, fopen("../ImagesBDD/".$sous_fichier, "rb"), PDO::PARAM_LOB);
		$stmt->execute();
	}
}

closedir($rep);

?>