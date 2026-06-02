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
           // Consulta para el Mesero: solo los pedidos marcados como "listos" (status 1)
$query = "SELECT orders.id, users.username, dishes.name AS dish_name, orders.status 
          FROM orders 
          INNER JOIN users ON orders.user_id = users.id 
          INNER JOIN dishes ON orders.dish_id = dishes.id 
          WHERE orders.status = 1 
          ORDER BY orders.id DESC";
            $result = mysqli_query($conexion, $query);
if ($result && mysqli_num_rows($result) > 0) {
                while ($order = mysqli_fetch_assoc($result)) {
                    // AQUÍ ESTABA EL ERROR: cambiamos 'nombre_plato' por 'dish_name'
                    echo "<tr>
                            <td>{$order['id']}</td>
                            <td>{$order['dish_name']}</td> 
                            <td>{$order['username']}</td>
                            <td>
                                <a href='update_order.php?id={$order['id']}&accion=pagado' class='btn btn-primary btn-sm'>Confirmar Pago</a>
                            </td>
                        </tr>";
                }
            }
             else {
                echo "<tr><td colspan='4' class='text-center'>No hay pedidos listos.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php include('includes/footer.php'); ?>