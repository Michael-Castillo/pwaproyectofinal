<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema gestor de tareas</title>
    <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <header>
            <h1 class="center">Sistema gestor de tareas</h1>
            <h2 class="center">Bienvenido Gerente de proyecto</h2>
        </header>
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
            <input type="submit" name="crear_tarea" value="Crear tarea">
        </form>
        <!-- Formulario de cambiar estado -->
        <form method="post">
        <label for="tarea_id">ID de Tarea:</label>
        <input type="text" id="tarea_id" name="tarea_id"><br><br>
        <label for="nuevo_estado">Nuevo Estado:</label>
        <input type="text" id="nuevo_estado" name="nuevo_estado"><br><br>
        <input type="submit" value="Cambiar Estado">
        </form>
        <!-- Formulario de eliminar tarea -->
        <h3>Eliminar tarea</h3>
        <form method="post">
            <input type="number" name="id_tarea" placeholder="ID de la tarea a eliminar" required>
            <input type="submit" name="eliminar_tarea" value="Eliminar tarea">
        </form>
        <!-- Formulario de asignar tarea -->
        <form method="post">
        <label for="tarea">Seleccionar Tarea:</label>
        <select name="tarea">
            <?php
            $query = "SELECT id, titulo FROM tareas";
            $result = $conexion->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['titulo'] . "</option>";
            }
            ?>
        </select>
        <br>
        <label for="miembro">Seleccionar Miembro del Equipo:</label>
        <select name="miembro">
            <?php
            $query = "SELECT id, nombre FROM miembros_equipo";
            $result = $conexion->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Asignar Tarea">
    </form>

    </div>
    <script src="./bootstrap/bootstrap.bundle.min.js"></script>
    <script src="./bootstrap/popper.min.js"></script>
</body>
</html>