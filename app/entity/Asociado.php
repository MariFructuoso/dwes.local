<?php
namespace dwes\app\entity;

class Asociado implements IEntity
{
    const RUTA_LOGOS_ASOCIADOS = '/public/images/asociados/';

    private $id;
    private $nombre;
    private $logo;
    private $descripcion;

    public function __construct($nombre = "", $logo = "", $descripcion = "")
    {
        $this->id = null;
        $this->nombre = $nombre;
        $this->logo = $logo;
        $this->descripcion = $descripcion;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getUrl()
    {
        return self::RUTA_LOGOS_ASOCIADOS . $this->logo;
    }

    public function __toString()
    {
        return $this->descripcion;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'logo' => $this->logo,
            'descripcion' => $this->descripcion
        ];
    }
}
?>