<?php
    
    function dbConnectmysqli($config) {
        
        // ORIGINAL return mysqli_connect('localhost', 'root', 'ube2023', 'sistema_de_calificaciones');

        return mysqli_connect($config['server'], $config['user'], $config['password'], $config['database']);

    }
    
?>