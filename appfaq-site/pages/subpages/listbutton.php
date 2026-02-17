<?php
require_once 'confitest.php';
session_start();

// Mode test : on force l'utilisateur jef
$username = "jef";

// Connexion à la base de données (utilisation de l'objet $pdo de confitest.php)
$dbh = $pdo;

// Récupération des FAQ
$sql = "SELECT id_faq, pseudo, question, reponse FROM v_faq WHERE pseudo = :user";

try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(':user' => $username));
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
    <title>M2L - Liste des FAQ</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="main.css"> 
</head>
<body>

    <div class="barre_haute ">
        <h2>M2L - Gestion FAQ</h2>
        <a href="../index.php">Accueil</a>
        <a href="page/add.php">Ajouter</a>
        <a href="../index.php">Déconnexion</a>
    </div>

    <div class="content">
        <h1>Liste des questions</h1>
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
                                <a href="page/edit.php?id=<?= $row['id_faq'] ?>" title="Modifier" style="text-decoration:none;">📝</a>
                                <a href="page/delete.php?id=<?= $row['id_faq'] ?>" 
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
    </div>

    <div class="footer">
        Maison des Ligues - Tous droits réservés 2026
    </div>

</body>
</html>