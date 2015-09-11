<?php

/* Permet de créer une liste déroulante avec tous les fichiers avec l'extension sqlite.
La liste déroulante contient donc toutes les bases de données exploitables par l'utilisateur.
Ces fichiers sont dans le dossier Bases */

/* La liste déroulante */

/* Dossier où on recherche les fichiers SQLite */

session_start();

$dir = "../Bases";


echo '<option value="bases" disabled selected> Bases </option>';
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) != false) {

        	/* On ne prend que le fichier avec l'extension sqlite */

            if ($file != '.' && $file != '..' && strpos($file,".sqlite")){
            	echo '<option id="'.$file.'" value="'.$file.'">'.$file.'</option>'."\n";
            }
        }
        closedir($dh);
    }
}



?>