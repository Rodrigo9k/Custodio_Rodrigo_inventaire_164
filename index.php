<link rel="stylesheet" href="style.css">

<?php
include 'config.php';

// Suppression d'un enregistrement
if (isset($_GET['delete_table'], $_GET['delete_id'])) {
    $table = $_GET['delete_table'];
    $id = intval($_GET['delete_id']);
    $id_col = "";

    switch ($table) {
        case 't_categorie': $id_col = "id_id_categorie"; break;
        case 't_mouvement': $id_col = "id_id_mouvement"; break;
        case 't_objet': $id_col = "id_id_objet"; break;
        case 't_utilisateur': $id_col = "id_id_utilisateur"; break;
    }

    if ($id_col) {
        $stmt = $conn->prepare("DELETE FROM $table WHERE $id_col = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Admin Inventaire</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1>Administration Inventaire</h1>
    <nav>
        <a href="liste_t_categorie.php">Catégories</a>
        <a href="liste_t_mouvement.php">Mouvements</a>
        <a href="liste_t_objet.php">Objets</a>
        <a href="liste_t_utilisateur.php">Utilisateurs</a>
    </nav>
    <p>Choisis une table dans la barre ci-dessus.</p>
</body>
</html>
