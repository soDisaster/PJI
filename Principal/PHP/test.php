<?php

$db = new PDO('sqlite:../Bases/animaux.sqlite');

	$q = $db->query('SELECT imagechatons from chatons WHERE idchatons = 1');
	header("Content-Type: image/jpg");
	echo $q->fetchColumn();

	?>