<?php
require_once 'src/core/bootstrap.php'; 
$routes = require 'app/routes.php'; 
$uri = trim($_SERVER['REQUEST_URI'], '/'); 
require $routes[$uri];