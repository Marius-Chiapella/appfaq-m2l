<?php
session_start();

// 1. Connexion BDD (Version compacte)
try {
    $db = new PDO('mysql:host=localhost;dbname=m2l;charset=utf8', 'root', '');
} catch (Exception $e) { die('Erreur : ' . $e->getMessage()); }

// 2. Traitement du formulaire
$error = null; // On initialise la variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $pass  = $_POST['password'] ?? '';

    // Vérification simplifiée : si login OU pass est vide, c'est une erreur
    if (!$login || !$pass) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        // Requête SQL
        $stmt = $db->prepare("SELECT * FROM user WHERE pseudo = ?");
        $stmt->execute([$login]);
        $user = $stmt->fetch();

        // Vérification du mot de passe
        if ($user && password_verify($pass, $user['mdp'])) {
            $_SESSION['user'] = $user;
            header('Location: ../index.php');
            exit();
        } else {
            $error = "Identifiants invalides. Veuillez recommencer.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Connexion</h2>

    <?php if ($error): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <div>
            <label>Pseudo / Login :</label>
            <input type="text" name="login" required value="<?= htmlspecialchars($login ?? '') ?>">
        </div>
        <div>
            <label>Mot de passe :</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>