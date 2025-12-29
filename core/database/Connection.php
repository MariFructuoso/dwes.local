<?php
namespace dwes\core\database;

use PDO;
use PDOException;
use Exception;
use dwes\core\App; 

class Connection
{
    /**
     * @return PDO
     * @throws Exception
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
            die("ERROR REAL DE MYSQL: " . $PDOException->getMessage());
        } catch (Exception $e) {
            die("OTRO ERROR: " . $e->getMessage());
        }

        return $connection;
    }
}
?>