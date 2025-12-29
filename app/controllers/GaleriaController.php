<?php
namespace dwes\app\controllers;

use dwes\core\App;
use dwes\core\Response;
use dwes\app\utils\File;
use dwes\app\entity\Imagen;
use dwes\app\repository\ImagenesRepository;
use dwes\app\repository\CategoriaRepository;
use dwes\app\exceptions\FileException;
use dwes\app\exceptions\AppException;
use dwes\app\exceptions\CategoriaException;
use dwes\app\exceptions\QueryException;

class GaleriaController
{
    public function index()
    {
        $errores = [];
        $imagenes = [];
        $categorias = [];
        $titulo = "";
        $descripcion = "";
        $mensaje = "";

        try {
            $imagenesRepository = App::getRepository(ImagenesRepository::class);
            $categoriaRepository = App::getRepository(CategoriaRepository::class);
            $categorias = $categoriaRepository->findAll();
            $imagenes = $imagenesRepository->findAll();
        } catch (FileException $fileException) {
            $errores[] = $fileException->getMessage();
        } catch (QueryException $queryException) {
            $errores[] = $queryException->getMessage();
        } catch (AppException $appException) {
            $errores[] = $appException->getMessage();
        } catch (CategoriaException $categoriaException) {
            $errores[] = "No se ha seleccionado una categoría válida";
        } catch (\PDOException $e) {
            $errores[] = "Error: " . $e->getMessage();
        }

        Response::renderView(
            'galeria',
            'layout',
            compact('errores', 'imagenes', 'categorias', 'titulo', 'descripcion', 'mensaje', 'imagenesRepository')
        );
    }

    public function nueva()
    {
        $errores = [];

        try {
            $imagenesRepository = App::getRepository(ImagenesRepository::class);

            $titulo = trim(htmlspecialchars($_POST['titulo'] ?? ''));
            $descripcion = trim(htmlspecialchars($_POST['descripcion']));

            $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
            $imagen = new File('imagen', $tiposAceptados);

            $categoria = trim(htmlspecialchars($_POST['categoria']));

            if (empty($categoria)) {
                throw new CategoriaException;
            }

            $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);

            $imagenGaleria = new Imagen($imagen->getFileName(), $descripcion, $categoria);
            $imagenesRepository->save($imagenGaleria);

            App::get('logger')->add("Se ha guardado una imagen: " . $imagenGaleria->getNombre());

            App::get('router')->redirect('galeria');
        } catch (FileException $fileException) {
            $errores[] = $fileException->getMessage();
        } catch (QueryException $queryException) {
            $errores[] = $queryException->getMessage();
        } catch (AppException $appException) {
            $errores[] = $appException->getMessage();
        } catch (CategoriaException $e) {
            $errores[] = "No se ha seleccionado una categoría válida";
        }

        if (!empty($errores)) {
            echo "<div class='alert alert-danger'><ul>";
            foreach ($errores as $error) {
                echo "<li>" . $error . "</li>";
            }
            echo "</ul><p><a href='/galeria'>Volver a intentar</a></p></div>";
            die();
        }
    }
}