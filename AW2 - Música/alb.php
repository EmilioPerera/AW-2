<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ver álbum</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/web.css">
  </head>
  <body>

    <?php require 'header.php' ?>
    <?php require 'db.php' ?>

    <h1>Ver álbum</h1>
    <form action="alb.php" method="post">
      <select name = "alb">

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
    <br><br><input type="submit" value="Ver">
    </form>

  </body>
</html>

<?php

  session_start();
  require 'db.php';
  if (isset($_SESSION['user_id'])) {

  $message = '';

    if (!empty($_POST['alb'])) {
      $albumABuscar = $_POST['alb'];
      echo "<b>$albumABuscar:</b><br><br>";
      $albumes = "SELECT Song.ID, Song.Título,
                              Album.ID, Album.Nombre, Album.RutaImg,
                              Aux.canción, Aux.lreprod
                      FROM canciones Song
                      INNER JOIN aux Aux ON Song.ID = Aux.canción
                      INNER JOIN lreprod Album ON Album.ID = Aux.lreprod
                      WHERE Album.Nombre = '$albumABuscar'";
          $consulta = $conn->query($albumes);
          while ($fila=$consulta->fetch(PDO::FETCH_ASSOC)) {
            echo'
              <tr>
              <td>'.$fila['Título'].' <br></td>
              </tr>
            ';
          }
      $portada = "SELECT RutaImg FROM lreprod WHERE Nombre = '$albumABuscar'";
      $consulta2 = $conn->query($portada);
      while($fila2 = $consulta2->fetch(PDO::FETCH_ASSOC)){
        $img = $fila2['RutaImg'];
      };


      if ($consulta->execute()) {
        $message = 'Se ha eliminado correctamente';
      } else {
        $message = 'Lo sentimos, ha habido un problema al eliminar el álbum';
      }
    }
  }
?>
<br><img src = "/Examen AW/assets/img/<?php echo $img; ?>" id = "portada">