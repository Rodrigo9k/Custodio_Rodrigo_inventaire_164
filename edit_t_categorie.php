<?php
include 'config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$nom = "";

if ($id > 0) {
    $stmt = $conn->prepare("SELECT nom FROM t_categorie WHERE id_id_categorie = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nom);
    $stmt->fetch();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_post = $_POST['nom'];

    if ($id > 0) {
        $stmt = $conn->prepare("UPDATE t_categorie SET nom = ? WHERE id_id_categorie = ?");
        $stmt->bind_param("si", $nom_post, $id);
        $stmt->execute();
        $stmt->close();
    } else {
        $stmt = $conn->prepare("INSERT INTO t_categorie (nom) VALUES (?)");
        $stmt->bind_param("s", $nom_post);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: liste_t_categorie.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title><?= $id > 0 ? "Modifier" : "Ajouter" ?> Catégorie</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1><?= $id > 0 ? "Modifier" : "Ajouter" ?> Catégorie</h1>
    <nav><a href="liste_t_categorie.php">Retour</a></nav>
    <form method="post">
        <label for="nom">Nom :</label><br/>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($nom) ?>" required/><br/><br/>
        <button type="submit"><?= $id > 0 ? "Modifier" : "Ajouter" ?></button>
    </form>
</body>
</html>
