<?php
// 1. Aseguramos que solo el cliente pueda estar aquí
session_start();
include('includes/auth.php'); // Esto verifica que la sesión esté activa

// Verificación adicional de rol (seguridad extra)
if ($_SESSION['role_id'] != 4) {
    echo "No tienes permiso para acceder a esta página.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Mi Restaurante</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="logout.php">Cerrar Sesión</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center">Bienvenido, Cliente</h1>
    <p class="text-center">Aquí podrás ver tus pedidos y realizar nuevas órdenes.</p>
    
    <div class="row mt-4">
        <div class="col-md-6 offset-md-3">
            <div class="card p-4">
                <h5>Opciones disponibles:</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Ver menú</li>
                    <li class="list-group-item">Mis pedidos recientes</li>
                    <li class="list-group-item">Editar perfil</li>
                </ul>
            </div>
        </div>
    </div>
</div>

</body>
</html>