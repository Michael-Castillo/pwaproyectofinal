<?php
    // Código del backend del Gerente de proyecto
    require_once '../functions.php';
    $config = require '../public/configuracion.php';

    $conexion = dbConnectmysqli($config['database']);

    // Crear tareas
    if (isset($_POST['crear_tarea'])) {
        $titulo = $_POST['titulo']; // Se obtiene el título de la tarea
        $descripcion = $_POST['descripcion']; // Se obtiene la descripción de la tarea
        $usuario_id = $_POST['usuario_id'];
        $estado = 0; // Estado por defecto (Pendiente)

        $sql = "INSERT INTO `tareas`(`titulo`, `descripcion`, `estado`, `usuario_id`) VALUES ('$titulo','$descripcion','$estado', '$usuario_id')";
        $result = mysqli_query($conexion,$sql);

        if ($result === TRUE) {
            echo '<script>';
            echo '  alert("Tarea añadida con éxito");';
            echo '</script>';
        } else {
            echo '<script>';
            echo '  alert("<?= "Error al añadir la tarea: " . $conexion->error?>");';
            echo '</script>';
        }
    }

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

    // // Asignar Tarea
    if (isset($_POST['asignar_tarea'])) {
        $id_usuario = $_POST['id_usuario'];
        $id_tarea = $_POST['id_tarea'];
        
        $sql = "UPDATE tareas SET usuario_id = $id_usuario WHERE id = $id_tarea";

        if ($conexion->query($sql) === TRUE) {
            echo '<script>';
            echo '  alert("Tarea asignada con éxito");';
            echo '</script>';
        } else {
            echo '<script>';
            echo '  alert("<?= "Error al asignar la tarea al usuario: " . $conn->error?>");';
            echo '</script>';
        }
    }

    // Eliminar tarea
    if (isset($_POST['eliminar_tarea'])) {
        $id_tarea = $_POST['id_tarea'];

        $sql = "DELETE FROM `tareas` WHERE id = $id_tarea";

        if ($conexion->query($sql) === TRUE) {
            echo '<script>';
            echo '  alert("Tarea eliminada con éxito.");';
            echo '</script>';
        } else {
            echo '<script>';
            echo '  alert("<?= "Error al eliminar la tarea: " . $conexion->error?>");';
            echo '</script>';
        }
    }

    

    


    // Consulta para obtener la lista de tareas con sus IDs y datos (titulo, descripción y estado)
    $sql = "SELECT `id`, `titulo`, `descripcion`, `estado`, `usuario_id` FROM `tareas`";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Lista de Tareas</h3>";
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            $estado = $row["estado"] == 0 ? "Pendiente" : "Completado";
            echo "<li>ID: " . $row["id"] . " - Título: " . $row["titulo"] . " - Descripción: " . $row["descripcion"] . " - Estado: " . $estado . " - Id del usuario: " . $row["usuario_id"] ."</li>";
        }
        echo "</ul>";
    } else {
        echo "<h3>Lista de Tareas</h3>";
        echo "No se encontraron tareas.";
    }

    if (isset($_POST['salir'])) {
        header("Location: ../index.php");
    }

    $conexion->close();

    ?>