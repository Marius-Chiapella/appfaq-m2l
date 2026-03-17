<?php
include "fonctions.inc.php";
session_start();
$titre = "Liste";
// Redirige vers la page de connexion si on n'est pas connecté
if (!isset($_SESSION['user'])) {
  header("Location: ../index.php");
  exit();
} else {
  $id = strval($_SESSION['user']['id_user']);
}

// Connexion à la base de données
$dbh = connexion();
// Liste des utilisateurs
$sql = "select * from v_faq
        WHERE id_user = :id;";
try {
  $sth = $dbh->prepare($sql);
  $sth->execute(array(':id' => $id));
  $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
  die("Erreur lors de la requête SQL : " . $ex->getMessage());
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProjetM2L</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="main.css"> 
</head>
<body>

    <div class="barre_haute ">
        <h2>AppFaq - M2L</h2>
        <a href="disconnect.php">Se déconnecter</a>
        <a href="../index.php">Accueil</a>
    </div>

    <div class="content">
        <h1>M2L-list</h1>
        <p>Utilisateur : <strong><?= htmlspecialchars($username) ?></strong></p>

        <table border="1" style="width:100%; border-collapse: collapse; background-color: white;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Auteur</th>
                    <th>Question</th>
                    <th>Réponse</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($rows) > 0): ?>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id_faq']) ?></td>
                            <td><?= htmlspecialchars($row['pseudo']) ?></td>
                            <td><?= htmlspecialchars($row['question']) ?></td>
                            <td><?= htmlspecialchars($row['reponse']) ?></td>
                            <td style="text-align: center;">
                                <a href="list_subpages/edit.php?id=<?= $row['id_faq'] ?>" title="Modifier" style="text-decoration:none;">📝</a>
                                <a href="list_subpages/delete.php?id=<?= $row['id_faq'] ?>" 
                                   title="Supprimer" 
                                   style="text-decoration:none;"
                                   onclick="return confirm('Voulez-vous vraiment supprimer cette question ?');">
                                   🗑️
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">Aucune donnée disponible.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="list_subpages/add.php">Page add</a> <br>
    </div>

    <div class="footer">
        Maison des Ligues - Tous droits réservés 2026
    </div>

</body>

</html>