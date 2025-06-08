<?php
include 'config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$nom = $description = "";
$id_categorie = 0;
$quantite = 0;

$categories = $conn->query("SELECT id_id_categorie, nom FROM t_categorie");

if ($id > 0) {
    $stmt = $conn->prepare("SELECT nom, id_id_categorie, description, quantite FROM t_objet WHERE id_id_objet = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nom, $id_categorie, $description, $quantite);
    $stmt->fetch();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_post = $_POST['nom'];
    $id_categorie_post = intval($_POST['id_id_categorie']);
    $description_post = $_POST['description'];
    $quantite_post = intval($_POST['quantite']);

    if ($id > 0) {
        $stmt = $conn->prepare("UPDATE t_objet SET nom = ?, id_id_categorie = ?, description = ?, quantite = ? WHERE id_id_objet = ?");
        $stmt->bind_param("sisii", $nom_post, $id_categorie_post, $description_post, $quantite_post, $id);
        $stmt->execute();
        $stmt->close();
    } else {
        $stmt = $conn->prepare("INSERT INTO t_objet (nom, id_id_categorie, description, quantite) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sisi", $nom_post, $id_categorie_post, $description_post, $quantite_post);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: liste_t_objet.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title><?= $id > 0 ? "Modifier" : "Ajouter" ?> Objet</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1><?= $id > 0 ? "Modifier" : "Ajouter" ?> Objet</h1>
    <nav><a href="liste_t_objet.php">Retour</a></nav>
    <form method="post">
        <label for="nom">Nom :</label><br/>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($nom) ?>" required/><br/><br/>

        <label for="id_id_categorie">Catégorie :</label><br/>
        <select name="id_id_categorie" id="id_id_categorie" required>
            <option value="">--Choisir--</option>
            <?php while($cat = $categories->fetch_assoc()): ?>
                <option value="<?= $cat['id_id_categorie'] ?>" <?= $cat['id_id_categorie'] == $id_categorie ? 'selected' : '' ?>><?= htmlspecialchars($cat['nom']) ?></option>
            <?php endwhile; ?>
        </select><br/><br/>

        <label for="description">Description :</label><br/>
        <textarea id="description" name="description" rows="4"><?= htmlspecialchars($description) ?></textarea><br/><br/>

        <label for="quantite">Quantité :</label><br/>
        <input type="number" id="quantite" name="quantite" value="<?= $quantite ?>" min="0" required/><br/><br/>

        <button type="submit"><?= $id > 0 ? "Modifier" : "Ajouter" ?></button>
    </form>
</body>
</html>
