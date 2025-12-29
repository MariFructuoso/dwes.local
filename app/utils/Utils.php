<?php
namespace dwes\app\utils;

class Utils {
    
    public static function esOpcionMenuActiva($opcion) {
        $actual = explode('/', $_SERVER['REQUEST_URI']);
        $actual = '/' . end($actual); 
        
        if(strpos($actual, '?') !== false){
            $actual = substr($actual, 0, strpos($actual, '?'));
        }

        if ($actual === $opcion) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param array $lista
     * @param int $cantidad
     * @return array|null
     */
    public static function extraeElementosAleatorios($lista, $cantidad)
    {
        if ($cantidad < 1 || sizeof($lista) == 0) {
            return null;
        } else {
            shuffle($lista);
            $listaNueva = array_chunk($lista, $cantidad);
            return $listaNueva[0]; 
        }
    }
}