<?php

  session_start();
  require 'db.php';

  if (isset($_SESSION['user_id'])) {

    $sql = "INSERT INTO lreprod (Nombre, RutaImg, UserID) VALUES (:nom, :rutaImg, :userID)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':nom', $_POST['Nombre']);
      $stmt->bindParam(':rutaImg', $_POST['RutaImg']);
      $stmt->bindParam(':userID', $_SESSION['user_id']);
      if ($stmt->execute()) {
        $message = 'Se ha añadido correctamente';
      } else {
        $message = 'Lo sentimos, ha habido un problema al añadirla';
      }

  }
?>