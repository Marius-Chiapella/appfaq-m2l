<?php
require_once 'confitest.php';
session_start();

// 1. Sécurité : Redirige vers la connexion si l'utilisateur n'est PAS connecté
/*if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
} else {
    // On récupère le pseudo de la session
    //$username = $_SESSION['user']; 
    $username = "jef";
} */
$username = "jef";

// 2. Connexion à la base de données
$dbh = $pdo;

// 3. Récupération des FAQ de l'utilisateur
// Note : Assurez-vous que votre vue 'v_faq' contient bien la colonne 'id_faq'
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
    <link rel="stylesheet" href="style.css">
    <title>M2L - Liste des FAQ</title>
    <style>
        /* Petit style rapide pour les icônes */
        .btn-action { text-decoration: none; margin: 0 5px; font-size: 1.2rem; }
        .delete { color: #e74c3c; }
        .edit { color: #3498db; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>

    <h1>M2L - Gestion de vos FAQ</h1>
    <p>Utilisateur connecté : <strong><?= htmlspecialchars($username) ?></strong></p>

    <table>
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
                        <td>
                            <a href="page/edit.php?id=<?= $row['id_faq'] ?>" class="btn-action edit" title="Modifier">📝</a>
                            
                            <a href="page/delete.php?id=<?= $row['id_faq'] ?>" 
                               class="btn-action delete" 
                               title="Supprimer" 
                               onclick="return confirm('Voulez-vous vraiment supprimer cette question ?');">
                               🗑️
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center;">Aucune FAQ trouvée pour votre compte.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <hr>
    <div class="navigation">
        <a href="page/add.php">➕ Ajouter une question</a> | 
        <a href="../index.php">🏠 Accueil</a>
    </div>

</body>
</html>