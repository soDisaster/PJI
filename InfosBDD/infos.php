<?php


	function creation(){
		//Ouvrir ou créer la base de données 

		$db = new PDO('sqlite:animaux.sqlite');

		//Activer les exceptions

		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//Créer la table

		$db->exec("CREATE TABLE IF NOT EXISTS chatons (
		                    id_chaton INTEGER PRIMARY KEY AUTOINCREMENT, 
		                    couleur_chaton VARCHAR(100), 
		                    angora boolean)");

		//insert rows

		$db->exec('INSERT INTO chatons (id_chaton, couleur_chaton, angora) VALUES (1, "roux","FAUX")');
		echo "Row inserted \n";
		$db->exec('INSERT INTO chatons (id_chaton, couleur_chaton, angora) VALUES (2, "blanc","TRUE")');
		echo "Row inserted \n";
		$db->exec('INSERT INTO chatons (couleur_chaton, angora) VALUES ("noir","TRUE")');
		echo "Row inserted \n";


		$db->exec('ALTER TABLE chatons ADD COLUMN groupe boolean');

	}


	function infos(){

		$db = new PDO('sqlite:animaux.sqlite');
		$req = $db->query("SELECT * FROM chatons");
		$champs = $db->query("PRAGMA table_info(chatons)");
		$colcount = $req->columnCount();
		while ($r = $req->fetch(PDO::FETCH_BOTH)){
			for ($i = 0; $i <= $colcount ; $i++) {
				print_r($r[$i]);
				print("<br/>");
			}
		}
		while ($r = $champs->fetch(PDO::FETCH_BOTH)){
				print_r($r[1]);
				print("<br/>");
		}
	}

?>