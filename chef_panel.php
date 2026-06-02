<?php
include('includes/auth.php'); 
include('includes/header.php'); 
require_once 'config/conexion.php';

if ($_SESSION['role_id'] != 2) { die("Acceso denegado."); }
?>

<div class="container mt-4">
    <h2 class="text-center">Panel del Chef: Pedidos Pendientes</h2>
    <table class="table mt-4">
        <thead>
            <tr><th>Cliente</th><th>Plato</th><th>Estado</th><th>Acción</th></tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT orders.id, users.username, dishes.name AS dish_name, orders.status 
                      FROM orders 
                      INNER JOIN users ON orders.user_id = users.id 
                      INNER JOIN dishes ON orders.dish_id = dishes.id 
                      WHERE orders.status = 0 
                      ORDER BY orders.id DESC";

            $result = mysqli_query($conexion, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($order = mysqli_fetch_assoc($result)) {
                    // Usamos $order['dish_name'] en lugar de $order['name']
                    echo "<tr>
                            <td>{$order['username']}</td>
                            <td>{$order['dish_name']}</td> 
                            <td><span class='badge bg-warning'>Pendiente</span></td>
                            <td>
                                <a href='update_order.php?id={$order['id']}&accion=listo' class='btn btn-success btn-sm'>Marcar como Listo</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>No hay pedidos pendientes.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php include('includes/footer.php'); ?>