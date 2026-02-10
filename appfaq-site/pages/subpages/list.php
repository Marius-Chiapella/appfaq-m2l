<?php
include "fonctions.inc.php";
session_start();

// Redirige vers la page de connexion si on n'est pas connecté
if (isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
} else {
    // $username = $_SESSION['username'];
    $username = "jef";
}

// Connexion à la base de données
$dbh = connexion();

// Liste des utilisateurs
$sql = "select * from v_faq
        WHERE pseudo = 'jef';";
try {
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : ".$ex->getMessage());
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>M2L-list</title>
</head>
<body>
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
    echo "<tr><td>".$row['id_user']."</td><td>".$row['pseudo']."</td><td>".$row['question']."</td><td>". $row['reponse'] ."</td></tr>";
}
?>
  </table>
</table>
<a href="page/add.php">Page add</a> <br>
<a href="page/edit.php">Page edit</a> <br>
<a href="page/delete.php">Page delete</a> <br>

</body>
</html>