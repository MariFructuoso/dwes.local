<?php
// Añadimos el require hacia FileException [cite: 261]
require_once __DIR__ . '/../exceptions/FileException.class.php';

class File
{
    private $file; 
    private $fileName; 

    /**
     * @param string $fileName
     * @param array $arrTypes
     * @throws FileException
     */
    public function __construct(string $fileName, array $arrTypes)
    {
        $this->file = $_FILES[$fileName]; 
        $this->fileName = "";

        if (!isset($this->file)) 
        {
            // [cite: 264]
            throw new FileException('Debes seleccionar un fichero');
        }

        if ($this->file['error'] !== UPLOAD_ERR_OK) {
            switch ($this->file['error']) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new FileException('El fichero es demasiado grande');
                    break;
                case UPLOAD_ERR_PARTIAL:
                    throw new FileException('No se ha podido subir el fichero completo');
                    break;
                default:
                    throw new FileException('No se ha podido subir el fichero');
                    break;
            }
        }

        if (in_array($this->file['type'], $arrTypes) === false) {
            // [cite: 272]
            throw new FileException('Tipo de fichero no soportado');
        }
    }

    /**
     * @param string $rutaDestino
     * @return void
     * @throws FileException
     */
    public function saveUploadFile(string $rutaDestino)
    {
        // Primero hay que comprobar que el fichero se ha subido desde el formulario.
        if (is_uploaded_file($this->file['tmp_name']) === false) {
            throw new FileException('El archivo no ha sido subido mediante un formulario.');
        }

        $this->fileName = $this->file['name'];
        $ruta = $rutaDestino . $this->fileName;

        // Comprobamos si ya existe el fichero
        if (is_file($_SERVER['DOCUMENT_ROOT'] . $ruta) === true) {
            // Generamos un nombre aleatorio
            $idUnico = time();
            $this->fileName = $idUnico . "_" . $this->fileName;
            $ruta = $rutaDestino . $this->fileName;
        }

        if (move_uploaded_file($this->file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $ruta) === false) {
            throw new FileException('No se puede mover el archivo a su destino');
        }
    }

    public function getFileName()
    {
        return $this->fileName;
    }
}
?>