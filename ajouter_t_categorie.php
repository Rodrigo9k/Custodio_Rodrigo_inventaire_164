<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $stmt = $conn->prepare("INSERT INTO t_categorie (nom) VALUES (?)");
    $stmt->bind_param("s", $nom);
    $stmt->execute();
    header("Location: liste_t_categorie.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Catégorie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Ajouter une Catégorie</h1>
    <form method="POST">
        <label>Nom:</label>
        <input type="text" name="nom" required>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
