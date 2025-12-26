<?php
class Imagen
{
    // Constantes de rutas definidas en el PDF
    const RUTA_IMAGENES_PORTFOLIO = '/public/images/index/portfolio/';
    const RUTA_IMAGENES_GALERIA = '/public/images/index/gallery/';
    const RUTA_IMAGENES_CLIENTES = '/public/images/clients/';
    const RUTA_IMAGENES_SUBIDAS = '/public/images/galeria/';

    // Atributos privados
    private $id;
    private $nombre;
    private $descripcion;
    private $categoria;
    private $numVisualizaciones;
    private $numLikes;
    private $numDownloads;

    // Constructor: id no se pasa. Los numéricos valen 0 por defecto.
    public function __construct($nombre, $descripcion, $categoria = 0, $numVisualizaciones = 0, $numLikes = 0, $numDownloads = 0)
    {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->categoria = $categoria;
        $this->numVisualizaciones = $numVisualizaciones;
        $this->numLikes = $numLikes;
        $this->numDownloads = $numDownloads;
    }

    // GETTERS Y SETTERS
    // (No se crea setId, y los setters devuelven el objeto Imagen)

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

    // Método __toString que devuelve solamente la descripción
    public function __toString()
    {
        return $this->descripcion;
    }

    // Métodos para obtener las URLs completas (ruta + nombre)
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
}
?>