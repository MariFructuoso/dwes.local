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

    private function executeQuery(string $sql, array $parameters = []): array
    {
        $pdoStatement = $this->connection->prepare($sql);

        if ($pdoStatement->execute($parameters) === false) {
            throw new \dwes\app\exceptions\QueryException("No se ha podido ejecutar la query solicitada.");
        }

        return $pdoStatement->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->classEntity);
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

    public function findBy(array $filters): array
    {
        $sql = "SELECT * FROM $this->table " . $this->getFilters($filters);
        return $this->executeQuery($sql, $filters);
    }

    public function findOneBy(array $filters): ?\dwes\app\entity\IEntity
    {
        $result = $this->findBy($filters);
        if (count($result) > 0) {
            return $result[0];
        }
        return null;
    }
    private function getFilters(array $filters)
    {
        if (empty($filters)) return "";

        $strFilters = [];
        foreach ($filters as $key => $value) {
            $strFilters[] = "$key = :$key";
        }
        return " WHERE " . implode(' AND ', $strFilters);
    }
    public function findByUsuario(int $idUsuario): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE usuario = :idUsuario";
        return $this->executeQuery($sql, ['idUsuario' => $idUsuario]);
    }
    public function borrar(int $id): void
    {
        try {
            $sql = "DELETE FROM {$this->table} WHERE id = :id";
            $statement = $this->connection->prepare($sql);
            $statement->execute(['id' => $id]);
        } catch (PDOException $e) {
            throw new QueryException("Error al borrar el registro con ID {$id}");
        }
    }
    public function update(IEntity $entity)
    {
        try {
            $parameters = $entity->toArray();
            $id = $parameters['id'];
            unset($parameters['id']);
            unset($parameters['usuario']); 

            $sql = sprintf(
                'UPDATE %s SET %s WHERE id = :id',
                $this->table,
                implode(', ', array_map(function ($key) {
                    return "$key = :$key";
                }, array_keys($parameters)))
            );

            $parameters['id'] = $id; 

            $statement = $this->connection->prepare($sql);
            $statement->execute($parameters);
            
        } catch (\PDOException $e) {
            throw new QueryException("Error al actualizar el elemento: " . $e->getMessage());
        }
    }
}
