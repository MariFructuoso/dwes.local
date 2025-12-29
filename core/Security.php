<?php
namespace dwes\core;

use dwes\core\App;

class Security
{
    public static function isUserGranted(string $role): bool
    {
        if ($role === 'ROLE_ANONYMOUS') {
            return true; // Cualquiera puede entrar
        }

        $usuario = App::get('appUser'); // Obtenemos el usuario logueado
        
        if (is_null($usuario)) {
            return false; // No hay usuario logueado -> Acceso denegado
        }

        // Obtenemos el valor numérico del rol requerido (ej: 2)
        $valor_role = App::get('config')['security']['roles'][$role]; 
        
        // Obtenemos el valor numérico del rol del usuario (ej: 3)
        $valor_role_user = App::get('config')['security']['roles'][$usuario->getRole()];

        // Si el usuario tiene igual o más nivel, pasa
        return ($valor_role_user >= $valor_role);
    }
}