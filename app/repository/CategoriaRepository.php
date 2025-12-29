<?php
namespace dwes\app\repository;

use dwes\core\database\QueryBuilder;
use dwes\app\entity\Categoria;

class CategoriaRepository extends QueryBuilder
{
    public function __construct(string $table = 'categorias', string $classEntity = Categoria::class)
    {
        parent::__construct($table, $classEntity);
    }
}
?>