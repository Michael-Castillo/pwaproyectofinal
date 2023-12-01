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
            <h2 class="center">Bienvenido Miembro del equipo</h2>
        </header>
        <form action="" method="post">
            <input type="submit" name="salir" value="Cerrar sesión">
        </form>
    </div>
    <div class="container">
        <?php
            include 'dashboard_miembro.php';
        ?>
        <h3>Actualizar estado de la tarea</h3>
        <form method="post">
            <input type="number" name="id_tarea" placeholder="ID de la tarea" required>
            <select name="estado" required>
                <option value="0">Pendiente</option>
                <option value="1">Completada</option>
            </select>
            <input type="submit" name="actualizar_estado" value="Actualizar estado">
        </form>
    </div>
    <script src="./bootstrap/bootstrap.bundle.min.js"></script>
    <script src="./bootstrap/popper.min.js"></script>
</body>
</html>