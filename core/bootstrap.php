<?php

require_once __DIR__ . '/../vendor/autoload.php';

use dwes\core\App;
use dwes\core\Router;
use dwes\app\utils\MyLog; 

$config = require __DIR__ . '/../app/config.php';
App::bind('config', $config); 

// 3. Cargar Rutas
$router = Router::load(__DIR__ . '/../app/routes.php');
App::bind('router', $router); 

$logger = MyLog::load(__DIR__ . '/../logs/curso.log'); 
App::bind('logger', $logger); 
?>