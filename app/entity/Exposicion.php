<?php
namespace dwes\app\entity;

class Exposicion implements IEntity
{
    private $id;
    private $nombre;
    private $descripcion;
    private $fecha_inicio;
    private $fecha_fin;
    private $activa;
    private $usuario; // Esta propiedad guarda el ID en memoria

    public function __construct($nombre = "", $descripcion = "", $fecha_inicio = null, $fecha_fin = null, $activa = 1)
    {
        $this->id = null;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->activa = $activa;
    }

    public function getId() { return $this->id; }

    public function getNombre() { return $this->nombre; }
    public function setNombre($nombre) { $this->nombre = $nombre; return $this; }

    public function getDescripcion() { return $this->descripcion; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; return $this; }

    public function getFechaInicio() { return $this->fecha_inicio; }
    public function setFechaInicio($fecha) { $this->fecha_inicio = $fecha; return $this; }

    public function getFechaFin() { return $this->fecha_fin; }
    public function setFechaFin($fecha) { $this->fecha_fin = $fecha; return $this; }

    public function getActiva() { return $this->activa; }
    public function setActiva($activa) { $this->activa = $activa; return $this; }

    public function getUsuarioId() { return $this->usuario; }
    public function setUsuarioId($usuario) { $this->usuario = $usuario; return $this; }

    public function __toString() { return $this->nombre; }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'activa' => $this->activa,
            'usuario_id' => $this->usuario 
        ];
    }
}