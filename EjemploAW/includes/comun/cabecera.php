<?php
use es\ucm\fdi\aw;

function mostrarSaludo() {
  $html = '';
  $app = aw\Aplicacion::getSingleton();
  if ($app->usuarioLogueado()) {
    $nombreUsuario = $app->nombreUsuario();
    $logoutUrl = $app->resuelve('/logout.php');
    $html = "Bienvenido, ${nombreUsuario}.<a href='${logoutUrl}'>(salir)</a>";
  } else {
    $loginUrl = $app->resuelve('/login.php');
    $registroUrl = $app->resuelve('/procesarRegistro.php');
    $html = "Usuario desconocido. <a href='${loginUrl}'>Login</a> <a href='${registroUrl}'>Regístrate</a>";
  }

  return $html;
}

?>
<div id="cabecera">
	<h1>Mi gran página web</h1>
	<div class="saludo">
	  <?=	mostrarSaludo() ?>
	</div>
</div>

