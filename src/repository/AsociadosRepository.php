<?php
// src/repository/AsociadosRepository.php
require_once __DIR__ . '/../database/QueryBuilder.class.php';

class AsociadosRepository extends QueryBuilder 
{
    public function __construct(string $table='asociados', string $classEntity='Asociado') 
    {
        
        parent::__construct($table, $classEntity);
    }
}
?>