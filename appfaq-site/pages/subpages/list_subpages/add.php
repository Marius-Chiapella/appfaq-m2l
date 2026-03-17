<?php
session_start();
require_once '../fonctions.inc.php';
$titre = "Ajouter page";
$pdo = connexion();
$submit = isset($_POST['submit']);

$_SESSION['id_user'] = 1;
$_SESSION['id_usertype'] = 3;
$username = "jef";

if (($_SESSION['id_user']) == '') {
    header('Location: ../../index.php');
    exit;
}

$id_usertype = $_SESSION['id_usertype'] ?? null;
if ($id_usertype == null) {
    die("Accès refusé : droits insuffisants.");
}
if ($submit) {

    if (isset($_POST['annuler'])) {
        header('Location: ../list.php');
        exit;
    }

    $question = $_POST['question'] ?? '';

    if ($question == '') {
        $error = "La question est obligatoire.";
    } else {
        $now = date('Y-m-d H:i:s');

        $sql = "INSERT INTO faq (question, dat_question, id_user) 
                      VALUES (:question, :dat_question, :id_user)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':question' => $question,
            ':dat_question' => $now,
            ':id_user' => $_SESSION['id_user'],
        ]);

        header('Location: ../list.php');
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
    <title>ProjetM2L</title>
</head>

<body>
  <div class="barre_haute">
    <h2>AppFaq - M2L</h2>
    <a href="disconnect.php">Se déconnecter</a>
    <a href="../index.php">Accueil</a>
  </div>

    <div class="content">
        <h1><?= $titre ?></h1>

        <?php if (isset($error)):
           echo "<p> $error </p>";
        endif; ?>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <textarea name="question" id="question" cols="100" rows="20" style="resize: none;"></textarea>
            <br><br>
            <input type="submit" name='submit' value="Ajouter">
            <input type="button" name='annuler' onclick="window.location.href='../list.php'" value="Annuler">
        </form>
    </div>

    <div class="footer">
        <p>placeholder</p>
    </div>

</body>

</html>