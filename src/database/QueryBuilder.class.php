<?php
require_once __DIR__ . '/../exceptions/QueryException.class.php';

class QueryBuilder
{
    /**
     * @var PDO
     */
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(string $tabla, string $classEntity): array
    {
        $sql = "SELECT * FROM $tabla";
        $pdoStatement = $this->connection->prepare($sql);
        
        if ($pdoStatement->execute() === false) {
            throw new QueryException("No se ha podido ejecutar la query solicitada.");
        }
        
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $classEntity);
    }
}
?>