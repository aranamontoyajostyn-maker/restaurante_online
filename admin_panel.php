<?php

include('includes/auth.php'); 
// 1. CARGA LA CONEXIÓN PRIMERO
require_once 'config/conexion.php'; 

// Verificación de rol de administrador (rol 1)
if ($_SESSION['role_id'] != 1) {
    header("Location: client_panel.php");
    exit();
}

include('includes/header.php');
?>

<div class="container mt-4">
    <h2 class="text-center">Panel de Administración</h2>
    <h3 class="mt-5">Historial Global de Pedidos</h3>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Plato</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // 2. Consulta usando JOIN para unir las tablas correctamente
            // Esto evita el error de "Unknown column" al traer los nombres de las tablas correspondientes
            $query = "SELECT orders.id, users.username, dishes.name, orders.status 
                      FROM orders 
                      INNER JOIN users ON orders.user_id = users.id 
                      INNER JOIN dishes ON orders.dish_id = dishes.id 
                      ORDER BY orders.id DESC";

            // Asegúrate de que $conexion esté definida en tu archivo config/conexion.php
            $result = mysqli_query($conexion, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($order = mysqli_fetch_assoc($result)) {
                    $badge = ($order['status'] == 'Pending') ? 'bg-warning' : 'bg-success';
                    
                    echo "<tr>
                            <td>{$order['id']}</td>
                            <td>{$order['username']}</td>
                            <td>{$order['name']}</td>
                            <td><span class='badge {$badge}'>{$order['status']}</span></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>No hay pedidos registrados o error en la consulta.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>