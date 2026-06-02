<?php
include('config/conexion.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $password = $_POST['password']; // En un entorno real, usa password_verify()

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conexion, $query);
    $user = mysqli_fetch_assoc($result);

    // Verificación simple (asegúrate de que las contraseñas coincidan)
    if ($user && $password == $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role_id'] = $user['role_id'];
        
        // Redirección según rol (1: Admin, 2: Chef, 3: Waiter, 4: Client)
        header("Location: dashboard.php");
    } else {
        echo "Credenciales incorrectas.";
    }
}
?>
<!-- Tu formulario HTML simple aquí -->
<form method="POST">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Contraseña">
    <button type="submit">Ingresar</button>
</form>