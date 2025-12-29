<?php
namespace dwes\core;

use dwes\app\exceptions\NotFoundException;
use dwes\core\App;

class Router
{
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function load(string $file): Router
    {
        $router = new Router();
        require $file;
        return $router;
    }

    public function get(string $uri, string $controller): void
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post(string $uri, string $controller): void
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct(string $uri, string $method): void
    {
        if (!array_key_exists($uri, $this->routes[$method])) {
            throw new NotFoundException("No se ha definido una ruta para la uri solicitada");
        }
        if (strpos($this->routes[$method][$uri], '@') === false) {

            require $this->routes[$method][$uri];
            return;
        }

        list($controller, $action) = explode('@', $this->routes[$method][$uri]);
        $this->callAction($controller, $action);
    }

    private function callAction(string $controller, string $action): void
    {
        $controller = App::get('config')['project']['namespace'] . '\\app\\controllers\\' . $controller;
        $objController = new $controller();

        if (!method_exists($objController, $action)) {
            throw new NotFoundException("El controlador $controller no responde al action $action");
        }

        $objController->$action();
    }

    public function redirect(string $path)
    {
        header('location: /' . $path);
    }
}
?>