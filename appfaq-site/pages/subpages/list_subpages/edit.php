<?php
session_start();
require 'faut mettre le nom du php qui correspond pour que sa marche'; // $pdo

// 1) Vérifier connexion
if (empty($_SESSION['id_user'])) {
    header('Location: login.php');
    exit;
}

// 2) Vérifier que l'utilisateur est admin / superadmin
// ---- Variante A : tu stockes le libellé dans la session ----
// $role = $_SESSION['lib_usertype'] ?? 'user';
// if (!in_array($role, ['admin', 'superadmin'], true)) { ... }

// ---- Variante B : tu stockes l'id_usertype dans la session ----
$id_usertype = $_SESSION['id_usertype'] ?? null;
if ($id_usertype === null) {
    http_response_code(403);
    die("Accès refusé : droits insuffisants (type non défini).");
}

// on considère par exemple : 1 = user, 2 = admin, 3 = superadmin (à adapter à ta BDD)
if (!in_array((int)$id_usertype, [2, 3], true)) {
    http_response_code(403);
    die("Accès refusé : droits insuffisants.");
}

// 3) Récupérer l'ID de la FAQ dans l'URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID invalide.");
}
$id_faq = (int)$_GET['id'];

// 4) Charger la FAQ à éditer
$sql = "SELECT id_faq, question, reponse, id_user
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

    if (isset($_POST['annuler'])) {
        header('Location: list.php');
        exit;
    }

    $nouvelleQuestion = trim($_POST['question'] ?? '');
    $nouvelleReponse  = trim($_POST['reponse'] ?? '');

    // Question obligatoire, réponse facultative
    if ($nouvelleQuestion === '') {
        $error = "La question est obligatoire.";
    } else {
        // dat_question : tu peux la garder comme date de création (non modifiée)
        // dat_reponse : date de dernière modif de la réponse (ou de l'entrée)
        $now = date('Y-m-d H:i:s');

        $updateSql = "UPDATE m2l_faq
                      SET question    = :question,
                          reponse     = :reponse,
                          dat_reponse = :dat_reponse
                      WHERE id_faq    = :id_faq";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([
            ':question'    => $nouvelleQuestion,
            ':reponse'     => $nouvelleReponse, // peut être vide
            ':dat_reponse' => $now,
            ':id_faq'      => $id_faq,
        ]);

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
  <title>M2L-edit</title>
</head>
<body>
  <h1>M2L-edit</h1>

  <?php if (!empty($error)) : ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="post">
    <h3>Question</h3>
    <textarea name="question" rows="4" cols="50" placeholder="Question"><?= htmlspecialchars($faq['question']) ?></textarea><br>

    <h3>Réponse</h3>
    <textarea name="reponse" rows="4" cols="50" placeholder="Réponse à la question"><?= htmlspecialchars($faq['reponse']) ?></textarea><br>

    <button type="submit" name="enregistrer">Enregistrer</button>
    <button type="submit" name="annuler">Annuler</button>
  </form>

  <br><br>
  <a href="list.php">Page list</a> <br>
</body>
</html>
