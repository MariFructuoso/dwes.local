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
    private $usuario_id;

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function getDescripcion() { return $this->descripcion; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }
    public function getFechaInicio() { return $this->fecha_inicio; }
    public function setFechaInicio($fecha) { $this->fecha_inicio = $fecha; }
    public function getFechaFin() { return $this->fecha_fin; }
    public function setFechaFin($fecha) { $this->fecha_fin = $fecha; }
    public function getActiva() { return $this->activa; }
    public function setActiva($activa) { $this->activa = $activa; }
    public function getUsuarioId() { return $this->usuario_id; }
    public function setUsuarioId($id) { $this->usuario_id = $id; }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'activa' => $this->activa,
            'usuario_id' => $this->usuario_id
        ];
    }
}