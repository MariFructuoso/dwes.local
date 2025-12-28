<?php
require_once __DIR__ . '/../../src/utils/utils.class.php';
require_once __DIR__ . '/../../src/utils/file.class.php';
require_once __DIR__ . '/../../src/exceptions/FileException.class.php';
require_once __DIR__ . '/../../src/entity/asociado.class.php';
require_once __DIR__ . '/../../src/repository/AsociadosRepository.php';
require_once __DIR__ . '/../../src/core/App.php';
require_once __DIR__ . '/../../src/exceptions/AppException.class.php';

$errores = [];
$asociados = []; 
$nombre = "";
$descripcion = "";
$mensaje = "";

try {
    $config = require __DIR__ . '/../config.php';
    App::bind('config', $config);

    $asociadosRepository = new AsociadosRepository();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nombre = trim(htmlspecialchars($_POST['nombre']));
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));

        if (empty($nombre)) {
            $errores[] = "El nombre del asociado es obligatorio.";
        }

        if (empty($errores)) {
            
            $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
            $logo = new File('logo', $tiposAceptados);

            $logo->saveUploadFile(Asociado::RUTA_LOGOS_ASOCIADOS);

            $nuevoAsociado = new Asociado($nombre, $logo->getFileName(), $descripcion);

            $asociadosRepository->save($nuevoAsociado);

            $nombre = "";
            $descripcion = "";
            $mensaje = "Se ha guardado el asociado correctamente";
        }
    }

    $asociados = $asociadosRepository->findAll();

} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
} catch (QueryException $queryException) {
    $errores[] = $queryException->getMessage();
} catch (AppException $appException) {
    $errores[] = $appException->getMessage();
} catch (PDOException $e) {
    $errores[] = "Error de base de datos: " . $e->getMessage();
}

require_once __DIR__ . '/../views/asociados.view.php';
?>