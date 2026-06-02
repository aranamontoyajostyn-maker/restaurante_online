<div class="container mt-4">
    <h2 class="text-center mb-4">Nuestro Menú</h2>
    <div class="row">
        <?php
        // Asegúrate de incluir la conexión antes de esta consulta
        require_once 'config/conexion.php'; 

        $query_dishes = "SELECT name, description, price FROM dishes";
        $result_dishes = mysqli_query($conexion, $query_dishes);

        if (mysqli_num_rows($result_dishes) > 0) {
            while ($dish = mysqli_fetch_assoc($result_dishes)) {
                echo '
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">' . htmlspecialchars($dish['name']) . '</h5>
                            <p class="card-text text-muted">' . htmlspecialchars($dish['description']) . '</p>
                            <p class="card-text fw-bold">Precio: $' . number_format($dish['price'], 2) . '</p>
                            <button class="btn btn-outline-success w-100">Agregar al Pedido</button>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<p class="text-center">No hay platos disponibles en este momento.</p>';
        }
        ?>
    </div>
</div>