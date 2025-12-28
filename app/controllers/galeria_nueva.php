<?php
require_once __DIR__ . '/../../src/core/App.php';
require_once __DIR__ . '/../../src/utils/file.class.php';
require_once __DIR__ . '/../../src/entity/imagen.class.php'; 
require_once __DIR__ . '/../../src/repository/ImagenesRepository.php';
require_once __DIR__ . '/../../src/exceptions/FileException.class.php'; 
require_once __DIR__ . '/../../src/exceptions/CategoriaException.php';
require_once __DIR__ . '/../../src/exceptions/AppException.class.php';

try {
    $imagenesRepository = new ImagenesRepository();

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
    // Opción rápida para ver el error: imprimirlo y detener
    echo "<div class='alert alert-danger'><ul>";
    foreach ($errores as $error) {
        echo "<li>" . $error . "</li>";
    }
    echo "</ul><p><a href='/galeria'>Volver a intentar</a></p></div>";
    die(); 
}
?>