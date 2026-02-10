<?php
$_SESSION['username'] = $row['pseudo'];
header('Location: ../index.php');
try {
    $db = new PDO('mysql:host=localhost;dbname=m2l;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? ''; 

    if (!empty($login) && !empty($password)) {

        
        $query = $db->prepare("SELECT * FROM user WHERE pseudo = :login");
        $query->execute(['login' => $login]);
        $user = $query->fetch();
        /*print_r($user);exit();*/
        if ($user && password_verify($password, $user['mdp'])) { 
            
            $_SESSION['user'] = $user;
            
            header('Location: list.php');
            exit();

        } else {
            $error = "Identifiants invalides. Veuillez recommencer.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
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

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <div>
            <label>Pseudo / Login :</label>
            <input type="text" name="login" required>
        </div>
        <div>
            <label>Mot de passe :</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>


