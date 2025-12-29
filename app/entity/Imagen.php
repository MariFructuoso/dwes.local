<?php
namespace dwes\app\entity;

class Imagen implements IEntity
{
    const RUTA_IMAGENES_PORTFOLIO = '/public/images/index/portfolio/';
    const RUTA_IMAGENES_GALERIA = '/public/images/index/gallery/';
    const RUTA_IMAGENES_CLIENTES = '/public/images/clients/';
    const RUTA_IMAGENES_SUBIDAS = '/public/images/galeria/';

    private $id;
    private $nombre;
    private $descripcion;
    private $categoria; 
    private $numVisualizaciones;
    private $numLikes;
    private $numDownloads;

    public function __construct($nombre = "", $descripcion = "", $categoria = 1, $numVisualizaciones = 0, $numLikes = 0, $numDownloads = 0)
    {
        $this->id = null;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->categoria = $categoria;
        $this->numVisualizaciones = $numVisualizaciones;
        $this->numLikes = $numLikes;
        $this->numDownloads = $numDownloads;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): Imagen
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): Imagen
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria(int $categoria): Imagen
    {
        $this->categoria = $categoria;
        return $this;
    }

    public function getNumVisualizaciones()
    {
        return $this->numVisualizaciones;
    }

    public function setNumVisualizaciones(int $numVisualizaciones): Imagen
    {
        $this->numVisualizaciones = $numVisualizaciones;
        return $this;
    }

    public function getNumLikes()
    {
        return $this->numLikes;
    }

    public function setNumLikes(int $numLikes): Imagen
    {
        $this->numLikes = $numLikes;
        return $this;
    }

    public function getNumDownloads()
    {
        return $this->numDownloads;
    }

    public function setNumDownloads(int $numDownloads): Imagen
    {
        $this->numDownloads = $numDownloads;
        return $this;
    }

    public function __toString()
    {
        return $this->descripcion;
    }

    public function getUrlPortfolio()
    {
        return self::RUTA_IMAGENES_PORTFOLIO . $this->nombre;
    }

    public function getUrlGaleria()
    {
        return self::RUTA_IMAGENES_GALERIA . $this->nombre;
    }

    public function getUrlClientes()
    {
        return self::RUTA_IMAGENES_CLIENTES . $this->nombre;
    }

    public function getUrlSubidas()
    {
        return self::RUTA_IMAGENES_SUBIDAS . $this->nombre;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'descripcion' => $this->getDescripcion(),
            'numVisualizaciones' => $this->getNumVisualizaciones(),
            'numLikes' => $this->getNumLikes(),
            'numDownloads' => $this->getNumDownloads(),
            'categoria' => $this->getCategoria()
        ];
    }
}