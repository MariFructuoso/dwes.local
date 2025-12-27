<?php
require_once __DIR__ . '/../database/QueryBuilder.class.php';
require_once __DIR__ . '/../entity/Categoria.class.php';

class CategoriaRepository extends QueryBuilder
{
    public function __construct(string $table = 'categorias', string $classEntity = 'Categoria')
    {
        parent::__construct($table, $classEntity);
    }
}