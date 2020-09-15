<?php

  session_start();
  require 'db.php';
  if (isset($_SESSION['user_id'])) {

  $message = '';

    if (!empty($_POST['delete'])) {
      $sql = "DELETE FROM lreprod WHERE Nombre = :nombre";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':nombre', $_POST['delete']);

      if ($stmt->execute()) {
        $message = 'Se ha eliminado correctamente';
      } else {
        $message = 'Lo sentimos, ha habido un problema al eliminar el álbum';
      }
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Borrar álbum</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/web.css">
  </head>
  <body>

    <?php require 'header.php' ?>
    <?php require 'db.php' ?>

    <h1>Borrar álbum</h1>
    <form action="delete.php" method="post">
      <select name = "delete">

      <?php
      include 'db.php';
        $borrar = "SELECT * FROM lreprod";
        $consulta = $conn->query($borrar);
        $fila=$consulta->fetchAll(PDO::FETCH_ASSOC);
      ?>

      <option id = "opt">Álbum</option>

      <?php foreach ($fila as $op): ?>
        <option value = "<?php echo $op['Nombre']?>"><?php echo $op['Nombre']?></option>
      <?php endforeach ?>

    </select>
    <br><br><input type="submit" value="Eliminar">
    </form>

  </body>
</html>