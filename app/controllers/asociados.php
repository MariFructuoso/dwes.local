<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use dwes\core\App;
use dwes\app\utils\File;
use dwes\app\entity\Asociado;
use dwes\app\repository\AsociadosRepository;
use dwes\app\exceptions\FileException;
use dwes\app\exceptions\QueryException;
use dwes\app\exceptions\AppException;
use PDOException;

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