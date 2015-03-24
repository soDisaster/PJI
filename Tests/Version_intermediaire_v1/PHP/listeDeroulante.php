<?php

    function listeD(){


        echo '<select id="bases" name="bases">';
    	$dir = "../Bases";
        echo '<option value="bases"> Bases </option>';
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