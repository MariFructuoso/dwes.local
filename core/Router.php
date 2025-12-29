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

    public function get(string $uri, string $controller, string $role = 'ROLE_ANONYMOUS'): void
    {
        $this->routes['GET'][$uri] = [
            'controller' => $controller,
            'role' => $role 
        ];
    }

    public function post(string $uri, string $controller, string $role = 'ROLE_ANONYMOUS'): void
    {
        $this->routes['POST'][$uri] = [
            'controller' => $controller,
            'role' => $role 
        ];
    }
    public function direct(string $uri, string $method): void
    {
        foreach ($this->routes[$method] as $route => $routerData) {
            $controller = $routerData['controller'];
            $minRole = $routerData['role']; 

            $urlRule = $this->prepareRoute($route);

            if (preg_match($urlRule, $uri, $matches)) {
                
                if (\dwes\core\Security::isUserGranted($minRole) === false) {
                    
                    if (!is_null(\dwes\core\App::get('appUser'))) {
                        throw new \dwes\app\exceptions\AuthenticationException('Acceso no autorizado');
                    } else {
                        $this->redirect('login');
                    }
                }
                $parameters = $this->getParametersRoute($route, $matches);
                list($controller, $action) = explode('@', $controller);
                
                if ($this->callAction($controller, $action, $parameters) === true) {
                    return;
                }
            }
        }

        throw new \dwes\app\exceptions\NotFoundException("No se ha definido una ruta para la uri solicitada");
    }
    private function callAction(string $controller, string $action, array $parameters): bool
    {
        try {
            $controllerClass = App::get('config')['project']['namespace'] . '\\app\\controllers\\' . $controller;
            
            $objController = new $controllerClass();

            if (!method_exists($objController, $action)) {
                throw new NotFoundException("El controlador $controller no responde al action $action");
            }

            call_user_func_array([$objController, $action], $parameters);
            
            return true;
        } catch (\TypeError $typeError) {
            return false;
        }
    }

    private function prepareRoute(string $route): string
    {
        $urlRule = preg_replace('/:([^\/]+)/', '(?<\1>[^/]+)', $route);
        $urlRule = str_replace('/', '\/', $urlRule);
        
        return '/^' . $urlRule . '\/*$/s';
    }


    private function getParametersRoute(string $route, array $matches): array
    {
        preg_match_all('/:([^\/]+)/', $route, $parameterNames);
        
        $parameterNames = array_flip($parameterNames[1]);
        
        return array_intersect_key($matches, $parameterNames);
    }

    public function redirect(string $path)
    {
        header('location: /' . $path);
        exit();
    }
}
?>