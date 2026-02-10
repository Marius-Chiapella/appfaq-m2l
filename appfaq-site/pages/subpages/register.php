<?php
$_SESSION['username'] = $row['pseudo'];
header('Location: ../index.php');
?>