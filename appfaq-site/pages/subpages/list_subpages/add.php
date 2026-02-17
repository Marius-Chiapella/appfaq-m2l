<?php
$titre = "Ajouter question";
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
        <a href="#">Link</a>
        <a href="#">Link</a>
        <a href="#">Link</a>
    </div>

    <div class="content">
        <h1><?= $titre ?></h1>
        <a href="../../index.php">Accueil</a> <br> <br> <br>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <textarea name="question" id="question" cols="100" rows="20" style="resize: none;"></textarea>
        </form>
    </div>

    <div class="footer">
        <p>placeholder</p>
    </div>

</body>

</html>