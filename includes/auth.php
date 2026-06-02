<?php
session_start();
// Si no existe la sesión, lo manda a loguearse
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>