<?php
require_once 'vendor/autoload.php';
require_once 'core/bootstrap.php'; 

use dwes\core\Router;
use dwes\core\Request;
use dwes\app\exceptions\NotFoundException;

try {
    Router::load('app/routes.php')
        ->direct(Request::uri(), Request::method());

} catch (NotFoundException $notFoundException) {
    die($notFoundException->getMessage());
}