<?php
session_start();
require_once 'config/conexion.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['accion'])) {
    $order_id = intval($_GET['id']);
    $accion = $_GET['accion'];

    // Lógica: 1 = Listo (Chef), 2 = Pagado (Mesero)
    if ($accion == 'listo' && $_SESSION['role_id'] == 2) {
        $nuevo_status = 1;
        $redirect = 'chef_panel.php';
    } elseif ($accion == 'pagado' && $_SESSION['role_id'] == 3) {
        $nuevo_status = 2;
        $redirect = 'waiter_panel.php';
    } else {
        die("Acción no autorizada.");
    }

    // Actualización directa usando números
    $query = "UPDATE orders SET status = $nuevo_status WHERE id = $order_id";
    
    if (mysqli_query($conexion, $query)) {
        header("Location: $redirect?success=1");
        exit();
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>