<?php
// 1. Primero iniciamos la sesión (si auth.php ya lo hace, esto no molesta)
session_start();

// 2. Luego incluimos la seguridad
include('includes/auth.php');

// 3. Ya no necesitas volver a verificar !isset($_SESSION['role_id']) aquí 
// porque tu archivo 'includes/auth.php' seguramente ya hace esa comprobación.

// 4. Lógica de roles
switch ($_SESSION['role_id']) {
    case 1: header("Location: admin_panel.php"); break;
    case 2: header("Location: chef_panel.php"); break;
    case 3: header("Location: waiter_panel.php"); break;
    case 4: header("Location: client_panel.php"); break;
    default: echo "Rol no reconocido.";
}
exit(); // Siempre es buena práctica ponerlo tras las redirecciones
?>