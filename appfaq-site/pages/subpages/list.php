<?php
include "fonctions.inc.php";
session_start();
$titre = "Liste";

// 1) Vérification connexion
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
} else {
    $id = strval($_SESSION['user']['id_user']);
}

// 2) Connexion à la base de données
$dbh = connexion();

// 3) Requête SQL (Filtrée par l'utilisateur connecté)
$sql = "SELECT id_faq, pseudo, question, reponse FROM v_faq WHERE id_user = :id";

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
    <title>ProjetM2L - <?= $titre ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="main.css"> 
</head>
<body>

    <div class="barre_haute">
        <h2>AppFaq - M2L</h2>
        <a href="disconnect.php">Se déconnecter</a>
        <a href="../index.php">Accueil</a>
    </div>

    <div class="content">
        <h1>M2L-list</h1>
        <p>Utilisateur : <?= $_SESSION['user']['pseudo'] ?></p>

        <?php if (empty($rows)): ?>
            <p>Vous n'avez aucun message pour l'instant !</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>NR</th>
                        <th>Auteur</th>
                        <th>Question</th>
                        <th>Réponse</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?= ($row['id_faq']) ?></td>
                            <td><?= ($row['pseudo']) ?></td>
                            <td><?= htmlspecialchars($row['question']) ?></td>
                            <td><?= htmlspecialchars($row['reponse']) ?></td>
                            
                            <td style="text-align: center;">
                                <?php if (isset($_SESSION['user']['id_usertype']) && $_SESSION['user']['id_usertype'] == 3): ?>
                                    <a href="list_subpages/edit.php?id=<?= $row['id_faq'] ?>" title="Modifier" style="text-decoration:none;">📝</a>
                                    <a href="list_subpages/delete.php?id=<?= $row['id_faq'] ?>" 
                                       title="Supprimer" 
                                       style="text-decoration:none;"
                                       onclick="return confirm('Voulez-vous vraiment supprimer cette question ?');">
                                       🗑️</a>
                                <?php else: ?>
                                    <span style="color:gray; font-size: 0.8em;">Lecture seule</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <br><br>
        <a href="list_subpages/add.php">Ajouter une question</a>
      </div>

    <div class="footer">
        <p>Copyright © : Théliau, Anthony, Marius, Liam - 2026</p>
    </div>

</body>
</html>