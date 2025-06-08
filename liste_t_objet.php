<?php
include 'config.php';

$result = $conn->query("SELECT * FROM t_objet ORDER BY id_id_objet");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Objets</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1>Objets</h1>
    <nav><a href="index.php">Accueil</a></nav>
    <a href="edit_t_objet.php">Ajouter un objet</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Description</th>
                <th>Quantité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_id_objet'] ?></td>
                <td><?= htmlspecialchars($row['nom']) ?></td>
                <td><?= $row['id_id_categorie'] ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= $row['quantite'] ?></td>
                <td>
                    <a href="edit_t_objet.php?id=<?= $row['id_id_objet'] ?>">Éditer</a>
                    <a href="index.php?delete_table=t_objet&delete_id=<?= $row['id_id_objet'] ?>" onclick="return confirm('Supprimer cet objet ?')">Supprimer</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
