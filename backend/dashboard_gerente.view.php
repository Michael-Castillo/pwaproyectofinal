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
            <h2 class="center">Bienvenido Gerente de proyecto</h2>
        </header>
        <form action="" method="post">
            <input type="submit" name="salir" value="Cerrar sesión">
        </form>
    </div>
    <div class="container">
        <?php
            include 'dashboard_gerente.php';
        ?>
        <!-- Formulario de crear tarea -->
        <h3>Crear tarea</h3>
        <form method="post">
            <input type="text" name="titulo" placeholder="Título de la tarea" required>
            <input type="text" name="descripcion" placeholder="Descripción de la tarea" required>
            <input type="number" name="usuario_id" placeholder="ID del usuario al que se le asignará la tarea" required>
            <input type="submit" name="crear_tarea" value="Crear tarea">
        </form>
        <!-- Formulario de cambiar estado -->
        <h3>Actualizar estado de la tarea</h3>
        <form method="post">
            <input type="number" name="id_tarea" placeholder="ID de la tarea" required>
            <select name="estado" required>
                <option value="0">Pendiente</option>
                <option value="1">Completada</option>
            </select>
            <input type="submit" name="actualizar_estado" value="Actualizar estado">
        </form>
        <!-- Formulario de eliminar tarea -->
        <h3>Eliminar tarea</h3>
        <form method="post">
            <input type="number" name="id_tarea" placeholder="ID de la tarea a eliminar" required>
            <input type="submit" name="eliminar_tarea" value="Eliminar tarea">
        </form>
        <!-- Formulario de asignar tarea -->
        <h3>Asignar tareas a los usuarios</h3>
        <form method="post">
            <input type="number" name="id_tarea" placeholder="ID de la tarea" required>
            <input type="number" name="id_usuario" placeholder="ID del usuario" required>
            <input type="submit" name="asignar_tarea" value="Asignar tarea">
        </form>

    </div>
    <script src="./bootstrap/bootstrap.bundle.min.js"></script>
    <script src="./bootstrap/popper.min.js"></script>
</body>
</html>