<?php
include('includes/auth.php');
session_start();

if (!isset($_SESSION['role_id'])) {
    header("Location: login.php");
    exit();
}

// Lógica de roles
switch ($_SESSION['role_id']) {
    case 1: header("Location: admin_panel.php"); break;
    case 2: header("Location: chef_panel.php"); break;
    case 3: header("Location: waiter_panel.php"); break;
    case 4: header("Location: client_panel.php"); break;
    default: echo "Rol no reconocido.";
}
?>