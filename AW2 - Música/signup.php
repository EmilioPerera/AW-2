<?php

  require 'db.php';

  $message = '';

  if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && $_POST['password'] === $_POST['confirm_password']) {
    $sql = "INSERT INTO usuarios (Nombre, Contraseña) VALUES (:username, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $_POST['username']);
    //$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $_POST['password']);

    if ($stmt->execute()) {
      $message = 'Se ha creado correctamente';
    } else {
      $message = 'Lo sentimos, ha habido un problema al crear la cuenta';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/web.css">
  </head>
  <body>

    <?php require 'header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registro</h1>
    <span>¿Ya tienes cuenta? <a href="login.php">Login</a></span>

    <form action="signup.php" method="POST">
      <input name="username" type="text" placeholder="Introduce tu nombre de usuario">
      <input name="password" type="password" placeholder="Introduce tu contraseña">
      <input name="confirm_password" type="password" placeholder="Confirma la contraseña">
      <input type="submit" value="Registro">
    </form>

  </body>
</html>