<?php
namespace dwes\app\controllers;

use dwes\core\App;
use dwes\core\Response;
use dwes\app\utils\File;
use dwes\app\entity\Asociado;
use dwes\app\repository\AsociadosRepository;
use dwes\app\exceptions\FileException;
use dwes\app\exceptions\QueryException;
use dwes\app\exceptions\AppException;

class AsociadosController
{
    public function index()
    {
        $errores = [];
        $asociados = [];
        $nombre = "";
        $descripcion = "";
        $mensaje = "";

        try {
            $asociadosRepository = App::getRepository(AsociadosRepository::class);

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
        } catch (\PDOException $e) {
            $errores[] = "Error de base de datos: " . $e->getMessage();
        }

        Response::renderView(
            'asociados',
            'layout',
            compact('errores', 'asociados', 'nombre', 'descripcion', 'mensaje')
        );
    }
}