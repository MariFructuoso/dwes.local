<?php
require_once 'vendor/autoload.php';
require_once 'core/bootstrap.php'; 

use dwes\core\App;
use dwes\core\Request;
use dwes\app\exceptions\AppException;

try {
    App::get('router')->direct(Request::uri(), Request::method());
} catch (AppException $appException) {
    $appException->handleError();
} catch (Exception $e) {
    die("Error crítico inesperado: " . $e->getMessage());
}