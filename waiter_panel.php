<?php
include('includes/auth.php');
include('includes/header.php');
require_once 'config/conexion.php';

if ($_SESSION['role_id'] != 3) {
    die("Acceso denegado.");
}
?>

<div class="container mt-4">
    <h2 class="text-center">Panel del Mesero: Pedidos Listos</h2>
    <table class="table table-hover mt-4">
        <thead>
            <tr><th>ID Pedido</th><th>Plato</th><th>Cliente</th><th>Acción</th></tr>
        </thead>
        <tbody>
            <?php
            // Ahora sí usamos JOIN para traer los datos de las otras tablas
            $query = "SELECT orders.id, dishes.name AS nombre_plato, users.username, orders.status 
                      FROM orders 
                      JOIN dishes ON orders.dish_id = dishes.id 
                      JOIN users ON orders.user_id = users.id 
                      WHERE orders.status = 1"; // 1 es 'Listo'

            $result = mysqli_query($conexion, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($order = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$order['id']}</td>
                        <td>{$order['nombre_plato']}</td>
                        <td>{$order['username']}</td>
                        <td>
                            <a href='update_order.php?id={$order['id']}&accion=pagado' class='btn btn-primary btn-sm'>Confirmar Pago</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>No hay pedidos listos.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php include('includes/footer.php'); ?>