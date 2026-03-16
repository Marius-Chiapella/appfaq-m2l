<?php
require_once '../fonctions.inc.php';
session_start();

// 1) Vérifier connexion
/*if (empty($_SESSION['id_user'])) {
    header('Location: login.php');
    exit;
}*/ 
// Simulation de session pour le test
$_SESSION['id_usertype'] = 3; // a supprimer


$id_usertype = $_SESSION['id_usertype'] ?? null;
if ($id_usertype === null || !in_array((int)$id_usertype, [2, 3], true)) {
    http_response_code(403);
    die("Accès refusé.");
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID invalide.");
}
$id_faq = (int)$_GET['id'];

$sql = "SELECT id_faq, question, reponse FROM faq WHERE id_faq = :id_faq";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id_faq' => $id_faq]);
$faq = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$faq) {
    die("FAQ introuvable.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['supprimer'])) {
        $delSql = "DELETE FROM faq WHERE id_faq = :id_faq";
        $delStmt = $pdo->prepare($delSql);
        $delStmt->execute([':id_faq' => $id_faq]);

        header('Location: ../listtestbutton.php'); // Redirection corrigée
        exit;
    }

    if (isset($_POST['annuler'])) {
        header('Location: ../listtestbutton.php'); // Redirection corrigée
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
    <title>M2L - Suppression</title>
</head>
<body>

    <div class="barre_haute">
        <h2>M2L - Suppression</h2>
        <a href="../listtestbutton.php">Retour Liste</a>
    </div>

    <div class="content">
        <h1>Confirmer la suppression</h1>
        <p>Voulez-vous vraiment supprimer cette question ? Cette action est irréversible.</p>

        <h3>Question</h3>
        <textarea disabled rows="4" cols="50" style="width: 100%; max-width: 600px;"><?= htmlspecialchars($faq['question']) ?></textarea>

        <h3>Réponse</h3>
        <textarea disabled rows="4" cols="50" style="width: 100%; max-width: 600px;"><?= htmlspecialchars($faq['reponse']) ?></textarea>

        <form method="post" style="margin-top: 20px;">
            <button type="submit" name="supprimer" style="cursor:pointer;">Confirmer la suppression</button>
            <button type="submit" name="annuler" style="cursor:pointer;">Annuler</button>
        </form>
    </div>

    <div class="footer">
        Maison des Ligues - Administration
    </div>

</body>
</html>