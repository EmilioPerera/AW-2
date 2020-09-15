<?php
  session_start();

  require 'db.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT ID, Nombre, Contraseña FROM usuarios WHERE ID = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $users = $records->fetch(PDO::FETCH_ASSOC);

    $records = $conn->prepare('SELECT UserID, Nombre, RutaImg FROM lreprod WHERE UserID = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $albums = $records->fetchAll(PDO::FETCH_ASSOC);

    $records = $conn->prepare('SELECT ID, Título, Autor, Duración FROM canciones');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $songs = $records->fetchAll(PDO::FETCH_ASSOC);

    $records = $conn->prepare('SELECT canción, lreprod FROM aux');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $auxs = $records->fetchAll(PDO::FETCH_ASSOC);

    $user = null;
    if (count($users) > 0) {
      $user = $users;
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
    <script src="assets/lib/jquery-3.5.1.min.js"></script>
  </head>
  <body>

    <?php if(!empty($user)): ?>
      <h2> Bienvenido a Música UCM <?= $user['Nombre']; ?>!</h2>

      <a href="logout.php"> Cerrar sesión </a><br>

      <!-- Álbumes -->
      <br><h4> Estos son los álbumes que tienes guardados: </h4>
      <table id = "tabla" border="1">
        <?php
          foreach ($albums as $album) {
        ?>
        <tr>
          <td><?php echo $album['Nombre']?></td>
        </tr>
        <?php
          }
        ?>
        </table>

        <br><a href="/Examen AW/alb.php">Ver álbumes</a><br>

        <!-- Canciones -->
        <br><h4> Estas son las canciones disponibles: </h4>
        <table id = "tabla" border="1">
          <tr>
            <td id = "tab"><b>Título</b></td>
            <td id = "tab"><b>Autor</b></td>
            <td id = "tab"><b> Duración (s) </b></td>
          </tr>
        <?php
          foreach ($songs as $song) {
            //if($song['UserID'])
        ?>
        <tr>
          <td><?php echo $song['Título']?></td>
          <td><?php echo $song['Autor']?></td>
          <td><?php echo $song['Duración']?></td>
        </tr>
        <?php
          }
        ?>
      </table>

        <!-- Canciones por álbum -->
        <h4> Álbumes: </h4>
        <table id = "tabla" border="1">
          <tr>
            <td id = "tab"><b>Álbum</b></td>
            <td id = "tab"><b>Canción</b></td>
          </tr>
        <?php
          for($i = 1; $i <= 1000; $i++){
            $albumes = "SELECT Song.ID, Song.Título,
                               Album.ID, Album.Nombre, Album.RutaImg,
                               Aux.canción, Aux.lreprod
                        FROM canciones Song
                        INNER JOIN aux Aux ON Song.ID = Aux.canción
                        INNER JOIN lreprod Album ON Album.ID = Aux.lreprod
                        WHERE Album.ID = $i";
            $consulta = $conn->query($albumes);
            while ($fila=$consulta->fetch(PDO::FETCH_ASSOC)) {
              echo'
                <tr>
                <td>'.$fila['Nombre'].'</td>
                <td>'.$fila['Título'].'</td>
                </tr>
              ';
            }
          }
        ?>
        </table>

        <!-- Canciones por álbum -->
        <h4> Álbumes: </h4>
        <?php
        $numAlb = 0;
        $numCan = 0;
        $numCanAlb = 0;
        $aux = 0;
          for($i = 1; $i <= 1000; $i++){
            $albumes = "SELECT Song.ID, Song.Título,
                               Album.ID, Album.Nombre, Album.RutaImg,
                               Aux.canción, Aux.lreprod
                        FROM canciones Song
                        INNER JOIN aux Aux ON Song.ID = Aux.canción
                        INNER JOIN lreprod Album ON Album.ID = Aux.lreprod
                        WHERE Album.ID = $i";
            $consulta = $conn->query($albumes);
            while ($fila=$consulta->fetch(PDO::FETCH_ASSOC)) {
              if($fila['Título']){
                $numCan++;
                if($aux === 0){
                  $numAlb++;
                  $aux = 1;
                }
                $arrayNom[$numAlb] = $fila['Nombre'];
                $arrayTit[$numAlb][$numCan] = $fila['Título'];
                $arrayNum[$numAlb] = $numCan;
              }
            }
            $numCan = 0;
            $aux = 0;
          }
          for($i = 1; $i <= $numAlb; $i++){
            echo "<b>" . $arrayNom[$i] . "</b>" . ": <br>";
            for($j = 1; $j <= $arrayNum[$i]; $j++)
              echo $arrayTit[$i][$j] . "<br>";
            echo "<br><br>";
          }

        ?>

        <!-- Nuevo álbum -->
        <br>
        <a href="/Examen AW/album.php">Crear nuevo álbum</a><br>
        <a href="/Examen AW/add.php">Añadir canciones a un álbum</a><br>
        <a href="/Examen AW/delete.php">Borrar álbum</a>

    <?php endif; ?>
    <br><br><h4>Añadir mediante JS un nuevo álbum:</b></h4>
    <form id="formAjax" method="POST">
      <label>Nombre</label>
      <input type="text2" name="Nombre" id = "Nombre"><br>
      <label>RutaImg</label>
      <input type="text2" name="RutaImg" id = "RutaImg"><br>
      <button id = btnAjax>Botón Ajax</button><br><br>
    </form>

  </body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    $('#btnAjax').click(function(){
      var datos = $('#formAjax').serialize();
      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: datos,
        success:function(){
        }
      });
      document.getElementById('formAjax').reset();
      return false;
    });
  });
</script>