<?php
include 'config.php';

$result = $conn->query("SELECT * FROM t_utilisateur ORDER BY id_id_utilisateur");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Utilisateurs</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1>Utilisateurs</h1>
    <nav><a href="index.php">Accueil</a></nav>
    <a href="edit_t_utilisateur.php">Ajouter un utilisateur</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_id_utilisateur'] ?></td>
                <td><?= htmlspecialchars($row['nom']) ?></td>
                <td>
                    <a href="edit_t_utilisateur.php?id=<?= $row['id_id_utilisateur'] ?>">Éditer</a>
                    <a href="index.php?delete_table=t_utilisateur&delete_id=<?= $row['id_id_utilisateur'] ?>" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
