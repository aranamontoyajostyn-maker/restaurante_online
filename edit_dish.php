<?php
include('includes/auth.php');
require_once 'config/conexion.php';
include('includes/header.php');

// Si se recibe el ID, cargamos los datos del plato
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conexion, "SELECT * FROM dishes WHERE id = $id");
    $dish = mysqli_fetch_assoc($result);
}

// Si se envía el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $query = "UPDATE dishes SET name='$name', price='$price', description='$description' WHERE id=$id";
    
    if (mysqli_query($conexion, $query)) {
        header("Location: add_dish.php?msg=actualizado");
    }
}
?>

<div class="container mt-4">
    <h2>Editar Plato</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $dish['id']; ?>">
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" value="<?php echo $dish['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Precio</label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?php echo $dish['price']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control"><?php echo $dish['description']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="add_dish.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include('includes/footer.php'); ?>