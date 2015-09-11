<?php

/*

Dans la base de données sont stockées un ID pour chaque élément et en dur deux images.
La miniature de l'image sélectionnée par l'utilsiateur qui sera affichée au centre.
La plus petite miniature qui sera affichée dans la vue d'ensemble.

*/


/* Code trouvé sur le net pour créer des miniatures */


include('miniatures.php'); 

/*

Dans la base de données sont stockées en dur deux images.
La miniature de l'image sélectionnée par l'utilisateur qui sera affichée au centre.
La plus petite miniature qui sera affichée dans la vue d'ensemble.

*/

/* Nombre d'images choisies par l'utilisateur */

$numberFiles = count($_FILES['images']['tmp_name']);

/* Créé ou charge la base de données */

$db = new PDO('sqlite:../Bases/'.$_POST['selectbase']);

/* Nom de la table */

$reqTable = $db->query("select name from sqlite_master where type = 'table' and name <> 'sqlite_sequence'");
$r = $reqTable->fetch();
$table = $r[0];

/* Recherche de l'ID max */ 

$reqIdExistants = $db->query("SELECT MAX(id". $table .") FROM ". $table);
$n = $reqIdExistants->fetch(PDO::FETCH_BOTH);

/* Si il n'y a pas d'ID max */

if(is_null($n[0])){
	
	/* Pour chaque ID à partir de 0 jusqu'au nombre de fichiers */

	for ($i=0; $i < $numberFiles ; $i++) { 

		/* On prépare une requête d'insertion, on ajoute déjà l'ID */

		$qh = $db->prepare("INSERT INTO ". $table. " (id". $table . ", image" . $table . ", imageMin" . $table . ") VALUES (" . $i . ", ?, ?)");
		$extension = str_replace(array('.',$_FILES['images']['type']), array('', $_FILES['images']['type']), $imagesize['mime']);

		$filename = time() .'.'. $extension;
		$image_path = $filename;
		$thumb_path = $filename;
		$thumb_path2 = $filename;

		/* On créé le chemin temporaire de la première miniature */

		move_uploaded_file($_FILES['images']['tmp_name'][$i], $image_path);

		/* On créé la miniature */

		imagethumb($image_path, $thumb_path, 200);

		/* On ajoute la première miniature en paramètre de la requête d'insertion */

		$qh->bindParam(1, file_get_contents($thumb_path), PDO::PARAM_LOB);

		/* On utilise le chemin temporaire de la première miniature et on créé le chemin temporaire de la seconde miniature */

		imagethumb($thumb_path, $thumb_path2, 50);

		/* On ajoute la seconde miniature en paramètre de la requête d'insertion */


		$qh->bindParam(2, file_get_contents($thumb_path2), PDO::PARAM_LOB);

		/* On exécute la requête d'insertion */

		$qh->execute();

		unlink($thumb_path2);
	}
}

/* Si il y a un ID max, on créé les nouveaux éléments de la base à partir de l'ID max + 1. */

else{

	/* ID max */

	$id = $n[0] + 1;
	$j = 0;

	/* Pour chaque ID à partir de l'ID max jusqu'à l'ID max + nombre de fichiers */

	for ($i=$id; $i < $id+$numberFiles ; $i++) {

		/* On prépare une requête d'insertion, on ajoute déjà l'ID */

		$qh = $db->prepare("INSERT INTO ". $table. " (id". $table . ", image" . $table . ", imageMin" . $table . ") VALUES (" . $i . ", ?, ?)");
		$extension = str_replace(array('.',$_FILES['images']['type']), array('', $_FILES['images']['type']), $imagesize['mime']);

		$filename = time() .'.'. $extension;
		$image_path2 = $filename;
		$thumb_path3 = $filename;
		$thumb_path4 = $filename;

		/* On créé le chemin temporaire de la première miniature */

		move_uploaded_file($_FILES['images']['tmp_name'][$j], $image_path2);

		/* On créé la miniature */

		imagethumb($image_path2, $thumb_path3, 200);

		/* On ajoute la première miniature en paramètre de la requête d'insertion */

		$qh->bindParam(1, file_get_contents($thumb_path3), PDO::PARAM_LOB);

		/* On utilise le chemin temporaire de la première miniature et on créé le chemin temporaire de la seconde miniature */

		imagethumb($thumb_path3, $thumb_path4, 50);

		/* On ajoute la seconde miniature en paramètre de la requête d'insertion */

		$qh->bindParam(2, file_get_contents($thumb_path4), PDO::PARAM_LOB);

		/* On exécute la requête d'insertion */

		$qh->execute();
		unlink($thumb_path4);
		$j++;
	}
}

/* On retourne au fichier principal */

header('Location:principal.php');



?>