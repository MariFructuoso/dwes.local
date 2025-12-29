<?php
namespace dwes\core\database;

use PDO;
use dwes\core\App;
use PDOException;
use dwes\app\entity\IEntity;
use dwes\app\exceptions\QueryException; 
use dwes\app\exceptions\NotFoundException;

abstract class QueryBuilder
{
    private $connection;
    private $table;
    private $classEntity;

    public function __construct(string $table, string $classEntity)
    {
        $this->connection = App::getConnection();
        $this->table = $table;
        $this->classEntity = $classEntity;
    }

    private function executeQuery(string $sql): array
    {
        $pdoStatement = $this->connection->prepare($sql);
        
        if ($pdoStatement->execute() === false) {
            throw new QueryException("No se ha podido ejecutar la query solicitada.");
        }
        
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM $this->table";
        return $this->executeQuery($sql);
    }

    public function find(int $id): IEntity
    {
        $sql = "SELECT * FROM $this->table WHERE id=$id";
        
        $result = $this->executeQuery($sql);
        
        if (empty($result)) {
            throw new NotFoundException("No se ha encontrado ningún elemento con id $id.");
        }
        
        return $result[0]; 
    }

    public function save(IEntity $entity): void
    {
        try {
            $parameters = $entity->toArray();
            
            $sql = sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                $this->table,
                implode(', ', array_keys($parameters)),
                ':' . implode(', :', array_keys($parameters))
            );
            
            $statement = $this->connection->prepare($sql);
            $statement->execute($parameters);
            
        } catch (PDOException $exception) {
            throw new QueryException("Error al insertar en la base de datos.");
        }
    }
}
?>