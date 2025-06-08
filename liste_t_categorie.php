<?php
include 'config.php';

$result = $conn->query("SELECT * FROM t_categorie ORDER BY id_id_categorie");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Catégories</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1>Catégories</h1>
    <nav><a href="index.php">Accueil</a></nav>
    <a href="edit_t_categorie.php">Ajouter une catégorie</a>
    <table>
        <thead>
            <tr><th>ID</th><th>Nom</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_id_categorie'] ?></td>
                <td><?= htmlspecialchars($row['nom']) ?></td>
                <td>
                    <a href="edit_t_categorie.php?id=<?= $row['id_id_categorie'] ?>">Éditer</a>
                    <a href="index.php?delete_table=t_categorie&delete_id=<?= $row['id_id_categorie'] ?>" onclick="return confirm('Supprimer cette catégorie ?')">Supprimer</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
