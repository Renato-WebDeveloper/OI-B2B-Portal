

<?php

$conn = "mysql:dbname=portal_indicadores;host=localhost";
$dbuser = "root";
$dbpass = "adm@superuser";

try {
	$pdo = new PDO($conn, $dbuser, $dbpass);
	global $pdo;
} catch (PDOException $e) {
	echo $e->getMessage();
}

?>