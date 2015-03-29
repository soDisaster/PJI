<?php


$dbh = new PDO('sqlite:images.sqlite');
//$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$dbh->exec("CREATE TABLE IF NOT EXISTS image (
		                    img BLOB)");


header("content-type: image/bmp");
//header("content-type: image/jpg");
$stmt = $dbh->prepare('INSERT INTO image (img) VALUES (?)');
$stmt->bindParam(1, fopen("1.bmp", "rb"), PDO::PARAM_LOB);
$stmt->execute();

$query = $dbh->query("SELECT img from image");
header("Content-Type: image/bmp");
echo $query->fetchColumn();

?>