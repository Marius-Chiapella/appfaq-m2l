<?php
require_once '../fonctions.inc.php';
session_start();

// 1) Vérification connexion
if (!isset($_SESSION['user'])) {
    header("Location: ../../index.php");
    exit();
}

// 2) Initialisation de la connexion (Correction de l'erreur $pdo)
$pdo = connexion();

// 3) Vérification du rôle (Adapté à ta structure de session)
$id_usertype = $_SESSION['user']['id_usertype'] ?? null;
if ($id_usertype === null || !in_array((int)$id_usertype, [2, 3], true)) {
    http_response_code(403);
    die("Accès refusé : droits insuffisants.");
}

// 4) Récupération de l'ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID invalide.");
}
$id_faq = (int)$_GET['id'];

// 5) Récupération de la FAQ pour affichage avant suppression
$sql = "SELECT id_faq, question, reponse FROM faq WHERE id_faq = :id_faq";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id_faq' => $id_faq]);
$faq = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$faq) {
    die("FAQ introuvable.");
}

// 6) Traitement de la suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['supprimer'])) {
        $delSql = "DELETE FROM faq WHERE id_faq = :id_faq";
        $delStmt = $pdo->prepare($delSql);
        $delStmt->execute([':id_faq' => $id_faq]);

        header('Location: ../list.php'); // Remplace par le nom exact de ta page liste
        exit;
    }

    if (isset($_POST['annuler'])) {
        header('Location: ../list.php'); // Remplace par le nom exact de ta page liste
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../main.css">
    <title>M2L - Suppression</title>
</head>
<body>

    <div class="barre_haute">
        <h2>M2L - Suppression</h2>
        <a href="../list.php">Retour Liste</a>
    </div>

    <div class="content">
        <h1>Confirmer la suppression</h1>
        <p>Voulez-vous vraiment supprimer cette question ? Cette action est irréversible.</p>

        <div>
            <h3>Question</h3>
            <p><?= htmlspecialchars($faq['question']) ?></p>

            <h3>Réponse</h3>
            <p><?= nl2br(htmlspecialchars($faq['reponse'])) ?></p>
        </div>

        <form method="post" >
            <button type="submit" name="supprimer" style="padding: 10px 20px; background: #333; color: white; border: none; cursor: pointer">
                🗑️ Confirmer la suppression
            </button>
            <button type="submit" name="annuler" style="padding: 10px 20px; cursor:pointer; margin-left: 10px;">
                Annuler
            </button>
        </form>
    </div>

    <div class="footer">
        <p>Copyright © : Théliau, Anthony, Marius, Liam - 2026</p>
    </div>

</body>
</html>