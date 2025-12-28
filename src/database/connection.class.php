<?php
require_once __DIR__ . '/../core/App.php';

class Connection
{
    /**
     * @return PDO
     * @throws AppException
     */
    public static function make()
    {
        try {
            $config = App::get('config')['database'];
            
            $connection = new PDO(
                $config['connection'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $PDOException) {
            // --- CAMBIO PARA DEPURAR ---
            // En lugar de lanzar una excepción genérica, imprimimos el error real y paramos.
            die("ERROR REAL DE MYSQL: " . $PDOException->getMessage());
        } catch (Exception $e) {
            // Capturamos cualquier otro error (como fallos al leer $config)
            die("OTRO ERROR: " . $e->getMessage());
        }

        return $connection;
    }
}
?>