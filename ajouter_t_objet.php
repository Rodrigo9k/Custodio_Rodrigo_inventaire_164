<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $categorie = $_POST["id_id_categorie"];
    $description = $_POST["description"];
    $quantite = $_POST["quantite"];

    $stmt = $conn->prepare("INSERT INTO t_objet (nom, id_id_categorie, description, quantite) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisi", $nom, $categorie, $description, $quantite);
    $stmt->execute();
    header("Location: liste_t_objet.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Objet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Ajouter un Objet</h1>
    <form method="POST">
        <label>Nom:</label>
        <input type="text" name="nom" required>
        <label>Catégorie (ID):</label>
        <input type="number" name="id_id_categorie" required>
        <label>Description:</label>
        <input type="text" name="description">
        <label>Quantité:</label>
        <input type="number" name="quantite" required>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
