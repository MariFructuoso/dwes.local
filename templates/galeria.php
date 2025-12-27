<?php
require_once __DIR__ . '/../src/utils/utils.class.php';
require_once __DIR__ . '/../src/utils/file.class.php';
require_once __DIR__ . '/../src/exceptions/FileException.class.php';
require_once __DIR__ . '/../src/entity/imagen.class.php';
require_once __DIR__ . '/../src/database/connection.class.php';
require_once __DIR__ . '/../src/database/QueryBuilder.class.php'; // <--- Importante

$errores = [];
$imagenes = []; // Aquí guardaremos las fotos de la BD
$descripcion = "";
$mensaje = "";
$titulo = "";

try {
    $conexion = Connection::make();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = trim(htmlspecialchars($_POST['titulo']));
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
        
        $imagen = new File('imagen', $tiposAceptados); 
        
        $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);

        $sql = "INSERT INTO imagenes (nombre, descripcion, categoria) VALUES (:nombre, :descripcion, :categoria)";
        $pdoStatement = $conexion->prepare($sql);
        
        $parametros = [
            ':nombre' => $imagen->getFileName(),
            ':descripcion' => $descripcion,
            ':categoria' => 1
        ];

        if ($pdoStatement->execute($parametros) === false) {
            $errores[] = "No se ha podido guardar la imagen en la base de datos";
        } else {
            $mensaje = "Se ha guardado la imagen correctamente";
            $descripcion = "";
            $titulo = "";
    
        }
    }

    $queryBuilder = new QueryBuilder($conexion);
    $imagenes = $queryBuilder->findAll('imagenes', 'Imagen');

} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
} catch (QueryException $queryException) {
    $errores[] = $queryException->getMessage();
} catch (PDOException $e) {
    $errores[] = "Error de base de datos: " . $e->getMessage();
}

require_once __DIR__ . '/views/galeria.view.php';
?>