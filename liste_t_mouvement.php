<?php
include 'config.php';

$result = $conn->query("SELECT * FROM t_mouvement ORDER BY id_id_mouvement");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Mouvements</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1>Mouvements</h1>
    <nav><a href="index.php">Accueil</a></nav>
    <a href="edit_t_mouvement.php">Ajouter un mouvement</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>ID Utilisateur</th>
                <th>ID Objet</th>
                <th>Type</th>
                <th>Quantité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_id_mouvement'] ?></td>
                <td><?= htmlspecialchars($row['date']) ?></td>
                <td><?= $row['id_id_utilisateur'] ?></td>
                <td><?= $row['id_id_objet'] ?></td>
                <td><?= htmlspecialchars($row['type']) ?></td>
                <td><?= $row['quantite'] ?></td>
                <td>
                    <a href="index.php?delete_table=t_mouvement&delete_id=<?= $row['id_id_mouvement'] ?>" onclick="return confirm('Supprimer ce mouvement ?')">Supprimer</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
