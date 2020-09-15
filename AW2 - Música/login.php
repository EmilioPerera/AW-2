<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /Examen AW/music.php');
  }
  require 'db.php';

  if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT ID, Nombre, Contraseña FROM usuarios WHERE Nombre = :username');
    $records->bindParam(':username', $_POST['username']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if (count($results) > 0 && $_POST['password'] === $results['Contraseña']) {
      $_SESSION['user_id'] = $results['ID'];
      header("Location: /Examen AW/music.php");
    } else {
      $message = 'Lo siento, los datos introducidos no son correctos';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/web.css">
  </head>
  <body>
    <?php require 'header.php' ?>

    <h1>Login</h1>
    <span>Si todavía no tienes cuenta <a href="signup.php">regístrate</a></span>

    <form action="login.php" method="POST">
      <input name="username" type="text" placeholder="Introduce tu nombre de usuario">
      <input name="password" type="password" placeholder="Introduce tu contraseña">
      <input type="submit" value="Entrar">
    </form>
  </body>
</html>