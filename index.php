<?php
require_once 'vendor/autoload.php';
require_once 'core/bootstrap.php'; 

use dwes\core\App;
use dwes\core\Request;
use dwes\app\exceptions\NotFoundException;

try {
    require App::get('router')->direct(Request::uri(), Request::method());
    
} catch (NotFoundException $notFoundException) {
    die($notFoundException->getMessage());
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}