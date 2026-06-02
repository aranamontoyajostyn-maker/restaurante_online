<?php
session_start();
require_once 'config/conexion.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['accion'])) {
    $order_id = mysqli_real_escape_string($conexion, $_GET['id']);
    $accion = $_GET['accion'];

    if ($accion == 'listo' && $_SESSION['role_id'] == 2) {
        $nuevo_status = 'Listo';
        $redirect = 'chef_panel.php';
    } elseif ($accion == 'pagado' && $_SESSION['role_id'] == 3) {
        $nuevo_status = 'Pagado';
        $redirect = 'waiter_panel.php';
    } else {
        die("Acción no autorizada.");
    }

    $query = "UPDATE orders SET status = '$nuevo_status' WHERE id = '$order_id'";
    
    if (mysqli_query($conexion, $query)) {
        header("Location: $redirect?success=1");
        exit();
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>