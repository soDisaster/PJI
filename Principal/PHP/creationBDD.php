<?php

	
		$db = new PDO('sqlite:../Bases/'. $_POST['newBDD'].'.sqlite');
		

		//Créer la table

		$db->exec("CREATE TABLE IF NOT EXISTS ". $_POST['newTable']."(
		                    id INTEGER PRIMARY KEY AUTOINCREMENT, 
		                    )");



?>