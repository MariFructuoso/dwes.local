<?php
require_once __DIR__ . '/../database/QueryBuilder.class.php';
require_once __DIR__ . '/../repository/CategoriaRepository.php';
require_once __DIR__ . '/../entity/Categoria.class.php';

class ImagenesRepository extends QueryBuilder 
{
    public function __construct(string $table='imagenes', string $classEntity='Imagen') 
    {
        parent::__construct($table, $classEntity);
    }

    /**
     * @param Imagen $imagenGaleria
     * @return Categoria
     * @throws NotFoundException
     * @throws QueryException
     */
    public function getCategoria(Imagen $imagenGaleria): Categoria
    {
        $categoriaRepository = new CategoriaRepository();
        return $categoriaRepository->find($imagenGaleria->getCategoria());
    }
}
?>