<?php
require_once __DIR__ . '/../src/utils/utils.class.php';
require_once __DIR__ . '/../src/utils/file.class.php';
require_once __DIR__ . '/../src/exceptions/FileException.class.php';
require_once __DIR__ . '/../src/entity/asociado.class.php';
require_once __DIR__ . '/../src/database/connection.class.php';

$errores = [];
$nombre = "";
$descripcion = "";
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = trim(htmlspecialchars($_POST['nombre']));
    $descripcion = trim(htmlspecialchars($_POST['descripcion']));

    if (empty($nombre)) {
        $errores[] = "El nombre del asociado es obligatorio.";
    }

    if (empty($errores)) {
        try {
            $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];

            $logo = new File('logo', $tiposAceptados);

            $logo->saveUploadFile(Asociado::RUTA_LOGOS_ASOCIADOS);

            $conexion = Connection::make();
            $sql = "INSERT INTO asociados (nombre, logo, descripcion) VALUES (:nombre, :logo, :descripcion)";
            $pdoStatement = $conexion->prepare($sql);
            $parametros = [
                ':nombre' => $nombre,
                ':logo' => $logo->getFileName(),
                ':descripcion' => $descripcion
            ];

            if ($pdoStatement->execute($parametros) === false) {
                $errores[] = "No se ha podido guardar el asociado en la base de datos";
            } else {
                $nombre = "";
                $descripcion = "";
                $mensaje = "Se ha guardado el asociado correctamente";
            }

        } catch (FileException $fileException) {
            $errores[] = $fileException->getMessage();
        }
    }
}

require_once __DIR__ . '/views/asociados.view.php';
