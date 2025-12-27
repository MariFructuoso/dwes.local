<?php
require_once __DIR__ . '/../database/QueryBuilder.class.php';

class ImagenesRepository extends QueryBuilder 
{
    public function __construct(string $table='imagenes', string $classEntity='Imagen') 
    {
        parent::__construct($table, $classEntity);
    }
}
?>