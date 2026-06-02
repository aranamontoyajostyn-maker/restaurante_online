<?php
include('includes/auth.php'); 
require_once 'config/conexion.php'; 

if ($_SESSION['role_id'] != 1) {
    header("Location: client_panel.php");
    exit();
}

include('includes/header.php');
?>

<div class="container mt-4">
    <h2 class="text-center">Panel de Administración</h2>

    <ul class="nav nav-tabs mt-4">
        <li class="nav-item">
            <a class="nav-link active" href="admin_panel.php">Historial de Pedidos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="add_dish.php">Gestionar Platos</a>
        </li>
    </ul>

    <h3 class="mt-4">Historial Global de Pedidos</h3>

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
            $query = "SELECT orders.id, users.username, dishes.name, orders.status 
                      FROM orders 
                      INNER JOIN users ON orders.user_id = users.id 
                      INNER JOIN dishes ON orders.dish_id = dishes.id 
                      ORDER BY orders.id DESC";

            $result = mysqli_query($conexion, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($order = mysqli_fetch_assoc($result)) {
                    // Lógica real: 0 es Pendiente, cualquier otro valor es Completado
                    $is_pending = ($order['status'] == 0);
                    $badge = $is_pending ? 'bg-warning' : 'bg-success';
                    $status_text = $is_pending ? 'Pendiente' : 'Completado';
                    
                    echo "<tr>
                            <td>{$order['id']}</td>
                            <td>{$order['username']}</td>
                            <td>{$order['name']}</td>
                            <td><span class='badge {$badge}'>{$status_text}</span></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>No hay pedidos registrados.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>