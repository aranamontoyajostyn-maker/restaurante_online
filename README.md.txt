Características principales
Roles de usuario: Sistema de autenticación con tres perfiles distintos:

Cliente: Realiza pedidos.

Chef: Gestiona la cocina y marca pedidos como "Listos".

Mesero: Gestiona el servicio y confirma los pagos.

Flujo de estados automatizado:

0 (Pendiente): El pedido llega a la cocina.

1 (Listo): El plato está terminado.

2 (Pagado): El pedido se completa y sale del sistema.

Gestión de Platos: Panel administrativo para crear y desactivar platos (eliminación lógica mediante is_active).

🛠 Tecnologías utilizadas
Backend: PHP

Base de datos: MySQL (phpMyAdmin)

Frontend: Bootstrap (para un diseño responsivo)

Servidor local: XAMPP

Estructura de la Base de Datos
Para ejecutar el proyecto, asegúrate de tener una base de datos llamada restaurante_online y las siguientes tablas principales:

users (id, username, password, role_id)

dishes (id, name, is_active)

orders (id, user_id, dish_id, status)

roles (id, name)

 Cómo instalar
Clona este repositorio en tu carpeta htdocs de XAMPP.

Importa el archivo SQL para crear la base de datos restaurante_online.

Asegúrate de que las credenciales de conexión en config/conexion.php sean correctas.

Inicia Apache y MySQL desde el Panel de Control de XAMPP.

Accede al sistema a través de http://localhost/nombre_de_tu_carpeta/login.php.