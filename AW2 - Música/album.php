<?php

  session_start();
  require 'db.php';
  if (isset($_SESSION['user_id'])) {

  $message = '';

    if (!empty($_POST['title']) && !empty($_POST['img'])) {
      $sql = "INSERT INTO lreprod (Nombre, RutaImg, UserID) VALUES (:title, :img, :userID)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':title', $_POST['title']);
      $stmt->bindParam(':img', $_POST['img']);
      $stmt->bindParam(':userID', $_SESSION['user_id']);

      if ($stmt->execute()) {
        $message = 'Se ha creado correctamente';
      } else {
        $message = 'Lo sentimos, ha habido un problema al crear el álbum';
      }
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nuevo álbum</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/web.css">
  </head>
  <body>

    <?php require 'header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Nuevo álbum</h1>

    <form action="album.php" method="POST">
      <input name="title" type="text" placeholder="Introduce el nombre del álbum">
      <input name="img" type="file"><br><br>
      <input type="submit" value="Añadir">
    </form>

  </body>
</html>