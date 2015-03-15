<?php

    function listeD(){

        echo '<select name="dossiers">';
    	$dir = getcwd();
    	if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) != false) {
                    if ($file != '.' && $file != '..' && strpos($file,".sqlite")){
                        echo '<option value="'.$file.'">'.$file.'</option>'."\n";
                    }
                }
                    closedir($dh);
            }
        }
    	echo '</select>';

    }

?>