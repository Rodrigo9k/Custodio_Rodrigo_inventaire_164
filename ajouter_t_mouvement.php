<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_objet = intval($_POST['id_id_objet']);
    $id_utilisateur = intval($_POST['id_id_utilisateur']);
    $type = $_POST['type'];
    $quantite = intval($_POST['quantite']);

    $stmt = $conn->prepare("INSERT INTO t_mouvement (id_id_objet, id_id_utilisateur, type, quantite) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iisi", $id_objet, $id_utilisateur, $type, $quantite);

    if ($stmt->execute()) {
        header("Location: liste_t_mouvement.php");
        exit();
    } else {
        echo "Erreur : " . $stmt->error;
    }
    $stmt->close();
}

// Récupérer les objets et utilisateurs pour les listes déroulantes
$objets = $conn->query("SELECT id_id_objet, nom FROM t_objet");
$utilisateurs = $conn->query("SELECT id_id_utilisateur, nom FROM t_utilisateur");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Ajouter un mouvement</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1>Ajouter un mouvement</h1>
    <form method="post">
        <label for="id_id_objet">Objet :</label>
        <select name="id_id_objet" id="id_id_objet" required>
            <option value="">-- Choisir un objet --</option>
            <?php while ($row = $objets->fetch_assoc()): ?>
                <option value="<?= $row['id_id_objet'] ?>"><?= htmlspecialchars($row['nom']) ?></option>
            <?php endwhile; ?>
        </select><br/>

        <label for="id_id_utilisateur">Utilisateur :</label>
        <select name="id_id_utilisateur" id="id_id_utilisateur" required>
            <option value="">-- Choisir un utilisateur --</option>
            <?php while ($row = $utilisateurs->fetch_assoc()): ?>
                <option value="<?= $row['id_id_utilisateur'] ?>"><?= htmlspecialchars($row['nom']) ?></option>
            <?php endwhile; ?>
        </select><br/>

        <label for="type">Type :</label>
        <select name="type" id="type" required>
            <option value="">-- Choisir un type --</option>
            <option value="entrée">Entrée</option>
            <option value="sortie">Sortie</option>
        </select><br/>

        <label for="quantite">Quantité :</label>
        <input type="number" name="quantite" id="quantite" min="1" required><br/>

        <button type="submit">Ajouter</button>
    </form>
    <p><a href="liste_t_mouvement.php">Retour à la liste des mouvements</a></p>
</body>
</html>
