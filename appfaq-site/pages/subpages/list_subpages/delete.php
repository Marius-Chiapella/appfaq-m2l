<?php
session_start();
require 'confitest.php';//faut mettre le nom du php qui correspond pour que sa marche

// 1) Vérifier connexion
if (empty($_SESSION['id_user'])) {
    header('Location: login.php');
    exit;
}

// 2) Vérifier rôle (même logique que dans edit.php)
$id_usertype = $_SESSION['id_usertype'] ?? null;
if ($id_usertype === null) {
    http_response_code(403);
    die("Accès refusé : droits insuffisants (type non défini).");
}

if (!in_array((int)$id_usertype, [2, 3], true)) {
    http_response_code(403);
    die("Accès refusé : droits insuffisants.");
}

// 3) Récupérer l'ID de la FAQ
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID invalide.");
}
$id_faq = (int)$_GET['id'];

// 4) Charger la FAQ (pour afficher la question/réponse avant suppression)
$sql = "SELECT id_faq, question, reponse
        FROM m2l_faq
        WHERE id_faq = :id_faq";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id_faq' => $id_faq]);
$faq = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$faq) {
    die("FAQ introuvable.");
}

// 5) Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['supprimer'])) {
        $delSql = "DELETE FROM m2l_faq WHERE id_faq = :id_faq";
        $delStmt = $pdo->prepare($delSql);
        $delStmt->execute([':id_faq' => $id_faq]);

        header('Location: list.php');
        exit;
    }

    if (isset($_POST['annuler'])) {
        header('Location: list.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>M2L-delete</title>
</head>
<body>
  <h1>M2L-delete</h1>

  <h3>Question</h3>
  <textarea disabled rows="4" cols="50"><?= htmlspecialchars($faq['question']) ?></textarea><br>

  <h3>Réponse</h3>
  <textarea disabled rows="4" cols="50"><?= htmlspecialchars($faq['reponse']) ?></textarea><br>

  <form method="post">
    <button type="submit" name="supprimer">Supprimer</button>
    <button type="submit" name="annuler">Annuler</button>
  </form>

  <br><br>
  <a href="list.php">Page list</a> <br>
</body>
</html>
