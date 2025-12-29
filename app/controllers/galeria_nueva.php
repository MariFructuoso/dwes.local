<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use dwes\core\App;
use dwes\app\utils\File;
use dwes\app\entity\Imagen;
use dwes\app\repository\ImagenesRepository;
use dwes\app\exceptions\FileException;
use dwes\app\exceptions\QueryException;
use dwes\app\exceptions\AppException;
use dwes\app\exceptions\CategoriaException;

$errores = [];

try {
    $imagenesRepository = new ImagenesRepository();

    $titulo = trim(htmlspecialchars($_POST['titulo'] ?? ''));
    $descripcion = trim(htmlspecialchars($_POST['descripcion']));
    
    $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
    $imagen = new File('imagen', $tiposAceptados); 

    $categoria = trim(htmlspecialchars($_POST['categoria']));
    
    // Validación básica de categoría
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
?>