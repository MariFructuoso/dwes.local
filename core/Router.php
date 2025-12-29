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
    /**
     * Procesa la URI y decide qué controlador ejecutar.
     * Soporta rutas con parámetros (ej: galeria/:id)
     */
    public function direct(string $uri, string $method): void
    {
        // Recorremos las rutas registradas para ese método (GET o POST)
        foreach ($this->routes[$method] as $route => $controller) {
            
            // Convertimos la ruta registrada (galeria/:id) en una Expresión Regular
            $urlRule = $this->prepareRoute($route);
            
            // Comprobamos si la URI actual coincide con esa regla
            if (preg_match($urlRule, $uri, $matches) === 1) {
                
                // Extraemos los parámetros reales de la URL (el valor del ID)
                $parameters = $this->getParametersRoute($route, $matches);
                
                // Separamos el nombre del Controlador y el Método (Action)
                // Esperamos el formato 'Controlador@metodo'
                list($controllerClass, $action) = explode('@', $controller);
                
                // Llamamos a la acción pasando los parámetros
                if ($this->callAction($controllerClass, $action, $parameters) === true) {
                    return; // Si se ejecutó correctamente, salimos
                }
            }
        }

        // Si termina el bucle y no hubo coincidencia, lanzamos excepción
        throw new NotFoundException("No se ha definido una ruta para la uri solicitada");
    }

    /**
     * Instancia el controlador y ejecuta la acción pasando los parámetros
     */
    private function callAction(string $controller, string $action, array $parameters): bool
    {
        try {
            // Construimos el nombre completo de la clase incluyendo el namespace
            $controllerClass = App::get('config')['project']['namespace'] . '\\app\\controllers\\' . $controller;
            
            $objController = new $controllerClass();

            if (!method_exists($objController, $action)) {
                throw new NotFoundException("El controlador $controller no responde al action $action");
            }

            // Llamamos al método del controlador pasándole el array de parámetros
            call_user_func_array([$objController, $action], $parameters);
            
            return true;
        } catch (\TypeError $typeError) {
            // Si hay un error de tipos (ej: parámetros incorrectos), devolvemos false para seguir buscando rutas
            return false;
        }
    }

    /**
     * Prepara la expresión regular sustituyendo los parámetros :param por patrones regex
     */
    private function prepareRoute(string $route): string
    {
        // Busca patrones como :id y los reemplaza por una captura regex (?<id>[^/]+)
        $urlRule = preg_replace('/:([^\/]+)/', '(?<\1>[^/]+)', $route);
        $urlRule = str_replace('/', '\/', $urlRule);
        
        return '/^' . $urlRule . '\/*$/s';
    }

    /**
     * Extrae los valores de los parámetros capturados
     */
    private function getParametersRoute(string $route, array $matches): array
    {
        preg_match_all('/:([^\/]+)/', $route, $parameterNames);
        
        // Mapea los nombres de los parámetros con sus valores encontrados en $matches
        $parameterNames = array_flip($parameterNames[1]);
        
        // Devuelve solo las coincidencias que son parámetros nombrados
        return array_intersect_key($matches, $parameterNames);
    }

    public function redirect(string $path)
    {
        header('location: /' . $path);
    }
}
?>