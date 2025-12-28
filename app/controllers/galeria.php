<?php
// Ajustamos las rutas: de "../src" pasamos a "../../src"
require_once __DIR__ . '/../../src/utils/utils.class.php';
require_once __DIR__ . '/../../src/utils/file.class.php';
require_once __DIR__ . '/../../src/exceptions/FileException.class.php';
require_once __DIR__ . '/../../src/entity/imagen.class.php';
require_once __DIR__ . '/../../src/database/QueryBuilder.class.php';
require_once __DIR__ . '/../../src/repository/ImagenesRepository.php';
require_once __DIR__ . '/../../src/repository/CategoriaRepository.php'; 
require_once __DIR__ . '/../../src/core/App.php';
require_once __DIR__ . '/../../src/exceptions/AppException.class.php';
require_once __DIR__ . '/../../src/exceptions/CategoriaException.php'; 

$errores = [];
$imagenes = [];
$categorias = []; 
$titulo = "";
$descripcion = "";
$mensaje = "";

try { 
    $imagenesRepository = new ImagenesRepository();
    
    $categoriaRepository = new CategoriaRepository();
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