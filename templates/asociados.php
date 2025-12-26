<?php
require_once __DIR__ . '/../src/utils/utils.class.php';
require_once __DIR__ . '/../src/utils/file.class.php';
require_once __DIR__ . '/../src/exceptions/FileException.class.php';
require_once __DIR__ . '/../src/entity/asociado.class.php';

$errores = [];
$nombre = "";
$descripcion = "";
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Recogemos datos
    $nombre = trim(htmlspecialchars($_POST['nombre']));
    $descripcion = trim(htmlspecialchars($_POST['descripcion']));

    // Validación del nombre (Obligatorio según PDF)
    if (empty($nombre)) {
        $errores[] = "El nombre del asociado es obligatorio.";
    }

    // Si no hay errores de texto, intentamos subir la imagen
    if (empty($errores)) {
        try {
            $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
            
            // Usamos la clase File para el campo 'logo'
            $logo = new File('logo', $tiposAceptados);
            
            // Guardamos el logo en la carpeta de asociados definida en la clase Asociado
            $logo->saveUploadFile(Asociado::RUTA_LOGOS_ASOCIADOS);
            
            $mensaje = "Asociado guardado correctamente";
            
            // Limpiamos el formulario tras el éxito
            $nombre = "";
            $descripcion = "";

        } catch (FileException $fileException) {
            $errores[] = $fileException->getMessage();
        }
    }
}

require_once __DIR__ . '/views/asociados.view.php';
?>