<?php
namespace dwes\app\entity; 

class Categoria implements IEntity
{
    private $id;
    private $nombre;
    private $numImagenes;

    public function __construct(string $nombre = "", int $numImagenes = 0)
    {
        $this->id = null;
        $this->nombre = $nombre;
        $this->numImagenes = $numImagenes;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getNumImagenes(): int
    {
        return $this->numImagenes;
    }

    public function setNumImagenes(int $numImagenes): void
    {
        $this->numImagenes = $numImagenes;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'numImagenes' => $this->numImagenes
        ];
    }
}