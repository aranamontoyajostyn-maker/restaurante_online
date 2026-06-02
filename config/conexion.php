<?php
$host = "localhost";
$user = "root";
$pass = ""; // Si no le pusiste contraseña a tu XAMPP, déjalo vacío
$db = "restaurante_online";

$conexion = mysqli_connect($host, $user, $pass, $db);

// Verificar si la conexión funciona
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>