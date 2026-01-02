<?php
namespace dwes\app\repository;

use dwes\core\database\QueryBuilder;
use dwes\app\entity\Exposicion;

class ExposicionRepository extends QueryBuilder
{
    public function __construct(string $table = 'exposiciones', string $classEntity = Exposicion::class)
    {
        parent::__construct($table, $classEntity);
    }

    public function guardarRelacionImagen(int $idImagen, int $idExposicion)
    {
        $sql = "INSERT INTO exposiciones_imagenes (id_imagen, id_exposicion) VALUES (:id_img, :id_exp)";
        $statement = $this->connection->prepare($sql);
        return $statement->execute([
            'id_img' => $idImagen,
            'id_exp' => $idExposicion
        ]);
    }
}