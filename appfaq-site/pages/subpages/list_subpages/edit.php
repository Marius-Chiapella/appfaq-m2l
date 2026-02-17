<?php
session_start();
require 'confitest.php'; // On utilise ton fichier de connexion habituel

// --- MODE TEST ---
$_SESSION['id_user'] = 1;      // Simule un utilisateur connecté
$_SESSION['id_usertype'] = 3;  // Simule les droits de "jef"
$username = "jef";             // Pour l'affichage
// -----------------

// 1) Vérifier connexion
if (empty($_SESSION['id_user'])) {
    header('Location: ../index.php');
    exit;
}

// 2) Vérifier rôle
$id_usertype = $_SESSION['id_usertype'] ?? null;
if ($id_usertype === null || !in_array((int)$id_usertype, [2, 3], true)) {
    http_response_code(403);
    die("Accès refusé : droits insuffisants.");
}

// 3) Récupérer l'ID de la FAQ
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID invalide.");
}
$id_faq = (int)$_GET['id'];

// 4) Charger la FAQ à éditer (Table 'faq' d'après ta BDD)
$sql = "SELECT id_faq, question, reponse, id_user FROM faq WHERE id_faq = :id_faq";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id_faq' => $id_faq]);
$faq = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$faq) {
    die("FAQ introuvable.");
}

// 5) Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['annuler'])) {
        header('Location: ../listtestbutton.php');
        exit;
    }

    $nouvelleQuestion = trim($_POST['question'] ?? '');
    $nouvelleReponse  = trim($_POST['reponse'] ?? '');

    if ($nouvelleQuestion === '') {
        $error = "La question est obligatoire.";
    } else {
        $now = date('Y-m-d H:i:s');

        // On met à jour la table 'faq'
        $updateSql = "UPDATE faq 
                      SET question = :question, 
                          reponse = :reponse, 
                          dat_reponse = :dat_reponse 
                      WHERE id_faq = :id_faq";
        
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([
            ':question'    => $nouvelleQuestion,
            ':reponse'     => $nouvelleReponse,
            ':dat_reponse' => $now,
            ':id_faq'      => $id_faq,
        ]);

        header('Location: ../listtestbutton.php');
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
    <title>M2L - Modifier FAQ</title>
</head>
<body>

    <div class="barre_haute">
        <h2>M2L - Modification</h2>
        <a href="../listtestbutton.php">Retour Liste</a>
    </div>

    <div class="content">
        <h1>Éditer la question</h1>
        
        <?php if (!empty($error)) : ?>
            <p style="color:red; background: #ffcccc; padding: 10px; border: 1px solid red;">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <form method="post">
            <h3>Question</h3>
            <textarea name="question" rows="4" style="width:100%; max-width:600px;"><?= htmlspecialchars($faq['question']) ?></textarea>

            <h3>Réponse</h3>
            <textarea name="reponse" rows="6" style="width:100%; max-width:600px;"><?= htmlspecialchars($faq['reponse']) ?></textarea>

            <div style="margin-top: 20px;">
                <button type="submit" name="enregistrer" style="padding: 10px 20px; background: #333; color: white; border: none; cursor: pointer;">
                    💾 Enregistrer les modifications
                </button>
                <button type="submit" name="annuler" style="padding: 10px 20px; cursor: pointer;">
                    Annuler
                </button>
            </div>
        </form>
    </div>

    <div class="footer">
        Maison des Ligues - Administration
    </div>

</body>
</html>