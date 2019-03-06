
<?php

session_start();

if (isset($_SESSION['nombre']) && $_SESSION['loggedin'] == true) {

} else {
  header('Location: ../accesodenegado.php');
   exit;
}

$now = time();

if($now > $_SESSION['expire']) {
session_destroy();

echo 'Su sesión ha terminado,
<a href="login.php">volver al Login</a>';
exit;
}
?>
