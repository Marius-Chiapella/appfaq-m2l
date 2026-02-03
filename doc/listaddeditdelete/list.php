<?php
$placeholder = array(
    "placeholder1",
    "placeholder2",
    "placeholder3",
    "placeholder4",
    "placeholder5",
);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>M2L-list</title>
</head>
<body>
  <h1>M2L-list</h1>
  <table>
  <tr>
    <th>NR</th>
    <th>Auteur</th>
    <th>Question</th>
    <th>Réponse</th>
    <th>Action</th>
  </tr>
  <?php foreach ($placeholder as $value ) { ?>
    <tr>
      <td><?= $value ?></td>
      <td><?= $value ?></td>
      <td><?= $value ?></td>
      <td><?= $value ?> </td>
      <td><?= $value ?></td>
    </tr>
<?php } ?>
</table>
<a href="page/add.php">Page add</a> <br>
<a href="page/edit.php">Page edit</a> <br>
<a href="page/delete.php">Page delete</a> <br>

</body>
</html>