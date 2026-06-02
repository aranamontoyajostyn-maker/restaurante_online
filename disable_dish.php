<?php
require_once 'config/conexion.php';
include('includes/auth.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Cambiamos el estado a 0 (desactivado)
    $query = "UPDATE dishes SET is_active = 0 WHERE id = $id";
    
    if (mysqli_query($conexion, $query)) {
        header("Location: add_dish.php?msg=desactivado");
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>