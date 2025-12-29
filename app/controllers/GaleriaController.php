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
// Importamos el Helper
use dwes\core\helpers\FlashMessage;

class GaleriaController
{
    public function index()
    {
        $errores = FlashMessage::get('errores', []);
        $mensaje = FlashMessage::get('mensaje');
        $descripcion = FlashMessage::get('descripcion');
        $categoriaSeleccionada = FlashMessage::get('categoriaSeleccionada');
        
        // Variables por defecto si no vienen de sesión
        $titulo = FlashMessage::get('titulo');
        $imagenes = [];
        $categorias = [];

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
            compact('errores', 'imagenes', 'categorias', 'titulo', 'descripcion', 'mensaje', 'imagenesRepository', 'categoriaSeleccionada')
        );
    }

    public function show($id)
    {
        $imagenesRepository = App::getRepository(ImagenesRepository::class);
        $imagen = $imagenesRepository->find($id);
        Response::renderView(
            'imagen-show',
            'layout',
            compact('imagen', 'imagenesRepository')
        );
    }

    public function nueva()
    {
        try {
            $imagenesRepository = App::getRepository(ImagenesRepository::class);

            $titulo = trim(htmlspecialchars($_POST['titulo'] ?? ''));
            $descripcion = trim(htmlspecialchars($_POST['descripcion']));
            $categoria = trim(htmlspecialchars($_POST['categoria']));

            // Guardamos los datos recibidos en FlashMessage para repoblar el formulario si hay error
            FlashMessage::set('descripcion', $descripcion);
            FlashMessage::set('categoriaSeleccionada', $categoria);
            FlashMessage::set('titulo', $titulo);

            $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
            $imagen = new File('imagen', $tiposAceptados);

            if (empty($categoria)) {
                throw new CategoriaException;
            }

            $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);

            $imagenGaleria = new Imagen($imagen->getFileName(), $descripcion, $categoria);
            $imagenesRepository->save($imagenGaleria);

            $mensaje = "Se ha guardado una imagen: " . $imagenGaleria->getNombre();
            App::get('logger')->add($mensaje);
            
            // Guardamos mensaje de éxito
            FlashMessage::set('mensaje', $mensaje);
            
            // Limpiamos los datos del formulario de la sesión porque ha sido un éxito
            FlashMessage::unset('descripcion');
            FlashMessage::unset('categoriaSeleccionada');

        } catch (FileException $fileException) {
            FlashMessage::set('errores', [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        } catch (CategoriaException $e) {
            FlashMessage::set('errores', ["No se ha seleccionado una categoría válida"]);
        }

        // Siempre redirigimos a galeria (PRG Pattern)
        App::get('router')->redirect('galeria');
    }
}