<?php 

    // ---- Determino si estoy en localhost de mi computador o en nube PRODUCCIÓN

    if ( $_SERVER['HTTP_HOST'] == 'tarea1ubepwa.site' ) // ---------- Equipo Local
    {
        // ---------- BD Nube

        return [
            'database' => [
                'type' => 'mysql',
                'host' => '127.0.0.1',
                'database' => 'u499008041_calificaciones',
                'user' => 'u499008041_pwa',
                'password' => 'Ubepwa2023',
                'server' => 'localhost',
                'site' => 'tarea1ubepwa.site',
            ],
        ];
        

    }
    else // ------------------------------------------------- Nube
    {
        // ---------- BD Local

        return [
            'database' => [
                'type' => 'mysql',
                'host' => '127.0.0.1',
                'database' => 'gestor_de_tareas',
                'user' => 'root',
                'password' => 'ube2023',
                'server' => 'localhost',
                'site' => 'http://localhost/gestion_de_tareas',
            ],
        ];

    }



?>