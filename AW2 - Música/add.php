<?php
  
  session_start();
  require 'db.php';
  if (isset($_SESSION['user_id'])) {

  $message = '';

    if (!empty($_POST['album']) && !empty($_POST['song']) && !empty($_POST['btn1'])) {
      $sql = "INSERT INTO aux (canción, lreprod) VALUES (:song, :album)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':song', $_POST['song']);
      $stmt->bindParam(':album', $_POST['album']);

      if ($stmt->execute()) {
        $message = 'Se ha añadido correctamente';
      } else {
        $message = 'Lo sentimos, ha habido un problema al añadirla';
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

    <h1>Añadir canciones a un álbum</h1>
    <form action="add.php" method="post">
      <select name = "album">

      <?php
        $album = "SELECT * FROM lreprod";
        $consulta = $conn->query($album);
        $fila1=$consulta->fetchAll(PDO::FETCH_ASSOC);
      ?>

      <option id = "opt">Álbum</option>

      <?php foreach ($fila1 as $op): ?>
        <option value = "<?php echo $op['ID']?>"><?php echo $op['Nombre']?></option>
      <?php endforeach ?>

    </select>

    <select name = "song">

      <?php
        $song = "SELECT * FROM canciones";
        $consulta = $conn->query($song);
        $fila2=$consulta->fetchAll(PDO::FETCH_ASSOC);
      ?>

      <option id = "opt">Canción</option>

      <?php foreach ($fila2 as $op2): ?>
        <option value = "<?php echo $op2['ID']?>"><?php echo $op2['Título']?></option>
      <?php endforeach ?>

    </select>

    <br><br><input name = "btn1" type="submit" value="Añadir">
    </form>

  </body>
</html>