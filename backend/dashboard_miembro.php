<?php
    // Código del backend del Miembro del equipo
    require_once '../functions.php';
    $config = require '../public/configuracion.php';

    $conexion = dbConnectmysqli($config['database']);

    // Actualizar el estado de las tareas
    if (isset($_POST['actualizar_estado'])) {
        $id_tarea = $_POST['id_tarea'];
        $estado = $_POST['estado'];

        $sql = "UPDATE tareas SET estado = $estado WHERE id = $id_tarea";

        if ($conexion->query($sql) === TRUE) {
            echo '<script>';
            echo '  alert("Tarea actualizada con éxito");';
            echo '</script>';
        } else {
            echo '<script>';
            echo '  alert("<?= "Error al actualizar la tarea: " . $conn->error?>");';
            echo '</script>';
        }
    }

    // Consulta para obtener la lista de tareas con sus IDs y datos (titulo, descripción y estado)
    $usuario_id = $_SESSION['g_usuario_id_activo'];
    $sql = "SELECT `id`, `titulo`, `descripcion`, `estado` FROM `tareas` WHERE usuario_id = '$usuario_id'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Lista de Tareas</h3>";
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            $estado = $row["estado"] == 0 ? "Pendiente" : "Completado";
            echo "<li>ID: " . $row["id"] . " - Título: " . $row["titulo"] . " - Descripción: " . $row["descripcion"] . " - Estado: " . $estado . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<h3>Lista de Tareas</h3>";
        echo "No se encontraron tareas.";
    }

    $conexion->close();
    ?>