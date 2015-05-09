<?php

	include('miniatures.php'); 

	$numberFiles = count($_FILES['images']['tmp_name']);
	$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);
	$req = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
	while ($r = $req->fetch()){
		$table = ($r[0]);
	}
	for ($i=0; $i < $numberFiles ; $i++) { 
		$qh = $db->prepare("INSERT INTO ". $table. " (id". $table . ", image" . $table . ", imageMin" . $table . ") VALUES (" . $i . ", ?, ?)");
		 $extension = str_replace(array('.',$_FILES['images']['type']), array('', $_FILES['images']['type']), $imagesize['mime']);
		     
		    $filename = time() .'.'. $extension;
		    $image_path = $filename;
		    $image_paths = $filename;
		    $thumb_path = $filename;
		    $thumb_path2 = $filename;
		     
		    move_uploaded_file($_FILES['images']['tmp_name'][$i], $image_path);
		    imagethumb($image_path, $thumb_path, 200);
		    $qh->bindParam(1, file_get_contents($thumb_path), PDO::PARAM_LOB);
		    imagethumb($thumb_path, $thumb_path2, 50);
			$qh->bindParam(2, file_get_contents($thumb_path2), PDO::PARAM_LOB);
			$qh->execute();
			unlink($thumb_path2);
	}

	header('Location:principal.php');
    exit();



?>