<?php

    require_once '../functions.php';
    $config = require '../public/configuracion.php';

    $conexion = dbConnectmysqli($config['database']);

    // Crear usuario
    if (isset($_POST['crear_usuario'])) {
        $nombre = $_POST['nombre']; // Se obtiene el nombre del usuario
        $email = $_POST['email']; // Se obtiene el email del usuario
        $contrasena = '12345'; // Contraseña por defecto
        $w_contrasena = md5($contrasena); // Codificación a MD5 de la contraseña
        $rol = 3; // Rol por defecto

        $sql = "INSERT INTO `usuarios` (`nombre`, `email`, `contrasena`, `rol_id`) VALUES ('$nombre', '$email', '$w_contrasena', '$rol')";
        $result = mysqli_query($conexion,$sql);

        if ($result === TRUE) {
            echo '<script>';
            echo '  alert("Usuario creado con éxito");';
            echo '</script>';
        } else {
            echo '<script>';
            echo '  alert("<?= "Error al crear usuario: " . $conexion->error?>");';
            echo '</script>';
        }
    }

    // Eliminar usuario
    if (isset($_POST['eliminar_usuario'])) {
        $id_usuario = $_POST['id_usuario'];

        $sql = "DELETE FROM `usuarios` WHERE id = $id_usuario";

        if ($conexion->query($sql) === TRUE) {
            echo '<script>';
            echo '  alert("Usuario eliminado con éxito.");';
            echo '</script>';
        } else {
            echo '<script>';
            echo '  alert("<?= "Error al eliminar al usuario: " . $conexion->error?>");';
            echo '</script>';
        }
    }

    // Asignar un rol a los usuarios
    if (isset($_POST['asignar_rol'])) {
        $id_usuario = $_POST['id_usuario'];
        $rol = $_POST['rol'];

        $sql = "UPDATE usuarios SET rol_id = $rol WHERE id = $id_usuario";

        if ($conexion->query($sql) === TRUE) {
            echo '<script>';
            echo '  alert("Rol de usuario asignado con éxito");';
            echo '</script>';
        } else {
            echo '<script>';
            echo '  alert("<?= "Error al asignar el rol al usuario: " . $conn->error?>");';
            echo '</script>';
        }
    }

    // Consulta para obtener la lista de usuarios con sus IDs y datos (nombre, email, contraseña y rol)
    $sql = "SELECT `id`, `nombre`, `email`, `contrasena`, `rol_id` FROM `usuarios`";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Lista de Usuarios</h3>";
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            if ($row["rol_id"] == 1){
                $rol = "Administrador";
            } elseif ($row["rol_id"] == 2) {
                $rol = "Gerente de proyecto";
            } else {
                $rol = "Miembro de equipo";
            }
            echo "<li>ID: " . $row["id"] . " - Nombre: " . $row["nombre"] . " - Email: " . $row["email"] . " - Contraseña: " . $row["contrasena"] . " - Rol: " . $rol . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<h3>Lista de Usuarios</h3>";
        echo "No se encontraron usuarios.";
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