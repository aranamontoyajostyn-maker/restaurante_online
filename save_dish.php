<?php
require_once 'config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conexion, $_POST['name']);
    $price = mysqli_real_escape_string($conexion, $_POST['price']);
    $description = mysqli_real_escape_string($conexion, $_POST['description']);

    // En tu archivo save_dish.php, cambia tu INSERT a esto:
$query = "INSERT INTO dishes (name, price, description, is_active) VALUES ('$name', '$price', '$description', 1)";
    if (mysqli_query($conexion, $query)) {
        header("Location: add_dish.php?success=1");
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>