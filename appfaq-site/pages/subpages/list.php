<?php
include "fonctions.inc.php";
session_start();
$titre = "Liste";
$admin = $_SESSION['user']['id_usertype'] == 2 ? True : False;
$sup_admin = $_SESSION['user']['id_usertype'] == 3 ? True : False;

// 1) Vérification connexion
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
} else {
    $id = strval($_SESSION['user']['id_user']);
}

// 2) Connexion à la base de données
$dbh = connexion();
// Liste des utilisateurs
if(!$sup_admin) { // affiche tout si super-admin, sinon affiche la ligue de l'utilisateur
  $sql = "SELECT * FROM v_faq
        WHERE id_ligue = :id;";
} else {
  $sql = "SELECT * FROM v_faq;:id";
}
try {
  $ligue = $_SESSION['user']['id_ligue'];

  // Fonction sql préparer, protection contre l'injection sql
  $sth = $dbh->prepare($sql);
  $sth->execute(array(':id' => $ligue)); // association des variables à la requête préparée
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
    <title>ProjetM2L - <?= $titre ?></title>
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
    <p>Utilisateur : <?= $_SESSION['user']['pseudo'] ?></p>
    <?php // affichage des messages
    if (empty($rows)) {
      echo "<p> Il n'y a aucun message pour l'instant !";
    } else {
      echo "<table>
      <tr>
        <th>NR</th>
        <th>Auteur</th>
        <th> Ligue</th>
        <th>Question</th>
        <th>Réponse</th>";
      if ($admin || $sup_admin) { // verification si l'utilisateur est admin ou plus, affiche les actions et boutons en conséquence
        echo "<th> Actions </th>
            </tr>";
      } else {
        echo "</tr>";
      }
      foreach ($rows as $row) {
        echo "<tr><td>" . $row['id_user'] . "</td><td>" . $row['pseudo'] . "</td><td>" . $row['lib_ligue'] . "</td><td>" . $row['question'] . "</td><td>" . $row['reponse'] . "</td>";
        if ($admin || $sup_admin) { //de même, affiche selon les droits d'utilisateur
          echo "<td><a href='list_subpages/edit.php?id=" . $row['id_faq'] . "' title='Modifier' style='text-decoration:none;'>📝</a>
                <a href='list_subpages/delete.php?id=" . $row['id_faq'] . "' title='Supprimer' style='text-decoration:none;'onclick='return confirm('Voulez-vous vraiment supprimer cette question ?');'>🗑️</a></td>";
        }
      }
      echo "</table>";
    }
    ?>
    <br> <br>
    <a href="list_subpages/add.php">Ajouter un message</a> <br>
  </div>

    <div class="footer">
        <p>Copyright © : Théliau, Anthony, Marius, Liam - 2026</p>
    </div>

</body>
</html>