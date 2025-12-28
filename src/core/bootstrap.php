<?php
require_once __DIR__ . '/App.php';
$config = require_once __DIR__ . '/../../app/config.php';
App::bind('config', $config); // Guardamos la configuración en el contenedor de servicios