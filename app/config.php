<?php
return [
    'database' => [
        'name' => 'cursophp', // Asegúrate de que tu BBDD se llama así
        'username' => 'root', // El usuario jefe de XAMPP
        'password' => '',     // En XAMPP la contraseña suele estar vacía
        'connection' => 'mysql:host=127.0.0.1', // Usamos IP para evitar problemas con localhost
        'options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true
        ]
    ],
    'logs' => [
        'filename' => 'curso.log',
        'level' => \Monolog\Level::Info
    ],
    'routes' => [
        'filename' => 'routes.php'
    ],
    'project' => [
        'namespace' => 'dwes'
    ],
    'security' => [
        'roles' => [
            'ROLE_ADMIN' => 3,     
            'ROLE_USER' => 2,       
            'ROLE_ANONYMOUS' => 1   
        ]
    ]
];
