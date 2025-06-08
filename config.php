<link rel="stylesheet" href="style.css">

<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "custodio_rodrigo_inventaire_164";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>
