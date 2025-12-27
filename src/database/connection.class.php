<?php
class Connection
{
    public static function make()
    {
        try {
            $opciones = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => true
            ];
            
            $connection = new PDO(
                'mysql:host=localhost;dbname=cursophp;charset=utf8',
                'usercurso', 
                'php',       
                $opciones
            );
            
            return $connection;
            
        } catch (PDOException $PDOException) {
            die($PDOException->getMessage());
        }
    }
}
?>