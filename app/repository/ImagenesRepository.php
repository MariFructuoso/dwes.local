<?php
namespace dwes\app\repository;

use dwes\core\database\QueryBuilder;
use dwes\app\entity\Imagen;
use dwes\app\entity\Categoria;

class ImagenesRepository extends QueryBuilder 
{
    public function __construct(string $table='imagenes', string $classEntity=Imagen::class) 
    {
        parent::__construct($table, $classEntity);
    }

    public function getCategoria(Imagen $imagenGaleria): Categoria
    {
        $categoriaRepository = new CategoriaRepository();
        return $categoriaRepository->find($imagenGaleria->getCategoria());
    }
}
?>