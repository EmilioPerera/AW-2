<?php
  session_start();

  require 'db.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT ID, Nombre, Contraseña FROM usuarios WHERE ID = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Música UCM</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/web.css">
  </head>
  <body>

    <?php if(!empty($user)): ?>
      <br> Bienvenido a Música UCM <?= $user['Nombre']; ?> ! </br>
      <a href="logout.php"> Cerrar sesión </a>
    <?php else: ?>
      <h1>Bienvenido a Música UCM</h1>
      <h2>Por favor, inicia sesión o regístrate</h2>

      <a href="login.php">Login</a> or
      <a href="signup.php">Registrarse</a>
    <?php endif; ?>
  </body>
</html>