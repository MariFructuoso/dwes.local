<?php
class Utils {
    public static function esOpcionMenuActiva($opcion) {
        $actual = explode('/', $_SERVER['REQUEST_URI']);
        $actual = '/' . $actual[count($actual) - 1];
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
            // Obtenemos un array de fragmentos de tamaño cantidad
            $listaNueva = array_chunk($lista, $cantidad);
            // Devolvemos el primer fragmento del array
            return $listaNueva[0]; 
        }
    }
}
?>