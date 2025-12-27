<?php
require_once __DIR__ . '/../src/utils/utils.class.php';
require_once __DIR__ . '/../src/utils/file.class.php';
require_once __DIR__ . '/../src/exceptions/FileException.class.php';
require_once __DIR__ . '/../src/entity/imagen.class.php';
require_once __DIR__ . '/../src/database/connection.class.php';
require_once __DIR__ . '/../src/database/QueryBuilder.class.php';
require_once __DIR__ . '/../src/core/App.php';
require_once __DIR__ . '/../src/exceptions/AppException.class.php';

$errores = [];
$imagenes = [];
$titulo = "";
$descripcion = "";
$mensaje = "";

try {
    $config = require_once __DIR__ . '/../app/config.php';
    App::bind('config', $config);

    $conexion = App::getConnection();

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
            $titulo = "";
            $descripcion = "";
        }
    }

    $queryBuilder = new QueryBuilder($conexion);
    $imagenes = $queryBuilder->findAll('imagenes', 'Imagen');
} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
} catch (QueryException $queryException) {
    $errores[] = $queryException->getMessage();
} catch (AppException $appException) {
    $errores[] = $appException->getMessage();
} catch (PDOException $e) {
    $errores[] = "Error: " . $e->getMessage();
}

require_once 'views/galeria.view.php';
