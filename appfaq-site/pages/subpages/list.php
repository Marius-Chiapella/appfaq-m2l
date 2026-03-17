<?php
include "fonctions.inc.php";
session_start();
$titre = "Liste";
// Redirige vers la page de connexion si on n'est pas connecté
if (!isset($_SESSION['user'])) {
  header("Location: ../index.php");
  exit();
} else {
  $id = strval($_SESSION['user']['id_user']);
}

// Connexion à la base de données
$dbh = connexion();
// Liste des utilisateurs
$sql = "select * from v_faq
        WHERE id_user = :id;";
try {
  $sth = $dbh->prepare($sql);
  $sth->execute(array(':id' => $id));
  $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
  die("Erreur lors de la requête SQL : " . $ex->getMessage());
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProjetM2L</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="main.css"> 
</head>
<body>

    <div class="barre_haute ">
        <h2>AppFaq - M2L</h2>
        <a href="disconnect.php">Se déconnecter</a>
        <a href="../index.php">Accueil</a>
    </div>

  <div class="content">
    <h1><?= $titre ?></h1>
    <h1>M2L-list</h1>
    <p>User : <?= $_SESSION['user']['pseudo'] ?></p>
    <?php
    if (empty($rows)) {
      echo "<p> Vous n'avez aucun message pour l'instant !";
    } else {
      echo "<table>
      <tr>
        <th>NR</th>
        <th>Auteur</th>
        <th>Question</th>
        <th>Réponse</th>
      </tr>";
      foreach ($rows as $row) {
        echo "<tr><td>" . $row['id_user'] . "</td><td>" . $row['pseudo'] . "</td><td>" . $row['question'] . "</td><td>" . $row['reponse'] . "</td>";
      }
      echo "</table>";
    }
    ?>
    <br> <br>
    <a href="list_subpages/add.php">Page add</a> <br>
  </div>

  <div class="footer">
    <p>Copyright : Théliau, Anthony, Marius, Liam</p>
  </div>

</body>

</html>