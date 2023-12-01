<?php
    /*
        Iniciamos la sesión
    */
    session_start();

    /*
        Usaremos el archivo functions.php y cargamos también 
        el archivo de configuraciones en una variable.
    */

    require_once 'functions.php';
    $config = require './public/configuracion.php';

   
    if( isset( $_REQUEST["boton_acceso"] ) )
    {
        // Toma los datos del formulario

        $email      = $_REQUEST["email"];
        $password   = $_REQUEST["contrasena"];
        $w_password = md5($password);

        // Establecemos una conexión con la base de datos

        $conexion = dbConnectmysqli($config['database']);

        //Consulta a la base de datos

        $query = "SELECT * FROM usuarios
                    WHERE email= '$email' AND contrasena = '$w_password' ";

        $queryAdmin = mysqli_query($conexion,$query);
         
        if (mysqli_num_rows($queryAdmin) > 0) 
        {
            $usuarioAdmin = mysqli_fetch_assoc($queryAdmin);
  
            $_SESSION['g_usuario_id_activo'] = $usuarioAdmin['id'];
            $_SESSION['rol'] = $usuarioAdmin['rol_id'];
            $_SESSION['email'] = $email;
            $_SESSION['estado_sesion'] = "S";

            $_SESSION[ "g_nombre_del_usuario" ] = $usuarioAdmin['nombre']; // Corregido el nombre de la variable

            // --- A continuación decisiones de Acceso por Rol: 1 -> Administrador y 2 -> Gerente de proyecto o 3 -> Miembro del equipo
            
            if ($_SESSION['rol'] == 1) { // Corregido el operador de comparación
                // Inicia sesión el administrador
                header("Location: backend/dashboard_admin.view.php");
                exit();
            } 
            if ($_SESSION['rol'] == 2) { // Corregido el operador de comparación
                // Inicia sesión el gerente de proyecto
                header("Location: backend/dashboard_gerente.view.php");
                exit();
            } 
            if($_SESSION['rol'] == 3) {
                // Inicia sesión el miembro del equipo
                header("Location: backend/dashboard_miembro.view.php");
                exit();
            }
        } 
        else 
        {
            echo "Su email o contraseña no coincide con nuestros registros"; // Corregido el mensaje de error

            unset($_SESSION['email']);
            $_SESSION['estado_sesion'] = "N";
        }

        $queryAdmin = null;
        $conexion->close();
    }


    // --- Carga la Vista de index.php

    require 'index.view.php';
?>