<?php



	$numberFiles = count($_FILES['images']['tmp_name']);
	$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);
	$req = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
	while ($r = $req->fetch()){
		$table = ($r[0]);
	}
	for ($i=0; $i < $numberFiles ; $i++) { 
		$qh = $db->prepare("INSERT INTO ". $table. " (id". $table . ", image" . $table . ") VALUES (" . $i . ", ?)");
		$qh->bindParam(1, file_get_contents($_FILES['images']['tmp_name'][$i]), PDO::PARAM_LOB);
		$qh->execute();
	}

	header('Location:principal.php');
    exit();



?>