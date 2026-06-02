<?php
include('includes/auth.php');
require_once 'config/conexion.php'; 

include('includes/header.php'); 
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Nuestro Menú</h2>
    
    <?php if (isset($_GET['orden_exitosa'])): ?>
        <div id="mensajeExito" class="alert alert-success text-center">
            ¡Tu pedido ha sido enviado a cocina correctamente!
        </div>

        <script>
            setTimeout(function() {
                var mensaje = document.getElementById('mensajeExito');
                if (mensaje) {
                    mensaje.style.display = 'none';
                }
            }, 3000);
        </script>
    <?php endif; ?>

    <div class="row">
        <?php
        $query_dishes = "SELECT id, name, description, price FROM dishes";
        $result_dishes = mysqli_query($conexion, $query_dishes);

        if ($result_dishes && mysqli_num_rows($result_dishes) > 0) {
            while ($dish = mysqli_fetch_assoc($result_dishes)) {
                echo '
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">' . htmlspecialchars($dish['name']) . '</h5>
                            <p class="card-text text-muted">' . htmlspecialchars($dish['description']) . '</p>
                            <p class="card-text fw-bold">Precio: $' . number_format($dish['price'], 2) . '</p>
                            
                            <form action="process_order.php" method="POST">
                                <input type="hidden" name="dish_id" value="' . $dish['id'] . '">
                                <button type="submit" class="btn btn-outline-success w-100">Agregar al Pedido</button>
                            </form>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<div class="col-12 text-center alert alert-info">No hay platos disponibles en este momento.</div>';
        }
        ?>
    </div>
</div>

<?php include('includes/footer.php'); ?>