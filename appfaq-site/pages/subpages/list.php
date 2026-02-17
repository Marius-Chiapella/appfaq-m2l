<?php
include "fonctions.inc.php";
session_start();
$titre = "Liste";
// Redirige vers la page de connexion si on n'est pas connecté
if (!isset($_SESSION['user'])) {
  header("Location: ../index.php");
  exit();
} else {
  // $username = strval($_SESSION['user']);
  $username = "jef";
}

// Connexion à la base de données
$dbh = connexion();

// Liste des utilisateurs
$sql = "select * from v_faq
        WHERE pseudo = :user;";
try {
  $sth = $dbh->prepare($sql);
  $sth->execute(array(':user' => $username));
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
  <link rel="stylesheet" href="style.css">
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
    <h1>M2L-list</h1>
    <p>User : <?= $username ?></p>
    <table>
      <tr>
        <th>NR</th>
        <th>Auteur</th>
        <th>Question</th>
        <th>Réponse</th>
      </tr>
      <?php
      foreach ($rows as $row) {
        echo "<tr><td>" . $row['id_user'] . "</td><td>" . $row['pseudo'] . "</td><td>" . $row['question'] . "</td><td>" . $row['reponse'] . "</td>";
      }
      ?>
    </table>
    </table>
    <a href="list_subpages/add.php">Page add</a> <br>
  </div>

  <div class="footer">
    <p>placeholder</p>
  </div>

</body>

</html>