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
            $query = "SELECT id, name, username, status FROM orders WHERE status = 'Pending'";
            $result = mysqli_query($conexion, $query);
            while ($order = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$order['username']}</td>
                    <td>{$order['name']}</td>
                    <td><span class='badge bg-warning'>{$order['status']}</span></td>
                    <td>
                        <a href='update_order.php?id={$order['id']}&accion=listo' class='btn btn-success btn-sm'>Marcar como Listo</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php include('includes/footer.php'); ?>