<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrition</title>
</head>
<h1>Inscrition :</h1>


<form action="register.php" id="form1" method="post">
<p>Pseudo : <input type="text" name="nom" value="" /></p>


<p>Email : <input type="email" id="email" name="email" required><p>


<p>Mot de passe :<br /><input type="password" name="password"
value=""/></p>


<p>Ligue :<br />
<select name="Ligue">
<option value="1" selected >Football</option>
<option value="2" >Basket</option>
<option value="3" >Volley</option>
<option value="4" >Handball</option>
<option value="5" >Toutes les ligues</option>
</select>
</p>


<p><input type="submit" name="submit" value="Enregistrer" /></p>


</form>


<body>
    <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom      = $_POST['nom']      ?? '';
    $email    = $_POST['email']    ?? '';
    $password = $_POST['password'] ?? '';
    $ligue    = (int)($_POST['Ligue'] ?? 1);
    $id_usertype = 1;

    $conn = mysqli_connect("localhost", "root", "", "m2l");
    if (!$conn) {
        die("Connexion échouée : " . mysqli_connect_error());
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (pseudo, mdp, mail, id_usertype, id_ligue)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssii",
        $nom, $hash, $email, $id_usertype, $ligue);

    if (mysqli_stmt_execute($stmt)) {
        $message = "Inscription réussie";
    } else {
        $message = "Erreur SQL : " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
</body>
</html>