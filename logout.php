<?php
session_start(); // Inicia la sesión para poder destruirla
session_unset(); // Limpia todas las variables de sesión
session_destroy(); // Destruye la sesión del servidor

// Redirige al usuario a la página de inicio o login
header("Location: login.php");
exit();
?>