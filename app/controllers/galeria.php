<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use dwes\core\App;
use dwes\app\repository\ImagenesRepository;
use dwes\app\repository\CategoriaRepository;
use dwes\app\exceptions\FileException;
use dwes\app\exceptions\AppException;
use dwes\app\exceptions\CategoriaException;
use dwes\app\exceptions\QueryException; 

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
} catch (PDOException $e) {
    $errores[] = "Error: " . $e->getMessage();
}

require_once __DIR__ . '/../views/galeria.view.php';
?>