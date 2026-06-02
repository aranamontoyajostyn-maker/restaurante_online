<?php
include('includes/auth.php');
require_once 'config/conexion.php';
include('includes/header.php');

// Consulta para obtener todos los platos
$query_dishes = "SELECT * FROM dishes WHERE is_active = 1 ORDER BY id DESC";
$result_dishes = mysqli_query($conexion, $query_dishes);
?>

<div class="container mt-4">
    <h2>Gestionar Platos</h2>
    
    <ul class="nav nav-tabs mt-4">
        <li class="nav-item"><a class="nav-link" href="admin_panel.php">Historial de Pedidos</a></li>
        <li class="nav-item"><a class="nav-link active" href="add_dish.php">Gestionar Platos</a></li>
    </ul>

    <div class="card mt-4 shadow-sm">
        <div class="card-body">
            <h4>Agregar Nuevo Plato</h4>
            <form action="save_dish.php" method="POST">
                <div class="row">
                    <div class="col-md-4 mb-3"><input type="text" name="name" class="form-control" placeholder="Nombre" required></div>
                    <div class="col-md-2 mb-3"><input type="number" step="0.01" name="price" class="form-control" placeholder="Precio" required></div>
                    <div class="col-md-4 mb-3"><input type="text" name="description" class="form-control" placeholder="Descripción" required></div>
                    <div class="col-md-2"><button type="submit" class="btn btn-success w-100">Guardar</button></div>
                </div>
            </form>
        </div>
    </div>

    <h4 class="mt-4">Platos en el Menú</h4>
    <table class="table table-striped mt-2">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($dish = mysqli_fetch_assoc($result_dishes)) { ?>
            <tr>
                <td><?php echo $dish['id']; ?></td>
                <td><?php echo $dish['name']; ?></td>
                <td>$<?php echo number_format($dish['price'], 2); ?></td>
                <td><?php echo $dish['description']; ?></td>
                <td>
                    <a href="edit_dish.php?id=<?php echo $dish['id']; ?>" class="btn btn-sm btn-primary">Editar</a>
                   <a href="disable_dish.php?id=<?php echo $dish['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Desactivar este plato del menú?')">Borrar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>