<?php
session_start();
require_once 'config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; 
    $dish_id = mysqli_real_escape_string($conexion, $_POST['dish_id']);
    
    // Ahora usamos 0 en lugar de 'Pendiente' para coincidir con tu BD
    $status = 0; 

    $query = "INSERT INTO orders (user_id, dish_id, status) VALUES ('$user_id', '$dish_id', '$status')";
    
    if (mysqli_query($conexion, $query)) {
        header("Location: client_panel.php?orden_exitosa=1");
        exit();
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>