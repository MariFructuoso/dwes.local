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

        $titulo = FlashMessage::get('titulo');
        $imagenes = [];
        $categorias = [];

        try {
            $imagenesRepository = App::getRepository(ImagenesRepository::class);
            $categoriaRepository = App::getRepository(CategoriaRepository::class);
            $categorias = $categoriaRepository->findAll();

            // --- CORRECCIÓN ERROR 403/FATAL ---
            // Obtenemos el ID del usuario directamente de la sesión.
            // $_SESSION['loguedUser'] guarda el ID (un entero), no el objeto.
            $usuarioId = $_SESSION['loguedUser'];

            // Usamos el ID directamente para filtrar
            $imagenes = $imagenesRepository->findByUsuario($usuarioId);
            
        } catch (\Exception $e) {
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

            // Creamos la imagen con los datos del formulario
            $imagenGaleria = new Imagen($imagen->getFileName(), $descripcion, $categoria);
            
            // --- CORRECCIÓN IMPORTANTE ---
            // Asignamos el usuario a la imagen para que se guarde como TUYA.
            // Asumimos que tu entidad Imagen tiene un método setUsuario($id)
            $imagenGaleria->setUsuario($_SESSION['loguedUser']); 

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

    public function borrar($id)
    {
        try {
            $imagenesRepository = App::getRepository(ImagenesRepository::class);
            // Llamamos a la función borrar que añadimos al QueryBuilder
            $imagenesRepository->borrar($id);
            FlashMessage::set('mensaje', "Imagen eliminada correctamente.");
        } catch (\Exception $e) {
            FlashMessage::set('errores', ["No se pudo eliminar la imagen: " . $e->getMessage()]);
        }
        App::get('router')->redirect('galeria');
    }
    
    public function editar($id)
    {
        $imagenesRepository = App::getRepository(ImagenesRepository::class);
        $categoriaRepository = App::getRepository(CategoriaRepository::class);
        
        $imagen = $imagenesRepository->find($id);
        /** @var Imagen $imagen */
        $categorias = $categoriaRepository->findAll();
        
        // CORRECCIÓN: Usamos $_SESSION['loguedUser'] directamente porque es el ID (número)
        if ($imagen->getUsuario() != $_SESSION['loguedUser']) {
             App::get('router')->redirect('galeria'); 
        }

        Response::renderView(
            'galeria-editar',
            'layout',
            compact('imagen', 'categorias')
        );
    }

    public function update()
    {
        try {
            $id = $_POST['id'];
            $imagenesRepository = App::getRepository(ImagenesRepository::class);
            $imagen = $imagenesRepository->find($id);
            /** @var Imagen $imagen */

            // Actualizamos los datos
            $imagen->setNombre($_POST['titulo']);
            $imagen->setDescripcion($_POST['descripcion']);
            $imagen->setCategoria($_POST['categoria']);
            
            // CORRECCIÓN: Aseguramos que el usuario sigue siendo el mismo (usando la sesión directa)
            $imagen->setUsuario($_SESSION['loguedUser']);

            $imagenesRepository->update($imagen);
            
            FlashMessage::set('mensaje', "Imagen actualizada correctamente.");
            
        } catch (\Exception $e) {
            FlashMessage::set('errores', ["No se pudo actualizar: " . $e->getMessage()]);
        }
        
        App::get('router')->redirect('galeria');
    }
}