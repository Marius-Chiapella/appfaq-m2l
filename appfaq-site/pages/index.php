<?php
session_start();
$titre = "Accueil";

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = null; // Non connecté
} else {
    $username = isset($_SESSION['user']) ? $_SESSION['user'] : null;
}
?>

<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index-style.css">
    <title>ProjetM2L</title>
</head>

<body>
    <div class="barre_haute">
        <h2>AppFaq - M2L</h2>
        <?php if ($_SESSION['user']==null): ?> <!-- //!$username || $username === 'non connecté' -->
            <a href="subpages/register.php" id="register">S'inscrire</a>
            <a href="subpages/login.php" id="login">Se connecter</a>
        <?php else: ?>
            <a href="<?php $_SESSION['user'] = null?>">Se déconnecter</a>
            <a href="subpages/liste.php">Liste des utilisateurs</a>
        <?php endif; ?>
    </div>

    <div class="content">
        <h1><?= $titre ?></h1>
            <?php
            if (isset($username)) {
                echo "<p>Utilisateur actuel : " . $username['pseudo']. "</p>";
            }
            ?>
            

<!--        <div id="pop-up_form">

            <form action="subpages/login.php" method="post" id="login_form">
                <div class="inputs">
                    <label for="user">Pseudo</label> <br> 
                    <input type="text" name="user" id="pseudo">

                </div>

                 <div class="inputs">
                    <label for="Email">Email</label> <br>
                    <input type="text" name="Email" id="email">
                </div>

                <div class="inputs">
                    <label for="password">Mot de passe</label> <br>
                    <input type="password" name="password" id="password">
                </div>

                <div>
                    <input type="submit" value="Enregistrer" id="submit">
                    <input type="reset" value="Annuler" id="reset" onclick="hideall()">
                </div>

            </form>

        <form action="subpages/register.php" method="post" id="register_form">
            <div class="inputs">
                <label for="Pseudo">Pseudo</label><br>
                <input type="text" name="Pseudo" id="pseudo">
            </div>
            <div class="inputs">
                <label for="Email">Email</label><br>
                <input type="text" name="Email" id="email">
            </div>
            <div class="inputs">
                <label for="Password">Mot de passe</label><br>
                <input type="password" name="Password" id="password">
            </div>
            <div class="inputs">
                <label for="ligue">Ligue</label><br>
                <select name="ligue" id="ligue">
                    <option value="foot" selected>Football</option>
                    <option value="basket">Basket</option>
                    <option value="volley">Volleyball</option>
                    <option value="rugby">Rugby</option>
                </select>
            </div>
            <div>
                <input type="submit" value="Enregistrer" id="submit">
                <input type="reset" value="Annuler" id="reset" onclick="hideall()">
            </div>
        </form>
        -->
    </div>


<script>

    const login_form    = document.getElementById("login_form");
    const register_form = document.getElementById("register_form");
    const popup_form    = document.getElementById("pop-up_form");
    const overlay       = document.getElementById("overlay");

        function default_show() {
            popup_form.style.display = "block";
            overlay.style.display = "block";
        }

        function show_login() {
            register_form.style.display = "none";
            login_form.style.display = "block";
            default_show();
        }

        function show_register() {
            login_form.style.display = "none";
            register_form.style.display = "block";
            default_show();
        }

        function hideall() {
            login_form.style.display = "none";
            register_form.style.display = "none";
            popup_form.style.display = "none";
            overlay.style.display = "none";
            login_form.reset();
            register_form.reset();
        }
    </script>
</body>

</html>
