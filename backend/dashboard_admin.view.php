<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema gestor de tareas</title>
    <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/administrador.css">
</head>
<body>
    <div class="container">
        <header>
            <h1 class="center">Sistema gestor de tareas</h1>
            <h2 class="center">Bienvenido Administrador</h2>
        </header>
        <form action="" method="post">
            <input type="submit" name="salir" value="Cerrar sesión">
        </form>
    </div>
    <div class="container">
        <?php
            include 'dashboard_admin.php'
        ?>
        <h3>Crear usuario</h3>
        <form method="post">
            <input type="text" name="nombre" placeholder="Nombre de usuario" required>
            <input type="text" name="email" placeholder="Email del usuario" required>
            <input type="submit" name="crear_usuario" value="Agregar usuario">
        </form>

        <h3>Eliminar usuario</h3>
        <form method="post">
            <input type="number" name="id_usuario" placeholder="ID del usuario a eliminar" required>
            <input type="submit" name="eliminar_usuario" value="Eliminar usuario">
        </form>

        <h3>Asignar roles a usuarios</h3>
        <form method="post">
            <input type="number" name="id_usuario" placeholder="ID del usuario" required>
            <select name="rol" required>
                <option value="1">Administrador</option>
                <option value="2">Gerente de proyecto</option>
                <option value="3">Miembro de equipo</option>
            </select>
            <input type="submit" name="asignar_rol" value="Asignar rol">
        </form>
    </div>
    <script src="./bootstrap/bootstrap.bundle.min.js"></script>
    <script src="./bootstrap/popper.min.js"></script>
</body>
</html>