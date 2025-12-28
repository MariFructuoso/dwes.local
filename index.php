<?php
require_once 'src/core/bootstrap.php';

try {
    require Router::load('app/routes.php')
        ->direct(Request::uri(), Request::method());
} catch (Exception $e) {
    die($e->getMessage());
}