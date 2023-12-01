<?php
    // Código del backend del Gerente de proyecto
    require_once '../functions.php';
    $config = require '../public/configuracion.php';

    $conexion = dbConnectmysqli($config['database']);

    // Crear tareas
    if (isset($_POST['crear_tarea'])) {
        $titulo = $_POST['titulo']; // Se obtiene el título de la tarea
        $descripcion = $_POST['descripcion']; // Se obtiene la descripción de la tarea
        $estado = 0; // Estado por defecto (Pendiente)

        $sql = "INSERT INTO tareas(titulo, descripcion, estado) VALUES ('$titulo','$descripcion','$estado')";
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

    // Asignar Tarea
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Se obtendrían los datos del formulario
        $tarea_id = $_POST["tarea"];
        $miembro_id = $_POST["miembro"];
    
        // Se prepararía la consulta para obtener la información de la tarea
        $tarea_query = "SELECT * FROM tareas WHERE id = ?";
        $tarea_statement = $conexion->prepare($tarea_query);
        $tarea_statement->bind_param("i", $tarea_id);
        $tarea_statement->execute();
        $tarea_result = $tarea_statement->get_result();
        $tarea = $tarea_result->fetch_assoc();
        $tarea_statement->close();
    
        // Se prepararía la consulta para obtener la información del miembro del equipo
        $miembro_query = "SELECT * FROM usuarios WHERE id = ?";
        $miembro_statement = $conexion->prepare($miembro_query);
        $miembro_statement->bind_param("i", $miembro_id);
        $miembro_statement->execute();
        $miembro_result = $miembro_statement->get_result();
        $miembro = $miembro_result->fetch_assoc();
        $miembro_statement->close();
    
        // Ejemplo de mensaje de éxito
        echo "La tarea " . $tarea['titulo'] . " ha sido asignada a " . $miembro['nombre'] . " correctamente.";
    } else {
        // Si se intenta acceder a este archivo directamente sin enviar los datos del formulario, se redirigiría al index.php
        header("Location: index.php");
        exit;
    }

    // Cambiar de estado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Se obtendrían los datos del formulario
        $tarea_id = $_POST["tarea_id"];
        $nuevo_estado = $_POST["nuevo_estado"];
    
        // Se prepararía la consulta para obtener la información de la tarea
        $query = "SELECT * FROM tareas WHERE id = ?";
        
        // Se prepararía la declaración
        $statement = $conexion->prepare($query);
        
        // Se enlazaría el parámetro y se ejecutaría la consulta
        $statement->bind_param("i", $tarea_id);
        $statement->execute();
    
        // Se obtendrían los resultados de la consulta
        $result = $statement->get_result();
        $tarea = $result->fetch_assoc();
    
        // Se cerraría la declaración
        $statement->close();
    
        // Luego, se prepararía la consulta para actualizar el estado de la tarea
        $update_query = "UPDATE tareas SET estado = ? WHERE id = ?";
        $update_statement = $conexion->prepare($update_query);
        $update_statement->bind_param("si", $nuevo_estado, $tarea_id);
        $update_statement->execute();
        $update_statement->close();
    
        // Ejemplo de mensaje de éxito
        echo "El estado de la tarea " . $tarea['titulo'] . " ha sido actualizado a $nuevo_estado correctamente.";
    } else {
        // Si se intenta acceder a este archivo directamente sin enviar los datos del formulario, se redirigiría al index.php
        header("Location: index.php");
        exit;
    }


    // Consulta para obtener la lista de tareas con sus IDs y datos (titulo, descripción y estado)
    $sql = "SELECT `id`, `titulo`, `descripcion`, `estado` FROM `tareas`";
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